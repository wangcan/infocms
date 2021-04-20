<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserSourceEnum;
use App\Models\User;
use App\Services\WechatServe;
use Illuminate\Http\Request;
use Overtrue\Socialite\AuthorizeFailedException;
use Overtrue\Socialite\SocialiteManager;


use App\Models\User;
use Auth;
use Socialite;

class AuthLoginController extends Controller
{
    protected $allow = ['github', 'qq', 'weibo'];

    /**
     * @group auth登录模块
     *
     * dev:qrcode微信开放平台二维码
     *
     * 客户端验证认证用户信息，当客户为非登录用户时，需调用本接口
	 *
	 * 备注：pad系统下，除了获取登录二维码、扫码回调等操作外，其他所有操作均需要登录之后才可以操作；
	 * 用户登录的token时效可以自定义，当前设置为8个小时；前端开发，可以用自己的微信扫码登录；
	 *
	 * 另外为了方便前端开发调试，设置了四个类型的测试用户；前端开发时，可以通过指定请求参数，强制指定当前登录用户
	 * 方式为指定get参数： ?test_user=vip   参数有四个选项： 
	 *
	 * new  没有课程
	 *
	 * simple 只有一门课程
	 *
	 * common 有多门课程
	 *
	 * vip   有很多课程
	 *
	 * 
	 * 如  ?test_user=vip 接口会强制把vip用户设置为当前登录用户
     *
     * @response {
     *   "status": 0,
     *   "message": "success",
     *   "data": {"qrcode_url": "https://open.weixin.qq.com/connect/qrconnect?appid=&redirect_uri=&response_type=code&scope=snsapi_login&state=#wechat_redirect"}
     * }
     */
    public function qrcode()
    {
        $wechat = new WechatServe();
        $url = $wechat->getAuthurl();
        return responseJson(0, 'success', ['qrcode_url' => $url]);
    }

    /**
     * @group auth登录模块
     *
     * dev:qrscan客户端扫码
     *
     * 扫码后，调用www.liupinshuyuan.com下的一个接口；接口返回一个Token；Token作为用户的登录凭证；
	 *
	 * 获取到Token后，后续需要登录用户才能操作的请求，需在请求的header里带上token信息，header的变量名为Authorization，值为："Bearer {Token}" Bearer与token之间要有一个空格；
     *
     * 注意：下面还有个qrscan客户端扫码接口，proxypad/wxlogin.html 那个可以理解为这个接口的别名；用来接收从www.liupinshuyuan.com 域名反向解析用的；微信扫码的回调只能用 www.liupinshuyuan.com 域名；回调的扫码登录功能通过proxypad/wxlogin.html  重定向到本接口，完成扫码登录操作
     *
     * @return Array
     * @response {
     *   "status": 0,
     *   "message": "success",
     *   "data": {
     *     "prefix": "Bearer",
     *     "token": "token",
     *     "myinfo": {
     *       "uid": "用户ID",
     *       "uname": "用户名",
     *       "sex": "性别",
     *       "avatar": "用户头像"
     *     }
     *   }
     * }
     */
    public function qrscan(Request $request)
    {
		//$wechat->pointScopes = $pointScopes;
		//$wechat->pointParam = $pointParam;
		$code = $request->input('code');
		if (empty($code)) {
			return responseJson(1, '参数有误');
		}
		$wechat = new WechatServe();
		$app = $wechat->getWechatServe('official');
        $userInfo = $wechat->initUserInfo($app->oauth);
		if (empty($userInfo)) {
			return responseJson(1, '获取微信信息失败');
		}
		$userLogin = new UserLogin;
        $user = $userLogin->getExist($userInfo, 'pad');
        //$user = new User;
        //$user = $user->query()->where('uid', 629239)->first();
		if (empty($user)) {
			$userModel = new User();
			$userInfo['ip'] = $request->getClientIp();
			$user = $userModel->createBywechat($userInfo);
		}
        return responseJson(0, 'success', $this->getToken($user));
    }
    
    /**
     * 第三方授权登录跳转
     *
     * @param $driver
     * @return mixed
     */
    public function redirectToAuth($driver)
    {
        if (! in_array($driver, $this->allow) || ! config()->has("socialite.{$driver}")) {

            abort(403, '未知的第三方登录');
        }

        $socialite = new SocialiteManager(config('socialite'));

        return $socialite->driver($driver)->redirect();
    }
    
    
    /**
     * 第三方授权认证回调
     *
     * @param $driver
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function handleCallback($driver)
    {

        if (! in_array($driver, $this->allow) || ! config()->has("socialite.{$driver}")) {

            abort(403, '未知的第三方登录');
        }

        try {

            $socialite = new SocialiteManager(config('socialite'));
            $socialiteUser = $socialite->driver($driver)->user();
        } catch (AuthorizeFailedException $e) {

            return view('hint.error', ['status' => $e->getMessage(), 'url' => route('login')]);
        }

        /**
         * 处理第三方登录用户信息
         *
         * @var $user User
         */
        $user = $this->findOrCreateMatchUser($socialiteUser);

        // 如果用户已经登录的，作为绑定账号。跳转到个人中心页面
        if (auth()->check()) {

            return redirect('/user/setting')->with('status', '绑定成功');
        }

        // 第三方如果没有登录，那么主动登录
        auth()->login($user, true);
        // 登录次数
        $user->increment('login_count');

        // 如果 session 中有跳转 url，则跳转
        return redirect()->intended();
    }

    /**
     * 找到数据库匹配的记录，并存储用户
     *
     * @param \Overtrue\Socialite\User $socialiteUser
     * @return mixed
     */
    protected function findOrCreateMatchUser(\Overtrue\Socialite\User $socialiteUser)
    {
        // 新建用户
        $driver = strtoupper($socialiteUser->getProviderName());
        $idField = "{$driver}_id";
        $nameField = "{$driver}_name";

        /**
         * 如果是已经登录的用户
         * @var $user User
         */
        if ($user = auth()->user()) {
            $user->setAttribute($idField, $socialiteUser->getId())
                 ->setAttribute($nameField, $socialiteUser->getName())
                 ->save();

            return $user;
        }

        // 如果用户没有登录，就是使用第三方账号登录
        // 如果数据库没有记录就创建，有就修改一下显示名
        $user = User::query()->firstOrNew([$idField => $socialiteUser->getId()]);
        $user->$nameField = $socialiteUser->getName();
        // 用户的来源
        $sources = UserSourceEnum::toArray();
        $user->source = $sources[$driver] ?? array_first($sources);

        // 如果用户不存在
        if (! $user->exists) {

            if ($socialiteUser->getAvatar()) {
                $user->avatar = $socialiteUser->getAvatar();
            }

            // 用户的密码是初始的，可以不用输入旧密码修
            //// 使用第三方登录的用户，默认激活
            $user->is_active = 1;
            $user->is_init_name = 1;
            $user->is_init_email = 1;
            $user->is_init_password = 1;
        }

        $user->save();

        return $user;
    }
    
    
    /**
     * 解绑第三方账号
     *
     * @param $driver
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unBind($driver, Request $request)
    {
        if (! in_array($driver, $this->allow) || ! config()->has("socialite.{$driver}")) {

            return back()->withErrors(['msg' => '未知的第三方登录']);
        }


        // 可以做更多的判断，如用 QQ 注册的不能解绑之类的
        /**
         * @var $user User
         */
        $idField = "{$driver}_id";
        $nameField = "{$driver}_name";
        $user = $request->user();
        $user->setAttribute($idField, null)->setAttribute($nameField, null)->save();


        return back()->with('status', '解绑成功');
    }
}
<?php

namespace App\Http\Controllers\Auth;

class AuthController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (Exception $e) {
            return redirect()->route('login');
        }

        $authUser = $this->findOrCreateUser($user, $provider);

        Auth::login($authUser, true);

        return redirect()->route('home')->withSuccess(__('auth.logged_in_provider', ['provider' => $provider]));
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $user
     * @return User
     */
    private function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();

        if ($authUser) {
            return $authUser;
        }

        return User::create([
                        'name' => $user->name ?? $user->email,
                        'email' => $user->email,
                        'provider' => $provider,
                        'provider_id' => $user->id
                    ]);
    }
}

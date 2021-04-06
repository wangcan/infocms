<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Models\UserLogin;
use App\Models\PadPassword;
use App\Services\WechatServe;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     * 要求附带email和password（数据来源users表）
     * 
     * @return void
     */
    public function __construct()
    {
        // 这里额外注意了：官方文档样例中只除外了『login』
        // 这样的结果是，token 只能在有效期以内进行刷新，过期无法刷新
        // 如果把 refresh 也放进去，token 即使过期但仍在刷新期以内也可刷新
        // 不过刷新一次作废
        $this->middleware('auth:api', ['except' => ['login', 'qrcode', 'qrscan', 'logout']]);
        // 另外关于上面的中间件，官方文档写的是『auth:api』
        // 但是我推荐用 『jwt.auth』，效果是一样的，但是有更加丰富的报错信息返回
    }

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
     * @group auth登录模块
     *
     * dev:login账号密码登录，暂时用不到
	 * 获取到Token后，后续需要登录用户才能操作的请求，需在请求的header里带上token信息，header的变量名为Authorization，值为："Bearer {Token}" Bearer与token之间要有一个空格；
     *
     * @return Array
     * @response {
     *   "code": 200,
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
    public function login(LoginRequest $request)
    {
        /*$credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);*/

        $name = $request->input('name');
        $password = $request->input('password');
        if (empty($name) || empty($password)) {
            //return response()->json(['status' => 400, 'message' => '账号或密码为空']);
            return responseJsonHttp(400, '用户名或者密码为空');
        }
        $user = new User();
        $info = $user->getLoginUser($name);
        if (empty($info)) {
            //return response()->json(['status' => 400, 'message' => '用户不存在']);
            return responseJsonHttp(400, '用户名或者密码错误');
        }
		$isAdmin = $info->isAdmin();
		if (empty($isAdmin)) {
            return responseJsonHttp(403, '用户不是管理员，不能登录后台系统');
		}
        $verifyPassword = $info->checkPassword($password);
        if (empty($verifyPassword)) {
            return responseJsonAsBadRequest('用户名或者密码错误1');
        }

        return responseJsonHttp(200, '登录成功', $this->getToken($info));
    }

    /**
     * @group space宝贝空间
     *
     * dev:myinfo当前登录用户信息
     *
     * @response {
     *   "status": 0,
     *   "message": "success",
     *   "data": {
     *     "uid": "用户ID",
     *     "uname": "用户名",
     *     "sex": "性别",
     *     "avatar": "用户头像"
     *   }
     * }
     * @return \Illuminate\Http\JsonResponse
     */
    public function myinfo()
    {
        $myinfo = $this->_userInfo($this->getCurrentUser());
        return responseJsonHttp(200, 'success', $myinfo);
    }

    /**
     * @group auth登录模块
     *
     * logout退出登录
     *
     * @return \Illuminate\Http\JsonResponse
     * @response {
     *   "code": 200,
     *   "message": "您已成功退出登录"
     * }
     */
    public function logout()
    {
        auth('api')->logout();

        return responseJsonHttp(200, '您已成功退出登录');
    }

    /**
     * Refresh a token.
     * 刷新token，如果开启黑名单，以前的token便会失效。
     * 值得注意的是用上面的getToken再获取一次Token并不算做刷新，两次获得的Token是并行的，即两个都可用。
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    /**
     * 拼接 token
     *
     * @param User $user
     * @return array
     */
    protected function getToken(User $user)
    {
        // 换取 token
        $prefix = 'Bearer';
        $token = auth('api')->login($user);
		$deviceno = $this->getDeviceno();
		if (!empty($deviceno)) {
		    $padPassword = new PadPassword();
			$padPassword->cancelToken($user['uid'], $deviceno);
		    $padPassword->setPadToken($token, $user['uid'], $deviceno);
		}
        $myinfo = $this->_userInfo($user);

        return compact('prefix', 'token', 'myinfo');
    }
}

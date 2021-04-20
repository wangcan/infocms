<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use RedirectsUsers, ThrottlesLogins;

    protected $redirectTo = '/';

    // 排除记录的回跳 url, 防止重复跳转
    protected $except = ['*login*', '*register*'];


    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest');
    }

    /**
     * 登录页面
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        $lastUrl = URL::previous();


        // 记录上一次的 url，用于登录之后的回跳
        if (! str_is($this->except, $lastUrl)) {

            session()->put('url.intended', $lastUrl);
        }

        return view('auth.login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector|\Symfony\Component\HttpFoundation\Response|void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request, UserService $userService)
    {
        $this->validateLogin($request);

        // 如果超过限制登录次数
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

           $this->sendLockoutResponse($request);
        }

        /**
         * @var $user User
         */
        $credentials = $this->credentials($request);
        $user = User::query()->where($credentials)->first();

        if ($user instanceof User  && \Hash::check($request->input('password'), $user->password)) {

            // 如果用户没有激活
            if ($user->is_active == UserStatusEnum::UN_ACTIVE) {

                // 显示 再次发送激活链接
                return redirect('login')->withInput()
                                        ->withErrors([
                                            $this->username() => $userService->getActiveLink($user)
                                        ]);
            }

            // 登录用户
            auth()->login($user, $request->has('remember'));

            return $this->sendLoginResponse($request);
        }

        // 如果登录尝试不成功，我们将增加数量
        // 登录并将用户重定向到登录表单。当然，当这个
        // 超过最大尝试次数的用户将被锁定。
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * 登录之后增加登录次数
     *
     * @param $user
     */
    protected function authenticated($user)
    {
        $user->increment('login_count');
    }


    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request->user())
            ?: redirect()->intended($this->redirectPath());
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * 登录使用用户名还是邮箱
     * @param Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $input = $request->input($this->username());
        $field = filter_var($input, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        return [
            $field => $input,
        ];
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ], [
            $this->username() . '.required' => '账号不能为空',
            $this->username() . '.string' => '账号必须是正确的字符串',
            'password.required' => '密码不能为空'
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    protected function username()
    {
        return 'account';
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';


    /**
     * 核心注册方法
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        if ($request->input('captcha') != session()->get('captcha')) {

            return back()->withErrors(['captcha' => '验证码不正确']);
        }


        event(new Registered($user = $this->create($request->all())));

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath())->with('status', '注册成功');
    }

    /**
     * registered event (send email)
     * @param Request $request
     * @param $user
     */
    protected function registered(Request $request, $user)
    {
        Mail::to($user->email)
            ->queue(new UserRegister($user));
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:50|unique:users',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:5|confirmed',
            'sex' => ['required', Rule::in([0, 1])],
            'captcha' => 'required',
        ], [
            'name.required' => '用户名不能为空',
            'name.max' => '用户名不能超过50个字符',
            'name.unique' => '用户名已经被占用',
            'email.unique' => '邮箱已经被占用',
            'email.required' => '邮箱不能为空',
            'email.email' => '邮箱格式不正确',
            'password.min' => '密码最少六位数',
            'password.required' => '密码不能为空',
            'password.confirmed' => '两次密码不一致',
            'captcha.required' => '验证码不能为空',
            'sex.in' => '性别错误',
        ]);
    }

    protected function create(array $data)
    {
        // email_active,
        return  User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'sex' => $data['sex'],
            'password' => bcrypt($data['password']),
            'active_token' => str_random(60),
        ]);

    }

    /**
     * @return string
     */
    public function captcha()
    {
        $builder = (new CaptchaBuilder(4))->build(150, 46);

        session()->put('captcha', $builder->getPhrase());

        return $builder->get();
    }
}

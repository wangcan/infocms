<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;

use App\Mail\UserRegister;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{

    protected $redirectTo = '/';

    // 排除记录的回跳 url, 防止重复跳转
    protected $except = ['*login*', '*register*'];

    /**
     * RegisterController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        //$this->middleware('guest');
    }

    /**
     * 核心注册方法
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(RegisterRequest $request)
    {
        /*if ($request->input('captcha') != session()->get('captcha')) {
            return back()->withErrors(['captcha' => '验证码不正确']);
        }*/

        // 用户注册事件
        $token = JWTAuth::fromUser($user);

        return $this->response->array(compact('token'));

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

    protected function create(array $data)
    {
        // email_active,
        return  User::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'sex' => $data['sex'],
            'password' => bcrypt($data['password']),
            //'password' => app('hash')->make($password),
            'active_token' => str_random(60),
        ]);

    }
}

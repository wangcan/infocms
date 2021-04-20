<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Services\UserService;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
//use Illuminate\Foundation\Auth\RedirectsUsers;
//use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;

use App\Mail\UserRegister;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{
    //use RedirectsUsers, ThrottlesLogins;

    protected $redirectTo = '/';

    // 排除记录的回跳 url, 防止重复跳转
    protected $except = ['*login*', '*register*'];

    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        //$this->middleware('guest');
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
     * @api {post} /user 注册(register)
     * @apiDescription 注册(register)
     * @apiGroup Auth
     * @apiPermission none
     * @apiVersion 1.0.0
     * @apiParam {String} user       user[unique]
     * @apiParam {String} password   password
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *         token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6XC9cL21vYmlsZS5kZWZhcmEuY29tXC9hdXRoXC90b2tlbiIsImlhdCI6IjE0NDU0MjY0MTAiLCJleHAiOiIxNDQ1NjQyNDIxIiwibmJmIjoiMTQ0NTQyNjQyMSIsImp0aSI6Ijk3OTRjMTljYTk1NTdkNDQyYzBiMzk0ZjI2N2QzMTMxIn0.9UPMTxo3_PudxTWldsf4ag0PHq1rK8yO9e5vqdwRZLY
     *     }
     * @apiErrorExample {json} Error-Response:
     *     HTTP/1.1 422 error info
     *     {
     *       "message": "注册新用户失败",
     *       "errors": {
     *         "user": [
     *           "该用户名已被他人注册"
     *         ]
     *       },
     *       "status_code": 422
     *     }
     */
    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->input(),
            [
                'user'     => 'required|alpha_num|unique:manager',
                'password' => 'required|min:6',
            ]
        );

        if ($validator->fails()) {
            throw new StoreResourceFailedException('注册新用户失败', $validator->messages());
        }

        $user     = $request->get('user');
        $password = $request->get('password');

        $attributes = [
            'user'     => $user,
            'password' => app('hash')->make($password),
        ];

        $user = Manager::create($attributes);

        if ($user) {
            $this->response->error('注册新用户失败', 422);
        }

        // 用户注册事件
        $token = JWTAuth::fromUser($user);

        return $this->response->array(compact('token'));
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

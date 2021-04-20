<?php

namespace App\Http\Controllers\Auth;

use App\Mail\UserRegister;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
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
        //var_dump($myinfo);exit();
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
     * @group space宝贝空间
     *
     * dev:update修改昵称接口
     *
     *
     * @response  {
     *  "status": 0,
     *  "message": "修改成功"
     * }
     * @response  {
     *  "status": 1,
     *  "message": "修改失败"
     * }
     *
     */
    public function update(UserRequest $request)
    {
        $uname = $request->input('uname');
        $self = auth('api')->user();
        if ($self['uname'] == $uname) {
            return responseJson(0, 'success');
        }
        $exist = User::query()->where('uname', $uname)->first();
        if ($exist) {
            return responseJson(1, '昵称已存在，请重新选用昵称');
        }
        $self->uname = $uname;
        $r = $self->save();
        $data = $this->_userInfo($self);
        return response()->json(['status' => 0, 'message' => 'success', 'data' => $data]);
    }

    public function activeAccount($token)
    {
        if ($user = User::query()->where('active_token', $token)->first()) {
            $user->is_active = 1;
            // 重新生成激活token
            $user->active_token = str_random(60);
            $user->save();

            return view('hint.success', ['status' => "{$user->name} 账户激活成功！", 'url' => url('login')]);
        } else {
            return view('hint.error', ['status' => '无效的token']);
        }
    }

    public function sendActiveMail($id)
    {
        if ($user = User::query()->find($id)) {
            //  again send active link, join queue
            Mail::to($user->email)
                ->queue(new UserRegister($user));

            return view('hint.success', ['status' => '发送邮件成功', 'url' => route('login')]);

        }

        return view('hint.error', ['status' => '用户名或者密码错误']);
    }
}

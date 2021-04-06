<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\UserRegister;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
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

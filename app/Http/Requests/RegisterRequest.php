<?php

namespace App\Http\Requests;

/**
 * @bodyParam name string required 手机号/用户名
 * @bodyParam password string required 密码
 */
class RegisterRequest extends AbstractRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'password' => 'required',
        ];
    }
}

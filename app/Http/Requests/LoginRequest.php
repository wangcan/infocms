<?php

namespace App\Http\Requests;

/**
 * @bodyParam name string required 手机号/用户名
 * @bodyParam password string required 密码
 */
class LoginRequest extends AbstractRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

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

    public function messages()
    {
        return [
            'name.required' => '用户名不能为空',
            'password.required' => '密码不能为空',
        ];
    }
}

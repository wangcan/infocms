<?php

namespace App\Http\Requests;

class UserRequest extends AbstractRequest;
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:newsletter_subscriptions',
        ];
    }
}

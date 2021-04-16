<?php

namespace Larabase\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class AbstractRequest
 * @category Larabase
 * @package Larabase\Http\Requests
 * @license https://opensource.org/licenses/MIT MIT
 */
class AbstractRequest extends FormRequest
{
    /**
     * The route to redirect to if validation fails.
     *
     * @var string
     */
    protected $redirectRoute = 'roles.create';
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
            'slug'        => 'required|max:50',
            'name'        => 'required|unique:admin_permissions|max:50',
            'http_method' => 'array',
            'http_path'   => 'required',
            'slug'  => 'required|max:50',
            'name'  => [
                'required',
                Rule::unique('admin_permissions')->ignore($this->name, 'name'),
                'max:50',
            ],
            'http_method' => 'array',
            'http_path'   => 'required',
            'slug'        => 'required|max:50',
            'name'        => 'required|unique:admin_roles|max:50',
            'permissions' => 'array|required',
            'username'	=> [
                'required',
                Rule::unique('users')->ignore($this->username, 'username'),
                'max:50',
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->email, 'email'),
                'max:150',
            ],
            'password'              => 'required|confirmed',
            'password_confirmation' => 'required',
            'content' => 'required',
            'posted_at' => 'required|after_or_equal:' . $this->comment->post->posted_at,
            'author_id' => 'required|exists:users,id'
          'image' => 'required|image',
          'name' => 'nullable|string|max:255'
            'title' => 'required',
            'content' => 'required',
            'posted_at' => 'required|date',
            'thumbnail_id' => 'nullable|exists:media,id',
            'author_id' => ['required', 'exists:users,id', new CanBeAuthor],
            'slug' => 'unique:posts,slug,' . (optional($this->post)->id ?: 'NULL'),
            'name' => ['required', 'string', 'max:255', new AlphaName],
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'password' => 'nullable|confirmed',
            'roles.*' => 'exists:roles,id'
            'username'      => 'required|max:50|unique:users,email',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|min:6',
            'email'            => 'nullable|email',
            'provider'         => 'required|in:xiaomi,facebook,twitter,google',
            'oauth_data'       => 'required|json',
            'expires_at'       => 'required|date',
            'name' => ['required', 'string', 'max:255', new AlphaName],
            'username' => 'required|unique:users|max:50',
            'email' => 'required|email|unique:newsletter_subscriptions',
            'post_id' => 'required|exists:posts,id'
            'email'	                => 'required|email|unique:users|max:150',
            'password'              => 'required|confirmed',
            'password_confirmation' => 'required',
            'current_password' => ['required', new CurrentPassword],
            'password' => 'required|confirmed'
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'slug'  => 'required|max:50',
            'name'  => [
                'required',
                Rule::unique('admin_roles')->ignore($this->name, 'name'),
                'max:50',
            ],
            'permissions' => 'array|required',
            'username'              => 'required|unique:admin_users|max:190',
            'name'                  => 'required|max:255',
            'password'              => 'required|confirmed',
            'password_confirmation' => 'required',
            'permissions'           => 'array',
            'roles'                 => 'array',
            'username' => [
                'required',
                Rule::unique('admin_users')->ignore($this->username, 'username'),
                'max:190',
            ],
            'name'                  => 'required|max:255',
            'password'              => 'required|confirmed',
            'password_confirmation' => 'required',
            'permissions'           => 'array',
            'roles'                 => 'array',
            'username' => [
                'nullable',
                Rule::unique('users')->ignore($this->username, 'username'),
                'max:50',
            ],
            'email' => [
                'nullable',
                'email',
                Rule::unique('users')->ignore($this->email, 'email'),
            ],
            'gender' => [
                'nullable',
                Rule::in(['F', 'M']),
            ],
            'birthday' => 'nullable|date_format:Y-m-d',
            'country'  => [
                'nullable',
                Rule::in(CountryModel::getCountryISOCodeList()),
            ],
            'timezone' => 'nullable|timezone',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'posted_at' => Carbon::parse($this->input('posted_at')),
            'slug' => Str::slug($this->input('title'))
        ]);
    }
    /**
     * Get the URL to redirect to on a validation error.
     *
     * @return string
     */
    protected function getRedirectUrl()
    {
        return $this->getSession()->previousUrl();
    }
}

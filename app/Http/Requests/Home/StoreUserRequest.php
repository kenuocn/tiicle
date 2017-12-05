<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'github_id'      => 'unique:users',
            'github_name'    => 'string',
            'wechat_openid'  => 'string',
            'name'           => 'alpha_num|required|unique:users',
            'email'          => 'email|required|unique:users',
            'github_url'     => 'url',
            'avatar'         => 'url',
            'wechat_unionid' => 'string',
            'password'       => 'required|confirmed|min:6',
        ];
    }

    public function messages()
    {
        return [
            'github_id.unique'   => '此Github账号已经被使用啦!',
            'github_name.string' => 'Github名称必须是字符串',
            'name.alpha_num'     => '用户名必须是数字或者字母',
            'name.required'      => '用户名不能为空',
            'name.unique'        => '用户名已经被人使用啦',
            'email.email'        => '邮箱格式不正确',
            'email.required'     => '邮箱不能为空',
            'email.unique'       => '邮箱已经被人使用啦',
            'github_url'         => 'gthub地址格式不正确',
            'avatar.url'         => '头像地址格式不正确',
            'password.required'  => '密码不能为空',
            'password.confirmed' => '两次密码输入不一致哦',
            'password.min'       => '密码最小长度不能少于6位',
        ];
    }
}

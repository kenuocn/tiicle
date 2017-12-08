<?php
/**
 * YICMS
 * ============================================================================
 * 版权所有 2014-2017 YICMS，并保留所有权利。
 * 网站地址: http://www.yicms.vip
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * Created by PhpStorm.
 * Author: kenuo
 * Date: 2017/12/5
 * Time: 下午9:57
 */

namespace App\Http\Controllers\Auth;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Auth\Traits\SocialiteHelper;

class AuthController
{
    use SocialiteHelper;

    private function loginUser($user)
    {
        if ($user->is_banned == 1)
        {
            return $this->userIsBanned($user);
        }

        return $this->userFound($user);
    }

    /**
     * 第三方注册授权数据
     * @param $driver
     * @param $registerUserData
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function userNotFound($driver, $registerUserData)
    {
        if ($driver == 'github') {
            $oauthData['github_id'] = $registerUserData->user['id'];
            $oauthData['github_url'] = $registerUserData->user['html_url'];
            $oauthData['github_name'] = $registerUserData->nickname;
            $oauthData['name'] = $registerUserData->nickname;
            $oauthData['email'] = $registerUserData->user['email'];
            $oauthData['real_name'] = $registerUserData->user['name'];
            $oauthData['city'] = $registerUserData->user['location'];
            $oauthData['company'] = $registerUserData->user['company'];
            $oauthData['avatar'] = $registerUserData->user['avatar_url'];
            $oauthData['website'] = $registerUserData->user['blog'];
            $oauthData['introduction'] = $registerUserData->user['bio'];
        }elseif($driver == 'wechat')
        {
            $oauthData['avatar'] = $registerUserData->avatar;
            $oauthData['name'] = $registerUserData->nickname;
            $oauthData['email'] = $registerUserData->email;
            $oauthData['wechat_openid'] = $registerUserData->id;
            $oauthData['wechat_unionid'] = $registerUserData->user['unionid'];
        }

        $oauthData['driver'] = $driver;
        Session::put('oauthData', $oauthData);

        flash("{$this->oauthLang[$driver]}授权成功!")->success()->important();

        return redirect(route('signup'));
    }

    /**
     * 数据库有用户信息, 登录用户
     * @param $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function userFound($user)
    {
        Auth::login($user, true);
        Session::forget('oauthData');

        flash('成功登录!')->success()->important();

        return redirect('/');
    }

    /**
     * 用户屏蔽
     * @param $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function userIsBanned($user)
    {
        return redirect(route('user-banned'));
    }

    /**
     * 展示第三方注册表单
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create()
    {
        if (! Session::has('oauthData')) {
            return redirect()->route('login');
        }

        $oauthData = array_merge(Session::get('oauthData'), Session::get('_old_input', []));

        return view('home.auth.signupconfirm', compact('oauthData'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createNewUser(Request $request)
    {
        $this->validator($request->all())->validate();

        if (! Session::has('oauthData'))
        {
            return redirect()->route('login');
        }

        $userData = array_merge(Session::get('oauthData'), $request->only('name', 'email', 'password'));
        $userData['register_source'] = $userData['driver'];
        $userData['password'] = bcrypt($userData['password']);
        $user = User::create($userData);

        return $this->userFound($user);
    }

    /**
     * @param array $data
     * @return mixed
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'           => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,' . Auth::id(),
            'github_name'    => 'string|max:60',
            'email'          => 'email|required|unique:users,email,' . Auth::id(),
            'password'       => 'required|confirmed|min:6',
        ]);
    }
}
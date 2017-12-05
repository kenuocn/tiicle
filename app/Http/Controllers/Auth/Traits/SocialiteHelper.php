<?php

namespace App\Http\Controllers\Auth\Traits;

use Auth;
use Socialite;
use App\Models\User;
use Illuminate\Http\Request;

trait SocialiteHelper
{
    protected $oauthDrivers = [
        'github' => 'github',
        'wechat' => 'weixin',
    ];

    protected $oauthLang = [
        'github' => 'Github',
        'wechat' => '微信',
    ];

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirectToProvider(Request $request)
    {
        $driver = $request->input('driver');
        /**验证登录方式*/
        $driver = ! isset($this->oauthDrivers[$driver]) ? 'github' : $this->oauthDrivers[$driver];

        if (Auth::check() && Auth::user()->register_source == $driver) {
            return redirect('/');
        }

        return Socialite::driver($driver)->redirect();
    }


    public function handleProviderCallback(Request $request)
    {
        $driver = $request->input('driver');

        if (! isset($this->oauthDrivers[$driver]) || (Auth::check() && Auth::user()->register_source == $driver)) {
            return redirect()->intended('/');
        }

        $oauthUser = Socialite::with($this->oauthDrivers[$driver])->user();

        /**根据对应的登录方式获取id去数据库查询是否存在*/
        $user = User::getByDriver($driver, $oauthUser->id);

        /**如果已经登录*/
        if (Auth::check()) {
            /**已经注册过*/
            if ($user && $user->id != Auth::id()) {
                flash("绑定失败：你的账号{$this->oauthLang[$driver]}已被其他用户使用. T_T")->error()->important();
            } else {
                $this->bindSocialiteUser($oauthUser, $driver);
                flash("绑定成功！以后可以使用你的 {$this->oauthLang[$driver]} 账号登录 Laravel China 了 ^_^")->success()->important();
            }

            return redirect(route('users.edit_social_binding', Auth::id()));
        } else {

            /**存在就直接登录*/
            if ($user) {
                return $this->loginUser($user);
            }

            /**不存在就跳转到绑定页面*/
            return $this->userNotFound($driver, $oauthUser);
        }

    }

    /**更新资料*/
    public function bindSocialiteUser($oauthUser, $driver)
    {
        $currentUser = Auth::user();

        if ($driver == 'github') {
            $currentUser->github_id = $oauthUser->id;
            $currentUser->github_url = $oauthUser->user['url'];
        } else if ($driver == 'wechat') {
            $currentUser->wechat_openid = $oauthUser->id;
            $currentUser->wechat_unionid = $oauthUser->user['unionid'];
        }

        $currentUser->save();
    }
}
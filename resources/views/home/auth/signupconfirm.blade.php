@extends('home.auth.app')
@section('title', '创建新账号')
@section('content')

    <div class="six wide column mt150 mb100">
        <div class="ui stacked segment">
            <div class="content">
                <h2>创建新账号</h2>
                <div class="ui divider"></div>
                @include('home.common.error')
                <form class="ui form" role="form" method="POST" action="{{ route('signup') }}" accept-charset="UTF-8">
                    {{ csrf_field() }}
                    <div class="field">
                        <div class="ui segment">
                            <img class="ui centered  image"  src="{{ $oauthData['avatar'] }}" />
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="user icon"></i>
                            <input type="text" name="name" placeholder="用户名" value="{{ $oauthData['name'] ?: '' }}" required="">
                        </div>
                    </div>
                    @if($oauthData['driver'] == 'github')
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="github icon"></i>
                            <input type="text" name="github_name" placeholder="Github Name" value="{{ isset($oauthData['github_name']) ? $oauthData['github_name'] : $oauthData['name'] }}" required="">
                        </div>
                    </div>
                    @endif
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="envelope icon"></i>
                            <input type="text" name="email" placeholder="邮箱" value="{{ $oauthData['email'] ?: '' }}" required="">
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input type="password" name="password" placeholder="密码" value="" required="">
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input type="password" name="password_confirmation" placeholder="确认密码" value="" required="">
                        </div>
                    </div>
                    <button class="ui primary teal button fluid" type="submit">
                        <i class="save icon"></i>确定
                    </button>
                </form>
            </div>
        </div>
    </div>
@stop

@extends('home.auth.app')
@section('title', '用户登录')
@section('content')

<div class="six wide column mt150 mb100">
    <div class="ui stacked segment">
        <div class="content">
            <h2>邮箱登录</h2>
            <div class="ui divider"></div>
            @include('home.common.error')
            <form class="ui form" role="form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="field">
                    <div class="ui left icon input">
                        <i class="envelope icon"></i>
                        <input type="text" name="email" placeholder="邮箱" value="{{old('enail')}}" required="">
                    </div>
                </div>
                <div class="field">
                    <div class="ui left icon action input ">
                        <i class="lock icon"></i>
                        <input type="password" name="password" placeholder="密码" value="" required="">
                        <a class="ui button basic light" href="{{route('password.request')}}">
                            忘记密码？
                        </a>
                    </div>
                </div>
                <div class="field">
                    <div class="ui checkbox checked">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label>记住密码</label>
                    </div>
                </div>
                <div class="ui buttons fluid">
                    <button class="ui blue button" type="submit"><i class="send icon"></i>登录</button>
                    <div class="or"></div>
                    <a class="ui button" href="{{route('register')}}">注册</a>
                </div>
            </form>

            <div class="ui horizontal divider">Or</div>

            <a class="ui basic teal button fluid" href="{{route('login.github',['driver'=>'github'])}}"><i class="icon github alternate"></i> Github 登录</a>
        </div>
    </div>
</div>
@endsection

@extends('home.layouts.app')
@section('title', '重置密码')
@section('content')
<div class="nine wide column">
    <div class="ui stacked segment">
        <div class="content">
            <h2>重置密码</h2>
            <div class="ui divider"></div>
            @include('home.common.error')
            <form class="ui form" role="form" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}
                <div class="field">
                    <div class="ui left icon input">
                        <i class="mail icon"></i>
                        <input type="text" name="email" placeholder="E-mail address" value="{{ old('email') }}" required="">
                    </div>
                </div>
                <button class="ui primary labeled icon button" type="submit">
                    <i class="send icon"></i>
                    发送密码重置链接
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('home.layouts.app')

@section('title', $user->name . ' 的个人中心')

@section('content')
    <!--左部分-->
    <div class="four wide column ">
        <div class="ui stackable cards">
            <div class="ui card">
                <div class="image">
                    <img src="{{$user->avatar}}">
                </div>
                <div class="content">
                    <div class="header">
                        {{ $user->name }}
                    </div>

                    <p class="meta">
                        @switch($user->gender)
                            @case(0)
                            <i class="non binary transgender icon"></i>未知
                            @break
                            @case(1)
                                <i class="male icon"></i>男
                            @break
                            @case(2)
                                <i class="female icon"></i>女
                            @break
                        @endswitch
                    </p>

                    @if ($user->github_name)
                        <p class="meta">
                            <a href="{{$user->github_url}}" target="_blank">
                                <i class="icon github alternate grey"></i>
                                {{$user->github_name}}
                            </a>
                        </p>
                    @endif

                    <div class="description"></div>
                </div>

                @if ($user->city)
                    <div class="extra content">
                        <i class="marker icon"></i>{{$user->city}}
                    </div>
                @endif

                @if ($user->personal_website)
                    <div class="extra content">
                        <i class="linkify icon"></i>
                        <a href="{{$user->personal_website}}" target="_blank">{{$user->personal_website}}</a>
                    </div>
                @endif

                @if ($user->company)
                    <div class="extra content">
                        <i class="building icon"></i>{{$user->company}}
                    </div>
                @endif

                <div class="extra content">
                    <button class=" ui basic teal button fluid follow" data-act="follow" data-id="{{$user->id}}"><span class="state">关注</span></button>
                </div>
            </div>
        </div>
    </div>
    <!--end左部分-->

    <!--右部分-->
    {{-- 用户发布的内容 --}}
    <div class="twelve wide column">
        <div class="ui stacked segment">
            <div class="ui teal ribbon label"><i class="trophy icon"></i>贡献 0</div>
            <div class="content extra-padding">
                <div class="ui attached tabular menu stackable">
                    <a class="item active" data-tab="first" href="{{ route('users.show', $user->name)}}"><i class="icon feed"></i>动态</a>
                    <a class="item " href="https://tiicle.com/kenuocn/items"><i class="icon file text outline"></i> 编程知识<span class="counter">0</span> </a>
                    <a href="https://tiicle.com/kenuocn/followers" class="item "><i class="icon user"></i> 关注者 <span class="counter">0</span> </a>
                    <a href="https://tiicle.com/kenuocn/stars" class="item "><i class="icon thumbs up"></i> 赞过 <span class="counter">2</span> </a>
                </div>
                {{--@if (if_query('tab', 'replies'))--}}
                    {{--@include('users._replies', ['replies' => $user->replies()->with('topic')->recent()->paginate(5)])--}}
                {{--@else--}}
                    {{--@include('users._topics', ['topics' => $user->topics()->recent()->paginate(5)])--}}
                {{--@endif--}}
            </div>
        </div>
    </div>
    <!--end右部分-->
@stop
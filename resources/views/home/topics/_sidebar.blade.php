<div class="four wide column stackable">
    {{--<div class="ui stackable cards">--}}
        {{--<div class="ui card tag-active-user-card stackable">--}}
            {{--<div class="content">--}}
                {{--<span class="">我关注的标签</span>--}}
            {{--</div>--}}
            {{--<div class="extra content">--}}
                {{--<div class="ui middle aligned divided list">--}}
                    {{--<a class="item" href="https://tiicle.com/tags/laravel">--}}
                        {{--<div class="right floated content">--}}
                            {{--<div class="ui label basic circular">92</div>--}}
                        {{--</div>--}}
                        {{--<img class="ui avatar image tagged"--}}
                             {{--src="https://omu8v0x3b.qnssl.com/uploads/images/201703/26/1/u5BuIO5Ujn.png?imageView2/1/w/200/h/200">--}}
                        {{--<div class="content color-black">--}}
                            {{--Laravel--}}
                        {{--</div>--}}
                    {{--</a>--}}
                    {{--<a class="item" href="https://tiicle.com/tags/php">--}}
                        {{--<div class="right floated content">--}}
                            {{--<div class="ui label basic circular">58</div>--}}
                        {{--</div>--}}
                        {{--<img class="ui avatar image tagged"--}}
                             {{--src="https://omu8v0x3b.qnssl.com/uploads/images/201703/15/1/hIYECohuQg.png?imageView2/1/w/200/h/200">--}}
                        {{--<div class="content color-black">--}}
                            {{--PHP--}}
                        {{--</div>--}}
                    {{--</a>--}}
                    {{--<a class="item" href="https://tiicle.com/tags/javascript">--}}
                        {{--<div class="right floated content">--}}
                            {{--<div class="ui label basic circular">39</div>--}}
                        {{--</div>--}}
                        {{--<img class="ui avatar image tagged"--}}
                             {{--src="https://omu8v0x3b.qnssl.com/uploads/images/201703/26/1/yqZu5lo2Lr.png?imageView2/1/w/200/h/200">--}}
                        {{--<div class="content color-black">--}}
                            {{--JavaScript--}}
                        {{--</div>--}}
                    {{--</a>--}}
                    {{--<a class="item" href="https://tiicle.com/tags/semantic-ui">--}}
                        {{--<div class="right floated content">--}}
                            {{--<div class="ui label basic circular">2</div>--}}
                        {{--</div>--}}
                        {{--<img class="ui avatar image tagged"--}}
                             {{--src="https://omu8v0x3b.qnssl.com/uploads/images/201703/26/1/QgVAxezgbE.png?imageView2/1/w/200/h/200">--}}
                        {{--<div class="content color-black">--}}
                            {{--Semantic UI--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</div>--}}

            {{--</div>--}}
        {{--</div>--}}

        @if (count($active_users))
        <div class="ui card tag-active-user-card stackable">
            <div class="content">
                <span class=""><i class="diamond icon"></i>活跃用户</span>
            </div>
            <div class="extra content">
                <div class="ui middle aligned divided list">
                    @foreach ($active_users as $active_user)
                    <a class="item" href="{{ route('users.show', $active_user->id) }}">
                        <div class="right floated content">
                            <div class="ui label basic circular">{{$active_user->contribution_count}}</div>
                        </div>
                        <img class="ui avatar image"
                             src="{{$active_user->avatar}}">
                        <div class="content color-black">
                            {{$active_user->name}}
                        </div>
                    </a>
                    @endforeach
                </div>

            </div>
        </div>
        @endif
    </div>
</div>
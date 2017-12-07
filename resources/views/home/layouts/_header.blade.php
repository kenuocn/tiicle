<nav class="ui main borderless menu top stackable">
    <div class="ui container">
        <a href="{{ url('/') }}" class="header item">
            Tiicle
            <div class="ui left pointing orange basic label" style="font-weight: normal;"> 记录让编码更高效</div>
        </a>
        <a href="#" class="item">发现</a>
        <div class="ui fluid category search item">
            <div class="ui icon input">
                <input class="prompt" type="text" placeholder="" autocomplete="off">
                <i class="search icon"></i>
            </div>
            <div class="results"></div>
        </div>
        <a href="#" class="item top-nav-hint">
            <i class="icon idea"></i>
            如何高效地记录？
        </a>
        <div class=" right menu stackable">
            <!-- Authentication Links -->
            @guest
                <div class="item">
                    <a class="ui basic button" href="{{ route('login')}}"><i class="icon user "></i> 登录 </a>
                </div>
            @else
                <a class="ui item" href="#">
                    <i class="plus icon"></i>
                </a>
                <a class="item" href="#">
                    <span class="ui basic circular label notification" id="notification-count">0</span>
                </a>
                <div class="ui simple dropdown item stackable nav-user-item" tabindex="0">
                    <img class="ui avatar image" src="{{ Auth::user()->avatar }}">&nbsp;
                    {{ Auth::user()->name }} <i class="dropdown icon"></i>
                    <div class="ui menu stackable" tabindex="-1">
                        <a href="{{route('users.show',Auth::user()->id)}}" class="item"><i class="icon user"></i>个人中心</a>

                        <a href="{{route('users.profile')}}" class="item"><i class="icon cogs"></i>编辑资料</a>

                        <a href="javascript:void(0)" class="item" id="login-out">
                            <i class="icon sign out"></i>退出
                        </a>

                        <form id="logout-form" action="{{url('logout')}}" method="POST" style="display: none;">
                            {{csrf_field()}}
                        </form>
                    </div>
                </div>
            @endguest
        </div>
    </div>
</nav>
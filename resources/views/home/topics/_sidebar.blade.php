<div class="four wide column stackable">
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
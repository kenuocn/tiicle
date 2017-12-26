<div class="four wide column">
    <div class="item header">
        <div class="ui segment">
            <div class="ui three statistics">
                <div class="ui huge statistic">
                    <div class="value">{{$topic->voted_count}} </div>
                    <div class="label">点赞</div>
                </div>
                <div class="ui huge statistic">
                    <div class="value">{{$topic->view_count}} </div>
                    <div class="label">浏览</div>
                </div>
                <div class="ui huge statistic">
                    <div class="value">{{$topic->reply_count}} </div>
                    <div class="label">评论</div>
                </div>
            </div>
            <br>
        </div>
    </div>
    <div class="ui stackable cards">
        <div class="ui  card column author-box grid" style="margin-top: 20px;">
            <div class="ui fluid" style="margin-top: 20px;">
                <div class="ui teal ribbon label"><i class="trophy icon"></i> 贡献 {{$user->contribution_count}} </div>
            </div>
            <a href="{{route('users.show',$user->id)}}" class="avatar-link">
                <img class="ui centered circular tiny image " src="{{$user->avatar}}">
            </a>
            <div class="extra content ui center aligned container">
                <a class="header" href="{{route('users.show',$user->id)}}">{{$user->name}}</a>
                <div class="description">{{$user->introduction}}</div>
            </div>
            @if( Auth::check() && $topic->user_id != Auth::user()->id)
            <div class="extra content">
                <user-followers-button user="{{$user->id}}"></user-followers-button>
                {{--<a href="https://tiicle.com/messages/to/1" class="ui basic button fluid" style="margin-top: 6px;">--}}
                    {{--<i class="icon envelope"></i> 私信--}}
                {{--</a>--}}
            </div>
            @endif
        </div>
    </div>
    <div class="ui sticky" style="padding-top: 20px; width: 262px !important; height: 20px !important;">
        <div class="ui  card column author-box grid  tocify-hide" id="toc">
        </div>
    </div>
</div>
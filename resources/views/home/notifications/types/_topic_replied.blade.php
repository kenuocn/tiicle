<div class="event">
    <a class="label" href="{{ route('users.show', $notification->data['user_id']) }}">
        <img src="{{ $notification->data['user_avatar'] }}" title="{{ $notification->data['user_name'] }}" alt="{{ $notification->data['user_name'] }}">
    </a>
    <div class="content">
        <div class="summary">
            <a href="{{ route('users.show', $notification->data['user_id']) }}" style="color:#05a1a2;">{{ $notification->data['user_name'] }}</a> ⋅ 评论了你发布 ⋅
            <a class="title" href="{{ $notification->data['topic_link'] }}" target="_blank" style="color: #05a1a2;">{{ $notification->data['topic_title'] }}</a>
            <span class="meta">
                 ⋅ 于 ⋅ <span class="timeago">{{$notification->created_at->diffForHumans()}}</span>
            </span>
            <div class="extra text markdown-reply">
                <p>{!! $notification->data['reply_content'] !!}</p>
            </div>
        </div>
    </div>
</div>
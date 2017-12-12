<div class="comments-feed">
    @foreach ($replies as $index => $reply)
    <div class="comment">
        <div id="comments-147"></div>
        <a class="avatar" href="{{ route('users.show', [$reply->user_id]) }}">
            <img src="{{ $reply->user->avatar }}" alt="{{ $reply->user->name }}">
        </a>
        <div class="content">
            <div class="comment-header">
                <div class="meta">
                    <a class="author" href="{{ route('users.show', [$reply->user_id]) }}">{{ $reply->user->name }}</a>
                    <div class="metadata">
                        <span class="date">{{ $reply->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <div class="reaction">
                    <div class="ui floating basic icon dropdown button" tabindex="0">
                        <a href="javascript:void(0)" onclick="replyOne('{{ $reply->user->name }}');" title="回复 {{ $reply->user->name }}" class="ui teal reply-btn" style="display: none;"><i class="icon reply"></i></a>
                        <div class="menu" tabindex="-1"></div></div>
                </div>
            </div>
            <div class="text comment-body markdown-reply">
                {!! $reply->content !!}
            </div>
        </div>
    </div>
    @endforeach
</div>
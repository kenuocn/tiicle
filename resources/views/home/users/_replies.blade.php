@if (count($replies))
    <div class="list-group">
        @foreach ($replies as $index => $reply)
            <div class="list-group-item">
                <a href="{{ $reply->topic->link() }}" title="{{{ $reply->topic->title }}}" class="remove-padding-left">
                    {{{ $reply->topic->title }}}
                </a>
                <span class="meta">
                    回复时间&nbsp;&nbsp;<span class="timeago" title="{{ $reply->created_at }}">{{ $reply->created_at->diffForHumans() }}</span>
                </span>
                <div class="reply-body markdown-reply content-body">
                    {!! $reply->content !!}
                </div>
                <div class="item-meta">
                    <a class="ui label basic light grey" href="{{ $reply->topic->link() }}"><i class="thumbs up icon"></i> {{ $reply->topic->voted_count}} </a>
                    <a class="ui label basic light grey" href="{{ $reply->topic->link() }}"><i class="comment icon"></i> {{ $reply->topic->reply_count }} </a>
                </div>
            </div>
        @endforeach
    </div>
@else
    <h3 class="text-center alert alert-info"> 暂无数据 ~_~ </h3>
@endif
{{-- 分页 --}}
{!! $replies->render() !!}
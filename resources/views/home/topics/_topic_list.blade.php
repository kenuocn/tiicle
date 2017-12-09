@if (count($topics))
    <div class="ui feed">
        @foreach ($topics as $topic)
        <div class="event">
            <div class="label">
                <a href="{{ route('users.show', [$topic->user_id]) }}">
                    <img class="ui avatar image" src="{{ $topic->user->avatar }}" alt="{{ $topic->user->name }}" data-title="{{ $topic->user->name }}">
                </a>
            </div>
            <div class="content">
                <div class="summary">
                    <a class="ui label small " href="#">{{ $topic->category->name }}</a>
                    <a href="{{ route('topics.show', [$topic->id]) }}" class="title" title="{{ $topic->title }}">{{ $topic->title }}</a>
                </div>
                <div class="meta">
                    <a  class="author" href="{{ route('users.show', [$topic->user_id]) }}">
                        <i class="user icon"></i>
                        {{ $topic->user->name }}
                    </a>
                    <span class="date">
                        <i class="time icon"></i>
                        {{$topic->created_at->diffForHumans()}}
                    </span>
                </div>
            </div>

            <div class="item-meta">
                <a class="ui label basic light grey" href="{{ route('topics.show', [$topic->id]) }}"><i class="thumbs up icon"></i> {{ $topic->reply_count}} </a>
                <a class="ui label basic light grey" href="{{ route('topics.show', [$topic->id]) }}"><i class="comment icon"></i> {{ $topic->reply_count }} </a>
            </div>
        </div>
        @endforeach
    </div>
@else
    <h3 class="text-center alert alert-info">暂无数据 ~_~ </h3>
@endif
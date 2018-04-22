@if (count($topics))
    <div class="ui divided feed">
        @foreach ($topics as $topic)
            <div class="event">
                <div class="label">
                    <a href="{{ route('users.show', [$user->id]) }}">
                        <img class="ui avatar image" src="{{ $user->avatar }}" alt="{{ $user->name }}"
                             data-title="{{ $user->name }}">
                    </a>
                </div>
                <div class="content">
                    <div class="summary">
                        <a class="ui label small " href="{{ route('categories.show', $topic->category->id) }}"
                           title="{{ $topic->category->name }}">{{ $topic->category->name }}</a>
                        <a href="{{ $topic->link() }}" class="title" title="{{ $topic->title }}">{{ $topic->title }}</a>
                    </div>
                    <div class="meta">
                        <a class="author" href="{{ route('users.show', [$user->id]) }}">
                            <i class="user icon"></i>
                            {{ $user->name }}
                        </a>
                        <span class="date">
                        <i class="time icon"></i>
                            {{$topic->created_at->diffForHumans()}}
                        </span>
                    </div>
                </div>
                <div class="five wide right aligned column">
                    @if($topic->tags->isNotEmpty())
                        <span class="item-tags">
                            @foreach($topic->tags as $tag)
                                <a class="ui label mini {{color()[colorRand()]}}" href="{{route('tags.show',$tag->id)}}">
                                    {{$tag->name}}
                                    @if($tag->images)
                                        <img src="" class="tagged">
                                    @endif
                                </a>
                            @endforeach
                    </span>
                    @endif
                    <div class="item-meta">
                        <a class="ui label basic light grey" href="{{ $topic->link() }}"><i class="eye icon"></i> {{ $topic->view_count}} </a>
                        <a class="ui label basic light grey" href="{{ $topic->link() }}"><i class="thumbs up icon"></i> {{ $topic->voted_count}} </a>
                        <a class="ui label basic light grey" href="{{ $topic->link() }}"><i class="comment icon"></i> {{ $topic->reply_count }} </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <h3 class="text-center alert alert-info"> 暂无数据 ~_~ </h3>
@endif

{{-- 分页 --}}
{!! $topics->render() !!}



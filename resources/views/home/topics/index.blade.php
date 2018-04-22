@extends('home.layouts.app')
@section('title', isset($category) ? $category->name  : '话题列表')
@section('content')
    <div class="twelve wide column right-side stacked segments">
        <div class="ui segment">
            <div class="content extra-padding">
                @if (isset($category))
                <div>
                    <h1 class="pull-left">
                        <a class="ui tag label large {{color()[colorRand()]}}" href="{{ route('categories.show', $category->id) }}">{{$category->name}}</a>
                    </h1>
                    <div class="login-required ui compact floating subscribe button subscribe-wrap  pull-right teal" data-act="subscribe" data-id="10">
                        <span class="state">关注标签</span>
                    </div>
                </div>
                @else
                    <h1>
                        <a class="ui icon button teal" href="{{ route('topics.create') }}"><i class="icon plus"></i> 创建话题</a>
                    </h1>
                @endif
                <div style="clear: both"></div>
                <div class="ui attached tabular menu stackable">
                    <a class="item {{ active_class(( ! if_query('order', 'recent') )) }}" data-tab="first" href="{{ Request::url() }}?order=default"><i class="icon feed"></i> 活跃</a>
                    <a class="item {{ active_class(if_query('order', 'recent')) }}" href="{{ Request::url() }}?order=recent"><i class="icon wait"></i> 最新</a>
                </div>
                {{-- 话题列表 --}}
                @include('home.topics._topic_list', ['topics' => $topics])

                {{-- 分页 --}}
                {!! $topics->links() !!}

            </div>
        </div>
    </div>

    {{-- 右边栏 --}}
    @include('home.topics._sidebar')
@endsection
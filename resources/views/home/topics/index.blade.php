@extends('home.layouts.app')
@section('title', '话题列表')
@section('content')
    <div class="twelve wide column right-side stacked segments">
        <div class="ui segment">
            <div class="content extra-padding">
                <h1>
                    <a class="ui icon button teal" href="https://tiicle.com/items/create"><i class="icon plus"></i> 记录编码技巧</a>
                </h1>
                <div class="ui attached tabular menu stackable">
                    <a class="item active" data-tab="first" href="https://tiicle.com"><i class="icon feed"></i> 动态</a>
                    <a class="item " href="https://tiicle.com/items"><i class="icon content"></i> 整站</a>
                    <a href="https://tiicle.com/items?show=mine" class="item "><i class="icon text file outline"></i> 我的 <span class="counter">0</span> </a>
                </div>
                {{-- 话题列表 --}}
                @include('home.topics._topic_list', ['topics' => $topics])

                {{-- 分页 --}}
                {!! $topics->links() !!}

            </div>
        </div>
    </div>
@endsection
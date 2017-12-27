@extends('home.layouts.app')

@section('title')
    我的通知
@stop

@section('content')
    <div class="four wide column ">
        <div class="ui fluid large vertical pointing menu" style="border: 1px solid #d3e0e9;">
            <a class="item {{ active_class(if_route('notifications.index'))}}" href="{{route('notifications.index')}}">
                <i class="icon bell nofloat grey"></i> &nbsp;通知
            </a>
            {{--<a class="item " href="https://tiicle.com/messages">--}}
                {{--<i class="icon envelope nofloat grey"></i> &nbsp;私信--}}
            {{--</a>--}}
        </div>
    </div>
    <div class="twelve wide column">
        <div class="ui stacked segment">
            <div class="content extra-padding">
                <h1>
                    <i class="bell outline icon"></i>
                    我的提醒
                </h1>
                <div class="ui divider"></div>
                <div class="ui feed">
                    @if ($notifications->count())
                        @foreach ($notifications as $notification)
                            @include('home.notifications.types._' . snake_case(class_basename($notification->type)))
                        @endforeach
                        {!! $notifications->render() !!}
                    @else
                        <h3 class="text-center alert alert-info">Empty!</h3>
                    @endif
                </div>

            </div>
        </div>
    </div>
@stop
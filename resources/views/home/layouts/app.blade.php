<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'LaraBBS') |  Tiicle - 共享编程知识 </title>
    <meta name="author" content="Summer" />
    <meta name="description" content="@yield('description', 'Tiicle 是一个程序员分享编程知识和协作的平台。你可以在 Tiicle 上记录编程小贴士、编程小技巧或者编码日志。')" />
    <meta name="keywords" content="编程,编码,编程学习,编程技巧,编程知识,php,javascript,laravel,java,vuejs " />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>

<body class="{{ route_class() }}-page">
<div class="main container" id="app">

    @include('home.layouts._header')
    @include('flash::message')
    {{--网页主体--}}
    <div class="ui centered grid container stackable">
        @yield('content')

    </div>
    {{--end网页主体--}}
    <div class="push"></div>

</div>
<!--反馈意见-->
<a class="circular ui icon button fixed feedback popover" data-content="建议与反馈 @Summer" data-position="left center" href="mailto:summer@yousails.com">
    <i class="icon talk outline"></i>
</a>
<!--end反馈意见-->
@include('home.layouts._footer')
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
<script>
    
    $('.message .close')
        .on('click', function() {
            $(this)
                .closest('.message-container')
                .transition('fade')
            ;
        })
    ;
</script>
</body>
</html>
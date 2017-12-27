<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'LaraBBS') | Tiicle - 共享编程知识 </title>
    <meta name="author" content="Summer"/>
    <meta name="description"
          content="@yield('description', 'Tiicle 是一个程序员分享编程知识和协作的平台。你可以在 Tiicle 上记录编程小贴士、编程小技巧或者编码日志。')"/>
    <meta name="keywords" content="编程,编码,编程学习,编程技巧,编程知识,php,javascript,laravel,java,vuejs "/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>

<body class="{{ route_class() }}-page">
    <div id="particles-js" ></div>
    <div class="particles-js">
        <ul class="bg-bubbles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
<div class="main container">
    @include('home.layouts._header')
    @include('flash::message')
    {{--网页主体--}}
    <div class="ui centered grid container stackable" id="app">
        @yield('content')
    </div>
    {{--end网页主体--}}
    <div class="push"></div>

</div>
<!--反馈意见-->
<a class="circular ui icon button fixed feedback popover" data-content="建议与反馈 @kenuo" data-position="left center"
   href="#">
    <i class="icon talk outline"></i>
</a>
<!--end反馈意见-->
@include('home.layouts._footer')
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
<script>

    $('.message .close')
        .on('click', function () {
            $(this)
                .closest('.message-container')
                .transition('fade')
            ;
        })
    ;

    particlesJS("particles-js", {
        "particles": {
            "number": {
                "value": 88,
                "density": {
                    "enable": true,
                    "value_area": 700
                }
            },
            "color": {
                "value": ["#aa73ff", "#f8c210", "#83d238", "#33b1f8"]
            },
            "shape": {
                "type": "circle",
                "stroke": {
                    "width": 0,
                    "color": "#000000"
                },
                "polygon": {
                    "nb_sides": 15
                },
                "image": {
                    "src": "img/github.svg",
                    "width": 100,
                    "height": 100
                }
            },
            "opacity": {
                "value": 0.5,
                "random": false,
                "anim": {
                    "enable": false,
                    "speed": 1.5,
                    "opacity_min": 0.15,
                    "sync": false
                }
            },
            "size": {
                "value": 2.5,
                "random": false,
                "anim": {
                    "enable": true,
                    "speed": 2,
                    "size_min": 0.15,
                    "sync": false
                }
            },
            "line_linked": {
                "enable": true,
                "distance": 110,
                "color": "#33b1f8",
                "opacity": 0.25,
                "width": 1
            },
            "move": {
                "enable": true,
                "speed": 1.6,
                "direction": "none",
                "random": false,
                "straight": false,
                "out_mode": "bounce",
                "bounce": false,
                "attract": {
                    "enable": false,
                    "rotateX": 600,
                    "rotateY": 1200
                }
            }
        },
        "interactivity": {
            "detect_on": "canvas",
            "events": {
                "onhover": {
                    "enable": false,
                    "mode": "repulse"
                },
                "onclick": {
                    "enable": false,
                    "mode": "push"
                },
                "resize": true
            },
            "modes": {
                "grab": {
                    "distance": 400,
                    "line_linked": {
                        "opacity": 1
                    }
                },
                "bubble": {
                    "distance": 400,
                    "size": 40,
                    "duration": 2,
                    "opacity": 8,
                    "speed": 3
                },
                "repulse": {
                    "distance": 200,
                    "duration": 0.4
                },
                "push": {
                    "particles_nb": 4
                },
                "remove": {
                    "particles_nb": 2
                }
            }
        },
        "retina_detect": true
    });
</script>
</body>
</html>


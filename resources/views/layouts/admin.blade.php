<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" ng-app="app">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Bright Creations</title>

    <!-- Scripts -->
    {{--v1.5.9--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>--}}
    {{--<script src="{{ asset('js/angular.js') }}" ></script>--}}
    {{--<script src="{{ asset('js/angular-animate.min.js') }}" ></script>--}}
    {{--<script src="{{ asset('js/angular-ui-router.js') }}" ></script>--}}



    <script src="{{ asset('js/admin.js') }}" ></script>
    {{--<script src="{{ asset('js/component/dashboard/ctrl.js') }}" ></script>--}}
    {{--<script src="{{ asset('js/component/post/ctrl.js') }}" ></script>--}}
    {{--<script src="{{ asset('js/component/category/ctrl.js') }}" ></script>--}}
    {{--<script src="{{ asset('js/component/comment/ctrl.js') }}" ></script>--}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="/">

                <img src="{{asset('img/BC-logo.jpg')}}" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">


                <!-- Left Side Of Navbar -->
                {{--<ul class="navbar-nav mr-auto" id="nav_pages">--}}
                    {{--<li><a ui-sref="postManager">Posts</a></li>--}}
                    {{--<li><a ui-sref="commentManager">Comments</a></li>--}}
                    {{--<li><a ui-sref="categoryManager">Categories</a></li>--}}

                {{--</ul>--}}
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="{{asset('img/avatar/'.Auth::user()->avatar)}}" class="img-circle special-img">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('users.edit',['user'=>Auth::user()->id],'edit') }}"
                                     >
                                  Profile
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>



</body>
</html>
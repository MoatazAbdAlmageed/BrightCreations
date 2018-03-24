@extends('layouts.app')


@section('header')
    <script src="{{ asset('js/angular.js') }}"></script>
    <script src="{{ asset('js/angular-animate.min.js') }}"></script>
    <script src="{{ asset('js/angular-ui-router.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/component/dashboard/ctrl.js') }}"></script>
    <script src="{{ asset('js/component/post/ctrl.js') }}"></script>
    <script src="{{ asset('js/component/category/ctrl.js') }}"></script>
    <script src="{{ asset('js/component/comment/ctrl.js') }}"></script>
@endsection

@section('brand')
    {{--ui-sref="admin"--}}
    <a class="navbar-brand" href="/">
        <img src="{{asset('img/BC-logo.jpg')}}" alt="">
    </a>
@endsection


@section('navbar')
    <li><a ui-sref="postManager">Posts</a></li>
    <li><a ui-sref="commentManager">Comments</a></li>
    <li><a ui-sref="categoryManager">Categories</a></li>
@endsection


@section('content')
    <div ui-view></div>
@endsection
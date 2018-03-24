@extends('layouts.app')
@section('header')
    <script src="{{ asset('js/admin.js') }}"></script>
@endsection
@section('brand')
    {{--ui-sref="admin"--}}
    <a class="navbar-brand" href="/">
        <img src="{{asset('img/BC-logo.jpg')}}" alt="">
    </a>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Profile') }}</div>

                    <div class="card-body">
                        <form method="post" action="{{ route('users.update',['user'=>$user->id]) }}"
                              enctype="multipart/form-data">
                            {{--@csrf--}}
                            {{ method_field('PATCH') }}
                            {{csrf_field()}}

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="name" value="{{ $user->name }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" value="{{ $user->email }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="gender"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                                <div class="col-md-6">
                                    <select name="gender" class="form-control">
                                        <option @if ($user->gender == "Male")
                                                selected
                                                @endif  value="Male">Male
                                        </option>
                                        <option
                                                @if ($user->gender == "Female")
                                                selected
                                                @endif
                                                value="Female">Female
                                        </option>
                                    </select>
                                    @if ($errors->has('gender'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            @if (count($hobbies) > 0)



                                <div class="form-group row">
                                    <label for="gender"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Hobbies') }}</label>
                                    <div class="col-md-6">

                                        {{--{{Form::checkbox('hobby[]','art')}}Art--}}

                                        @foreach($hobbies as $hobby)
                                            <label class="form-check-label">


												<?php
												$checked = false;
												foreach ( $user->hobbies as $user_hobby ) {
													if ( $hobby->id == $user_hobby->id ) {
														$checked = true;
													}
												}
												?>

                                                {{Form::checkbox('hobby[]',$hobby->id, $checked)}}{{$hobby->name}}

                                            </label>



                                        @endforeach
                                        @if ($errors->has('hobby'))
                                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('hobby') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                            @endif


                            <div class="form-group row">
                                <label for="avatar"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Avatar') }}</label>
                                <div class="col-md-6">
                                    {!! Form::file('avatar', array('class' => 'image')) !!}
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

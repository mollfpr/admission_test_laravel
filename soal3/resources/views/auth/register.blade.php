@extends('layouts.app')

@section('css')
    <style>
        .content {
            width: 100%;
            height: 100%;
            background-image: url('/svg/500.svg');
            background-repeat: no-repeat;
            background-size: cover;
        }

        .py-4 {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }
    </style>
@endsection

@section('content')

    <div class="content">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-4 col-sm-8 col-xs-10">
                <div class="card">
                    <div class="p-1-5 d-flex justify-content-center align-items-center flex-column">
                        <img src="{{ asset('LaravelLogo.png') }}" class="logo" alt="Fox">
                        <h4 class="header-title text-center">Registration</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group col-md-12">
                                <label for="name">{{ __('Name') }}</label>

                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <label for="email">{{ __('E-Mail Address') }}</label>

                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <label for="password">{{ __('Password') }}</label>

                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>

                            <div class="form-group col-md-12">
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>

                                    <a class="btn btn-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

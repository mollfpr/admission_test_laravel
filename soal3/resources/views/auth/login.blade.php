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
                    <div class="p-1-5 d-flex justify-content-center align-items-center">
                        <img src="{{ asset('LaravelLogo.png') }}" class="logo" alt="Fox">
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group col-md-12">
                                <label for="email">{{ __('E-Mail Address') }}</label>

                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

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
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    <a class="btn btn-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
			<h1>{{ $errorMessage }}</h1>
			<a href="{{ route('home') }}" class="btn btn-default">Home</a>
		</div>
		<div class="col-md-6">
			<img src="{{ asset('svg/404.svg') }}" alt="404" class="img-error">
		</div>
	</div>

@endsection
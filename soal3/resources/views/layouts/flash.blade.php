@if(Session::has('error'))
	<div class="row justify-content-center">
		<div class="col-md-9">
			<div class="alert alert-danger">
				{{ Session::get('error')}}
			</div>
		</div>
	</div>
@endif

@if(Session::has('success'))
	<div class="row justify-content-center">
		<div class="col-md-9">
			<div class="alert alert-success">
				{{ Session::get('success')}}
			</div>
		</div>
	</div>
@endif

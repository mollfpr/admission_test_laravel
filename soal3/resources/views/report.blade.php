@extends('layouts.app')

@section('content')
	<div class="row justify-content-center">
		<div class="col-md-9">
			<table class="table table-bordered">
				<thead>
					<th>#</th>
					<th>Type</th>
					<th>Amount</th>
					<th>Time</th>
				</thead>
				<tbody>
					@foreach($transactions as $t)
		                <tr>
		                    <td>{{ $loop->iteration }}</td>
		                    <td>{!! $t->type_formatted !!}</td>
		                    <td>{!! $t->amount_formatted !!}</td>
		                    <td>{!! $t->created_at !!}</td>
		                </tr>
		            @endforeach
				</tbody>
			</table>
		</div>
	</div>

	<script>
		window.print();
	</script>
@endsection
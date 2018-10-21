@extends('layouts.app')

@section('content')
<div class="container">
    @include('layouts.flash')
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4 class="header-title">Account Information</h4>     
                </div>

                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column">
                            <h4>Number</h4>
                            {{ $account->number }}
                        </div>
                        <div class="d-flex flex-column">
                            <h4>Balance</h4>
                            {{ $account->balance_formatted }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center m-t-2">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">Mutation</h4>
                        <a href="{{ route('download') }}" class="btn btn-primary btn-xs">Download</a>
                    </div>
                </div>
                <div class="card-body">
                    @if($transactions->isEmpty())
                        <div class="alert alert-warning">
                            No data.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-center">
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
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

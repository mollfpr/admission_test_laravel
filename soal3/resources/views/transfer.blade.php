@extends('layouts.app')

@section('content')
<div class="container">
    @include('layouts.flash')
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4 class="header-title">Transfer</h4>     
                </div>

                <div class="card-body">
                    {!! Form::open(['route' => 'transfer.store']) !!}

                        <div class="form-group col-md-12">
                            <label for="">Account</label>
                            {!! Form::select('account_id', $accounts, null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group col-md-12">
                            <label for="">Amount</label>
                            {!! Form::number('amount', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="d-flex justify-content-center">
                            <button class="btn btn-success">Transfer</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

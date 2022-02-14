@extends('layouts.admin.app')

@section('content')

    <div class="row" style="float: right; width: 85%;">

        <div class="col-lg-12 col-md-12">
            @if(session('success'))
                <div class="text-center alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card ">
                <div class="card-header">
                </div>
                <div class="card-body">
                    @dd($orders)
                </div>

            </div>


        </div>

    </div>

@endsection

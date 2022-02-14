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
                    <p>Расчеты: {{$count ?? ''}}</p>
                    <p>Оплаченные: {{$paidCount ?? ''}}</p>
                    <p>Подписанные: {{$acceptedCount ?? ''}}</p>
                    <p>Не подписались: {{$inProcessCount ?? ''}}</p>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Номер заказ</th>
                            <th scope="col">ИИН</th>
                            <th scope="col">Agr_isn</th>
                            <th scope="col">Status</th>
                            <th scope="col">Premium Sum</th>
                            <th scope="col">Policy Result</th>
                            <th scope="col">Updated_at</th>
                            <th scope="col">Created_at</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <th scope="row">{{$order->id}}</th>
                                <td>{{$order->iin}}</td>
                                <td>{{$order->agr_isn}}</td>
                                <td>{{$order->status}}</td>
                                <td>{{$order->premium_sum}}</td>
                                <td>{{$order->policy_result}}</td>
                                <td>{{$order->updated_at}}</td>
                                <td>{{$order->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>

            </div>


        </div>

    </div>

@endsection

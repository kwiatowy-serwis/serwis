@extends('layouts.admin')

@section('content')
    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-sm-12">
                <h1>Wszystkie zamówienia</h1>
                <table class="table table-bordered">
                    <tr>

                        <th>@sortablelink('id')</th>
                        <th>@sortablelink('user_id')</th>
                        <th>@sortablelink('ware')</th>
                        <th>@sortablelink('quantity')</th>
                        <th>@sortablelink('price')</th>
                        <th>@sortablelink('firstname')</th>
                        <th>@sortablelink('lastname')</th>
                        <th>@sortablelink('phone')</th>
                        <th>@sortablelink('city')</th>
                        <th>@sortablelink('street')</th>
                        <th>@sortablelink('houseNumber')</th>
                        <th>@sortablelink('zip_code')</th>
                        <th>@sortablelink('created_at')</th>
                    </tr>
                    @foreach($flowerOrders as $key => $flowerOrder)
                            <tr>
                                <td>{{ $flowerOrder->id }}</td>
                                <td>{{$flowerOrder->user_id}}</td>
                                <td>{{ $flowerOrder->ware}}</td>
                                <td>{{ $flowerOrder->quantity}}</td>
                                <td>{{ $flowerOrder->price}}</td>
                                <td>{{ $flowerOrder->orderPlace()->firstname}}</td>
                                <td>{{ $flowerOrder->orderPlace()->lastname}}</td>
                                <td>{{ $flowerOrder->orderPlace()->phone}}</td>
                                <td>{{ $flowerOrder->orderPlace()->city}}</td>
                                <td>{{ $flowerOrder->orderPlace()->street}}</td>
                                <td>{{ $flowerOrder->orderPlace()->houseNumber}}</td>
                                <td>{{ $flowerOrder->orderPlace()->zip_code}}</td>
                                <td>{{ $flowerOrder->created_at}}</td>
                            </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                {!! $flowerOrders->appends(\Request::except('page'))->render() !!}
            </div>
        </div>
    </div>

@endsection

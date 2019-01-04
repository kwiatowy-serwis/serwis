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
            @if($flowerOrders->count())
                @foreach($flowerOrders as $key => $flowerOrder)
                    <tr>
                        <td>{{ $flowerOrder->id }}</td>
                        <td>{{$flowerOrder->user_id}}</td>
                        <td>{{ $flowerOrder->ware}}</td>
                        <td>{{ $flowerOrder->quantity}}</td>
                        <td>{{ $flowerOrder->price}}</td>
                        <td>{{ $orderPlaces[$key]->firstname}}</td>
                        <td>{{ $orderPlaces[$key]->lastname}}</td>
                        <td>{{ $orderPlaces[$key]->phone}}</td>
                        <td>{{ $orderPlaces[$key]->city}}</td>
                        <td>{{ $orderPlaces[$key]->street}}</td>
                        <td>{{ $orderPlaces[$key]->houseNumber}}</td>
                        <td>{{ $orderPlaces[$key]->zip_code}}</td>
                        <td>{{ $flowerOrder->created_at}}</td>
                    </tr>
                @endforeach
            @endif
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

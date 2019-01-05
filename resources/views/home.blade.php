@extends('layouts.admin')

@section('content')
    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-sm-12">
                <h1>Wszystkie zamówienia</h1>
                <table class="table table-bordered">
                    <tr>
                        <th>Lp</th>
                        <th>@sortablelink('ware', 'Towar')</th>
                        <th>@sortablelink('quantity', 'Ilość')</th>
                        <th>@sortablelink('price', 'Cena')</th>
                        <th>@sortablelink('firstname', 'Imię')</th>
                        <th>@sortablelink('lastname', 'Nazwisko')</th>
                        <th>@sortablelink('phone', 'Numer telefonu')</th>
                        <th>@sortablelink('city', 'Miasto')</th>
                        <th>@sortablelink('street', 'Ulica')</th>
                        <th>@sortablelink('houseNumber', 'Numer domu')</th>
                        <th>@sortablelink('zip_code', 'Kod pocztowy')</th>
                        <th>@sortablelink('created_at', 'Data złożenia zamówienia')</th>
                    </tr>
                    @foreach($flowerOrders as $key => $flowerOrder)
                            <tr>
                                <td>{{ $i++}}</td>
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

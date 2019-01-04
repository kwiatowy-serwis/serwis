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
                        @if($flowerOrder->user_id == $user->id)
                            <tr>
                                <td>{{ $i++}}</td>
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
                        @endif
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

@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <h1>Wszystkie zamówienia</h1>

                <table class="table">
                    <thead>
                    <tr>
                        <th>Lp</th>
                        <th>Towar</th>
                        <th>Ilość</th>
                        <th>Cena</th>
                        <th>Imie</th>
                        <th>Nazwisko</th>
                        <th>Telefon</th>
                        <th>Miasto</th>
                        <th>Ulica</th>
                        <th>Numer domu</th>
                        <th>Kod pocztowy</th>
                        <th>created_at</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($flowerOrders && $orderPlaces)
                        @foreach($flowerOrders as $key => $flowerOrder)
                            @if($user->id == $flowerOrder->user_id)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$flowerOrder->ware}}</td>
                                <td>{{$flowerOrder->quantity}}</td>
                                <td>{{$flowerOrder->price}}</td>
                                <td>{{$orderPlaces[$key]->firstname}}</td>
                                <td>{{$orderPlaces[$key]->lastname}}</td>
                                <td>{{$orderPlaces[$key]->phone}}</td>
                                <td>{{$orderPlaces[$key]->city}}</td>
                                <td>{{$orderPlaces[$key]->street}}</td>
                                <td>{{$orderPlaces[$key]->houseNumber}}</td>
                                <td>{{$orderPlaces[$key]->zip_code}}</td>
                                <td>{{$flowerOrder->created_at}}</td>

                            </tr>
                        @endif
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
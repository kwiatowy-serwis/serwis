@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <h1>Szczegóły zamówienia:</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <h2>Towar: {{$flower->name}}</h2>
                        <h2>Ilość sztuk: {{$data->quantity}}</h2>
                        <h2>Cena: {{$data->quantity*$flower->price}} zł</h2>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection
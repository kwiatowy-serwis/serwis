@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row text-center">
            <div class="col-sm-12">
                <a href="{{route('ordersAdmin')}}"><button class="btn btn-primary" style="width: 50%">Przejrzyj zamówienia</button></a>
            </div>
        </div>
        <br/>
        <div class="row text-center">
            <div class="col-sm-12">
                <a href="{{route('usersAdmin')}}"><button class="btn btn-primary" style="width: 50%">Zobacz listę użytkowników</button></a>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')

    <h1>Opis</h1>
    <h2>Cena</h2>
    <h2>Ilosc sztuk</h2>

    @foreach($flowers as $key=>$flower)

        @if($flower->id == 3)


            <p>{{$flower->name}}</p>


        @endif


    @endforeach



@endsection

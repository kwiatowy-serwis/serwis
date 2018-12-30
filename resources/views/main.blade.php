@extends('welcome')

@section('content')
    <div class="row">
@foreach ($flowers as $key => $flower)

        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img src="{{$flower->flowerImage}}" alt="roza" width="200px" height="200px">
                <div class="caption">
                    <h3>{{$flower->name}}</h3>
                    <p>Count: {{$flower->quantity}}</p>
            </div>
                <p class="button-flower"><a href="{{route('flower-details')}}" class="btn btn-primary" role="button">Kup Teraz</a></p>
            </div>
        </div>

@endforeach
    </div>
@endsection
@extends('welcome')

@section('content')
@foreach ($flowers as $flower)
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img src="{{$flower->flowerImage}}" alt="roza" width="200px" height="200px">
                <div class="caption">
                    <h3>{{$flower->name}}</h3>
                    <p>Count: {{$flower->quantity}}</p>
                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection
@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="thumbnail">
                    <img class="flower-image-details" src="{{$flower->flowerImage}}" alt="{{$flower->name}}">
                    <div class="caption caption-custom">
                        <h1>{{$flower->name}}</h1>
                        <h3>Ilość sztuk:</h3>
                        <select class="form-control form-control-custom">
                            @for($i=1; $i<=$flower->quantity; $i++)

                                <option>{{$i}}</option>
                            @endfor
                        </select>

                            <h3>Cena:</h3>

                    <div class="button-details">
                        <form action="" method="GET">
                            <input type="hidden" name="flower" value=""/>
                            <button type="submit" class="btn btn-primary" role="button">Kup Teraz</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

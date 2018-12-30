@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-12">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <h1>Szczegóły zamówienia:</h1>
                        <br/>
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



    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 contact-header-text">
                <h1>Formularz zamówienia</h1>
            </div>
        </div>
    </div>
<br/>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">

                <form method="post" action="{{action('OrderController@makeOrder')}}">
                    @csrf
                    <div class="form-group row">
                        <label for="firstname" class="col-md-2 col-form-label text-md-left">{{ __('Imie') }}</label>

                        <div class="col-md-4">
                            <input id="firstname" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="lastname" class="col-md-2 col-form-label text-md-left">{{ __('Nazwisko') }}</label>

                        <div class="col-md-4">
                            <input id="lastname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('surname') }}" required autofocus>

                            @if ($errors->has('surname'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-2 col-form-label text-md-left">{{ __('Numer telefonu') }}</label>

                        <div class="col-md-4">
                            <input id="phone" type="text" class="form-control" name="phone" required>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="city" class="col-md-2 col-form-label text-md-left">{{ __('Miasto') }}</label>

                        <div class="col-md-4">
                            <select class="form-control" name="city">

                                @if($flower->city == "Rzeszow")
                                    <option value="rzeszow">Rzeszów</option>
                               @else
                                    <option value="krakow">Kraków</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="street" class="col-md-2 col-form-label text-md-left">{{ __('Ulica') }}</label>

                        <div class="col-md-4">
                            <input id="street" type="text" class="form-control" name="street" required>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="houseNumber" class="col-md-2 col-form-label text-md-left">{{ __('Numer domu') }}</label>

                        <div class="col-md-4">
                            <input id="houseNumber" type="text" class="form-control" name="houseNumber" required>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="zip_code" class="col-md-2 col-form-label text-md-left">{{ __('Kod pocztowy') }}</label>

                        <div class="col-md-4">
                            <input id="zip_code" type="text" class="form-control" name="zip_code" required>

                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4 offset-md-2">
                            <button type="submit" class="btn btn-primary btn-primary-custom">
                                {{ __('Złóż zamówienie') }}
                            </button>
                        </div>
                    </div>

            </div>
        </div>
    </div>



@endsection
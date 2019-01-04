@extends('layouts.admin')

@section('content')
    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-sm-12">
                <h1>Wszyscy użytkownicy</h1>
                <table class="table table-bordered">
                    <tr>

                        <th>@sortablelink('id')</th>
                        <th>@sortablelink('name', 'Imie')</th>
                        <th>@sortablelink('surname', 'Nazwisko')</th>
                        <th>@sortablelink('email', 'Email')</th>
                        <th>@sortablelink('isAdmin', 'Uprawnienia admina')</th>
                        <th>@sortablelink('created_at', 'Data utworzenia')</th>
                    </tr>
                    @if($users->count())
                        @foreach($users as $key => $user)
                            <tr>
                                <td><a href="{{route('userAdmin.show', ['id' => $user->id])}}">{{$user->id}}</a></td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->surname}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->isAdmin}}</td>
                                <td>{{$user->created_at}}</td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                {!! $users->appends(\Request::except('page'))->render() !!}
            </div>
        </div>
    </div>

@endsection

@extends('layouts.admin')

@section('content')
    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-sm-12">
                <h1>Wszyscy użytkownicy</h1>
                <table class="table table-bordered">
                    <tr>

                        <th>@sortablelink('id')</th>
                        <th>@sortablelink('name')</th>
                        <th>@sortablelink('surname')</th>
                        <th>@sortablelink('email')</th>
                        <th>@sortablelink('isAdmin')</th>
                        <th>@sortablelink('created_at')</th>
                    </tr>
                    @if($users->count())
                        @foreach($users as $key => $user)
                            <tr>
                                <td>{{$user->id}}</td>
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

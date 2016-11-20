@extends('layouts.app')


@section('content')

    @foreach($users as $user)
        <ul><li> <a href="{{route('users.profile',$user->username)}}">{!!$user->username!!}</a></li></ul>


        @endforeach

    @endsection
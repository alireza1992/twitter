@extends('layouts.app')

@section('content')
    <div class="container">
    <h1>Results for "{{\Illuminate\Support\Facades\Request::input('query')}}"</h1>
    @if(!$users->count())
        <p>No Results</p>

        @else

        @foreach($users as $user)
        <div class="col-md-8">

            <div class="posts" >
                <div class="media"  >
                    <div class="media-left">
                        <img class="media-object" src="https://www.gravatar.com/avatar/{{md5($user->email)}}x?s=45&d=mm">
                    </div>
                    <div class="media-body">
                        <div class="user">
                            <a href="{{route('users.profile',$user->username)}}">{{$user->username}}</a>
                        </div>
                        <p></p>
                    </div>
                </div>
            </div>

            <hr>
        </div>
        @endforeach

        @endif




    </div>




    @endsection

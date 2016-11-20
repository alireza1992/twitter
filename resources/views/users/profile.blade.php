@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>{{$user->username}}</h3>


                @if(\Illuminate\Support\Facades\Auth::user()->isNot($user))
                    @if(\Illuminate\Support\Facades\Auth::user()->isFollowing($user))
                        <a href="{{route('users.unfollow',$user)}}">unfollow</a>

                    @else
                        <a href="{{route('users.follow',$user)}}">follow</a>
                        @endif
                    @endif
            </div>
        </div>
    </div>
    @endsection
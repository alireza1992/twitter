@extends('layouts.app')


@section('content')
    <div class="container">
    <div class="row">


    @foreach($users as $user)

        <div style="width: 200px;height: 200px;background-color: gray;text-align: center; float: right; margin-bottom: 22px;
                    margin-right: 17px;
         ">
            <a href="{{route('users.profile',$user->username)}}"><img src="{{$user->getavatar()}}" alt="{!!$user->username!!}" ></a>
            <strong>{!!$user->username!!}</strong>
        </div>
        <br>


        @endforeach
    </div>
    </div>


@endsection


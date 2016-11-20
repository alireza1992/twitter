<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index(User $user)
    {
        $user=User::where('username', $user->username)->first();

        if(!$user)
        {
            abort(404);
        }

        return view('users.profile')->with('user', $user);

    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */

    public function follow(Request $request, User $user)
    {
        if($request->user()->canFollow($user))
        {
            $request->user()->following()->attach($user);
        }

        return redirect()->back();
    }

    public function unfollow(Request $request, User $user)
    {
        if($request->user()->canUnFollow($user))
        {
            $request->user()->following()->detach($user);
        }
        return redirect()->back();

    }

    public function lists()
        {
            $users = User::all();
            return view('user.list',compact('users'));

        }




}

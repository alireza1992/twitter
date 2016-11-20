<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    public function index(User $user)
    {

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

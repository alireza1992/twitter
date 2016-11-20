<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function getResult(Request $request)
    {

        $query = $request->input('query');
        if(!$query)
        {
            return redirect('/');
        }

        $users = User::where('username','LIKE',"%{$query}%")
            ->get();


        return view('search.results',compact('users'));
    }
}

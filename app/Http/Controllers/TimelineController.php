<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class TimelineController extends Controller
{

    public function index()
    {
//        dd(\Auth::user()->follower());
        return view('home');
    }
}

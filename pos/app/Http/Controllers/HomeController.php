<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index ()
    {
        // if (auth()->user()->level == 0) {
        //     abort(403, 'You are not admin');
        // }
        return view("page.home.index");
    }
}

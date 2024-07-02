<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function dashboard()
    {
        return view('public.dashboard');
    }

    public function allnewsletters()
    {
        return view('public.allnewsletters');
    }
}
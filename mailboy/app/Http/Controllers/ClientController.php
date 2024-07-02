<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function dashboard()
    {
        return view('client.dashboard');
    }

    public function mynewsletters()
    {
        return view('client.mynewsletters');
    }

    public function mysubscribers()
    {
        return view('client.mysubscribers');
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function dashboard()
    {
        return view('subscriber.dashboard');
    }
    
    public function mysubscriptions()
    {
        return view('subscriber.mysubscriptions');
    }

    public function allnewsletters()
    {
        return view('subscriber.allnewsletters');
    }
}

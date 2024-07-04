<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;

class PublicController extends Controller
{
    public function dashboard()
    {
        return view('public.dashboard');
    }

    /**
     * Display a listing with only name and date added.
     */
    public function allNewsletters()
    {
        $newsletters = Newsletter::where('active', 1)
                                ->select('name', 'created_at')
                                ->get();
        // dd($newsletters); // to Debug output

        return view('public.allnewsletters', compact('newsletters'));
    }

}

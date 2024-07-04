<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;

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

    public function showActiveNewsletters()
    {
        $activeNewsletters = Newsletter::where('active', 1)->get();
        $subscriptions = auth()->user()->newsletters->pluck('id')->toArray();

        return view('subscriber.allnewsletters', compact('activeNewsletters', 'subscriptions'));
    }

    public function subscribe(Request $request, $newsletterId)
    {
        logger()->info('Subscription attempt for newsletterId: ' . $newsletterId);

        $user = auth()->user();
        $newsletter = Newsletter::findOrFail($newsletterId);
    
        if ($user->newsletters->contains($newsletter->id)) {
            return back()->with('error', 'Already subscribed to this newsletter.');
        }
    
        $newsletter->subscribers()->attach($user->id);
    
        logger()->info('Successfully subscribed to newsletter.');

        return back()->with('success', 'Successfully subscribed to newsletter.')
        ->with('newsletterId', $newsletterId);

    }

    public function unsubscribe(Request $request, $newsletterId)
    {
        $user = auth()->user();
        $newsletter = Newsletter::findOrFail($newsletterId);

        if (!$user->newsletters->contains($newsletter->id)) {
            return back()->with('error', 'Not subscribed to this newsletter.');
        }

        $newsletter->subscribers()->detach($user->id);

        return back()->with('success', 'Successfully unsubscribed from newsletter.');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;

class ClientController extends Controller
{
    public function dashboard()
    {
        return view('client.dashboard');
    }

    public function mysubscribers($newsletterId)
    {
        $newsletter = Newsletter::findOrFail($newsletterId);
        $subscribers = $newsletter->subscribers;
    
        return view('client.mysubscribers', compact('newsletter', 'subscribers'));
    }
    
    public function mynewsletters()
    {
        $clientNewsletters = auth()->user()->newsletters;
        return view('client.mynewsletters', compact('clientNewsletters'));
    }

    /**
     * Show the form for creating a new newsletter.
     */
    public function createNewsletter()
    {
        return view('client.create-newsletter');
    }

    /**
     * Store a newly created newsletter in storage.
     */
    public function storeNewsletter(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'active' => 'required|boolean',
        ]);

        auth()->user()->newsletters()->create([
            'name' => $request->name,
            'description' => $request->description,
            'active' => $request->active,
        ]);

        return redirect()->route('client.mynewsletters')->with('success', 'Newsletter created successfully.');
    }

    /**
     * Show the form for editing the specified newsletter.
     */
    public function editNewsletter($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        return view('client.edit-newsletter', compact('newsletter'));
    }

    /**
     * Update the specified newsletter in storage.
     */
    public function updateNewsletter(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'active' => 'required|boolean',
        ]);

        $newsletter = Newsletter::findOrFail($id);
        $newsletter->update([
            'name' => $request->name,
            'description' => $request->description,
            'active' => $request->active,
        ]);

        return redirect()->route('client.mynewsletters')->with('success', 'Newsletter updated successfully.');
    }

    /**
     * Remove the specified newsletter from storage.
     */
    public function destroyNewsletter($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        $newsletter->delete();

        return redirect()->route('client.mynewsletters')->with('success', 'Newsletter deleted successfully.');
    }
}
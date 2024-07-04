<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Auth;

class NewsletterController extends Controller
{
    public function index()
    {
        $newsletters = Newsletter::all();
        return view('newsletters.index', compact('newsletters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('newsletters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'active' => 'required|boolean',
        ]);

        Newsletter::create([
            'name' => $request->name,
            'description' => $request->description,
            'active' => $request->active,
            'addeduid' => Auth::id(),
        ]);

        return redirect()->route('newsletters.index')->with('success', 'Newsletter created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $newsletter = Newsletter::findOrFail($id);
        return view('newsletters.show', compact('newsletter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $newsletter = Newsletter::findOrFail($id);
        return view('newsletters.edit', compact('newsletter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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

        return redirect()->route('newsletters.index')->with('success', 'Newsletter updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $newsletter = Newsletter::findOrFail($id);
        $newsletter->delete();

        return redirect()->route('newsletters.index')->with('success', 'Newsletter deleted successfully.');
    }
}

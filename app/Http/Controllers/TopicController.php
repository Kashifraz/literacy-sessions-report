<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $topics = Topic::all();
        return view("subforms.topic", ['topics' => $topics]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
        ]);

        Topic::create([
            'title' => $request->title,
        ]);

        return redirect()->back()->with("message", "Topic Added Successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Topic $topic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Topic $topic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic)
    {
        $topic->delete();
        return redirect()->back()->with("message","Topic Deleted Successfully");
    }
}

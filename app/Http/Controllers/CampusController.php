<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use Illuminate\Http\Request;

class CampusController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $campuses = Campus::all();
        return view("subforms.campus", ['campuses' => $campuses]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
            'code' => 'required|min:2|max:255',
        ]);

        Campus::create([
            'name' => $request->name,
            'code' => $request->code
        ]);

        return redirect()->back()->with("message", "Campus Added Successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Campus $campus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Campus $campus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Campus $campus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campus $campus)
    {
        $campus->delete();
        return redirect()->back()->with("message","campus deleted successfully");
    }
}

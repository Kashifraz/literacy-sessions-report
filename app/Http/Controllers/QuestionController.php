<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $questions = Question::orderBy('order_id', 'asc')->get();
        return view("subforms.question", ['questions' => $questions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'order_id' => 'required',
        ]);

        Question::create([
            'title' => $request->title,
            'order_id' => $request->order_id,
            'strongly_agree'=> 0,
            'agree' => 0,
            'disagree' => 0,
            'strongly_disagree' => 0,
            'no_response' => 0,
        ]);

        return redirect()->back()->with("message", "Question Added Successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->back()->with("message", "Question deleted successfully");
    }
}

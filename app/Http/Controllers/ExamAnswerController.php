<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamAnswer;
use App\Models\ExamQuestion;
use Inertia\Inertia;

class ExamAnswerController extends Controller
{
  public function store(Request $request, $questionId)
  {
    $request->validate([
      'answer_text' => 'required|string|max:500',
      'is_correct' => 'required|boolean',
    ]);

    ExamAnswer::create([
      'question_id' => $questionId,
      'answer_text' => $request->answer_text,
      'is_correct' => $request->is_correct,
    ]);

    return redirect()->back()->with('success', 'Answer added successfully.');
  }

  public function destroy($id)
  {
    ExamAnswer::findOrFail($id)->delete();
    return redirect()->back()->with('success', 'Answer deleted.');
  }
}

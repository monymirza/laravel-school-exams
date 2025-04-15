<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamQuestion;
use App\Models\Exam;
use Inertia\Inertia;

class ExamQuestionController extends Controller
{
  public function index($examId)
  {
    $exam = Exam::with('questions.answers')->findOrFail($examId);
    return Inertia::render('Exams/ManageQuestions', [
      'exam' => $exam
    ]);
  }

  public function store(Request $request, $examId)
  {
    $request->validate([
      'question_text' => 'required|string|max:500',
    ]);

    ExamQuestion::create([
      'exam_id' => $examId,
      'question_text' => $request->question_text
    ]);

    return redirect()->back()->with('success', 'Question added successfully.');
  }

  public function destroy($id)
  {
    ExamQuestion::findOrFail($id)->delete();
    return redirect()->back()->with('success', 'Question deleted.');
  }
}

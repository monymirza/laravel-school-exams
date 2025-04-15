<?php

namespace App\Http\Controllers;

use App\Models\ExamAnswer;
use App\Models\ExamSubmission;
use Illuminate\Http\Request;
use App\Models\Exam;
use Inertia\Inertia;

class ExamController extends Controller
{
  public function index()
  {
    // Ensure that we only fetch exams for the logged-in teacher
    $exams = Exam::where('teacher_id', auth()->id())->get();

    return Inertia::render('Exams/ExamsList', [
      'exams' => $exams,
      'userRole' => auth()->user()->getRoleNames()->first(),
    ]);
  }

  public function create()
  {
    return Inertia::render('Exams/Create', []);
  }

  public function show($id)
  {
    $exam = Exam::with('questions.answers')->findOrFail($id);

    return Inertia::render('Exams/Take', [
      'exam' => $exam
    ]);
  }

  public function indexApi(Request $request)
  {
    return response()->json(
      Exam::where('teacher_id', $request->user()->id)->get()
    );
  }


  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required|string|max:255',
      'description' => 'nullable|string',
    ]);

    Exam::create([
      'teacher_id' => auth()->id(),
      'title' => $request->title,
      'description' => $request->description,
      'status' => 'active',
    ]);

    return redirect()->route('exams.index')->with('success', 'Exam created successfully.');
  }

  public function take($id)
  {
    $exam = Exam::with('questions.answers')->findOrFail($id);

    return Inertia::render('Exams/Take', [
      'exam' => $exam
    ]);
  }

  public function submit(Request $request, $examId)
  {
    $request->validate([
      'answers' => 'required|array',
    ]);

    $exam = Exam::findOrFail($examId);

    // Check if student has already submitted this exam
    if (ExamSubmission::where('exam_id', $exam->id)->where('student_id', auth()->id())->exists()) {
      return redirect()->route('dashboard')->with('error', 'You have already submitted this exam.');
    }

    // Calculate score
    $totalQuestions = count($exam->questions);
    $correctAnswers = 0;

    foreach ($request->answers as $questionId => $answerId) {
      $correctAnswer = ExamAnswer::where('question_id', $questionId)
        ->where('is_correct', true)
        ->first();

      if ($correctAnswer && $correctAnswer->id == $answerId) {
        $correctAnswers++;
      }
    }

    $score = ($correctAnswers / $totalQuestions) * 100;

    // Store submission
    ExamSubmission::create([
      'exam_id' => $exam->id,
      'student_id' => auth()->id(),
      'answers' => json_encode($request->answers),
      'score' => round($score),
      'submitted_at' => now(),
    ]);

    return redirect()->route('dashboard')->with('success', 'Exam submitted successfully.');
  }

}

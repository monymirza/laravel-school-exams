<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
  public function index()
  {
    return Inertia::render('Dashboard', [
      'userRole' => auth()->user()->getRoleNames()->first(),
      'availableExams' => Exam::where('status', 'active')->get(),
      'examHistory' => ExamSubmission::where('student_id', Auth::id())->with('exam')->get(),
    ]);
  }
}

<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExamAnswerController;
use App\Http\Controllers\ExamQuestionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Middleware\RoleMiddleware;

Route::get('/', function () {
  return Inertia::render('Welcome');
})->name('home');

//Route::get('/dashboard', function () {
//  return Inertia::render('Dashboard', [
//    'userRole' => auth()->user()->getRoleNames()->first(),
//  ]);
//})->middleware(['auth', 'verified'])->name('dashboard');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
  ->middleware(['auth'])
  ->name('dashboard');

// User Management (Only for Superadmin)
Route::middleware(['auth', 'role:superadmin'])->group(function () {
  Route::resource('users', UserController::class);
});

Route::middleware('auth')->group(function () {
  // Profile Management
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

  // **Teacher Routes**
  Route::middleware(['role:teacher'])->group(function () {
    Route::get('/exams', [ExamController::class, 'index'])->name('exams.index');
    Route::get('/exams/create', [ExamController::class, 'create'])->name('exams.create');
    Route::post('/exams', [ExamController::class, 'store'])->name('exams.store');
    Route::get('/exams/{exam}', [ExamController::class, 'show'])->name('exams.show');

    // Questions
    Route::get('/exams/{exam}/questions', [ExamQuestionController::class, 'index'])->name('exams.questions');
    Route::post('/exams/{exam}/questions', [ExamQuestionController::class, 'store'])->name('exams.questions.store');
    Route::delete('/questions/{id}', [ExamQuestionController::class, 'destroy'])->name('questions.destroy');

    // Answers
    Route::get('/questions/{question}/answers', [ExamAnswerController::class, 'index'])->name('exams.answers');
    Route::post('/questions/{question}/answers', [ExamAnswerController::class, 'store'])->name('answers.store');
    Route::delete('/answers/{id}', [ExamAnswerController::class, 'destroy'])->name('answers.destroy');
  });

  // **Student Routes**
  Route::middleware(['role:student'])->group(function () {
    Route::get('/exams/take/{exam}', [ExamController::class, 'take'])->name('exams.take');
    Route::post('/exams/submit/{exam}', [ExamController::class, 'submit'])->name('exams.submit');
  });
});

// Disable registration route
Route::get('/register', function () {
  abort(403, 'Registration is disabled.');
})->name('register');

require __DIR__.'/auth.php';

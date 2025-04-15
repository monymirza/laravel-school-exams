<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSubmission extends Model
{
  use HasFactory;

  protected $fillable = ['exam_id', 'student_id', 'answers', 'score', 'submitted_at'];

  protected $casts = [
    'answers' => 'array', // Store JSON answers as an array
  ];

  public function exam()
  {
    return $this->belongsTo(Exam::class);
  }

  public function student()
  {
    return $this->belongsTo(User::class, 'student_id');
  }
}

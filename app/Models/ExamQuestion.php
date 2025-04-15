<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
  use HasFactory;

  protected $fillable = ['exam_id', 'question_text'];

  public function exam()
  {
    return $this->belongsTo(Exam::class);
  }

  public function answers()
  {
    return $this->hasMany(ExamAnswer::class, 'question_id');
  }
}

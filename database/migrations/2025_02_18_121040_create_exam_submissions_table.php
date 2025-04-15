<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('exam_submissions', function (Blueprint $table) {
      $table->id();
      $table->foreignId('exam_id')->constrained('exams')->onDelete('cascade');
      $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
      $table->json('answers'); // Stores submitted answers in JSON format
      $table->integer('score')->nullable(); // Score after grading
      $table->timestamp('submitted_at')->nullable(); // Time of submission
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('exam_submissions');
  }
};

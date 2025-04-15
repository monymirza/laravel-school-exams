<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('exam_answers', function (Blueprint $table) {
      $table->id();
      $table->foreignId('question_id')->constrained('exam_questions')->onDelete('cascade'); // Links to a question
      $table->text('answer_text'); // Answer option text
      $table->boolean('is_correct')->default(false); // Indicates if it's the correct answer
      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('exam_answers');
  }
};

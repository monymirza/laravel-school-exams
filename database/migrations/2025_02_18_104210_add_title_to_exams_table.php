<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::table('exams', function (Blueprint $table) {
      $table->string('title')->after('teacher_id'); // Add title column
      $table->text('description')->nullable()->after('title'); // Add description
      $table->enum('status', ['active', 'inactive'])->default('active')->after('description'); // Add status column
    });
  }

  public function down(): void
  {
    Schema::table('exams', function (Blueprint $table) {
      $table->dropColumn(['title', 'description', 'status']);
    });
  }
};

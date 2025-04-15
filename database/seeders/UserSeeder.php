<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder {

  public function run() {
    // Ensure roles exist
    $roles = ['superadmin', 'teacher', 'student'];
    foreach ($roles as $role) {
      Role::firstOrCreate(['name' => $role]);
    }

    // Create 3 Superadmin Users
    for ($i = 1; $i <= 3; $i++) {
      $user = User::create([
        'name' => "Superadmin $i",
        'email' => "superadmin$i@example.com",
        'password' => Hash::make('password'), // Default password: password
      ]);
      $user->assignRole('superadmin');
    }

    // Create 3 Teacher Users
    for ($i = 1; $i <= 3; $i++) {
      $user = User::create([
        'name' => "Teacher $i",
        'email' => "teacher$i@example.com",
        'password' => Hash::make('password'),
      ]);
      $user->assignRole('teacher');
    }

    // Create 3 Student Users
    for ($i = 1; $i <= 3; $i++) {
      $user = User::create([
        'name' => "Student $i",
        'email' => "student$i@example.com",
        'password' => Hash::make('password'),
      ]);
      $user->assignRole('student');
    }

    $this->command->info('✅ 3 users created for each role: Superadmin, Teacher, and Student.');
  }

}

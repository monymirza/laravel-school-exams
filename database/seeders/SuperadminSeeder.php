<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class SuperadminSeeder extends Seeder
{
  public function run()
  {
    $user = User::firstOrCreate([
      'email' => 'superadmin@example.com'
    ], [
      'name' => 'Super Admin',
      'password' => bcrypt('password123'),
    ]);

    $role = Role::firstOrCreate(['name' => 'superadmin']);
    $user->assignRole($role);
  }
}

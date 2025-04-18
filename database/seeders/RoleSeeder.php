<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
  public function run()
  {
    Role::create(['name' => 'superadmin']);
    Role::create(['name' => 'teacher']);
    Role::create(['name' => 'student']);
  }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Inertia\Inertia;

class UserController extends Controller
{
  public function index()
  {
    return Inertia::render('Users/Index', [
      'users' => User::whereHas('roles')->get(),
      'roles' => Role::whereIn('name', ['teacher', 'student'])->get(), // Ensure correct role retrieval
    ]);
  }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'email' => 'required|email|unique:users',
      'password' => 'required|min:6',
      'role' => 'required|in:teacher,student',
    ]);

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => bcrypt($request->password),
    ]);

    $role = Role::where('name', $request->role)->firstOrFail();
    $user->assignRole($role);

    return redirect()->route('users.index')->with('success', 'User created successfully.');
  }
}

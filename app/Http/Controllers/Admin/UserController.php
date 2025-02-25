<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return view('admins.users.index');
    }

    public function create()
    {
        $roles = Role::all();
        return view('admins.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'role_id' => 'required',
        ]);

        if (User::where('email', $request->email)->exists()) {
            return redirect()->back()->with('error', 'Email already exists');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $role = Role::findById($request->role_id);
        $user->syncRoles($role);

        return redirect()->route('admins.users.index')->with('success', 'User created');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admins.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role_id' => 'required',
        ]);

        if (User::where('email', $request->email)->exists() and $user->email != $request->email) {
            return redirect()->back()->with('error', 'Email already exists');
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $role = Role::findById($request->role_id);
        $user->syncRoles($role);

        return redirect()->route('admins.users.index')->with('success', 'User updated');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admins.users.index')->with('success', 'User deleted');
    }

    public function show(User $user)
    {
        $user->load('roles');
        return view('admins.users.show', compact('user'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')
            ->latest()
            ->paginate(10);

        $roles = Role::all();

        return view('user.index', compact('users', 'roles'));
    }

    public function show($id)
    {
        $user = User::with('roles')->findOrFail($id);

        return view('user.show', compact('user'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('user.create', compact('roles'));
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole($data['role']);

        return redirect()->route('users.index')->with('toasts', [['type' => 'success', 'message' => 'User created successfully.']]);
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        return view('user.edit', compact('user', 'roles'));
    }

    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        if (!empty($data['password'])) {
            $user->update([
                'password' => Hash::make($data['password']),
            ]);
        }

        $user->syncRoles([$data['role']]);

        return redirect()->route('users.index')->with('toasts', [['type' => 'success', 'message' => 'User updated successfully.']]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('toasts', [['type' => 'success', 'message' => 'User deleted successfully.']]);
    }
}

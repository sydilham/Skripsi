<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::whereIn('role', ['operator', 'kepala_sekolah'])->get();
        return view('kelolaakun.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User ditambahkan');
    }

    public function edit(User $user)
    {
        return view('kelolaakun.partials.form-edit-user', compact('user'));
    }

    public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'required',
        'password' => 'nullable|min:6',
    ]);

    $data = $request->only(['name', 'email', 'role']);

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User diperbarui');
    }

    public function resetPassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|min:6',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Password direset');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User dihapus');
    }
}

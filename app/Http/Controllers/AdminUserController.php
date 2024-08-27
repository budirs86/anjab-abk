<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        $title = 'Data User';
        $users = User::all();

        return view('admin.users.index', compact('title', 'users'));
    }

    public function create()
    {
        $title = 'Tambah User';
        $roles = Role::all();

        return view('admin.users.create', compact('title','roles'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|min:4|max:255',
            'email' => 'required|email|unique:user',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
            'role' => 'required'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password'])
        ]);

        $user->assignRole($validated['role']);

        return redirect()->route('admin.users.index')->with('success', 'User ' . $user->name . ' berhasil ditambahkan');
    }
    public function destroy(User $user){
        // dd($user->name);

        $user->delete();
    
        return redirect()->route('admin.users.index')->with('success', 'User ' . $user->name . ' berhasil dihapus');
    }

    // create empty edit and update function
    public function edit(User $user) {
        // dd($user->getRoleNames()[0]);
        $title = 'Edit User';
        $roles = Role::all();

        return view('admin.users.edit', compact('title', 'user', 'roles'));
    }
    
    public function update(Request $request, User $user) {

        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|min:4|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required',
            'password' => 'nullable|min:8|confirmed',
            'password_confirmation' => 'nullable'
        ]);

        if (!empty($validated['password']) && !Hash::check($validated['password'], $user->password)) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }
        
        $user->update($validated);

        $user->assignRole($validated['role']);

        return redirect()->route('admin.users.index')->with('success', 'User ' . $user->name . ' berhasil diupdate');
    }

}


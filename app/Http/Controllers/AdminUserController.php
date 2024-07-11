<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

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
}

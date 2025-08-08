<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->oldest()->paginate(10);
        return view('admin.pages.user', [
            'user' => Auth::user(),
            'userCount' => User::count(),
            'aktivitas' => User::latest()->get(),
            'users' => $users
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            'title' => 'Register',
            'active' => 'register',
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'userName' => ['required', 'min:3', 'unique:users'],
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['role_id'] = 5;

        User::create($validatedData);

        return redirect('/login')->with('success', 'Daftar berhasil! Silahkan Login.');
    }
}

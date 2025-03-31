<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            ' name'=>'required|max:100|string',
            'email'=>'required|string|email|unique:users',
            'password'=>'required|min:8|max:50'
        ]);
    }
}

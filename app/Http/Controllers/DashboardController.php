<?php

namespace App\Http\Controllers;


use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::whereNot('id', auth()->id())->get();

        return view('dashboard', compact('users'));
    }
}

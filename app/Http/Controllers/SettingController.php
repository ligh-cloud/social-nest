<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('user.settings', ['user' => $user]);
    }


    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'bio' => 'nullable|string|max:255',
        ]);

        $user->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'bio' => $request->bio,
        ]);

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}

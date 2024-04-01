<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard() {
        return view('admin1');
    }

    public function login() {
        return view('adminlog');
    }

    public function processLogin(Request $request) {
        $validated = $request->validate([
            'username' => ['required', 'max:55'],
            'password' => ['required', 'max:15']
        ]);

        $user = Admin::where('username', $validated['username'])
            ->first();

        if($user && auth()->guard('admin')->attempt($validated)) {
            auth()->login($user);
            $request->session()->regenerate();
            return redirect('/admin/dashboard')->with('message_success', 'Welcome ' . auth()->user()->full_name . '!');
        } else {
            return back()->with('message_failed', 'Username or password is incorrect.');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index() {
        $admins = Admin::paginate(6);
        return view('admin.index', compact('admins'));
    }

    public function create() {
        return view('admin.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'full_name' => ['required', 'max:55'],
            'username' => ['required', 'max:12', Rule::unique('admins', 'username')],
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required']
        ]);
        $validated['password'] = bcrypt($validated['password']);
        $admin = Admin::create($validated);

        if($admin) {
            return back()->with('message_success', 'Admin successfully saved.');
        } else {
            return back()->with('message_failed', 'Failed to save admin.');
        }
    }

    public function edit($id) {
        $admin = Admin::find($id);
        return view('admin.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin) {
        $validated = $request->validate([
            'full_name' => ['required', 'max:55'],
            'username' => ['required', 'max:12', Rule::unique('admins', 'username')->ignore($admin)]
        ]);

        $admin = $admin->update($validated);

        if ($admin) {
            return redirect('/admins')->with('message_success', 'Admin successfully updated.');
        } else {
            return back()->with('message_failed', 'Failed to update admin.');
        }
    }

    public function delete($id) {
        $admin = Admin::find($id);
        return view('admin.delete', compact('admin'));
    }

    public function destroy(Request $request, Admin $admin) {
        $admin = $admin->delete($request);

        if($admin) {
            return redirect('/admins')->with('message_success', 'Admin successfully deleted.');
        } else {
            return back()->with('message_failed', 'Failed to delete admin.');
        }
    }

    public function resetPassword($id) {
        $admin = Admin::find($id);
        return view('admin.reset_password', compact('admin'));
    }

    public function processResetPassword(Admin $admin) {
        $admin = $admin->update([
            'password' => bcrypt('123')
        ]);

        if ($admin) {
            return redirect('/admins')->with('message_success', 'Successfully reset admin password.');
        } else {
            return back()->with('message_failed', 'Failed to reset admin password.');
        }
    }
    
    public function dashboard() {
        return view('admin1');
    }

    public function addAccount() {
        return view('admin.add_account');
    }

    public function login() {
        return view('adminlog');
    }

    public function processLogin(Request $request) {
        $validated = $request->validate([
            'username' => ['required', 'max:12'],
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

    public function logout() {
        return view('logout.logout');
    }

    public function processLogout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login')->with('message_success', 'Your account was successfully logged out.');
    }
}

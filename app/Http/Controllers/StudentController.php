<?php

namespace App\Http\Controllers;

use App\Models\LoginHistory;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function create() {
        return view('register');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'full_name' => ['required'],
            'student_id_no' => ['required'],
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required']
        ]);

        $validated['password'] = bcrypt($validated['password']);

        Student::create($validated);

        return back()->with('message_success', 'Student successfully registered.');
    }

    public function loginPage() {
        return view('login');
    }

    public function loginProcess(Request $request) {
        $validated = $request->validate([
            'student_id_no' => ['required'],
            'password' => ['required']
        ]);

        $student = Student::where('student_id_no', $validated['student_id_no'])
            ->first();

        if($student && Hash::check($validated['password'], $student->password)) {
            LoginHistory::create([
                'student_id' => $student->student_id
            ]);

            return back()->with('message_success', 'Successfully logged in.');
        }
    }
}

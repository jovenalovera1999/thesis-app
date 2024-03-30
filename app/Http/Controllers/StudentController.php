<?php

namespace App\Http\Controllers;

use App\Models\LoginHistory;
use App\Models\Section;
use App\Models\Strand;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index() {
        $students = LoginHistory::select('login_histories.created_at', 'students.full_name', 'students.student_id_no', 'strands.strand', 'sections.section', 'teachers.teacher')
            ->join('students', 'login_histories.student_id', '=', 'students.student_id')
            ->join('strands', 'students.strand_id', '=', 'strands.strand_id')
            ->join('sections', 'students.section_id', '=', 'sections.section_id')
            ->join('teachers', 'students.teacher_id', '=', 'teachers.teacher_id')
            ->get();
            
        return view('history', compact('students'));
    }

    public function create() {
        return view('register');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'full_name' => ['required'],
            'strand_id' => ['required'],
            'section_id' => ['required'],
            'teacher_id' => ['required'],
            'student_id_no' => ['required'],
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required']
        ]);

        $validated['password'] = bcrypt($validated['password']);

        // Strand
        $strand = Strand::where('strand', $validated['strand_id'])->first();

        if (empty($strand)) {
            $strand = Strand::create([
                'strand' => $validated['strand_id']
            ]);

            $validated['strand_id'] = $strand->strand_id;
        } else {
            $validated['strand_id'] = $strand->strand_id;
        }

        // Section
        $section = Section::where('section', $validated['section_id'])->first();

        if (empty($section)) {
            $section = Section::create([
                'section' => $validated['section_id']
            ]);

            $validated['section_id'] = $section->section_id;
        } else {
            $validated['section_id'] = $section->section_id;
        }

        // Teacher
        $teacher = Teacher::where('teacher', $validated['teacher_id'])->first();

        if (empty($teacher)) {
            $teacher = Teacher::create([
                'teacher' => $validated['teacher_id']
            ]);

            $validated['teacher_id'] = $teacher->teacher_id;
        } else {
            $validated['teacher_id'] = $teacher->teacher_id;
        }

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

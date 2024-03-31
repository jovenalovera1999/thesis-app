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
            ->orderBy('login_histories.login_history_id', 'desc');

        if(request()->has('search')) {
            $searchTerm = request()->get('search');

            if($searchTerm) {
                $students = $students->where(function($query) use ($searchTerm) {
                    $query->where('login_histories.created_at', 'like', "%$searchTerm%")
                        ->orWhere('students.full_name', 'like', "%$searchTerm%")
                        ->orWhere('students.student_id_no', 'like', "%$searchTerm%")
                        ->orWhere('strands.strand', 'like', "%$searchTerm%")
                        ->orWhere('sections.section', 'like', "%$searchTerm%")
                        ->orWhere('teachers.teacher', 'like', "%$searchTerm%")
                        ->orderBy('login_histories.login_history_id', 'desc');
                });
            }
        }

        $students = $students->paginate(25);

        return view('history', compact('students'));
    }

    public function create() {
        return view('register');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'full_name' => ['required', 'max:55'],
            'strand_id' => ['required', 'max:55'],
            'section_id' => ['required', 'max:55'],
            'teacher_id' => ['required', 'max:55'],
            'student_id_no' => ['required', 'max:55'],
            'password' => ['required', 'confirmed', 'max:15'],
            'password_confirmation' => ['required', 'max:15']
        ], [
            'strand_id.required' => 'The strand field is required.',
            'section_id.required' => 'The section field is required.',
            'teacher_id.required' => 'The teacher field is required.',
            'student_id_no.required' => 'The student id number is required',
            'strand_id.max' => 'The strand field must not be greater than 55 characters.',
            'section_id.max' => 'The section field must not be greater than 55 characters.',
            'teacher_id.max' => 'The teacher field must not be greater than 55 characters.',
            'student_id_no.max' => 'The student id number field must not be greater than 55 characters.'
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

    public function processLogin(Request $request) {
        $validated = $request->validate([
            'student_id_no' => ['required', 'max:55'],
            'password' => ['required', 'max:15']
        ], [
            'student_id_no.required' => 'The student id number field is required.',
            'student_id_no.max' => 'The student id number field must not be greater than 55 characters.'
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

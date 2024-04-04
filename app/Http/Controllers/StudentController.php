<?php

namespace App\Http\Controllers;

use App\Models\LoginHistory;
use App\Models\Section;
use App\Models\Strand;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index() {
        $students = Student::select('students.student_id','students.student_id_no', 'students.full_name', 'strands.strand', 'sections.section', 'teachers.teacher', 'students.created_at', 'students.updated_at')
            ->join('strands', 'students.strand_id', '=', 'strands.strand_id')
            ->join('sections', 'students.section_id', '=', 'sections.section_id')
            ->join('teachers', 'students.teacher_id', '=', 'teachers.teacher_id')
            ->where('students.is_deleted', false);

        if(request()->has('search')) {
            $searchTerm = request()->get('search');

            if($searchTerm) {
                $students = $students->where(function($query) use ($searchTerm) {
                    $query->where('students.student_id_no', 'like', "%$searchTerm%")
                        ->orWhere('students.full_name', 'like', "%$searchTerm%")
                        ->orWhere('strands.strand', 'like', "%$searchTerm%")
                        ->orWhere('sections.section', 'like', "%$searchTerm%")
                        ->orWhere('teachers.teacher', 'like', "%$searchTerm%");
                });
            }
        }

        $students = $students->orderBy('students.full_name')
            ->orderBy('students.student_id_no')
            ->paginate(7)
            ->appends(['search' => request()->get('search')]);

        return view('student.index', compact('students'));
    }

    public function loginHistories() {
        $students = LoginHistory::select('login_histories.created_at', 'students.full_name', 'students.student_id_no', 'strands.strand', 'sections.section', 'teachers.teacher')
            ->join('students', 'login_histories.student_id', '=', 'students.student_id')
            ->join('strands', 'students.strand_id', '=', 'strands.strand_id')
            ->join('sections', 'students.section_id', '=', 'sections.section_id')
            ->join('teachers', 'students.teacher_id', '=', 'teachers.teacher_id');

        if(request()->has('search')) {
            $searchTerm = request()->get('search');

            if($searchTerm) {
                $students = $students->where(function($query) use ($searchTerm) {
                    $query->where('login_histories.created_at', 'like', "%$searchTerm%")
                        ->orWhere('students.full_name', 'like', "%$searchTerm%")
                        ->orWhere('students.student_id_no', 'like', "%$searchTerm%")
                        ->orWhere('strands.strand', 'like', "%$searchTerm%")
                        ->orWhere('sections.section', 'like', "%$searchTerm%")
                        ->orWhere('teachers.teacher', 'like', "%$searchTerm%");
                });
            }
        }

        $students = $students->orderBy('login_histories.login_history_id', 'desc')
            ->paginate(8)
            ->appends(['search' => request()->get('search')]);

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
            'student_id_no' => ['required', 'max:55', Rule::unique('students', 'student_id_no')],
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

        // Retrieve or create Strand
        $strand = Strand::firstOrCreate(['strand' => $validated['strand_id']]);
        $validated['strand_id'] = $strand->strand_id;

        // Retrieve or create Section
        $section = Section::firstOrCreate(['section' => $validated['section_id']]);
        $validated['section_id'] = $section->section_id;

        // Retrieve or create Teacher
        $teacher = Teacher::firstOrCreate(['teacher' => $validated['teacher_id']]);
        $validated['teacher_id'] = $teacher->teacher_id;

        $student = Student::create($validated);

        if ($student) {
            return back()->with('message_success', 'Student successfully registered.');
        } else {
            return back()->with('message_failed', 'Failed to register student.');
        }
    }

    public function edit($id) {
        $student = Student::join('strands', 'students.strand_id', '=', 'strands.strand_id')
            ->join('sections', 'students.section_id', '=', 'sections.section_id')
            ->join('teachers', 'students.teacher_id', '=', 'teachers.teacher_id')
            ->find($id);

        return view('student.edit', compact('student'));
    }

    public function update(Request $request, Student $student) {
        $validated = $request->validate([
            'full_name' => ['required', 'max:55'],
            'strand_id' => ['required', 'max:55'],
            'section_id' => ['required', 'max:55'],
            'teacher_id' => ['required', 'max:55'],
            'student_id_no' => ['required', 'max:55', Rule::unique('students', 'student_id_no')->ignore($student)]
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

        $strand = Strand::firstOrCreate(['strand' => $validated['strand_id']]);
        $validated['strand_id'] = $strand->strand_id;

        $section = Section::firstOrCreate(['section' => $validated['section_id']]);
        $validated['section_id'] = $section->section_id;

        $teacher = Teacher::firstOrCreate(['teacher' => $validated['teacher_id']]);
        $validated['teacher_id'] = $teacher->teacher_id;

        $student = $student->update($validated);

        if($student) {
            return redirect('/students')->with('message_success', 'Student successfully updated.');
        } else {
            return back()->with('message_failed', 'Failed to update student.');
        }
    }

    public function editPassword($id) {
        $student = Student::find($id);
        return view('student.edit_password', compact('student'));
    }

    public function updatePassword(Request $request, Student $student) {
        $validated = $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required']
        ]);

        $validated['password'] = bcrypt($validated['password']);

        if(Hash::check($validated['current_password'], $student->password)) {
            $student = $student->update([
                'password' => $validated['password']
            ]);

            if($student) {
                return redirect('/students')->with('message_success', 'Student password successfully updated.');
            } else {
                return back()->with('message_failed', 'Failed to update student password.');
            }
        } else {
            return back()->with('message_failed', 'Password is incorrect.');
        }
    }

    public function delete($id) {
        $student = Student::join('strands', 'students.strand_id', '=', 'strands.strand_id')
            ->join('sections', 'students.section_id', '=', 'sections.section_id')
            ->join('teachers', 'students.teacher_id', '=', 'teachers.teacher_id')
            ->find($id);

        return view('student.delete', compact('student'));
    }

    public function destroy(Student $student) {
        $student = $student->update(['is_deleted' => 1]);

        if($student) {
            return redirect('/students')->with('message_success', 'Student successfully deleted.');
        } else {
            return back()->with('message_failed', 'Failed to delete student.');
        }
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
            $loginHistory = LoginHistory::create([
                'student_id' => $student->student_id
            ]);

            if($loginHistory) {
                return back()->with('message_success', 'Successfully logged in.');
            } else {
                return back()->with('message_failed', 'Failed to logged in.');
            }
        } else {
            return back()->with('message_failed', 'ID number or password is incorrect.');
        }
    }
}

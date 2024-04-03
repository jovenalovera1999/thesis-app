@extends('layout.main')

@section('content')

<header>
    <h1 class="logo"><img src="{{ asset('img/logo.png') }}"></h1>
    <nav class="navigation">
        @include('include.nav_menu')
    </nav>
</header>

<div class="wrapper">
    @include('include.toast_messages')
    <h1> EDIT STUDENT </h1>
    <form action="/student/update/{{ $student->student_id }}" method="post">
        @method('PUT')
        @csrf
        <div class="input-box">
            <input type="text" class="form-control" name="full_name" placeholder="Full Name"
                value="{{ old('full_name', $student->full_name) }}" />
            @error('full_name') <p style="color: white">{{ $message }}</p> @enderror
        </div>
        <div class="input-box">
            <input type="text" class="form-control" name="strand_id" placeholder="Strand"
                value="{{ old('strand_id', $student->strand) }}" />
            @error('strand_id') <p style="color: white">{{ $message }}</p> @enderror
        </div>
        <div class="input-box">
            <input type="text" class="form-control" name="section_id" placeholder="Section"
                value="{{ old('section_id', $student->section) }}" />
            @error('section_id') <p style="color: white">{{ $message }}</p> @enderror
        </div>
        <div class="input-box">
            <input type="text" class="form-control" name="teacher_id" placeholder="Teacher"
                value="{{ old('teacher_id', $student->teacher) }}" />
            @error('teacher_id') <p style="color: white">{{ $message }}</p> @enderror
        </div>
        <div class="input-box">
            <input type="text" class="form-control" name="student_id_no" placeholder="ID Number"
                value="{{ old('student_id_no', $student->student_id_no) }}" />
            @error('student_id_no') <p style="color: white">{{ $message }}</p> @enderror
        </div>
        <div class="form-btn">
            <button type="submit" class="btn btn-primary">SAVE</button>
            <a href="/students" class="btn btn-primary">BACK</a>
        </div>
    </form>
</div>

@endsection
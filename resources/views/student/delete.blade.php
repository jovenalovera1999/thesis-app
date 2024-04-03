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
    <h1> DELETE STUDENT </h1>
    <p>Are you sure do you want to delete this student named "{{ $student->full_name }}"</p>
    <form action="/student/destroy/{{ $student->student_id }}" method="post">
        @method('DELETE')
        @csrf
        <div class="input-box">
            <input type="text" class="form-control" name="full_name" placeholder="Full Name"
                value="{{ $student->full_name }}" readonly />
        </div>
        <div class="input-box">
            <input type="text" class="form-control" name="student_id_no" placeholder="ID Number"
                value="{{ $student->student_id_no }}" readonly />
        </div>
        <div class="form-btn">
            <button type="submit" class="btn btn-primary">Yes</button>
            <a href="/students" class="btn btn-primary mt-3">No</a>
        </div>
    </form>
</div>

@endsection
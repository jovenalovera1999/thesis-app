@extends('layout.main')

@section('content')

<div class="wrapper">
    <h1>LOG IN</h1>
    <form action="/student/process/login" method="post">
        @csrf
        <div class="input-box">
            <input type="text" placeholder="ID Number" name="student_id_no" class="form-control" value="{{ old('student_id_no') }}" />
            <i class='bx bxs-user'></i>
            @error('student_id_no') <p style="color: white">{{ $message }}</p> @enderror
        </div>
        <div class="input-box">
            <input type="password" placeholder="Password" name="password" class="form-control" />
            <i class='bx bxs-lock-alt'></i>
            @error('password') <p style="color: white">{{ $message }}</p> @enderror
        </div>
        <div class="form-btn">
            <input type="submit" value="Login" name="login" class="btn btn-primary">
        </div>
    </form>
</div>

@endsection
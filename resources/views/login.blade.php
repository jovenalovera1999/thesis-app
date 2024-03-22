@extends('layout.main')

@section('content')

<div class="wrapper">
    <h1>LOG IN</h1>
    <form action="/student/login" method="post">
        @csrf
        <div class="input-box">
            <input type="text" placeholder="ID Number" name="student_id_no" class="form-control" required>
            <i class='bx bxs-user'></i>
        </div>
        <div class="input-box">
            <input type="password" placeholder="Password" name="password" class="form-control" required>
            <i class='bx bxs-lock-alt'></i>
        </div>
        <div class="form-btn">
            <input type="submit" value="Login" name="login" class="btn btn-primary">
        </div>
    </form>
</div>

@endsection
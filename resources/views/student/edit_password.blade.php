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
    <form action="/student/update/password/{{ $student->student_id }}" method="post">
        @method('PUT')
        @csrf
        <div class="input-box">
            <input type="password" class="form-control" name="current_password" placeholder="Current Password" />
            @error('current_password') <p style="color: white">{{ $message }}</p> @enderror
        </div>
        <div class="input-box">
            <input type="password" class="form-control" name="password" placeholder="Password" />
            @error('password') <p style="color: white">{{ $message }}</p> @enderror
        </div>
        <div class="input-box">
            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" />
            @error('password_confirmation') <p style="color: white">{{ $message }}</p> @enderror
        </div>
        <div class="form-btn">
            <button type="submit" class="btn btn-primary">SAVE</button>
            <a href="/students" class="btn btn-primary">BACK</a>
        </div>
    </form>
</div>

@endsection
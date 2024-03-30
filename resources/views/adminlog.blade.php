@extends('layout.main')

@section('content')
<div class="wrapper">
    <h1>ADMIN LOG IN</h1>
    <form action="/admin/process/login" method="post">
        @csrf
        <div class="input-box">
            <input type="text" placeholder="Admin User" name="username" class="form-control" />
            <i class='bx bxs-user'></i>
            @error('username') <p style="color: white">{{ $message }}</p> @enderror
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
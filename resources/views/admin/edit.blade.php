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
    <h1> EDIT ADMIN </h1>
    <form action="/admin/update/{{ $admin->admin_id }}" method="post">
        @method('PUT')
        @csrf
        <div class="input-box">
            <input type="text" class="form-control" name="full_name" placeholder="Full Name"
                value="{{ old('full_name', $admin->full_name) }}" />
            @error('full_name') <p style="color: white">{{ $message }}</p> @enderror
        </div>
        <div class="input-box">
            <input type="text" class="form-control" name="username" placeholder="Username"
                value="{{ old('username', $admin->username) }}" />
            @error('username') <p style="color: white">{{ $message }}</p> @enderror
        </div>
        <div class="form-btn">
            <button type="submit" class="btn btn-primary">Yes</button>
            <a href="/admins" class="btn btn-primary mt-3">Back</a>
        </div>
    </form>
</div>

@endsection
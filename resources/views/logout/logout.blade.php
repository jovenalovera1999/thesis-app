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
    <h1> LOGOUT </h1>
    <p>Are you sure do you want to logout?</p>
    <form action="/admin/process/logout" method="post">
        @csrf
        <div class="input-box">
            <input type="text" class="form-control" name="full_name" placeholder="Full Name"
                value="{{ auth()->user()->full_name }}" readonly />
        </div>
        <div class="form-btn">
            <button type="submit" class="btn btn-primary">Yes</button>
            <a href="/admins" class="btn btn-primary mt-3">No</a>
        </div>
    </form>
</div>

@endsection
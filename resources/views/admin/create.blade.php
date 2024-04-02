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
    <h1> REGISTER </h1>
    <form action="/admin/store" method="post">
        @csrf
        <div class="input-box">
            <input type="text" class="form-control" name="full_name" placeholder="Full Name" value="{{ old('full_name') }}" />
            @error('full_name') <p style="color: white">{{ $message }}</p> @enderror
        </div>
        <div class="input-box">
            <input type="text" class="form-control" name="username" placeholder="Username" value="{{ old('username') }}" />
            @error('username') <p style="color: white">{{ $message }}</p> @enderror
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
            <input type="submit" class="btn btn-primary" name="submit" />
        </div>
    </form>
</div>

@endsection
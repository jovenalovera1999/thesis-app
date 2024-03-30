@extends('layout.main')

@section('content')
<header>
        <h1 class = "logo"><img src = "{{ asset('img/logo.png') }}"></h1>
        <nav class="navigation">
            <a href="/admin/dashboard">Home</a>
            <a href="/students/login/histories">History</a>
            <a href="#"></a>
        </nav>
</header>
    

    <div class="wrapper">
    <h1> REGISTER </h1>
        <form action="/student/store" method="post">
            @csrf
            <div class="input-box">
                <input type="text" class="form-control" name="full_name" placeholder="Full Name" value="{{ old('full_name') }}" />
                @error('full_name') <p style="color: white">{{ $message }}</p> @enderror
            </div>
            <div class="input-box">
                <input type="text" class="form-control" name="strand_id" placeholder="Strand" value="{{ old('strand_id') }}" />
                @error('strand_id') <p style="color: white">{{ $message }}</p> @enderror
            </div>
            <div class="input-box">
                <input type="text" class="form-control" name="section_id" placeholder="Section" value="{{ old('section_id') }}" />
                @error('section_id') <p style="color: white">{{ $message }}</p> @enderror
            </div>
            <div class="input-box">
                <input type="text" class="form-control" name="teacher_id" placeholder="Teacher" value="{{ old('teacher_id') }}" />
                @error('teacher_id') <p style="color: white">{{ $message }}</p> @enderror
            </div>
            <div class="input-box">
                <input type="text" class="form-control" name="student_id_no" placeholder="ID Number" value="{{ old('student_id_no') }}" />
                @error('student_id_no') <p style="color: white">{{ $message }}</p> @enderror
            </div>
            <div class="input-box">
                <input type="password" class="form-control" name="password" placeholder="Password" />
                @error('password') <p style="color: white">{{ $message }}</p> @enderror
            </div>
            <div class="input-box">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Repeat Password" />
                @error('password_confirmation') <p style="color: white">{{ $message }}</p> @enderror
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit" />
            </div>
        </form>
        <div>
        <div><p><center>Already Registered? <a href="/">Login Here</a></center></p></div>
      </div>
    </div>
@endsection
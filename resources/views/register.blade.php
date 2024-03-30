@extends('layout.main')

@section('content')
<header>
        <h1 class = "logo"><img src = "{{ asset('img/logo.png') }}"></h1>
        <nav class="navigation">
            <a href="admin1.html">Home</a>
            <a href="History.html">History</a>
            <a href="#"></a>
        </nav>
</header>
    

    <div class="wrapper">
    <h1> REGISTER </h1>
        <form action="/student/store" method="post">
            @csrf
            <div class="input-box">
                <input type="text" class="form-control" name="full_name" placeholder="Full Name" required>
            </div>
            <div class="input-box">
                <input type="text" class="form-control" name="strand_id" placeholder="Strand" required>
            </div>
            <div class="input-box">
                <input type="text" class="form-control" name="section_id" placeholder="Section" required>
            </div>
            <div class="input-box">
                <input type="text" class="form-control" name="teacher_id" placeholder="Teacher" required>
            </div>
            <div class="input-box">
                <input type="emamil" class="form-control" name="student_id_no" placeholder="ID Number" required>
            </div>
            <div class="input-box">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="input-box">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Repeat Password" required>
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
        <div>
        <div><p><center>Already Registered? <a href="/">Login Here</a></center></p></div>
      </div>
    </div>
@endsection
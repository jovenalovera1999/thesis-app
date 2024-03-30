@extends('layout.main')
    
@section('content')
    
<div class="wrapper">
        <h1>ADMIN PAGE</h1>
        <br>
        <div class="reg">
            <button type="button" onclick="location.href='/student/register'">ADD STUDENT ACCOUNT</button>
        </div>
        <br>
        <div class="history">
            <button type="button" onclick="location.href='/students/login/histories'">LOG IN HISTORY</button>  
        </div>
</div>

@endsection

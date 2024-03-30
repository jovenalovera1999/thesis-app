@extends('layout.main')

@section('content')
<header>
    <h1 class = "logo"><img src="{{ asset('img/logo.png') }}"></h1>
    <nav class="navigation">
        <a href="/admin/dashboard">Home</a>
        <a href="/student/register">Add Account</a>
        <a href="#"></a>
        <input class="srch" type="text" placeholder= "Search Here...">
        <button class ="btn"> SEARCH </button>
    </nav>
</header>

<div class="container">
    <h1>SENIOR HIGH STUDENTS HISTORY</h1> 
    <table>
        <thead class="head">
            <tr>
                <th>Date & Time</th>
                <th>Name</th>
                <th>Strand</th>
                <th>Teacher</th>
                <th>ID Number</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ date('m/d/Y h:i A', strtotime($student->created_at)) }}</td>
                    <td>{{ $student->full_name }}</td>
                    <td>{{ $student->strand . ' ' . $student->section }}</td>
                    <td>{{ $student->teacher }}</td>
                    <td>{{ $student->student_id_no }}</td>
                </tr>
            @endforeach
            <!-- Add more rows as needed -->
        </tbody>
    </table>
</div>

</body>
</html>

@endsection
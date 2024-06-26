@extends('layout.main')

@section('content')

<header>
    <h1 class="logo"><img src="{{ asset('img/logo.png') }}"></h1>
    <nav class="navigation">
        @include('include.nav_menu')
    </nav>
</header>

<div class="container">
    <h1 class="mt-5">SENIOR HIGH STUDENTS HISTORY</h1>
    <div class="table-responsive">
        <form action="/students/login/histories" method="get">
            <input class="srch float-end" type="text" id="search" name="search" placeholder= "Search Here..." />
        </form>
        <div class="mt-5 me-1">
            {{ $students->links() }}
        </div>
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
</div>

@endsection
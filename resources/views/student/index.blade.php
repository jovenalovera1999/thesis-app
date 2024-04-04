@extends('layout.main')

@section('content')

<header>
    <h1 class="logo"><img src="{{ asset('img/logo.png') }}"></h1>
    <nav class="navigation">
        @include('include.nav_menu')
    </nav>
</header>

<div class="container">
    <div class="mx-auto">
        @include('include.toast_messages')
    </div>
    <h1 class="mt-5">LIST OF STUDENTS</h1>
    <div class="table-responsive">
        <div class="mb-5">
            <form action="#" method="get">
                <input class="srch float-end" type="text" id="search" name="search" placeholder="Search Here..." />
            </form>
        </div>
        <div class="mt-3 me-1">
            {{ $students->links() }}
        </div>
        <table class="mt-1">
            <thead class="head">
                <tr>
                    <th>ID Number</th>
                    <th>Full Name</th>
                    <th>Strand</th>
                    <th>Section</th>
                    <th>Teacher</th>
                    <th>Date Created</th>
                    <th>Date Updated</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                <tr>
                    <td>{{ $student->student_id_no }}</td>
                    <td>{{ $student->full_name }}</td>
                    <td>{{ $student->strand }}</td>
                    <td>{{ $student->section }}</td>
                    <td>{{ $student->teacher }}</td>
                    <td>{{ date('m/d/Y h:i A', strtotime($student->created_at)) }}</td>
                    <td>{{ date('m/d/Y h:i A', strtotime($student->updated_at)) }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="/student/edit/{{ $student->student_id }}" class="btn btn-warning text-black">Edit</a>
                            <a href="/student/delete/{{ $student->student_id }}" class="btn btn-danger text-black">Delete</a>
                            <a href="/student/edit/password/{{ $student->student_id }}" class="btn btn-danger text-black">Change Password</a>
                        </div>
                    </td>
                </tr>
                @endforeach
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
</div>

@endsection
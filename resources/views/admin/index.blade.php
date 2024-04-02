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
    <h1 class="mt-5">LIST OF ADMINS</h1>
    <div class="table-responsive">
        <div class="mb-5">
            <form action="#" method="get">
                <input class="srch float-end" type="text" id="search" name="search" placeholder="Search Here..." />
            </form>
        </div>
        <div class="mt-3 me-1">
            {{ $admins->links() }}
        </div>
        <table class="mt-1">
            <thead class="head">
                <tr>
                    <th>Full Name</th>
                    <th>Date Created</th>
                    <th>Date Updated</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                    <tr>
                        <td>{{ $admin->full_name }}</td>
                        <td>{{ date('m/d/Y h:i A', strtotime($admin->created_at)) }}</td>
                        <td>{{ date('m/d/Y h:i A', strtotime($admin->updated_at)) }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="/admin/edit/{{ $admin->admin_id }}" class="btn btn-warning text-black">Edit</a>
                                <a href="/admin/delete/{{ $admin->admin_id }}" class="btn btn-danger text-black">Delete</a>
                                <a href="/admin/reset/password/{{ $admin->admin_id }}" class="btn btn-danger text-black">Reset Password</a>
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
@extends('layouts.main')

@section('content')
    <div id="main">
    <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
        <div class="row">
            <div class="col s10 m6 l6">
            <h5 class="breadcrumbs-title mt-0 mb-0"><span>Agnet Travels</span></h5>
            <ol class="breadcrumbs mb-0">
                <li class="breadcrumb-item"><a href="/admin">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="/admin/users">Agent Travel</a>
                </li>
                <li class="breadcrumb-item active">Agent List
                </li>
            </ol>
            </div>
        </div>
        </div>
        </div>
        <div class="col s12">
        <div class="container">
            <!-- users list start -->
        <section class="users-list-wrapper section">
            <div class="users-list-filter">
                <div class="card-panel">
                <div class="row">
                    <form>
                    <div class="col s12 m6 l3">
                        <label for="users-list-role">Role</label>
                        <div class="input-field">
                        <select class="form-control" id="users-list-role">
                            <option value="">Any</option>
                            <option value="User">User</option>
                            <option value="Admin">Admin</option>
                        </select>
                        </div>
                    </div>
                    <div class="col s12 m6 l3">
                        <label for="users-list-status">Status</label>
                        <div class="input-field">
                        <select class="form-control" id="users-list-status">
                            <option value="">Any</option>
                            <option value="Absolute">Absolute</option>
                            <option value="User">User</option>
                        </select>
                        </div>
                    </div>
                    </form>
                </div>
                </div>
            </div>
            <div class="users-list-table">
                <div class="card">
                <div class="card-content">
                    <!-- datatable start -->
                    <div class="responsive-table">
                    <table id="users-list-datatable" class="table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>id</th>
                            <th>username</th>
                            <th>name</th>
                            <th>registered</th>
                            <th>phone number</th>
                            <th>role</th>
                            <th>status</th>
                            <th>edit</th>
                            <th>view</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($users as $user)

                            <tr>
                                <td></td>
                                <td>{{ $user->id }}</td>
                                <td><a href="/admin/users/{{ $user->id }}">{{ $user->username }}</a>
                                </td>
                                <td>{{ $user->nama_agen_travel }}</td>
                                <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y ') }}</td>
                                <td>{{ $user->no_telepon !== null ? $user->no_telepon : "-" }}</td>
                                <td>{{ $user->is_admin ? 'Admin':'Agent travel' }}</td>
                                <td>
                                    @if($user->is_admin)
                                        <span class="chip green lighten-5"><span class="green-text">Absolute</span></span>
                                    @else
                                        <span class="chip red lighten-5"><span class="red-text">User</span></span>
                                    @endif
                                </td>
                                <td><a href="/admin/users/edit/{{ $user->id }}"><i class="material-icons">edit</i></a></td>
                                <td><a href="/admin/users/{{ $user->id }}"><i class="material-icons">remove_red_eye</i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                    <!-- datatable ends -->
                </div>
                </div>
            </div>
        </section>
<!-- users list ends -->
    </div>
@endsection

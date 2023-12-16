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
            <h5 class="breadcrumbs-title mt-0 mb-0"><span>Customer List</span></h5>
            <ol class="breadcrumbs mb-0">
                <li class="breadcrumb-item"><a href="/admin">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="/admin/customers">Customers</a>
                </li>
                <li class="breadcrumb-item active">Users List
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
            <div class="input-field">
                </div>
            </div>
            <div class="col s12 m6 l3">
                <div class="input-field">
                </div>
            </div>
            <div class="col s12 m6 l3">
                <label for="users-list-status">Gender</label>
                <div class="input-field">
                <select class="form-control" id="users-list-status">
                    <option value="">Any</option>
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
                </div>
            </div>
            <div class="col s12 m6 l3 display-flex align-items-center show-btn">
                <button type="submit" class="btn btn-block indigo waves-effect waves-light">Show</button>
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
                            <th>NIK</th>
                            <th>phone number</th>
                            <th>address</th>
                            <th>gender</th>
                            <th>registered</th>
                            <th>action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td></td>
                                <td>{{ $customer->id }}</td>
                                <td><a href="#">{{ $customer->username }}</a>
                                </td>
                                <td>{{ $customer->nama }}</td>
                                <td>{{ $customer->nik }}</td>
                                <td>{{ $customer->no_telepon !== null ? $customer->no_telepon : "-" }}</td>
                                <td>{{ $customer->alamat }}</td>
                                <td>
                                    @if ( $customer->jenis_kelamin !== 'perempuan' )
                                        <span class="chip cyan lighten-5">
                                        <span class="cyan-text">{{ $customer->jenis_kelamin  }}</span>
                                        </span>
                                    @else
                                        <span class="chip pink lighten-5">
                                        <span class="pink-text">{{ $customer->jenis_kelamin  }}</span>
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    {{  \Carbon\Carbon::parse($customer->created_at)->format('d M Y') }}
                                </td>
                                <td>
                                    <a href="/admin/customers/edit/{{ $customer->id }}"><i class="material-icons indigo-text">edit</i></a>
                                    <form id="deleteForm" action="/admin/customers/delete/{{ $customer->id }}" method="post">
                                        @method('delete')
                                        @csrf
                                            <button class="border-none N/A transparent" onclick="confirmDelete(event)"><i class="material-icons red-text">delete</i></button>
                                    </form>
                                </td>
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

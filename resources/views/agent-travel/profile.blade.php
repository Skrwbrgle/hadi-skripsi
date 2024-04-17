@extends('layouts.main')

@section('content')
    <!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>Users View</span></h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a href="/admin">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="/admin">User</a>
                  </li>
                  <li class="breadcrumb-item active">Users View
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="col s12">
          <div class="container">
            <!-- users view start -->
            <div class="section users-view">
            <!-- users view media object start -->
            <div class="card-panel">
                <div class="row">
                <div class="col s12 m7">
                    <div class="display-flex media">
                    <a href="#" class="avatar">
                        <img src="../../../app-assets/images/avatar/avatar-agen.png" alt="users view avatar" class="z-depth-4 circle"
                        height="64" width="64">
                    </a>
                    <div class="media-body">
                        <h6 class="media-heading">
                        <span class="">{{ $user->nama_agen_travel ? $user->nama_agen_travel : $user->username   }}</span>


                        </h6>
                        <span>ID:</span>
                        <span class="">{{ $user->id }}</span>
                    </div>
                    </div>
                </div>
                <div class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-2">
                    <a href="/agent-travel/edit/{{ $user->id }}" class="btn-small btn-light-indigo">Edit</a>
                    @can('admin')
                        <form id="deleteForm_{{ $user->id }}" action="/admin/users/delete/{{ $user->id }}" method="post" class="{{ $user->is_admin ? 'd-inline ml-3 hide' : 'd-inline ml-3' }}">
                            @method('delete')
                            @csrf
                                <button class="btn-small red" onclick="confirmDelete(event, '{{ $user->id }}')">Delete</button>
                        </form>
                    @endcan
                </div>
                </div>
            </div>
            <!-- users view media object ends -->

            <!-- users view card details start -->
            <div class="card">
                <div class="card-content">
                <div class="row">
                    <div class="col s12">
                      <table class="striped">
                        <tbody>
                            <tr>
                            <td>Registered:</td>
                            <td>{{  \Carbon\Carbon::parse($user->created_at)->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td>Role:</td>
                            <td class="">{{ $user->is_admin === 1 ? 'Admin':'Agent travel' }}</td>
                        </tr>
                        <tr>
                            <td>Status:</td>
                            <td>
                                @if($user->is_admin === 1)
                                    <span class="chip green lighten-5 green-text">Absolute</span>
                                @else
                                    <span class="chip red lighten-5 red-text">User</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Username:</td>
                            <td class="">{{ $user->username }}</td>
                        </tr>
                        <tr>
                            <td>Address:</td>
                            <td>{{ $user->alamat != null? $user->alamat : "-" }}</td>
                        </tr>
                        <tr>
                            <td>Comapny:</td>
                            <td>{{ $user->nama_agen_travel }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <h6 class="mb-2 mt-2"><i class="material-icons">error_outline</i> Personal Info</h6>
                    <table class="striped">
                        <tbody>
                        <tr>
                            <td>Country:</td>
                            <td>ID</td>
                        </tr>
                        <tr>
                            <td>Contact:</td>
                            <td>+(62) {{ $user->no_telepon != null? $user->no_telepon : " -" }}</td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                <!-- </div> -->
                </div>
            </div>
            <!-- users view card details ends -->
            </div>
            <!-- users view ends -->
          </div>
          <div class="content-overlay"></div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->
@endsection

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
                  <li class="breadcrumb-item"><a href="/">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="/">User</a>
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
                        <span class="users-view-name">Dean Stanley </span>
                        <span class="grey-text">@</span>
                        <span class="users-view-username grey-text">candy007</span>
                        </h6>
                        <span>ID:</span>
                        <span class="users-view-id">305</span>
                    </div>
                    </div>
                </div>
                <div class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-2">
                    <a href="user-profile-page.html" class="btn-small btn-light-indigo">Edit</a>
                    <a href="page-users-edit.html" class="btn-small red">Delete</a>
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
                            <td class="users-view-role">{{ $user->is_admin ? 'Admin':'Agent travel' }}</td>
                        </tr>
                        <tr>
                            <td>Status:</td>
                            <td>
                                @if($user->is_admin)
                                    <span class="users-view-status chip green lighten-5 green-text">Absolute</span>
                                @else
                                    <span class="users-view-status chip red lighten-5 red-text">User</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Username:</td>
                            <td class="users-view-username">dean3004</td>
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

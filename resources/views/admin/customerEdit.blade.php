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
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>Customer edit</span></h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a href="/admin">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="/admin/customers">Customers</a>
                  </li>
                  <li class="breadcrumb-item active">Customers Edit
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="col s12">
          <div class="container">
            <!-- users edit start -->
            <div class="section users-edit">
            <div class="card">
                <div class="card-content">
                <!-- <div class="card-body"> -->
                <ul class="tabs mb-2 row">
                    <li class="tab">
                    <a class="display-flex align-items-center active" id="account-tab" href="#account">
                        <i class="material-icons mr-1">person_outline</i><span>Account</span>
                    </a>
                    </li>
                </ul>
                <div class="divider mb-3"></div>
                <div class="row">
                    <div class="col s12" id="account">
                    <!-- users edit media object start -->
                    <div class="media display-flex align-items-center mb-2">
                        <a class="mr-2" href="#">
                        <img src="../../../app-assets/images/avatar/avatar-agen.png" alt="users avatar" class="z-depth-4 circle"
                            height="64" width="64">
                        </a>
                        <div class="media-body">
                        <h5 class="media-heading mt-0">{{ $customer->nama ?  $customer->nama :  $customer->username}}</h5>
                        </div>
                    </div>
                    <!-- users edit media object ends -->
                    <!-- users edit account form start -->
                    <form id="accountForm" method="post" action="/admin/customers/update/{{ $customer->id }}">
                        @method('put')
                        @csrf
                        <div class="row">
                            <div class="col s12 m6">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <input id="username" name="username" type="text" value="{{ old('username', $customer->username) }}" data-error=".errorTxt1" required autofocus>
                                        <label for="username">Username</label>
                                        @error('username')
                                            <div class="card-alert card gradient-45deg-red-pink">
                                            <div class="card-content white-text">
                                                <p>
                                                <i class="material-icons">error</i> DANGER : {{ $message }}</p>
                                            </div>
                                            <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col s12 input-field">
                                        <input id="nama" name="nama" type="text" value="{{ old('nama', $customer->nama ? $customer->nama : '-' ) }}"  data-error=".errorTxt2" required>
                                        <label for="nama">Name</label>
                                        @error('nama')
                                            <div class="card-alert card gradient-45deg-red-pink">
                                            <div class="card-content white-text">
                                                <p>
                                                <i class="material-icons">error</i> DANGER : {{ $message }}</p>
                                            </div>
                                            <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            </div>
                                        @enderror
                                        <small class="errorTxt2"></small>
                                    </div>
                                    <div class="col s12 input-field">
                                        <input id="no_telepon" name="no_telepon" type="text" value="{{ old('',$customer->no_telepon  ? $customer->no_telepon : '-') }}" required>
                                        <label for="no_telepon">Phone</label>
                                        @error('no_telepon')
                                            <div class="card-alert card gradient-45deg-red-pink">
                                            <div class="card-content white-text">
                                                <p>
                                                <i class="material-icons">error</i> DANGER : {{ $message }}</p>
                                            </div>
                                            <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6">
                                <div class="col s12 input-field">
                                    <input id="alamat" name="alamat" type="text" value="{{ old('alamat', $customer->alamat ? $customer->alamat : '-' ) }}"  data-error=".errorTxt2" required>
                                    <label for="alamat">Address</label>
                                    @error('alamat')
                                        <div class="card-alert card gradient-45deg-red-pink">
                                        <div class="card-content white-text">
                                            <p>
                                            <i class="material-icons">error</i> DANGER : {{ $message }}</p>
                                        </div>
                                        <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        </div>
                                    @enderror
                                    <small class="errorTxt2"></small>
                                </div>
                                <div class="col s12 input-field px-4">
                                    <input id="password" name="password" type="password" value="" data-error=".errorTxt3" autocomplete="new-password">
                                    <label for="password">New Password</label>
                                    @error('password')
                                        <div class="card-alert card gradient-45deg-red-pink">
                                        <div class="card-content white-text">
                                            <p>
                                            <i class="material-icons">error</i> DANGER : {{ $message }}</p>
                                        </div>
                                        <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        </div>
                                    @enderror
                                    <small class="errorTxt3"></small>
                                </div>
                                <div class="col s12 input-field">
                                    <input id="password_confirmation" name="password_confirmation" type="password" value="" autocomplete="new-password">
                                    <label for="password_confirmation">Password confirm</label>
                                    @error('password_confirmation')
                                        <div class="card-alert card gradient-45deg-red-pink">
                                        <div class="card-content white-text">
                                            <p>
                                            <i class="material-icons">error</i> DANGER : {{ $message }}</p>
                                        </div>
                                        <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col s12 display-flex justify-content-end mt-3">
                            <button type="submit" class="btn indigo" onclick="confirmEdit(event)">
                            Save changes</button>
                            <a type="button" href="/admin/customers/{{ $customer->id }}" class="btn btn-light">Cancel</a>
                        </div>
                    </form>
                    <!-- users edit account form ends -->
                    </div>
                </div>
                </div>
            </div>
            </div>
<!-- users edit ends -->
@endsection

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
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>Users edit</span></h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a href="/">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="/">User</a>
                  </li>
                  <li class="breadcrumb-item active">Users Edit
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
              <h5 class="media-heading mt-0">{{ $user->nama_agen_travel ?  $user->nama_agen_travel :  $user->username}}</h5>
            </div>
          </div>
          <!-- users edit media object ends -->
          <!-- users edit account form start -->
          <form id="accountForm" method="post" action="/users/update/{{ $user->id }}">
            @method('put')
            @csrf
            <div class="row">
              <div class="col s12 m6">
                <div class="row">
                  <div class="col s12 input-field">
                    <input id="username" name="username" type="text" class="validate" value="{{ old('username', $user->username) }}"
                      data-error=".errorTxt1" required autofocus>
                    <label for="username">Username</label>
                    {{-- @error('username') is-invalid @enderror  --}}
                    {{-- @error('username')
                    <small class="errorTxt1">{{ $message }}</small>
                    @enderror --}}
                  </div>
                  <div class="col s12 input-field">
                    <input id="nama_agen_travel" name="nama_agen_travel" type="text" class="validate" value="{{ old('nama_agen_travel', $user->nama_agen_travel ? $user->nama_agen_travel : '-' ) }}"  data-error=".errorTxt2" required>
                    <label for="nama_agen_travel">Name</label>
                    <small class="errorTxt2"></small>
                  </div>
                   <div class="col s12 input-field">
                    <input id="no_telepon" name="no_telepon" type="text" class="validate" value="{{ old('',$user->no_telepon  ? $user->no_telepon : '-') }}" required>
                    <label for="no_telepon">Phone</label>
                  </div>
                </div>
              </div>
              <div class="col s12 m6">
                <div class="col s12 input-field">
                    <input id="alamat" name="alamat" type="text" class="validate" value="{{ old('alamat', $user->alamat ? $user->alamat : '-' ) }}"  data-error=".errorTxt2" required>
                    <label for="alamat">Address</label>
                    <small class="errorTxt2"></small>
                  </div>
                   <div class="col s12 input-field px-4">
                        <input id="password" name="password" type="password" class="validate" value="" data-error=".errorTxt3">
                        <label for="password">Password</label>
                        <small class="errorTxt3">{{ $errors->first('password') }}</small>
                    </div>

                    <div class="col s12 input-field">
                        <input id="re-password" name="password_confirmation" type="password" class="validate" value="">
                        <label for="re-password">Re-Password</label>
                    </div>
                </div>
              </div>
              <div class="col s12 display-flex justify-content-end mt-3">
                <button type="submit" class="btn indigo" onclick="confirmEdit(event)">
                  Save changes</button>
                <a type="button" href="/users/{{ $user->id }}" class="btn btn-light">Cancel</a>
              </div>
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

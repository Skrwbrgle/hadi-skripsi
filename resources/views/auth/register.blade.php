@extends('layouts.index')

@section('author')
  <div class="col s12">
    <div class="container">
      <div id="login-page" class="row">
        <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
           <form class="login-form" method="post" action="/register">
            @method('post')
            @csrf
            <div class="row">
              <div class="input-field col s12">
                <h5 class="ml-4">Register</h5>
                <p class="ml-4">Join to our community now !</p>
              </div>
            </div>
            <div class="row margin">
              <div class="input-field col s12">
                <i class="material-icons prefix pt-2">person_outline</i>
                <input id="username" type="text" name="username" required value="{{ old('username') }}"/>
                <label for="username" class="center-align">Username</label>
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
            </div>
            <div class="row margin">
              <div class="input-field col s12">
                <i class="material-icons prefix pt-2">explore</i>
                <input id="nama_agen_travel" type="text" name="nama_agen_travel" required value="{{ old('nama_agen_travel') }}" />
                <label for="nama_agen_travel">Agent Travel Name</label>
                 @error('nama_agen_travel')
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
            <div class="row margin">
              <div class="input-field col s12">
                <i class="material-icons prefix pt-2">lock_outline</i>
                <input id="password" type="password" name="password" required/>
                <label for="password">Password</label>
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
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <button
                  class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12"
                  >Register</
                >
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <p class="margin medium-small">
                  <a href="/login">Already have an account? Login</a>
                </p>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

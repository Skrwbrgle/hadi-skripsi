@extends('layouts.index')

@section('author')
  <div class="col s12">
    <div class="container">
      <div id="login-page" class="row">
        <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
          <form class="login-form" method="post" action="/login">
            @method('post')
            @csrf
              <div class="row">
                  <div class="input-field col s12">
                  <h5 class="ml-4">Sign in</h5>
                  </div>
              </div>
              <div class="row margin">
                  <div class="input-field col s12">
                  <i class="material-icons prefix pt-2">person_outline</i>
                  <input id="username" name="username" type="text" autofocus required value="{{ old('username') }}">
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
                  <i class="material-icons prefix pt-2">lock_outline</i>
                  <input id="password" name="password" type="password" required>
                  <label for="password">Password</label>
                  </div>
              </div>
              <div class="row">
                  <div class="col s12 m12 l12 ml-2 mt-1">
                  <p>
                      <label>
                      <input type="checkbox" />
                      <span>Remember Me</span>
                      </label>
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
                  </p>
                  </div>
              </div>
              <div class="row">
                  <div class="input-field col s12">
                  <button class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Login</button>
                  </div>
              </div>
              <div class="row">
                  <div class="input-field col s12">
                  <p class="margin right-align medium-small"><a href="/register">Register Now!</a></p>
                  </div>
                  {{-- <div class="input-field col s6 m6 l6">
                  <p class="margin right-align medium-small">
                    <a href="user-forgot-password.html">Forgot password ?</a>
                  </p>
                  </div> --}}
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

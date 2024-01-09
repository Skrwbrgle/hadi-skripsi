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
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>Input new route</span></h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a href="/agent-travel">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="/agent-travel">Routes</a>
                  </li>
                  <li class="breadcrumb-item active">Input new route</li>
                </ol>
              </div>
            </div>
            </div>
        </div>
        <div class="col s12">
            <div class="container">
                <div class="section users-edit">
                <div class="card">
                    <div class="card-content">
                        <h4 class="card-title">Form with validation</h4>
                        <form method="post" action="/agent-travel/routes/create">
                            @method('post')
                            @csrf
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">place</i>
                                    <input id="rute" name="rute" type="text" class="validate">
                                    <label for="rute">Name route</label>
                                    @error('rute')
                                        <div class="card-alert card gradient-45deg-red-pink">
                                        <div class="card-content white-text">
                                            <p><i class="material-icons">error</i> DANGER : {{ $message }}</p>
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
                                    <i class="material-icons prefix">access_time</i>
                                    <input id="jam_keberangkatan" name="jam_keberangkatan" type="text" class="timepicker">
                                    <label for="jam_keberangkatan">Time</label>
                                    @error('jam_keberangkatan')
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
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">attach_money</i>
                                    <input id="tarif" name="tarif" type="text" class="validate">
                                    <label for="tarif">Price</label>
                                    @error('tarif')
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
                                <div class="input-field col s6">
                                    <select class="select2 browser-default" name="transportasi">
                                        <option value="">Transportation</option>
                                        <option value="Car">Car</option>
                                        <option value="Bus">Bus</option>
                                    </select>
                                    @error('transportasi')
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
                                <div class="input-field col s12 hide">
                                    @auth
                                        <input id="user_id" name="user_id" class="materialize-textarea validate" value="{{ auth()->user()->id }}">
                                    @endauth
                                </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn cyan waves-effect waves-light right" type="submit">Submit
                                        <i class="material-icons right">send</i>
                                    </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection

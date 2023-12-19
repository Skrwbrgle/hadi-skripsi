@extends('layouts.main')

@section('content')
    <div id="main">
      <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="col s12">
          <div class="container">
            <!-- invoice list -->
            <section class="invoice-list-wrapper section">
            <!-- create invoice button-->
            <!-- Options and filter dropdown button-->
            {{-- <div class="invoice-filter-action mr-3">
                <a href="#" class="btn waves-effect waves-light invoice-export border-round z-depth-4">
                <i class="material-icons">picture_as_pdf</i>
                <span class="hide-on-small-only">Export to PDF</span>
                </a>
            </div> --}}
            <!-- create invoice button-->
            <div class="invoice-create-btn">
                <a href="/agent-travel/inputForm" class="btn waves-effect waves-light invoice-create border-round z-depth-4">
                <i class="material-icons">add</i>
                <span class="hide-on-small-only">Create Route</span>
                </a>
            </div>
            <div class="filter-btn">
                <!-- Dropdown Trigger -->
                <a class='dropdown-trigger btn waves-effect waves-light purple darken-1 border-round' href='#'
                data-target='btn-filter'>
                <span class="hide-on-small-only">Filter Route</span>
                <i class="material-icons">keyboard_arrow_down</i>
                </a>
                <!-- Dropdown Structure -->
                <ul id='btn-filter' class='dropdown-content'>
                <li><a href="#!">Paid</a></li>
                <li><a href="#!">Unpaid</a></li>
                <li><a href="#!">Partial Payment</a></li>
                </ul>
            </div>
            <div class="responsive-table">
                <table class="table invoice-data-table white border-radius-4 pt-1">
                    <thead>
                        <tr>
                        <!-- data table responsive icons -->
                        <th></th>
                        <!-- data table checkbox -->
                        <th></th>
                        <th>
                            <span>Id</span>
                        </th>
                        <th>Price</th>
                        <th>Time</th>
                        <th>Route destination</th>
                        <th>Transportation</th>
                        <th>Status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($routes as $rute)
                            <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <a href="#">{{ $rute->id }}</a>
                            </td>
                            <td><span class="invoice-amount">Rp {{ number_format($rute->tarif, 0, ',', '.') }}</span></td>
                            <td><small>{{ \Carbon\Carbon::parse($rute->jam_keberangkatan)->format('h:i A') }}</small></td>
                            <td><span class="invoice-customer">{{ $rute->rute }}</span></td>
                            <td>
                                <span class="{{ $rute->transportasi === 'Bus' ? 'bullet green' : 'bullet blue' }}"></span>
                                <small>{{ $rute->transportasi }}</small>
                            </td>
                            <td>
                                <div style="display: flex; align-items: center; ">
                                    <form id="publishForm_{{ $rute->id }}" action="/agent-travel/routes/publish/{{ $rute->id }}" method="post" onsubmit="prepareCheckboxValue(this);">
                                        @method('put')
                                        @csrf
                                        <p>
                                            <label>
                                                <input type="checkbox" id="pubCheckbox" name="is_publish" {{ $rute->is_publish ? 'checked' : ' ' }} />
                                                <span></span>
                                            </label>
                                        </p>
                                    </form>
                                @if ($rute->is_publish)
                                    <span class="chip lighten-5 green green-text">Publish</span>
                                @else
                                    <span class="chip lighten-5 red red-text">Unpublish</span>
                                @endif
                                </div>
                            </td>
                            <td>
                                <div class="invoice-action" style="display: flex;">
                                    <button class="publish-button border-none N/A transparent" onclick="submitHiddenForm('publishForm_{{ $rute->id }}')">
                                        <i class="material-icons indigo-text">publish</i>{{ $rute->id }}
                                    </button>
                                    {{-- @dd($rute->id) --}}
                                    <form id="deleteForm" action="/agent-travel/routes/delete/{{ $rute->id }}" method="post">
                                        @method('delete')
                                        @csrf
                                            <button class="border-none N/A transparent" onclick="confirmDelete(event)"><i class="material-icons red-text">delete</i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </section>
          </div>
            </div>
          <div class="content-overlay"></div>
        </div>
      </div>
    </div>
@endsection

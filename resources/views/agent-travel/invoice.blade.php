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
            {{-- <div class="invoice-create-btn">
                <a href="app-invoice-add.html" class="btn waves-effect waves-light invoice-create border-round z-depth-4">
                <i class="material-icons">add</i>
                <span class="hide-on-small-only">Create Invoice</span>
                </a>
            </div> --}}
            <div class="filter-btn">
                <!-- Dropdown Trigger -->
                <a class='dropdown-trigger btn waves-effect waves-light purple darken-1 border-round' href='#'
                data-target='btn-filter'>
                <span class="hide-on-small-only">Filter Invoice</span>
                <i class="material-icons">keyboard_arrow_down</i>
                </a>
                <!-- Dropdown Structure -->
                <ul id='btn-filter' class='dropdown-content'>
                <li><a href="#" class="filter-status">Paid</a></li>
                <li><a href="#" class="filter-status">Unpaid</a></li>
                <li><a href="#" class="filter-status">Refund</a></li>
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
                        <span>Invoice</span>
                    </th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Pessenger</th>
                    <th>Status</th>
                    <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($invoices as $invoice)
                        <tr data-status="{{ strtolower($invoice['is_payment']) }}">
                        <td></td>
                        <td></td>
                        <td>
                            <a href="#">{{ $invoice['id_order'] }}</a>
                        </td>
                        <td><span class="invoice-amount">Rp{{ number_format($invoice['transaksi']->total_biaya,0,',','.') }}</span></td>
                        <td><small>{{ \Carbon\Carbon::parse($invoice['transaksi']->tanggal)->format('j F Y') }}</small></td>
                        <td><span class="invoice-customer">{{ $invoice['transaksi']->nama }}</span></td>
                        <td class="blue-text">
                            {{-- <span class="bullet green"></span> --}}
                            <i class="material-icons" style="font-size: 1rem;">airline_seat_recline_extra</i>
                            <small><b>{{ $invoice['transaksi']->jumlah_penumpang }}</b> Seat</small>
                        </td>
                        <td>
                            @php
                                $paymentStatus = $invoice['is_payment'];
                                $statusText = ($paymentStatus === 1) ? 'PAID' : (($paymentStatus === 2) ? 'REFUND' : 'UNPAID');
                            @endphp
                            @if ($statusText === 'PAID')
                                <span class="chip lighten-5 green green-text">{{ $statusText }}</span>

                            @elseif ($statusText === 'UNPAID')
                                <span class="chip lighten-5 red red-text">{{ $statusText }}</span>
                            @else
                                <span class="chip lighten-5 orange orange-text">{{ $statusText }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="invoice-action" style="display: flex;">
                                <a class="invoice-action-view mr-4 waves-effect waves-light modal-trigger" href="#modal1" onclick="showModal({{ $invoice['id'] }})">
                                    <i class="material-icons">remove_red_eye</i>
                                </a>
                                <a href="#" class="invoice-action-edit">
                                    <form id="deleteForm_{{ $invoice->id }}" action="/agent-travel/invoice/delete/{{ $invoice->id }}" method="post">
                                        @method('delete')
                                        @csrf
                                            <button class="border-none N/A transparent" onclick="confirmDelete(event, '{{ $invoice->id }}')"><i class="material-icons red-text">delete</i></button>
                                    </form>
                                </a>
                            </div>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
            </div>


            <!-- Modal Structure -->
            <div id="modal1" class="modal justify-content-center">
                <div class="card">
                    <div class="card-content invoice-print-area">
                    <!-- header section -->
                    <div class="row invoice-date-number">
                        <div class="col xl4 s12">
                        <span class="invoice-number mr-1">Invoice#</span>
                        <span id="invoice_id">000756</span>
                        </div>
                        <div class="col xl8 s12">
                        <div class="invoice-date display-flex align-items-center flex-wrap">
                            <div class="mr-3">
                            <small>Status:</small>
                            <span id="status">08/10/2019</span>
                            </div>
                            <div>
                            <small>Date Due:</small>
                            <span id="date">08/10/2019</span>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- logo and title -->
                    <div class="row mt-3 invoice-logo-title">
                        <div class="col m6 s12 display-flex invoice-logo mt-1 push-m6">
                        <h5 class="purple-text bold">TRAVELIZE</h5>
                        </div>
                        <div class="col m6 s12 pull-m6">
                        <h4 class="indigo-text bold">Invoice</h4>
                        <span>Transaction Detail</span>
                        </div>
                    </div>
                    <div class="divider mb-3 mt-3"></div>
                    <!-- invoice address and contact -->
                    <div class="row invoice-info">
                        <div class="col m6 s12">
                        <h6 class="invoice-from">Travel Agentsi</h6>
                        <div class="invoice-address">
                            <span id="agentsi_name">Clevision PVT. LTD.</span>
                        </div>
                        <div class="invoice-address">
                            <span id="agentsi_address">9205 Whitemarsh Street New York, NY 10002</span>
                        </div>
                        <div class="invoice-address">
                            <span id="agentsi_username">hello@clevision.net</span>
                        </div>
                        <div class="invoice-address">
                            <span id="agentsi_phone">601-678-8022</span>
                        </div>
                        </div>
                        <div class="col m6 s12">
                        {{-- <div class="divider show-on-small hide-on-med-and-up mb-3"></div> --}}
                        <h6 class="invoice-to">Customer</h6>
                        <div class="invoice-address">
                            <span id="cust_name">Pixinvent PVT. LTD.</span>
                        </div>
                        <div class="invoice-address">
                            <span id="cust_address">203 Sussex St. Suite B Waukegan, IL 60085</span>
                        </div>
                        <div class="invoice-address">
                            <span id="cust_nik">pixinvent@gmail.com</span>
                        </div>
                        <div class="invoice-address">
                            <span id="cust_phone">987-352-5603</span>
                        </div>
                        </div>
                    </div>
                    <div class="divider mb-3 mt-3"></div>
                    <!-- product details table-->
                    <div class="invoice-product-details">
                        <table class="striped responsive-table">
                        <thead>
                            <tr>
                            <th>Route</th>
                            <th>Pick-up Time</th>
                            <th>Transport</th>
                            <th>Seat</th>
                            <th class="right-align">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td id="route_name">Frest Admin</td>
                            <td id="route_time">HTML Admin Template</td>
                            <td id="route_transport">28</td>
                            <td id="cust_qty">1</td>
                            <td class="indigo-text right-align" id="route_price">$28.00</td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                    <!-- invoice subtotal -->
                    <div class="divider mt-3 mb-3"></div>
                    <div class="invoice-subtotal">
                        <div class="row">
                        <div class="col m5 s12">
                            <p>Thanks for your business.</p>
                        </div>
                        <div class="col xl4 m7 s12 offset-xl3">
                            <ul>
                            <li class="display-flex justify-content-between">
                                <span class="invoice-subtotal-title">Subtotal</span>
                                <h6 class="invoice-subtotal-value" id="subtotal">$72.00</h6>
                            </li>
                            <li class="display-flex justify-content-between">
                                <span class="invoice-subtotal-title">Seat</span>
                                <h6 class="invoice-subtotal-value" id="qty">- $ 09.60</h6>
                            </li>
                            <li class="divider mt-2 mb-2"></li>
                            <li class="display-flex justify-content-between">
                                <span class="invoice-subtotal-title">Invoice Total</span>
                                <h6 class="invoice-subtotal-value" id="cust_amount">$ 61.40</h6>
                            </li>
                            </ul>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="invoice-action-btn float-right mr-2 pb-2">
                        <a href="#" class="btn-block btn btn-light-indigo waves-effect waves-light invoice-print">
                        <span>Print</span>
                        </a>
                    </div>
                    <div class="invoice-action-btn float-right mr-2">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat btn-light-red">Close</a>
                    </div>
                </div>
            </div>
            </section>
          </div>
          <div class="content-overlay"></div>
        </div>
      </div>
    </div>

    {{-- Js detail --}}
    <script>
        var invoices = @json($invoices);

        function formatRupiah(amount) {
            // Add commas as thousand separators
            const formattedAmount = amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            // Add 'Rp' to the beginning
            return `Rp${formattedAmount}`;
        }

        const showModal = (id)=> {
            const invoice = invoices.find((v)=> v.id === id);

            const agentsi = invoice.transaksi.rute.user
            const rute = invoice.transaksi.rute
            const transaksi = invoice.transaksi

            const rawDate = new Date(invoice.created_at);
            const day = rawDate.getDate();
            const month = (rawDate.getMonth() + 1).toString().padStart(2, '0'); // Menambahkan "0" jika kurang dari 10
            const year = rawDate.getFullYear();
            const formattedDate = `${day}/${month}/${year}`;

            //Format tanggal "tanggal" menjadi "DD/MM/YYYY"
            const rawDepartureDate = new Date(transaksi.tanggal);
            const departureDay = rawDepartureDate.getDate();
            const departureMonth = (rawDepartureDate.getMonth() + 1).toString().padStart(2, '0');
            const departureYear = rawDepartureDate.getFullYear();
            const formattedDepartureDate = `${departureDay}/${departureMonth}/${departureYear}`;

            // Format jam keberangkatan
            const departureTimeParts = rute.jam_keberangkatan.split(':');
            let hours = parseInt(departureTimeParts[0], 10);
            const minutes = departureTimeParts[1].padStart(2, '0');
            const ampm = hours >= 12 ? 'PM' : 'AM';

            // Convert to 12-hour format
            hours = hours % 12;
            hours = hours ? hours : 12;

            const formattedDepartureTime = `${hours.toString().padStart(2, '0')}:${minutes} ${ampm}`;

            $('#invoice_id').html(invoice.id_order)
            $('#status').html(invoice.is_payment === 1 ? 'PAID' : invoice.is_payment === 2 ? 'REFUND' : 'UNPAID')
            $('#date').html(formattedDate)

            $('#agentsi_name').html(agentsi.nama_agen_travel)
            $('#agentsi_address').html(agentsi.almat)
            $('#agentsi_username').html(agentsi.username)
            $('#agentsi_phone').html(agentsi.no_telepon)

            $('#cust_name').html(transaksi.nama)
            $('#cust_address').html(transaksi.alamat)
            $('#cust_nik').html(`NIK.${transaksi.nik}`)
            $('#cust_phone').html(transaksi.no_telepon)
            $('#cust_amount').html(formatRupiah(transaksi.total_biaya))
            $('#cust_qty').html(transaksi.jumlah_penumpang)

            $('#route_name').html(rute.rute)
            $('#route_time').html(`${formattedDepartureDate} - ${formattedDepartureTime}`)
            $('#route_transport').html(rute.transportasi)
            $('#route_price').html(formatRupiah(rute.tarif))

            $('#subtotal').html(formatRupiah(rute.tarif))
            $('#qty').html(transaksi.jumlah_penumpang)

            const statusElement = document.getElementById('status');
            statusElement.classList.remove('green', 'green-text', 'orange','orange-text','red','red-text');
            if (invoice.is_payment === 1) {
                ['chip','lighten-5','green','green-text'].forEach((v) => {
                    statusElement.classList.add(v)
                });
            } else if (invoice.is_payment === 2) {
                ['chip','lighten-5','orange','orange-text'].forEach((v) => {
                    statusElement.classList.add(v)
                });
            } else {
                ['chip','lighten-5','red','red-text'].forEach((v) => {
                    statusElement.classList.add(v)
                });
            }
        }

    </script>
@endsection

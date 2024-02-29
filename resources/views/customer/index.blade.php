<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Travelize</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">
  {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11"> --}}

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

 @include('customer.navbar')

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
      <h1 class="mb-4 pb-0">Enjoy in the<span> best</span> way!</h1>
      <p class="mb-6 pb-0">Enjoy our services for your trip anytime</p>
      <form id="travelForm" action="/search" method="post">
        @method('post')
        @csrf
        <div class="d-flex">
          <div class="d-flex flex-wrap flex-row bg-white align-items-center p-4 gap-3 rounded-4">
            <!-- Dropdown Time -->
            <div class="form-group d-flex flex-column justify-content-start text-start">
              <label class="mb-1" for="timeDropdown">
                <i class="bi bi-clock"></i>
                Time:
              </label>
              <select id="timeDropdown" class="form-select fw-light fs-6 text-secondary" name="jam">
                <option value="morning">Morning</option>
                <option value="afternoon">Afternoon</option>
                <option value="evening">Evening</option>
              </select>
            </div>
             <svg xmlns="http://www.w3.org/2000/svg" width="1" height="52" viewBox="0 0 1 52" fill="none">
            <path opacity="0.1" d="M0.5 1V51" stroke="#333333" stroke-linecap="round"/>
            </svg>

            <!-- Dropdown Route -->
            <div class="form-group d-flex flex-column justify-content-start text-start">
              <label class="mb-1" for="routeDropdown">
                <i class="bi bi-flag"></i>
                Route:
              </label>
              <select id="routeDropdown" class="form-select fw-light fs-6 text-secondary" name="route">
                @foreach ($rute as $i)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endforeach
                {{-- <option value="palangka raya">Palangka Raya</option>
                <option value="sampit">Sampit</option>
                <option value="banjarmasin">Banjarmasin</option> --}}
              </select>
            </div>
             <svg xmlns="http://www.w3.org/2000/svg" width="1" height="52" viewBox="0 0 1 52" fill="none">
            <path opacity="0.1" d="M0.5 1V51" stroke="#333333" stroke-linecap="round"/>
            </svg>

            <!-- Dropdown Transportation -->
            <div class="form-group d-flex flex-column justify-content-start text-start">
              <label class="mb-1" for="transportationDropdown">
                <i class="bi bi-truck-front"></i>
                Transportation:
              </label>
              <select id="transportationDropdown" class="form-select fw-light fs-6 text-secondary" name="transport">
                <option value="car">Car</option>
                <option value="bus">Bus</option>
              </select>
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="buy-tickets scrollto">
              <i class="bi bi-search" style="font-size: 1.5rem;"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </section><!-- End Hero Section -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about">
      <div class="container position-relative" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-6">
            <h2>About Travelize</h2>
            <p>Welcome to Travelize, your go-to platform for seamless travel experiences! At Travelize, we are dedicated to providing you with a reliable and user-friendly solution for all your travel needs.</p>
          </div>
          <div class="col-lg-3">
            <h3>Where</h3>
            <p>Fakultas Teknik, Universitas Palangka Raya</p>
          </div>
          <div class="col-lg-3">
            <h3>Our Mission</h3>
            <p>Our mission at Travelize is to simplify travel planning, making it hassle-free and enjoyable for every user. We empower travelers by providing a wide range of affordable options on a secure platform, ensuring the creation of lasting memories.</p>
          </div>
        </div>
      </div>
    </section><!-- End About Section -->

    <!-- ======= Speakers Section ======= -->
    <section id="speakers">
      <div class="container" data-aos="fade-up">
        @if (!empty($results))
          <script>
            window.location.href = '#about';
          </script>
          <div class="section-header">
            <h2>Search Result</h2>
            <p>Here are some of our routes</p>
          </div>
          <div class="row">
            @foreach ($results as $result)
              <div class="col-lg-4 col-md-6">
              <div class="speaker" data-aos="fade-up" data-aos-delay="100">
                <img src="assets/img/route.jpeg" alt="Speaker 1" class="img-fluid">
                <div class="details">
                  <h3><a href="#">{{ $result->rute }}</a></h3>
                  <p>
                    <a href="/" class="fs-6" style="font-style: normal">"{{ $result->user->nama_agen_travel}}"</a>
                    <span style="color: #91a2c6">
                        {{ \Carbon\Carbon::parse($result->jam_keberangkatan)->format('h:i A') }}
                    </span>
                    @if ($result->transportasi === 'Car')
                    <a href="#" class="ml-3 "><i class="bi bi-car-front-fill"></i></a>
                  @else
                    <a href="#" class="ml-3"><i class="bi bi-bus-front-fill"></i></a>
                  @endif
                  </p>
                  <div class="text-center align-item-center">
                    {{-- <a class="buy-tickets scrollto" href="">Book Now</a> --}}
                    <span class="fs-4 scrollto" style="color: #f82249;">Rp {{ number_format($result->tarif, 0, ',', '.') }}</span>
                    <button
                        type="button"
                        class="buy-tickets scrollto mb-2"
                        data-bs-toggle="modal"
                        data-bs-target="#buy-ticket-modal"
                        data-ticket-id="{{ $result->id }}"
                      >
                        Book Now
                      </button>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        @else
        @endif
      </div>

    </section><!-- End Speakers Section -->

    <!-- ======= Supporters Section ======= -->
    <section id="supporters" class="section-with-bg">

      <div class="container" data-aos="fade-up">


      <div class="section-header">
        <h2>agentsi</h2>
        <p>Travelize agency partner</p>
      </div>
      <div class="row no-gutters supporters-wrap clearfix" data-aos="zoom-in" data-aos-delay="100">

        @foreach ($agensi as $agen)
            <div class="col-lg-3 col-md-6 col-xs-6">
                <div class="ag-courses_item">
                    <a href="#" class="ag-courses-item_link">
                        <div class="ag-courses-item_bg"></div>

                        <div class="ag-courses-item_title">
                        {{ $agen->nama_agen_travel }}
                        </div>


                        <div class="ag-courses-item_date-box">
                            <i class="bi bi-geo-alt" style="font-size: 1.5rem;"></i>
                            <span class="ag-courses-item_date">
                                {{ $agen->alamat }}
                            </span>
                        </div>
                        <div class="ag-courses-item_phone-box">
                            <i class="bi bi-telephone"></i>
                            <span class="ag-courses-item_phone">
                                {{ $agen->no_telepon }}
                            </span>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
        {{-- <div class="col-lg-3 col-md-4 col-xs-6">

          <div class="supporter-logo">
            <img src="assets/img/supporters/1.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-xs-6">
          <div class="supporter-logo">
            <img src="assets/img/supporters/2.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-xs-6">
          <div class="supporter-logo">
            <img src="assets/img/supporters/3.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-xs-6">
          <div class="supporter-logo">
            <img src="assets/img/supporters/4.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-xs-6">
          <div class="supporter-logo">
            <img src="assets/img/supporters/5.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-xs-6">
          <div class="supporter-logo">
            <img src="assets/img/supporters/6.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-xs-6">
          <div class="supporter-logo">
            <img src="assets/img/supporters/7.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-xs-6">
          <div class="supporter-logo">
            <img src="assets/img/supporters/8.png" class="img-fluid" alt="">
          </div>
        </div> --}}

      </div>
      </div>

    </section><!-- End Sponsors Section -->

    <!-- Modal Order Form -->
    <div id="buy-ticket-modal" class="modal fade">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Buy Tickets</h4>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form method="post" action="/booking">
              @method('post')
              @csrf
              <div class="form-group"  style="display: none;">
                <input
                  type="hidden"
                  class="form-control"
                  name="rute_id"
                  id="rute_id"
                  placeholder="Rute ID"
                  value=""
                />
              </div>
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  name="nama"
                  placeholder="Your Name"
                  required
                  value="{{ old('nama') }}"
                />
                @error('nama')
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
              <div class="form-group mt-3">
                <input
                  type="number"
                  class="form-control"
                  name="no_telepon"
                  placeholder="Your Phone Number"
                  required
                  value="{{ old('no_telepon') }}"
                />
                @error('no_telepon')
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
              <div class="form-group mt-3">
                <input
                  type="text"
                  class="form-control"
                  name="alamat"
                  placeholder="Your Address"
                  required
                  value="{{ old('alamat') }}"
                />
                @error('alamat')
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
              <div class="form-group mt-3">
                <input
                  type="number"
                  class="form-control"
                  name="nik"
                  placeholder="Your NIK"
                  required
                  value="{{ old('nik') }}"
                />
                @error('nik')
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
              <div class="form-group mt-3" style="display: none;">
                <select
                  id="ticket-type"
                  class="form-select"
                >
                  <option value="" disabled selected>-- Select Gender --</option>
                  <option value="laki-laki">Male</option>
                  <option value="perempuan">Famale</option>
                </select>
              </div>
              <div class="form-group mt-3">
                <select
                  id="ticket-type"
                  name="jenis_kelamin"
                  class="form-select"
                  required
                >
                  <option value="" disabled selected>-- Select Gender --</option>
                  <option value="laki-laki">Male</option>
                  <option value="perempuan">Famale</option>
                </select>
                @error('jenis_kelamin')
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
              <div class="form-group mt-3">
                <select
                  id="ticket-type"
                  name="jumlah_penumpang"
                  class="form-select"
                  required
                >
                  <option value="" disabled selected>-- Total Passenger --</option>
                  <option value="1">1 Pessenger</option>
                  <option value="2">2 Pessengers</option>
                  <option value="3">3 Pessengers</option>
                  <option value="4">4 Pessengers</option>
                  <option value="5">5 Pessengers</option>
                </select>
                @error('jumlah_penumpang')
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
              <div class="form-group mt-3">
                <label for="tanggal">Pilih Tanggal:</label>
                <input
                    type="date"
                    class="form-control"
                    name="tanggal"
                    id="tanggal"
                    required
                    value="{{ old('tanggal') }}"
                />
                @error('tanggal')
                    <div class="card-alert card gradient-45deg-red-pink">
                        <div class="card-content white-text">
                            <p><i class="material-icons">error</i> BAHAYA : {{ $message }}</p>
                        </div>
                        <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                @enderror
              </div>
              <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary scrollto">Buy Now</button>
              </div>
            </form>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <!-- /.modal -->
    <section id="contact" class="section-bg">

      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Contact Us</h2>
          <p>Nihil officia ut sint molestiae tenetur.</p>
        </div>

        <div class="row contact-info">

          <div class="col-md-4">
            <div class="contact-address">
              <i class="bi bi-geo-alt"></i>
              <h3>Address</h3>
              <address><a href="https://maps.app.goo.gl/qMhWAin7qdK3EqR59" target="_blank">Fakulta Teknik, Universitas Palangaka Raya</a></address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="bi bi-phone"></i>
              <h3>Whatsapp Number</h3>
              <p><a href="tel:+6285752443827">+62 857 5244 3827</a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="bi bi-envelope"></i>
              <h3>Email</h3>
              <p><a href="mailto:travelize7@gmail.com">travelize7@gmail.com</a></p>
            </div>
          </div>

        </div>
{{--
        <div class="form">
          <form action="/send-email" method="post" role="form" class="php-email-form">
            @csrf
            @method('post')
            <div class="row">
              <div class="form-group col-md-6">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
              </div>
              <div class="form-group col-md-6 mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
              </div>
            </div>
            <div class="form-group mt-3">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
            </div>
            <div class="my-3">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your message has been sent. Thank you!</div>
            </div>
            <div class="text-center"><button type="submit">Send Message</button></div>
          </form>
        </div> --}}

    </div>
</section><!-- End Contact Section -->

{{-- .modal --}}
<section id="refund" class="section-bg">
    <hr>
      <div class="container my-5" data-aos="fade-up">

        <div class="section-header">
          <h2>Refund ticket</h2>
          <p>Look into your ticket to insert data form refund.</p>
        </div>

        <div class="form">
          <form action="/refund" method="post" role="form">
            @method('post')
            @csrf
            <div class="row">
              <div class="form-group col-md-6">
                <input type="text" name="order_id" class="form-control" id="order_id" placeholder="TRAV-XXXXXXXXX-XX" required>
              </div>
              <div class="form-group col-md-6 mt-3 mt-md-0">
                <input type="text" class="form-control" name="amount" id="amount" placeholder="Gross Amount" required>
              </div>
            </div>
            <div class="text-center mt-5"><button class="buy-tickets fs-5 px-5 py-2" type="submit">Refund</button></div>
          </form>
         </div>

      </div>
    </section><!-- End Contact Section -->


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('customer.footer')
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- SweetAlert CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  {{-- CUSTOM JS --}}
  <script>
    // Menangkap event klik pada tombol "Book Now"
    document.addEventListener('DOMContentLoaded', function () {
        var buyTicketButtons = document.querySelectorAll('.buy-tickets');
        buyTicketButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var ticketId = button.getAttribute('data-ticket-id');
                document.getElementById('rute_id').value = ticketId;
            });
        });
    });
  </script>

  @if(session('not-found'))
  <script>
      Swal.fire({
          position: "center",
          icon: "warning",
          title: "{{ session('not-found') }}",
          showConfirmButton: false,
          timer: 3000
      });
  </script>
  @endif

  @if(session('refund'))
  @php
    $posisi = strpos(session('refund'), "Success");
    $posisi !== false ? $statusIcon = 'success' : $statusIcon = 'error';
  @endphp
    <script>
        Swal.fire({
            position: "center",
            icon: "{{ $statusIcon }}",
            title: "{{ session('refund') }}",
            showConfirmButton: false,
            timer: 3000
        });
    </script>
  @endif

  @if(session('error'))
  <script>
      Swal.fire({
          position: "center",
          icon: "error",
          title: "{{ session('error') }}",
          showConfirmButton: false,
          timer: 3000
      });
  </script>
  @endif

  @if(session('success'))
    <script>
        Swal.fire({
            position: "center",
            icon: "success",
            title: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 3000
        });
    </script>
    @endif

</body>

</html>

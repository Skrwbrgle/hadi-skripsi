<!DOCTYPE html>
<!--
Template Name: Materialize - Material Design Admin Template
Author: PixInvent
Website: http://www.pixinvent.com/
Contact: hello@pixinvent.com
Follow: www.twitter.com/pixinvents
Like: www.facebook.com/pixinvents
Purchase: https://themeforest.net/item/materialize-material-design-admin-template/11446068?ref=pixinvent
Renew Support: https://themeforest.net/item/materialize-material-design-admin-template/11446068?ref=pixinvent
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.

-->
<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>User Login </title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/favicon/apple-touch-icon-152x152.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/favicon/favicon-32x32.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/vendors.min.css">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11"> --}}
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/vertical-modern-menu-template/materialize.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/vertical-modern-menu-template/style.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/login.css">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/custom/custom.css">
    <!-- END: Custom CSS-->
  </head>
  <!-- END: Head-->
  <body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 1-column login-bg   blank-page blank-page" data-open="click" data-menu="vertical-modern-menu" data-col="1-column">

    <div class="row">
      @yield('author')
      <div class="content-overlay"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- BEGIN VENDOR JS-->
    <script src="../../../app-assets/js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="../../../app-assets/js/plugins.js"></script>
    <script src="../../../app-assets/js/search.js"></script>
    <script src="../../../app-assets/js/custom/custom-script.js"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->

    {{-- custom js --}}
    <script src="../../../app-assets/js/scripts/ui-alerts.js"></script>
    @if(session('success'))
    <script>
       Swal.fire({
            position: "center",
            icon: "success",
            title: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2000
        });
    </script>
    @endif

    @if(session('loginError'))
    <script>
        Swal.fire({
            position: "center",
            icon: "error",
            title: "{{ session('loginError') }}",
            showConfirmButton: false,
            timer: 2000
        });
    </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi dropdown
            const dropdownTrigger = document.querySelector('.dropdown-trigger');
            const dropdownOptions = document.querySelector('#btn-filter');

            const filterTable = function(status) {
                // Semua baris tabel
                const rows = document.querySelectorAll('.invoice-data-table tbody tr');

                rows.forEach(row => {
                    const rowStatus = row.dataset.status;

                    // Tampilkan atau sembunyikan berdasarkan status
                    if (status === 'all' || rowStatus === status) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });
            };

            // Tambahkan event listener untuk setiap opsi filter
            dropdownOptions.querySelectorAll('li a').forEach(option => {
                option.addEventListener('click', function(event) {
                    event.preventDefault();
                    const selectedStatus = this.textContent.toLowerCase();
                    filterTable(selectedStatus);
                });
            });

            // Event listener untuk dropdown trigger
            dropdownTrigger.addEventListener('click', function() {
                // Buka dropdown
                dropdownOptions.style.display = 'block';

                // Tutup dropdown saat item dipilih
                dropdownOptions.querySelectorAll('li a').forEach(option => {
                    option.addEventListener('click', function() {
                        dropdownOptions.style.display = 'none';
                    });
                });

                // Tutup dropdown saat di luar dropdown diklik
                document.addEventListener('click', function(e) {
                    if (!e.target.closest('.filter-btn')) {
                        dropdownOptions.style.display = 'none';
                    }
                });
            });
        });
    </script>
    </body>
</html>

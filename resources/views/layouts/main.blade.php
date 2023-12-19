<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google.">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>E-Travelize</title>
    <!-- resources/views/layouts/app.blade.php atau header.blade.php -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <link rel="apple-touch-icon" href="../../../app-assets/images/favicon/apple-touch-icon-152x152.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/favicon/favicon-32x32.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/data-tables/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/data-tables/css/dataTables.checkboxes.css">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/vertical-modern-menu-template/materialize.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/vertical-modern-menu-template/style.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/page-users.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-invoice.css">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/custom/custom.css">
    <!-- END: Custom CSS-->
</head>

<body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 2-columns   " data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    @include('components.header')
    {{-- @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"]) --}}
    <!-- END: Header-->

    <ul class="display-none" id="default-search-main">
        <li class="auto-suggestion-title"><a class="collection-item" href="#">
                <h6 class="search-title">FILES</h6>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img src="../../../app-assets/images/icon/pdf-image.png" width="24" height="30" alt="sample image"></div>
                        <div class="member-info display-flex flex-column"><span class="black-text">Two new item submitted</span><small class="grey-text">Marketing Manager</small></div>
                    </div>
                    <div class="status"><small class="grey-text">17kb</small></div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img src="../../../app-assets/images/icon/doc-image.png" width="24" height="30" alt="sample image"></div>
                        <div class="member-info display-flex flex-column"><span class="black-text">52 Doc file Generator</span><small class="grey-text">FontEnd Developer</small></div>
                    </div>
                    <div class="status"><small class="grey-text">550kb</small></div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img src="../../../app-assets/images/icon/xls-image.png" width="24" height="30" alt="sample image"></div>
                        <div class="member-info display-flex flex-column"><span class="black-text">25 Xls File Uploaded</span><small class="grey-text">Digital Marketing Manager</small></div>
                    </div>
                    <div class="status"><small class="grey-text">20kb</small></div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img src="../../../app-assets/images/icon/jpg-image.png" width="24" height="30" alt="sample image"></div>
                        <div class="member-info display-flex flex-column"><span class="black-text">Anna Strong</span><small class="grey-text">Web Designer</small></div>
                    </div>
                    <div class="status"><small class="grey-text">37kb</small></div>
                </div>
            </a></li>
        <li class="auto-suggestion-title"><a class="collection-item" href="#">
                <h6 class="search-title">MEMBERS</h6>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img class="circle" src="../../../app-assets/images/avatar/avatar-7.png" width="30" alt="sample image"></div>
                        <div class="member-info display-flex flex-column"><span class="black-text">John Doe</span><small class="grey-text">UI designer</small></div>
                    </div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img class="circle" src="../../../app-assets/images/avatar/avatar-8.png" width="30" alt="sample image"></div>
                        <div class="member-info display-flex flex-column"><span class="black-text">Michal Clark</span><small class="grey-text">FontEnd Developer</small></div>
                    </div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img class="circle" src="../../../app-assets/images/avatar/avatar-10.png" width="30" alt="sample image"></div>
                        <div class="member-info display-flex flex-column"><span class="black-text">Milena Gibson</span><small class="grey-text">Digital Marketing</small></div>
                    </div>
                </div>
            </a></li>
        <li class="auto-suggestion"><a class="collection-item" href="#">
                <div class="display-flex">
                    <div class="display-flex align-item-center flex-grow-1">
                        <div class="avatar"><img class="circle" src="../../../app-assets/images/avatar/avatar-12.png" width="30" alt="sample image"></div>
                        <div class="member-info display-flex flex-column"><span class="black-text">Anna Strong</span><small class="grey-text">Web Designer</small></div>
                    </div>
                </div>
            </a></li>
    </ul>
    <ul class="display-none" id="page-search-title">
        <li class="auto-suggestion-title"><a class="collection-item" href="#">
                <h6 class="search-title">PAGES</h6>
            </a></li>
    </ul>
    <ul class="display-none" id="search-not-found">
        <li class="auto-suggestion"><a class="collection-item display-flex align-items-center" href="#"><span class="material-icons">error_outline</span><span class="member-info">No results found.</span></a></li>
    </ul>



    <!-- BEGIN: SideNav-->
    @include('components.navbar')
    <!-- END: SideNav-->

    <!-- BEGIN: Page Main-->
    @yield('content')
    <!-- END: Page Main-->

    <!-- BEGIN: Footer-->
    <footer class="page-footer footer footer-static footer-dark gradient-45deg-indigo-purple gradient-shadow navbar-border navbar-shadow">
        <div class="footer-copyright">
            <div class="container"><span>&copy; 2023 <a target="_blank">E-Travelize</a> All rights reserved.</span></div>
        </div>
    </footer>
    <!-- END: Footer-->

    <!-- BEGIN VENDOR JS-->
    <script src="../../../app-assets/js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="../../../app-assets/vendors/data-tables/js/jquery.dataTables.min.js"></script>
    <script src="../../../app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../../app-assets/vendors/data-tables/js/datatables.checkboxes.min.js"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="../../../app-assets/js/plugins.js"></script>
    <script src="../../../app-assets/js/search.js"></script>
    <script src="../../../app-assets/js/custom/custom-script.js"></script>
    <script src="../../../app-assets/js/scripts/customizer.js"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="../../../app-assets/js/scripts/page-users.js"></script>
    <script src="../../../app-assets/js/scripts/app-invoice.js"></script>
    <!-- END PAGE LEVEL JS-->


    {{-- custom js --}}
    <script src="../../../app-assets/js/scripts/ui-alerts.js"></script>
    <script src="../../../app-assets/js/scripts/form-select2.js"></script>
    <script src="../../../app-assets/js/scripts/advance-ui-modals.js"></script>
    <script src="../../../app-assets/js/scripts/form-elements.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Ambil URL saat ini
        var currentUrl = window.location.pathname;

        // Cari elemen dengan href sesuai dengan URL saat ini dan tambahkan kelas "active"
        var activeElement = document.querySelector('a[href="' + currentUrl + '"]');
        if (activeElement) {
            activeElement.classList.add('active');
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.timepicker');
        var options = {
            twelveHour: false, // Gunakan format 24 jam
            format: 'HH:ii:ss', // Tetapkan format yang diinginkan
        };
        var instances = M.Timepicker.init(elems, options);
    });

    function confirmDelete(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm').submit();
            }
        });
    }

    function submitHiddenForm(formId) {
        // Temukan formulir yang tersembunyi berdasarkan ID
        var hiddenForm = document.getElementById(formId);
        if (hiddenForm) {
            // Panggil fungsi untuk menyiapkan nilai checkbox
            prepareCheckboxValue(hiddenForm);

            // Periksa apakah checkbox dicentang sebelum mengirimkan formulir
            // var checkbox = hiddenForm.querySelector('#pubCheckbox');
            // console.log(checkbox);

            // if (checkbox && !checkbox.checked) {
            //     // Tampilkan peringatan jika checkbox tidak dicentang
            //     Swal.fire({
            //     icon: 'warning',
            //     title: 'Oops...',
            //     text: 'Please check the box for publish',
            //     showConfirmButton: false,
            //     timer: 2000
            // });
            //     return;
            // }
            // Submit formulir yang tersembunyi
            hiddenForm.submit();
        }
    }

    function prepareCheckboxValue(form) {
        var checkbox = form.querySelector('#pubCheckbox');
        if (checkbox) {
            var checkboxValue = checkbox.checked ? '1' : '0';
            // Tambahkan elemen input tersembunyi untuk menyimpan nilai checkbox
            var hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'is_publish';
            hiddenInput.value = checkboxValue;
            form.appendChild(hiddenInput);
        }
    }

    function confirmEdit(event) {
        event.preventDefault();
         var passwordInput = document.getElementById('password');
        var rePasswordInput = document.getElementById('password_confirmation');

        if (passwordInput.value !== rePasswordInput.value) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Password and Re-Password must match!',
            });
            return;
        }

        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'btn indigo',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, change it!'
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.form.submit();
            }
        });
    }

    </script>

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

    @if(session('error'))
    <script>
        Swal.fire({
            position: "center",
            icon: "error",
            title: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 2000
        });
    </script>
    @endif
</body>

</html>


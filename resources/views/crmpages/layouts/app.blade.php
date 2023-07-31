<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    @stack('before-css')

    <!-- Favicons -->
    <link href="{{ asset('img/icon-sibisma.png') }}" rel="icon">
    <link href="{{ asset('img/icon-sibisma.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('crmassets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('crmassets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('crmassets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('crmassets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('crmassets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('crmassets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('crmassets/css/style.css') }}" rel="stylesheet">

    @stack('after-css')

    <!-- =======================================================
  * Template Name: MyResume
  * Updated: Jun 13 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/free-html-bootstrap-template-my-resume/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    @yield('content')

    @stack('before-script')

    <!-- Vendor JS Files -->
    <script src="{{ asset('crmassets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('crmassets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('crmassets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('crmassets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('crmassets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('crmassets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('crmassets/vendor/typed.js/typed.umd.js') }}"></script>
    <script src="{{ asset('crmassets/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('crmassets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('crmassets/js/main.js') }}"></script>

    @include('sweetalert::alert')
    @stack('after-script')
</body>

</html>

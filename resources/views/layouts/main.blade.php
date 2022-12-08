<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta charset="utf-8">
        <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
        @stack('meta')
        <link rel="icon" href="{{ asset('img/icon-sibisma.png') }}" type="image/x-icon"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

        <title>@yield('title') | SiBisma</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        @stack('before-css')
        <!-- Fonts and icons -->
        <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
        <script>
            WebFont.load({
                google: {"families":["Lato:300,400,700,900"]},
                custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{ asset("assets/css/fonts.min.css") }}']},
                active: function() {
                    sessionStorage.fonts = true;
                }
            });
        </script>

        <!-- Select2 -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <!-- CSS Files -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/atlantis.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/animation.css') }}">

        <style>
            .page-header .page-title,
            .page-header .nav-home a i,
            .page-header .separator,
            .page-header .nav-item a{
                color: #fff;
            }
        </style>

        @stack('after-css')

        @livewireStyles
    </head>
    <body>
        <div class="wrapper">
            <!-- Header -->
            <livewire:header>
            
            <!-- Sidebar -->
            <livewire:sidebar>
            
            <div class="main-panel">
			    <div class="content">
                    <div class="panel-header @if(Route::is('entry.*')) bg-info-gradient @elseif(Route::is('sale.*')) bg-success-gradient @elseif(Route::is('out.*')) bg-danger-gradient @elseif(Route::is('stock.*')) bg-secondary-gradient @else bg-dark-gradient @endif text-white bubble-shadow">
                        <div class="page-inner py-5">
                            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                                <div>
                                    <div class="page-header">
                                        <h4 class="page-title" style="color: #fff;">@yield('page-title')</h4>
                                        <ul class="breadcrumbs">
                                            <li class="nav-home">
                                                <a href="{{ route('dashboard') }}">
                                                    <i class="flaticon-home"></i>
                                                </a>
                                            </li>
                                            <li class="separator">
                                                <i class="flaticon-right-arrow"></i>
                                            </li>
                                            @stack('link-bread')
                                        </ul>
                                    </div>
                                </div>
                                <div class="ml-md-auto py-2 py-md-0" style="z-index: 99;">
                                    @stack('button')
                                </div>
                            </div>
                        </div>
                    </div>
				    <div class="page-inner mt--5">
                        <div class="row mt--2">
                            @yield('content')
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <livewire:footer>
            </div>
        </div>

        @stack('before-script')
        <!-- Script -->

        <!--   Core JS Files   -->
        <script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
        <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

        <!-- jQuery UI -->
        <script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

        <!-- jQuery Scrollbar -->
	    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

        <!-- Datatables -->
        <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>

        <!-- Bootstrap Notify -->
        <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

        <!-- jQuery Vector Maps -->
        <script src="{{ asset('assets/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>

        <!-- Select2 -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <!-- Sweet Alert -->
        <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

        <!-- Atlantis JS -->
        <script src="{{ asset('assets/js/atlantis.min.js') }}"></script>

        <!-- Tooltips -->
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>

        <!-- Tanya JS -->
        <script src="{{ asset('js/tanya.js') }}"></script>

        <!-- Moment -->
        <script src="{{ asset('js/moment.js') }}"></script>

        <!-- Select2 -->
        <script>
            $(document).ready(function() {
                $('.selectBasic').select2();
            });
        </script>

        <!-- Charting library -->
        <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
        <!-- Chartisan -->
        <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
        <!-- Your application script -->

        @include('sweetalert::alert')
        @livewireScripts
        @stack('after-script')
    </body>
</html>

<!DOCTYPE html>
<html lang="en" >

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ URL::asset('images/Eiffage_2400_02_black_RGB1.png') }}" type="image/png" sizes="66x66">
    <!-- Fontfaces CSS-->
    <link href="{{  URL::asset("css/font-face.css") }}" rel="stylesheet" media="all">
    <link href="{{  URL::asset("vendor/font-awesome-4.7/css/font-awesome.min.css") }}" rel="stylesheet" media="screen">
    <link href="{{  URL::asset("vendor/font-awesome-5/css/fontawesome-all.min.css") }}" rel="stylesheet" media="screen">
    <link href="{{  URL::asset("vendor/mdi-font/css/material-design-iconic-font.min.css") }}" rel="stylesheet" media="screen">

    <!-- Bootstrap CSS-->
    <link href="{{  URL::asset("vendor/bootstrap-4.1/bootstrap.min.css") }}" rel="stylesheet" media="screen">

    <!-- Vendor CSS-->
    <link href="{{  URL::asset("vendor/animsition/animsition.min.css") }}" rel="stylesheet" media="screen">
    <link href="{{  URL::asset("vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css") }}" rel="stylesheet" media="screen">
    <link href="{{  URL::asset("vendor/wow/animate.css") }}" rel="stylesheet" media="screen">
    <link href="{{  URL::asset("vendor/css-hamburgers/hamburgers.min.css") }}" rel="stylesheet" media="screen">
    <link href="{{  URL::asset("vendor/slick/slick.css") }}" rel="stylesheet" media="screen">
    <link href="{{  URL::asset("vendor/select2/select2.min.css") }}" rel="stylesheet" media="screen">
    <link href="{{  URL::asset("css/select2.min.css") }}" rel="stylesheet" media="screen">
    <link href="{{  URL::asset("vendor/perfect-scrollbar/perfect-scrollbar.css") }}" rel="stylesheet" media="screen">
    <link href="{{  URL::asset("css/buttons.dataTables.min.css") }}" rel="stylesheet" media="screen">
    <link href="{{  URL::asset("css/style.css") }}" rel="stylesheet" media="screen">

    <!-- Main CSS-->
    <link href="{{ asset("css/theme.css") }}" rel="stylesheet" media="screen">
    <link href="{{ asset("css/jquery.dataTables.min.css") }}" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/impression.css') }}" media="print">

</head>

<body class="animsition" >
    <div class="page-wrapper">
    @include('layouts.nav')
        <img src="{{ asset("images/Eiffage_2400_01_colour_RGB.jpg") }}" class="logo_eiffage" style="display: none">
    <!-- PAGE CONTAINER-->
        <div class="page-container">
            @include('layouts.bar')
            <!-- MAIN CONTENT-->
                <div class="main-content">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid" id="page">
                            <div class="agile-grid"  style="background-color: #FFFFFF;@yield('pour_register') margin: 5px">

                                @if(Session::has('success'))
                                    <div class="alert alert-success">{{Session::get('success')}}</div>
                                @endif()
                                @if(Session::has('error'))
                                    <div class="alert alert-danger">{{Session::get('error')}}</div>
                                @endif()
                                @yield('content')
                            </div>
            @yield('page')
                        </div>
                    </div>
                </div>
                <!-- END MAIN CONTENT-->
                <!-- END PAGE CONTAINER-->
        </div>
    </div>

    <!-- Jquery JS-->
    <!-- Jquery JS-->
    <script src="{{  URL::asset("vendor/jquery-3.2.1.min.js") }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{  URL::asset("vendor/bootstrap-4.1/popper.min.js") }}"></script>
    <script src="{{  URL::asset("vendor/bootstrap-4.1/bootstrap.min.js") }}"></script>
    <!-- Vendor JS       -->
    <script src="{{  URL::asset("vendor/slick/slick.min.js") }}">
    </script>
    <script src="{{  URL::asset("vendor/wow/wow.min.js") }}"></script>
    <script src="{{  URL::asset("vendor/animsition/animsition.min.js") }}"></script>
    <script src="{{  URL::asset("vendor/bootstrap-progressbar/bootstrap-progressbar.min.js") }}">
    </script>
    <script src="{{  URL::asset("vendor/counter-up/jquery.waypoints.min.js") }}"></script>
    <script src="{{  URL::asset("vendor/counter-up/jquery.counterup.min.js") }}">
    </script>
    <script src="{{  URL::asset("vendor/circle-progress/circle-progress.min.js") }}"></script>
    <script src="{{  URL::asset("vendor/perfect-scrollbar/perfect-scrollbar.js") }}"></script>
    <script src="{{  URL::asset("vendor/chartjs/Chart.bundle.min.js") }}"></script>
    <script src="{{  URL::asset("vendor/select2/select2.min.js") }}">
    </script>
    <script src="{{ asset("js/bootstrap.js") }}"></script>
    <script src="{{ asset("js/bootstrap-select.js") }}"></script>
    <script src="{{ asset("js/dataTables.min.js") }}"></script>
    <script src="{{ asset("js/dataTables.checkboxes.js") }}"></script>
    <script src="{{ asset("js/dataTables.buttons.min.js") }}"></script>
    <script src="{{ asset("js/buttons.flash.min.js") }}"></script>
    <script src="{{ asset("js/jszip.min.js") }}"></script>
    <script src="{{ asset("js/dataTable.pdfmaker.js") }}"></script>
    <script src="{{ asset("js/vfs_fonts.js") }}"></script>
    <script src="{{ asset("js/buttons.html5.min.js") }}"></script>
    <script src="{{ asset("js/buttons.print.min.js") }}"></script>

    <!-- Main JS-->
    <script src="{{ asset("js/main.js") }}"></script>



    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="{{  URL::asset("js/jquery.ui.widget.js") }}"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
    <!-- Bootstrap JS is not required, but included for the responsive demo navigation -->

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->


    <script src="{{  URL::asset("js/jquery.iframe-transport.js") }}"></script>
    <script src="{{  URL::asset("js/jquery.fileupload.js") }}"></script>
    <script src="{{  URL::asset("js/jquery.fileupload-process.js") }}"></script>
    <script src="{{  URL::asset("js/jquery.fileupload-image.js") }}"></script>
    <script src="{{  URL::asset("js/jquery.fileupload-audio.js") }}"></script>
    <script src="{{  URL::asset("js/jquery.fileupload-video.js") }}"></script>
    <script src="{{  URL::asset("js/jquery.fileupload-validate.js") }}"></script>
</body>

</html>
<!-- end document-->
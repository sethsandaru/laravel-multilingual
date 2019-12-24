<!---
LARAVEL MULTILINGUAL - By Seth Phat <github.com/sethsandaru>

Special thanks to Admin template by Creative Tim - 2019 - Light Dashboard Template - Bootstrap 4.
--->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@lang($namespace . "::base.site-title")</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="{{asset('vendor/multilingual/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('vendor/multilingual/css/light-bootstrap-dashboard.css')}}" rel="stylesheet" />
    <link href="{{asset('vendor/multilingual/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('vendor/multilingual/css/multilingual.css')}}" rel="stylesheet" />

    @stack('styles')
</head>

<body>
<div class="wrapper">
    <div class="sidebar" data-image="{{asset('vendor/multilingual/img/sidebar-4.jpg')}}" data-color="blue">
        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="{{route('multilingual.index')}}" class="simple-text">
                    @lang($namespace . "::base.short-name")
                </a>
            </div>
            <ul class="nav">
                <li>
                    <a class="nav-link" href="{{route('lml-language.index')}}">
                        <i class="nc-icon nc-chart-pie-35"></i>
                        <p>@lang($namespace . "::base.languages")</p>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{route('lml-text-bundle.index')}}">
                        <i class="nc-icon nc-circle-09"></i>
                        <p>@lang($namespace . "::base.text-modules")</p>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{route('lml-text-bundle-item.index')}}">
                        <i class="nc-icon nc-notes"></i>
                        <p>@lang($namespace . "::base.text-module-item")</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session()->get('error'))
                        <div class="alert alert-danger">
                            <p>{{session()->get('error')}}</p>
                        </div>
                    @endif

                    @if(session()->get('info'))
                        <div class="alert alert-info">
                            <p>{{session()->get('info')}}</p>
                        </div>
                    @endif
                </div>

                @yield('main-content')
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav>
                    <p class="copyright text-center">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <a href="http://www.creative-tim.com">Creative Tim</a> for the Light Admin Template
                        |
                        © 2019 by <a href="http://github.com/sethsandaru">Seth Phat - Phat Tran</a> for the
                        <a href="https://github.com/sethsandaru/laravel-multilingual">Laravel Multilingual</a>
                    </p>
                </nav>
            </div>
        </footer>
    </div>
</div>
</body>

<!--   Core JS Files   -->
<script src="{{asset('vendor/multilingual/js/core/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendor/multilingual/js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendor/multilingual/js/core/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendor/multilingual/js/core/underscore-min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendor/multilingual/js/core/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendor/multilingual/js/core/dataTables.bootstrap4.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendor/multilingual/js/light-bootstrap-dashboard.js?v=2.0.0')}}" type="text/javascript"></script>
<script src="{{asset('vendor/multilingual/js/lang-text-control.js?v=1.0.0')}}" type="text/javascript"></script>
@stack('script')

</html>

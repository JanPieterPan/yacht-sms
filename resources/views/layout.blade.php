<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@section('title') WE Management @show</title>
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/web/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/web/css/swiper.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/web/css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/web/css/styles.css') }}" rel="stylesheet">
    <!-- Favicon  -->
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}">
</head>
<body data-spy="scroll" data-target=".fixed-top">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
        <div class="container">
            <a class="navbar-brand logo-image" href="{{ route('home') }}">WE Management</a>

            <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    @if(request()->is('/'))
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="#home">HOME <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="#werkwijze">WERKWIJZE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('news') }}">NIEUWS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="#contact">CONTACT</a>
                        </li>
                        @guest
                            <li class="nav-item">
                                <a class="nav-link page-scroll" href=" {{ route('user.login.form') }}">LOGIN</a>
                            </li>
                        @endguest
                    @endif
                    @auth
                        <li class="nav-item">
                            <a href="{{ url('/profile') }}" class="d-block header_avatar bg_cover ml-2" style="background-image: url({{ auth()->user()->getAvatar() }})"></a>
                        </li>
                    @endauth
                </ul>
            </div> <!-- end of navbar-collapse -->
        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->

    <!-- Content -->
    @yield('content')
    <!-- end of content -->

    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-col first">
                        @if($footerTexts && $footerTexts['about'])
                            <h6>Over ons</h6>
                            <p class="p-small">{{ $footerTexts['about'] }}</p>
                        @endif
                    </div>
                    <div class="footer-col second">
                        @if($footerTexts && $footerTexts['details'])
                            <h6>Bedrijfsgegevens</h6>
                            <p class="p-small">{{ $footerTexts['details'] }}</p>
                        @endif
                    </div>
                    @if($settings)
                        <div class="footer-col third">
                            @if($settings->facebook)
                                <span class="fa-stack">
                                    <a href="{{ $settings->facebook }}" target="_blank">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-facebook-f fa-stack-1x"></i>
                                    </a>
                                </span>
                            @endif
                            @if($settings->twitter)
                                <span class="fa-stack">
                                    <a href="{{ $settings->twitter }}" target="_blank">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-twitter fa-stack-1x"></i>
                                    </a>
                                </span>
                            @endif
                            @if($settings->linkedin)
                                <span class="fa-stack">
                                    <a href="{{ $settings->linkedin }}" target="_blank">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-linkedin fa-stack-1x"></i>
                                    </a>
                                </span>
                            @endif
                            @if($settings->email)
                                <p class="p-small">
                                    <a href="mailto:{{ $settings->email }}">
                                        <strong>{{ $settings->email }}</strong>
                                    </a>
                                </p>
                            @endif
                        </div>
                    @endif
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of footer -->
    <!-- end of footer -->

    <!-- Copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small"> © <a href="{{ route('home') }}">{{ now()->year }} WE Management International BV</a></p>
                </div> <!-- end of col -->
            </div> <!-- enf of row -->
        </div> <!-- end of container -->
    </div> <!-- end of copyright -->
    <!-- end of copyright -->


    <!-- Scripts -->
    <script src="{{ asset('assets/web/js/jquery.min.js') }}"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="{{ asset('assets/web/js/bootstrap.min.js') }}"></script> <!-- Bootstrap framework -->
    <script src="{{ asset('assets/web/js/jquery.easing.min.js') }}"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="{{ asset('assets/web/js/swiper.min.js') }}"></script> <!-- Swiper for image and text sliders -->
    <script src="{{ asset('assets/web/js/jquery.magnific-popup.js') }}"></script> <!-- Magnific Popup for lightboxes -->
    <script src="{{ asset('assets/web/js/form-builder.min.js') }}"></script> <!-- Formbuilder -->
    <script src="{{ asset('assets/web/js/form-render.min.js') }}"></script> <!-- Formbuilder -->
    <script src="{{ asset('assets/web/js/scripts.js') }}"></script> <!-- Custom scripts -->
    @yield('blade-scripts')
</body>
</html>


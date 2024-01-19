<!DOCTYPE html>
<html  @if( app()->getLocale() == "fa") dir="rtl" @endif lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ \HackerESQ\Settings\Facades\Settings::get('site_title_'.app()->getLocale(), 'Site title') }}</title>
    <!-- Stylesheets -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    @if( app()->getLocale() == "fa")
        <link href="{{ asset('css/style-rtl.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @endif

    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">

    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
</head>

<body>

<div class="page-wrapper">

    <!-- Preloader -->
    <!-- <div class="preloader"></div> -->

    <!-- Main Header-->
    <header id="home" class="main-header header-style-three">
        <div class="container">
            <div class="row">
                @if(\HackerESQ\Settings\Facades\Settings::get('logo' , false))
                <div class="col-12 text-center">
                    <img src="{{ asset(Str::replaceFirst('public/' , 'storage/' , \HackerESQ\Settings\Facades\Settings::get('logo'))) }}" alt="">
                </div>
                @endif
                <div class="menu_con">
                    <a href="{{ route('home') }}" class="theme-btn btn-style-two">{{ __('Home') }}</a>
                    <a href="{{ route('about-us') }}" class="theme-btn btn-style-two">{{ __('about_us') }}</a>
                    <a href="contacts.html" class="theme-btn btn-style-two">{{ __('contact_us') }}</a>
                    <a href="{{ route('changeLang' , app()->getLocale() == "en" ? 'fa' : 'en') }}" class="theme-btn btn-style-two">{{ __('other_lang_name') }}</a>
                </div>
            </div>
        </div>

        <!-- Header Lower -->
        <div class="header-lower">
            <!-- Main box -->
            <div class="main-box text-center">
                <!--Nav Box-->
                <div class="nav-outer">
                    <div class="outer-box">
                        <!-- Mobile Nav toggler -->
                        <div class="mobile-nav-toggler"><span class="icon lnr-icon-bars"></span></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header Lower -->

        <!-- Mobile Menu  -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>

            <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
            <nav class="menu-box">
                <div class="upper-box">
                    <div class="close-btn"><i class="icon fa fa-times"></i></div>
                </div>

                <ul class="navigation clearfix">
                    <!--Keep This Empty / Menu will come through Javascript-->
                </ul>
                <ul class="contact-list-one">

                    <li><span class="title txt_white"><a href="{{ route('home') }}">{{ __('Home') }}</a></span></li>
                    <li><span class="title txt_white"><a href="{{ route('about-us') }}">{{ __('about_us') }}</a></span></li>
                    <li><span class="title txt_white"><a href="contacts.html">{{ __('contact_us') }}</a></span></li>
                    <li><span class="title txt_white"><a href="{{ route('changeLang' , app()->getLocale() == "en" ? 'fa' : 'en') }}">{{ __('other_lang_name') }}</a></span></li>

                    <li>
                        <!-- Contact Info Box -->
                        <div class="contact-info-box">
                            <i class="icon lnr-icon-phone-handset"></i>
                            <span class="title">{{ __('call_now') }}</span>
                            <a href="tel:{{ str_replace(' ' ,'' , \HackerESQ\Settings\Facades\Settings::get('telephone')) }}">{{ \HackerESQ\Settings\Facades\Settings::get('telephone') }}</a>
                        </div>
                    </li>
                    <li>
                        <!-- Contact Info Box -->
                        <div class="contact-info-box">
                            <span class="icon lnr-icon-envelope1"></span>
                            <span class="title">{{ __('Send_Email') }}</span>
                            <a href="mailto:{{ \HackerESQ\Settings\Facades\Settings::get('email') }}">{{ \HackerESQ\Settings\Facades\Settings::get('email') }}</a>
                        </div>
                    </li>
                    <li>
                        <!-- Contact Info Box -->
                        <div class="contact-info-box">
                            <span class="icon lnr-icon-clock"></span>
                            <span class="title"></span>
                            {{ \HackerESQ\Settings\Facades\Settings::get('work_time_'.app()->getLocale())   }}
                        </div>
                    </li>
                </ul>


                <ul class="social-links">
                    @if(\HackerESQ\Settings\Facades\Settings::get('twitter'))
                        <li><a href="{{ \HackerESQ\Settings\Facades\Settings::get('twitter') }}"><i class="fab fa-twitter"></i></a></li>
                    @endif
                    @if(\HackerESQ\Settings\Facades\Settings::get('facebook'))
                        <li><a href="{{ \HackerESQ\Settings\Facades\Settings::get('facebook') }}"><i class="fab fa-facebook-f"></i></a></li>
                    @endif
                    @if(\HackerESQ\Settings\Facades\Settings::get('instagram'))
                        <li><a href="{{ \HackerESQ\Settings\Facades\Settings::get('instagram') }}"><i class="fab fa-instagram"></i></a></li>
                    @endif
                </ul>
            </nav>
        </div><!-- End Mobile Menu -->
    </header>
    <!--End Main Header -->
    @hasSection('content')
        @yield('content')
    @endif
    @if( isset($slot))
        {{ $slot }}
    @endif
    <!-- Main Footer -->
    <footer class="main-footer">
        <!--Footer Bottom-->
        <div class="footer-bottom">
            <div class="auto-container">
                <div class="inner-container">
                    <div class="copyright-text">&copy; {{ __('copyright') }} {{ now()->year }} {{ __('by') }} {{ \HackerESQ\Settings\Facades\Settings::get('site_title_'.app()->getLocale(), 'Site title') }} {{ __('copyright2') }}</div>
                </div>
            </div>
        </div>
    </footer>
    <!--End Main Footer -->

</div><!-- End Page Wrapper -->

<!-- Scroll To Top -->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>

<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<!--Revolution Slider-->
<script src="{{ asset('plugins/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
<script src="{{ asset('plugins/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('plugins/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script src="{{ asset('plugins/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
<script src="{{ asset('plugins/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script src="{{ asset('plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{ asset('plugins/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
<script src="{{ asset('plugins/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ asset('plugins/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
<script src="{{ asset('plugins/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{ asset('plugins/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
<script src="{{ asset('js/main-slider-script.js') }}"></script>
<!--Revolution Slider-->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/wow.js') }}"></script>
<script src="{{ asset('js/appear.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/swiper.min.js') }}"></script>
<script src="{{ asset('js/owl.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

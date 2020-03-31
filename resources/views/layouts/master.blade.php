<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Suck Blow</title>

  <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon"/>

  <link rel="stylesheet" href="{{asset('main/vendors/bootstrap/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('main/vendors/fontawesome/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('main/vendors/themify-icons/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('main/vendors/owl-carousel/owl.theme.default.min.css')}}">
  <link rel="stylesheet" href="{{asset('main/vendors/owl-carousel/owl.carousel.min.css')}}">

  <link rel="stylesheet" href="{{asset('main/css/style.css')}}">
</head>
<body>

  <!--================ Start Header Menu Area =================-->
  <header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
          <a class="navbar-brand logo_h" href="{{url('/')}}">
            <img src="{{asset('images/layout/suckblow-logo.png')}}" width="70" height="70">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
              <li class="nav-item">
                @if(Auth::guard('partner')->check() || Auth::guard('web')->check())
                <a class="nav-link" href="{{url('/home')}}">Home</a>
                @else
                <a class="nav-link" href="{{url('/')}}">Home</a>
                @endif
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('/blog')}}">Blog</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('/about')}}">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('/contact')}}">Contact</a>
              </li>
            </ul>

            @if(Auth::guard('partner')->check() || Auth::guard('web')->check())
            <ul class="navbar-nav ml-auto">
              <li class="nav-item dropdown" style="margin-right: 10px;">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: #fff;">
                  @if(Auth::guard('partner')->check())
                    {{ Auth::guard('partner')->user()->name }}
                  @elseif(Auth::guard('web')->check())
                    {{ Auth::guard('web')->user()->name }}
                  @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a href="{{url('/dashboard')}}" class="dropdown-item">
                    Dashboard
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                </div>
              </li>
              <br>
              <li class="nav-item">
                <a class="button button-header" href="{{url('/select')}}">
                  Post Ads
                </a>
              </li>
              <br>
            </ul>
            @else
            <br>
            <ul class="nav-shop">
              <li class="nav-item"><a class="button button-header" href="{{url('/register')}}">Sign Up</a></li>
              <li class="nav-item"><a class="button button-header" href="{{url('/login')}}">Login</a></li>
            </ul>
            @endauth

            <!-- @guest
            <br>
            <ul class="nav-shop">
              <li class="nav-item"><a class="button button-header" href="{{url('/register')}}">Sign Up</a></li>
              <li class="nav-item"><a class="button button-header" href="{{url('/login')}}">Login</a></li>
            </ul>
            @endguest -->

          </div>
        </div>
      </nav>
    </div>
  </header>
  <!--================ End Header Menu Area =================-->

  <main class="site-main">

    @yield('content')

  </main>

  <!--================ Start footer Area  =================-->  
  <footer class="footer">
    <div class="footer-area">
      <div class="container">
        <div class="row section_gap">
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="single-footer-widget tp_widgets">
              <h4 class="footer_title large_title">Our Mission</h4>
              <p style="color: #fff;">
                So seed seed green that winged cattle in. Gathering thing made fly you're no 
                divided deep moved us lan Gathering thing us land years living.
              </p>
              <p style="color: #fff;">
                So seed seed green that winged cattle in. Gathering thing made fly you're no divided deep moved 
              </p>
            </div>
          </div>
          <div class="offset-lg-1 col-lg-2 col-md-6 col-sm-6">
            <div class="single-footer-widget tp_widgets">
              <h4 class="footer_title">Quick Links</h4>
              <ul class="list">
                @if(Auth::guard('partner')->check() || Auth::guard('web')->check())
                <li><a href="{{url('/home')}}">Home</a></li>
                @else
                <li><a href="{{url('/')}}">Home</a></li>
                @endif
                <li><a href="{{url('/blog')}}">Blog</a></li>
                <li><a href="{{url('/about')}}">About</a></li>
                <li><a href="{{url('/contact')}}">Contact</a></li>
              </ul>
            </div>
          </div>
          <div class="offset-lg-1 col-lg-3 col-md-6 col-sm-6">
            <div class="single-footer-widget tp_widgets">
              <h4 class="footer_title">Contact Us</h4>
              <div class="ml-40">
                <p class="sm-head">
                  <span class="fa fa-location-arrow"></span>
                  Head Office
                </p>
                <p>123, Main Street, Your City</p>
  
                <p class="sm-head">
                  <span class="fa fa-phone"></span>
                  Phone Number
                </p>
                <p>
                  +123 456 7890 <br>
                  +123 456 7890
                </p>
  
                <p class="sm-head">
                  <span class="fa fa-envelope"></span>
                  Email
                </p>
                <p>
                  free@infoexample.com <br>
                  www.infoexample.com
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">
        <div class="row d-flex">
          <p class="col-lg-12 footer-text text-center">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved 
            | <a href="{{url('http://suckblow.com')}}">Suck Blow</a> 
            | Powered by <a href="https://colorlib.com" target="_blank">Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
        </div>
      </div>
    </div>
  </footer>
  <!--================ End footer Area  =================-->

<script src="{{asset('main/vendors/jquery/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('main/vendors/bootstrap/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('main/vendors/skrollr.min.js')}}"></script>
<script src="{{asset('main/vendors/owl-carousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('main/vendors/jquery.ajaxchimp.min.js')}}"></script>
<script src="{{asset('main/vendors/mail-script.js')}}"></script>
<script src="{{asset('main/js/main.js')}}"></script>

@include('sweetalert::alert')

</body>
</html>

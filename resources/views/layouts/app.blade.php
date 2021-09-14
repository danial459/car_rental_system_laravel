<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!--   Core JS Files   -->
    <script src="{{ asset('js/core/jquery.min.js')}}" type = "text/javascript"></script>
    <script src="{{ asset('js/core/popper.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('js/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/moment.min.js')}}"></script>
    <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
    <script src="{{ asset('js/plugins/bootstrap-datetimepicker.js')}}" type="text/javascript"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="{{ asset('js/plugins/nouislider.min.js')}}" type="text/javascript"></script>
    <!--  Google Maps Plugin  -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('js/material-kit.js?v=2.0.4')}}" type="text/javascript"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- Toastr -->



    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/material-kit.css?v=2.0.4')}}"  />
</head>
<body>

    @if(Auth::guard('web')->check())
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container">
            <div class="mx-2"><a class="navbar-brand" href="{{route('user.home')}}">Car Rental Service</a></div>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <div class="mx-2"><li class="nav-item {{Request::path()=== 'user/booking/create/detail' ? 'active' : '' }}">
                <a class="nav-link" href="{{route('user.booking.create.detail')}}">Book Car<span class="sr-only">(current)</span></a>
              </li>
              </div>
              <div class="mx-2"><li class="nav-item {{Request::path()=== 'user/cars' ? 'active' : '' }}">
                <a class="nav-link" href="{{route('user.cars')}}">Cars<span class="sr-only">(current)</span></a>
              </li>
              </div>
            </ul>
            <ul class="navbar-nav form-inline ml-auto">
              <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" style='cursor: pointer;' data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{Auth::user()->name}}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" style='cursor: pointer;'>Profile</a>
                  <a class="dropdown-item"  href="" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">Log out</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>

                </div>
              </li>
            </ul>

          </div>
        </div>
      </nav>
      @elseif (Auth::guard('admin')->check())
      <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container">
          <a class="navbar-brand" href="{{route('admin.home')}}">Home</a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="sr-only">Toggle navigation</span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
          <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="{{route('admin.customer.all')}}">Customers<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('admin.car.all')}}">Cars</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="javascript:;">Pricing</a>
              </li>
            </ul>
            <ul class="navbar-nav form-inline ml-auto">
              <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" style='cursor: pointer;' data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{Auth::guard('admin')->user()->name}}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" style='cursor: pointer;'>Profile</a>
                  <a class="dropdown-item"  href="" onclick="event.preventDefault();
                  document.getElementById('admin-logout-form').submit();">Log out</a>
                  <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>

                </div>
              </li>
            </ul>

          </div>
        </div>
      </nav>


      @else


      @endif

            @yield('content')

</body>
</html>

<script>





</script>

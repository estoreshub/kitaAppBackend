<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="endless admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, endless admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @include('layouts_admin.style')
  </head>
  <body main-theme-layout="main-theme-layout-1">
    <!-- Loader starts-->
    <!-- <div class="loader-wrapper">
      <div class="loader bg-white">
        <div class="whirly-loader"> </div>
      </div>
    </div> -->
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
      @include('layouts_admin.header')
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        @include('layouts_admin.sidebar')
        <div class="page-body">
          <!-- breadcrumb  Start -->
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col">
                  <div class="page-header-left">
                    <h3>@yield('breadcrumb-title')</h3>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('/')}}"><i data-feather="home"></i></a></li>
                      @yield('breadcrumb-items')
                    </ol>
                  </div>
                </div>
                <!-- Bookmark Start-->

                <!-- Bookmark Ends-->
              </div>
            </div>
          </div>
          <!-- End Breadcrumb -->
          @yield('content')
        </div>
        @include('layouts_admin.footer')
      </div>
      <!-- Page Body End-->
    </div>
    @include('layouts_admin.script')
    @include('footervarview')
  </body>
</html>

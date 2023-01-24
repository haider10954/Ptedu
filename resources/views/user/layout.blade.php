<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title')</title>
  <!-- App favicon -->
  <link rel="shortcut icon" href="{{ asset('assets/images/icons/favicon.png') }}">
  @yield('custom-stylesheet')
  @include('user.includes.style')
  @yield('custom-style')
</head>

<body>
  <!-- header start -->
  @include('user.includes.header')
  <!-- header end -->

  {{-- content start --}}
  @yield('content')
  {{-- content end --}}

  <!-- footer start -->
  @include('user.includes.footer')
  <!-- footer end -->

  @yield('modals')
  <!-- js links -->
  @include('user.includes.script')
  @yield('custom-script')
</body>

</html>
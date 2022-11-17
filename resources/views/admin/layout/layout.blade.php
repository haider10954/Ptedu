<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/index.png') }}">

    @include('admin.includes.styles')
    @yield('custom-style')
</head>

<body data-sidebar="dark" data-layout-mode="light">
    <div id="layout-wrapper">
        @include('admin.includes.header')

        <!-- ========== Left Sidebar Start ========== -->
        @include('admin.includes.sidebar')
        <!-- Left Sidebar End -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid" style="background: #FAFAFA;">
                    @yield('content')
                </div>
            </div>

            @include('admin.includes.footer')
        </div>
    </div>

    @include('admin.includes.script')
    @yield('custom-script')
</body>

</html>

<!doctype html>
<html lang="en">


<!-- Mirrored from themesbrand.com/skote/layouts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Sep 2022 11:35:16 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Admin Login | PTEdu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    @include('admin.includes.styles')
</head>

<body>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary">{{ __('translation.Welcome Back') }} !</h5>
                                        <p>{{ __('translation.Sign in to continue to PTEdu') }}</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="{{ asset('assets/images/profile-img.png')}}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="auth-logo">
                                <a class="auth-logo-light">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="{{ asset('assets/images/logo-light.svg')}}" alt="" class="rounded-circle" height="34">
                                        </span>
                                    </div>
                                </a>

                                <a class="auth-logo-dark">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="{{ asset('assets/images/logo.svg')}}" alt="" class="rounded-circle" height="34">
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2">
                                <form class="form-horizontal" method="post" action="{{ route('admin_auth_login') }}">
                                    @if(Session::has('message'))
                                    <div class="alert alert-danger mb-3">{{ Session::get('message') }}</div>
                                    @endif
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="email">{{ __('translation.Email Address') }}</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('translation.Enter Email Address') }}">
                                        @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">{{ __('translation.Password') }}</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" class="form-control" name="password" placeholder="{{ __('translation.Enter Password') }}" aria-label="Password" aria-describedby="password-addon">
                                            <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                        </div>
                                        @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mt-3 d-grid">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">{{ __('translation.Login') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end account-pages -->
    <!-- JAVASCRIPT -->
    @include('admin.includes.script')
</body>

</html>
@extends('user.layout')

@section('title', 'PTEdu - User Change Password')

@section('content')
<div class="section pt-125">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 padding-left">
                <div class="page-sidemenu-heading mb-3">
                    <h5 class="mb-0 font-weight-600">{{ __('translation.User Info') }}</h5>
                    <a href="javscript:void(0)" class="btn btn-dark btn-custom-sm btn-theme-black page-side-menu-toggle">{{ __('translation.menu') }}</a>
                </div>
                <div class="page-side-menu">
                    <ul class="menu">
                        <li><a href="{{ route('my_classroom') }}">{{ __('translation.My Classroom') }}</a></li>
                        <li><a href="{{ route('shopping_bag') }}">{{ __('translation.Shopping Bag') }}</a></li>
                        <li><a href="{{ route('user_info') }}">{{ __('translation.Modifying Member Info') }}</a></li>
                        <li><a href="{{ route('user_inquiry')  }}">{{ __('translation.Inquiry') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="section-heading">
                    <h5 class="mb-4">{{ __('translation.Change Password') }}</h5>
                    <div class="mt-2 mb-3">
                        <p class="mb-0">{{ __('translation.To protect your personal information, please change your password, email, mobile phone number periodically.') }}.</p>
                    </div>
                    @if (Session::has('msg'))
                    <div class="alert alert-info" id="responseMessage">{{ Session::get('msg') }}</div>
                    @endif
                    @if (Session::has('error'))
                    <div class="alert alert-danger" id="responseMessage">{{ Session::get('error') }}</div>
                    @endif
                </div>
                <form method="POST" action="{{ route('user-password') }}">
                    @csrf
                    <div class="row">
                        <div class="col-3 pr-0">
                            <div class="user-info bottom-border">
                                <div class="d-flex align-items-center justify-content-start" style="height:69px;">
                                    <p class="mb-0 user_profile">{{ __('translation.Current Password') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 pl-0">
                            <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:70px;">
                                <div>
                                    <input type="password" class="form-control" name="current_password" placeholder="{{ __('translation.Your current password') }}">
                                    @error('current_password')
                                    <small style="color:#d02525;">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3 pr-0">
                            <div class="user-info bottom-border">
                                <div class="d-flex align-items-center justify-content-start" style="height:69px;">
                                    <p class="mb-0 user_profile">{{ __('translation.New Password') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 pl-0">
                            <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:70px;">
                                <div>
                                    <input type="password" class="form-control" name="new_password" placeholder="{{ __('translation.Enter New Password') }}">
                                    @error('new_password')
                                    <small style="color:#d02525;">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3 pr-0">
                            <div class="user-info bottom-border">
                                <div class="d-flex align-items-center justify-content-start" style="height:69px;">
                                    <p class="mb-0 user_profile">{{ __('translation.Confirm Password') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 pl-0">
                            <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:70px;">
                                <div>
                                    <input type="password" class="form-control" name="confirm_password" placeholder="{{ __('translation.Re Enter password') }}">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center justify-content-center mt-4">
                                <button type="submit" class="btn rounded-0 btn-theme-black text-white" style="padding: 5px 70px 5px 70px;">{{ __('translation.Ok') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection

@section('custom-script')
<script>
    $('.page-side-menu-toggle').on('click', function() {
        $('.page-side-menu').slideToggle();
    });

    $(document).ready(function() {
        setTimeout(function() {
            $("#responseMessage").hide()
        }, 2000);
    });
</script>
@endsection
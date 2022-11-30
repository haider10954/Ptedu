@extends('user.layout')

@section('title', 'PTEdu - User Information')

@section('content')
<div class="section pt-125">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2">
                <div class="page-sidemenu-heading mb-3">
                    <h5 class="mb-0 font-weight-600">My Classroom</h5>
                    <a href="javscript:void(0)" class="btn btn-dark btn-custom-sm btn-theme-black page-side-menu-toggle">menu</a>
                </div>
                <div class="page-side-menu">
                    <ul class="menu">
                        <li><a href="javascript:void(0)">My Classroom</a></li>
                        <li><a href="javascript:void(0)">Shopping Bag</a></li>
                        <li><a href="javascript:void(0)">Modifying Member Info</a></li>
                        <li><a href="javascript:void(0)">1:1 Inquiry</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="section-heading">
                    <h5 class="mb-0">Modifying Member Info</h5>
                    <div class="mt-2 mb-3">
                        <p class="mb-0">To protect your personal information, please change your password, email, mobile phone number periodically.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 pr-0">
                        <div class="user-info bottom-border">
                            <div class="user-details d-flex align-items-center justify-content-start" style="height: 155px;">
                                <p class="mb-0 user_profile">Profile Image</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 pl-0">
                        <div class="d-flex align-items-center bottom-border" style="height:156px; padding-left:10px;">
                            <img src="{{ asset('web_assets/images/User_avatar.png') }}" class="user_avatar" />
                            <div class="ml-2">
                                <p class="mb-0">* Please register your profile picture. <br /> * Image file size up to less than 2MB</p>
                                <div class="d-flex mt-2">
                                    <button class="btn rounded-0 btn-theme-delete mr-2">Register</button>
                                    <button class="btn rounded-0 btn-theme-delete">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3 pr-0">
                        <div class="user-info bottom-border">
                            <div class="d-flex align-items-center justify-content-start" style="height:50px;">
                                <p class="mb-0 user_profile">Name</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-9 pl-0">
                        <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:51px;">
                            <div>
                                <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3 pr-0">
                        <div class="user-info bottom-border">
                            <div class="d-flex align-items-center justify-content-start" style="height:50px;">
                                <p class="mb-0 user_profile">English Name</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-9 pl-0">
                        <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:51px;">
                            <div>
                                <input type="text" class="form-control" name="en_name" placeholder="English Name" value="{{ old('en_name') }}">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-3 pr-0">
                        <div class="user-info bottom-border">
                            <div class="d-flex align-items-center justify-content-start" style="height:50px;">
                                <p class="mb-0 user_profile">ID</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-9 pl-0">
                        <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:51px;">
                            <div>
                                <input type="text" class="form-control" name="ID" placeholder="Enter ID" value="{{ old('ID') }}">
                            </div>
                            <div class="verify_btn">
                                <button class="btn rounded-0 btn-theme-delete ml-2 text-black">Duplicate Verification</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="verify_mobile mt-2">
                            <button class="btn rounded-0 btn-theme-delete ml-2">Duplicate Verification</button>
                        </div>
                    </div>
                </div>



                <div class="mt-5 top-border">
                    <div class="row">
                        <div class="col-3 pr-0">
                            <div class="user-info bottom-border">
                                <div class="d-flex align-items-center justify-content-start" style="height:50px;">
                                    <p class="mb-0 user_profile">Current Password</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 pl-0">
                            <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:51px;">
                                <div>
                                    <input type="password" class="form-control" name="password" placeholder="Combination of 8 or more alphanumeric characters + numbers" value="{{ old('password') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3 pr-0">
                            <div class="user-info bottom-border">
                                <div class="d-flex align-items-center justify-content-start" style="height:50px;">
                                    <p class="mb-0 user_profile">Change Password</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 pl-0">
                            <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:51px;">
                                <div>
                                    <input type="password" class="form-control" name="change_password" placeholder="Enter New Password" value="{{ old('change_password') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3 pr-0">
                            <div class="user-info bottom-border">
                                <div class="d-flex align-items-center justify-content-start" style="height:50px;">
                                    <p class="mb-0 user_profile">Confirm Password</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 pl-0">
                            <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:51px;">
                                <div>
                                    <input type="password" class="form-control" name="confirm_password" placeholder="Enter New Password" value="{{ old('confirm_password') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3 pr-0">
                            <div class="user-info bottom-border">
                                <div class="d-flex align-items-center justify-content-start user_jobs">
                                    <p class="mb-0 user_profile">Job</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 pl-0">
                            <div class="d-flex align-items-center select_job bottom-border input_jobs">
                                <div class=" mr-2">
                                    <input type="radio"> physical therapist
                                </div>
                                <div class=" mr-2">
                                    <input type="radio"> occupational therapist
                                </div>
                                <div class=" mr-2">
                                    <input type="radio"> trainer
                                </div>
                                <div class=" mr-2">
                                    <input type="radio"> pilates instructor
                                </div>
                                <div class="mr-2">
                                    <input type="radio"> Student
                                </div>
                                <div class=" mr-2">
                                    <input type="radio"> office worker
                                </div>
                                <div class=" mr-2">
                                    <input type="radio"> ETC
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3 pr-0">
                            <div class="user-info bottom-border">
                                <div class="d-flex align-items-center justify-content-start" style="height:50px;">
                                    <p class="mb-0 user_profile">Phone number</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 pl-0">
                            <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:51px;">
                                <div>
                                    <input type="text" class="form-control custom_width mr-2" name="mobile" placeholder="010" value="{{ old('en_name') }}">
                                </div>
                                <div>
                                    <input type="text" class="form-control custom_width mr-2" name="mobile" placeholder="010" value="{{ old('en_name') }}">
                                </div>
                                <div>
                                    <input type="text" class="form-control custom_width" name="mobile" placeholder="010" value="{{ old('en_name') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3 pr-0">
                            <div class="user-info bottom-border">
                                <div class="d-flex align-items-center justify-content-start" style="height:50px;">
                                    <p class="mb-0 user_profile">Email</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 pl-0">
                            <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:51px;">
                                <div>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                                <div>
                                    <span class="mr-2 ml-2">@</span>
                                </div>
                                <div>
                                    <input type="text" class="form-control custom_width" name="email" value="{{ old('email') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3 pr-0">
                            <div class="user-info bottom-border">
                                <div class="d-flex align-items-center justify-content-start" style="height:99px;">
                                    <p class="mb-0 user_profile">Address</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 pl-0">
                            <div class="d-flex  bottom-border flex-column" style="padding-left:10px; height:100px;">
                                <div class="mt-2">
                                    <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                                </div>
                                <div class="d-flex">
                                    <input type="text" class="form-control mr-2 mt-1" name="email" value="{{ old('address') }}">
                                    <input type="text" class="form-control mt-1" name="email" value="{{ old('address') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <button class="btn rounded-0 btn-theme-black text-white" style="padding: 5px 30px 5px 30px">Ok</button>
                            </div>
                        </div>
                    </div>
                </div>
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
</script>
@endsection

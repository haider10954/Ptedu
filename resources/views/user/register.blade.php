@extends('user.layout')

@section('title' , 'PTEdu | Register')

@section('content')
<div class="section pt-150">
    <div class="container">
        <div class="m-auto form-register-wrapper">
            <form>
                <div class="section-heading">
                    <h5 class="mb-4">Register</h5>
                    <div class="mt-2 mb-3">
                        <p class="mb-1">It is a professional lecture led by physical therapy & Pilates experts.</p>
                        <p class="mb-0">We will promote your growth as an expert through close knowledge in the field.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3 pr-0">
                        <div class="user-info bottom-border">
                            <div class="d-flex align-items-center justify-content-start" style="height:50px;">
                                <p class="mb-0 user_profile">Name<span class="text-danger">*</span></p>
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
                                <p class="mb-0 user_profile">English Name<span class="text-danger">*</span></p>
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
                                <p class="mb-0 user_profile">ID<span class="text-danger">*</span></p>
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
                                    <p class="mb-0 user_profile">Password<span class="text-danger">*</span></p>
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
                                    <p class="mb-0 user_profile">Change Password<span class="text-danger">*</span></p>
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
                                    <p class="mb-0 user_profile">Confirm Password<span class="text-danger">*</span></p>
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
                                    <p class="mb-0 user_profile">Job<span class="text-danger">*</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 pl-0">
                            <div class="d-flex align-items-center  bottom-border input_jobs">
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
                                    <p class="mb-0 user_profile">Phone number<span class="text-danger">*</span></p>
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
                                    <p class="mb-0 user_profile">Email<span class="text-danger">*</span></p>
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
                                    <p class="mb-0 user_profile">Address<span class="text-danger">*</span></p>
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
                    <div class="mt-5">
                        <div class="form-check mb-2 ml-2">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label ml-2 font-weight-600" for="defaultCheck1">
                                To agree all
                            </label>
                        </div>
                    </div>
                    <div class="bottom-border-register">
                        <div class="form-check mb-2 ml-2 mt-2">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label ml-2" for="defaultCheck1">
                                Agree to the Terms and Conditions (required)
                            </label>
                        </div>

                        <div class="form-check mb-2 ml-2">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label ml-2" for="defaultCheck1">
                                Consent to the personal information processing policy (required)
                            </label>
                        </div>

                        <div class="form-check mb-2 ml-2">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label ml-2" for="defaultCheck1">
                                I’m 14 years of age or older (required)
                            </label>
                        </div>

                        <div class="form-check mb-2 ml-2">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label ml-2" for="defaultCheck1">
                                Agree to receive marketing and event information (optional)
                            </label>
                        </div>

                        <div class="form-check mb-2 ml-2">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label ml-2" for="defaultCheck1">
                                If you agree to receive marketing, you can receive various benefits and event news from Ipamaster.
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center justify-content-center mt-5">
                                <button class="btn rounded-0 btn-register" style="padding: 5px 30px 5px 30px">Register</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

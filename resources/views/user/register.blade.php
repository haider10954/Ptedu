@extends('user.layout')

@section('title' , 'PTEdu | Register')

@section('content')
<div class="section pt-150">
    <div class="container">
        <div class="m-auto form-register-wrapper">
            <form id="registerForm" type="POST">
                @csrf
                <div class="section-heading">
                    <h5 class="mb-4">{{ __('translation.Register') }}</h5>
                    <div class="mt-2 mb-3">
                        <p class="mb-0">{{ __('translation.It is a professional lecture led by physical therapy & Pilates experts') }}.</p>
                        <p class="mb-0">{{ __('translation.We will promote your growth as an expert through close knowledge in the field') }}.</p>
                    </div>
                </div>
                <div class="prompt"></div>
                <div class="error-user-id"></div>
                <div class="row">
                    <div class="col-3 pr-0">
                        <div class="user-info bottom-border">
                            <div class="d-flex align-items-center justify-content-start" style="height:69px;">
                                <p class="mb-0 user_profile">{{ __('translation.Name') }}<span class="text-danger ml-1">*</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-9 pl-0">
                        <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:70px;">
                            <div>
                                <input type="text" class="form-control" name="name" placeholder="{{ __('translation.Name') }}" value="{{ old('name') }}">
                                <div class="error-name"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3 pr-0">
                        <div class="user-info bottom-border">
                            <div class="d-flex align-items-center justify-content-start" style="height:69px;">
                                <p class="mb-0 user_profile">{{ __('translation.English Name') }}<span class="text-danger ml-1">*</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-9 pl-0">
                        <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:70px;">
                            <div>
                                <input type="text" class="form-control" name="en_name" placeholder="{{ __('translation.English Name') }}" value="{{ old('en_name') }}">
                                <div class="error-en-name"></div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-3 pr-0">
                        <div class="user-info bottom-border">
                            <div class="d-flex align-items-center justify-content-start" style="height:69px;">
                                <p class="mb-0 user_profile">{{ __('translation.ID') }}<span class="text-danger ml-1">*</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-9 pl-0">
                        <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:70px;">
                            <div>
                                <input type="text" class="form-control" id="user_id" name="user_id" placeholder="{{ __('translation.Enter ID') }}" value="{{ old('ID') }}">
                            </div>
                            <div class="verify_btn">
                                <button type="button" class="checkUserID btn rounded-0 btn-theme-delete ml-2 text-black">{{ __('translation.Duplicate Verification') }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="verify_mobile mt-2">
                            <button type="button" class="checkUserID btn rounded-0 btn-theme-delete ml-2 text-black">{{ __('translation.Duplicate Verification') }}</button>
                        </div>
                    </div>
                </div>



                <div class="mt-5 top-border">
                    <div class="row">
                        <div class="col-3 pr-0">
                            <div class="user-info bottom-border">
                                <div class="d-flex align-items-center justify-content-start" style="height:69px;">
                                    <p class="mb-0 user_profile">{{ __('translation.Password') }}<span class="text-danger ml-1">*</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 pl-0">
                            <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:70px;">
                                <div>
                                    <input type="password" class="form-control" name="password" placeholder="{{ __('translation.Min of 6 character') }}" value="{{ old('password') }}">
                                    <div class="error-pass"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3 pr-0">
                            <div class="user-info bottom-border">
                                <div class="d-flex align-items-center justify-content-start" style="height:69px;">
                                    <p class="mb-0 user_profile">{{ __('translation.Confirm Password') }}<span class="text-danger ml-1">*</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 pl-0">
                            <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:70px;">
                                <div>
                                    <input type="password" class="form-control" name="confirm_password" placeholder="{{ __('translation.Enter New Password') }}" value="{{ old('confirm_password') }}">
                                    <div class="error-confirm-pass"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3 pr-0">
                            <div class="user-info bottom-border">
                                <div class="d-flex  justify-content-start user_jobs">
                                    <p class="mb-0 user_profile">{{ __('translation.Job') }}<span class="text-danger ml-1">*</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 pl-0">
                            <div class="d-flex align-items-center  bottom-border input_jobs">
                                <div class=" mr-2 mb-1 mb-md-0">
                                    <input type="radio" value="physical therapist" name="job"> physical therapist
                                </div>
                                <div class=" mr-2 mb-1 mb-md-0">
                                    <input type="radio" value="occupational therapist" name="job"> occupational therapist
                                </div>
                                <div class=" mr-2 mb-1 mb-md-0">
                                    <input type="radio" value="trainer" name="job"> trainer
                                </div>
                                <div class=" mr-2 mb-1 mb-md-0">
                                    <input type="radio" value="pilates instructor" name="job"> pilates instructor
                                </div>
                                <div class="mr-2 mb-1 mb-md-0">
                                    <input type="radio" value="student" name="job"> Student
                                </div>
                                <div class=" mr-2 mb-1 mb-md-0">
                                    <input type="radio" value="office worker" name="job"> office worker
                                </div>
                                <div class=" mr-2">
                                    <input type="radio" value="ETC" name="job"> ETC
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3 pr-0">
                            <div class="user-info bottom-border">
                                <div class="d-flex align-items-center justify-content-start custom_label_height">
                                    <p class="mb-0 user_profile">{{ __('translation.Phone number') }}<span class="text-danger ml-1">*</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 pl-0">
                            <div class="d-flex align-items-center  bottom-border custom_height_phone" style="padding-left:10px;">
                                <div class="mr-2 mb-1 mb-md-0 mt-2 mt-md-0">
                                    <div>
                                        <input type="text" class="form-control custom_width" name="country_code" placeholder="{{ __('translation.Country Code') }}" value="{{ old('mobile') }}">
                                        <div class="error-mobile-number d-block"></div>
                                    </div>
                                </div>
                                <div class="mr-2 mb-1 mb-md-0">
                                    <div>
                                        <input type="number" class="form-control custom_width" name="mobile" placeholder="{{ __('translation.Mobile number') }}" value="{{ old('mobile') }}">
                                        <div class="error-mobile-number d-block"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3 pr-0">
                            <div class="user-info bottom-border">
                                <div class="d-flex align-items-center justify-content-start custom_height_email">
                                    <p class="mb-0 user_profile">{{ __('translation.Email') }}<span class="text-danger ml-1">*</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 pl-0">
                            <div class="d-flex align-items-center bottom-border custom_height_email_input" style="padding-left:10px;">
                                <div>
                                    <input type="text" class="form-control" name="email_name" value="{{ old('email') }}">
                                    <div class="error-email"></div>
                                </div>
                                <div>
                                    <span class="mr-2 ml-2">@</span>
                                </div>
                                <div>
                                    <input type="text" class="form-control custom_width" name="email_extension" value="{{ old('email') }}">
                                    <div class="error-extension"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3 pr-0">
                            <div class="user-info bottom-border">
                                <div class="d-flex  justify-content-start" style="height:114px;">
                                    <p class="mb-0 user_profile">{{ __('translation.Address') }}<span class="text-danger ml-1">*</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 pl-0">
                            <div class="d-flex  bottom-border flex-column" style="padding-left:10px; height:115px;">
                                <div class="mt-2">
                                    <textarea type="text" rows="2" style="resize: none;" class="form-control" name="address" placeholder="{{ __('translation.Enter your Address') }}">{{ old('address') }}</textarea>
                                </div>
                                <div class="error-address"></div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <div class="form-check mb-2 ml-2">
                            <input class="form-check-input selectAll" type="checkbox" value="">
                            <label class="form-check-label ml-2 font-weight-600" for="defaultCheck1">
                                {{ __('translation.To agree all') }}
                            </label>
                        </div>
                    </div>
                    <div class="bottom-border-register">
                        <div class="form-check mb-2 ml-2 mt-2">
                            <input class="form-check-input selectCheckBox" type="checkbox" value="">
                            <label class="form-check-label ml-2" for="defaultCheck1">
                                {{ __('translation.Agree to the Terms and Conditions') }} ({{ __('translation.required') }})
                            </label>
                        </div>

                        <div class="form-check mb-2 ml-2">
                            <input class="form-check-input selectCheckBox" type="checkbox" value="">
                            <label class="form-check-label ml-2 " for="defaultCheck1">
                                {{ __('translation.Consent to the personal information processing policy') }} ({{ __('translation.required') }})
                            </label>
                        </div>

                        <div class="form-check mb-2 ml-2">
                            <input class="form-check-input selectCheckBox" type="checkbox" value="">
                            <label class="form-check-label ml-2" for="defaultCheck1">
                                {{ __('translation.I’m 14 years of age or older') }} ({{ __('translation.required') }})
                            </label>
                        </div>

                        <div class="form-check mb-2 ml-2">
                            <input class="form-check-input selectCheckBox" type="checkbox" value="">
                            <label class="form-check-label ml-2" for="defaultCheck1">
                                {{ __('translation.Agree to receive marketing and event information') }} ({{ __('translation.optional') }})
                            </label>
                        </div>

                        <div class="form-check mb-2 ml-2">
                            <input class="form-check-input selectCheckBox" type="checkbox" value="">
                            <label class="form-check-label ml-2" for="defaultCheck1">
                                {{ __('translation.If you agree to receive marketing, you can receive various benefits and event news from Ipamaster') }}.
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center justify-content-center mt-5">
                                <button id="submitForm" disabled type="submit" class="btn rounded-0 btn-register" style="padding: 5px 30px 5px 30px">{{ __('translation.Register') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('custom-script')
<script>
    $('.selectAll').on('click', function() {
        if ($('.selectAll').is(':checked')) {
            $('#submitForm').removeAttr('disabled');
            $('.selectCheckBox').prop('checked', true);
        } else {
            $("#submitForm").attr("disabled", true);
            $('.selectCheckBox').prop('checked', false);
        }
    });

    $('.checkUserID').on('click', function() {

        $.ajax({
            type: "POST",
            url: "{{ route('check_user_id') }}",


            data: {
                "_token": "{{ csrf_token() }}",

                user_id: $('#user_id').val(),
            },

            beforeSend: function() {},
            success: function(res) {
                if (res.success == true) {

                    $('.prompt').show()
                    $('.prompt').html('<div class="alert alert-success">' + res.message + '</div>');
                    setTimeout(function() {
                        $('.prompt').hide()
                    }, 1500);


                } else {

                    $('.prompt').show()
                    $('.prompt').html('<div class="alert alert-danger">' + res.message + '</div>');
                    setTimeout(function() {
                        $('.prompt').hide()
                    }, 1500);

                }
            },
            error: function(e) {
                if (e.responseJSON.errors['user_id']) {
                    $('.prompt').html('<div class="alert alert-danger">' + e.responseJSON.errors['user_id'][0] + '</div>');
                }
                setTimeout(function() {
                    $('.prompt').hide()
                }, 1500);

                $('.prompt').show()

            }

        });
    });

    $("#registerForm").on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData($("#registerForm")[0]);
        formData = new FormData($("#registerForm")[0]);
        $.ajax({
            type: "POST",
            url: "{{ route('student_register') }}",
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            data: formData,
            beforeSend: function() {
                $("#submitForm").prop('disabled', true);
                $("#submitForm").html('<i class="fa fa-spinner fa-spin me-1"></i> Processing');
            },
            success: function(res) {
                $("#submitForm").attr('class', 'btn btn-success');
                $("#submitForm").html('<i class="fa fa-check me-1"></i>  Student Registered</>');
                if (res.success) {
                    $('.prompt').html('<div class="alert alert-success mb-3">' + res.message + '</div>');
                    setTimeout(function() {
                        $('html, body').animate({
                            scrollTop: $("html, body").offset().top
                        }, 1000);
                    }, 1500);

                    setTimeout(function() {
                        $('.prompt').hide()
                        window.location.href = "{{ route('user_login') }}";
                    }, 4000);

                    $('.prompt').show()
                } else {}
            },
            error: function(e) {
                $("#submitForm").prop('disabled', false);
                $("#submitForm").html('Register');
                setTimeout(function() {
                    $('html, body').animate({
                        scrollTop: $("html, body").offset().top
                    }, 1000);
                }, 1500);
                if (e.responseJSON.errors['name']) {
                    $('.error-name').html('<small class=" error-message text-danger">' + e.responseJSON.errors['name'][0] + '</small>');
                }
                if (e.responseJSON.errors['en_name']) {
                    $('.error-en-name').html('<small class=" error-message text-danger">' + e.responseJSON.errors['en_name'][0] + '</small>');
                }
                if (e.responseJSON.errors['user_id']) {
                    $('.error-user-id').html('<p class=" alert alert-danger">' + e.responseJSON.errors['user_id'][0] + '</p>');
                    setTimeout(function() {
                        $('.error-user-id').fadeOut();
                    }, 3000);
                }
                if (e.responseJSON.errors['password']) {
                    $('.error-pass').html('<small class=" error-message text-danger">' + e.responseJSON.errors['password'][0] + '</small>');
                }
                if (e.responseJSON.errors['confirm_password']) {
                    $('.error-confirm-pass').html('<small class=" error-message text-danger">' + e.responseJSON.errors['confirm_password'][0] + '</small>');
                }
                if (e.responseJSON.errors['mobile']) {
                    $('.error-mobile-number').html('<small class=" error-message text-danger">' + e.responseJSON.errors['mobile'][0] + '</small>');
                }
                if (e.responseJSON.errors['email_name']) {
                    $('.error-email').html('<small class=" error-message text-danger">' + e.responseJSON.errors['email_name'][0] + '</small>');
                }
                if (e.responseJSON.errors['email_extension']) {
                    $('.error-extension').html('<small class=" error-message text-danger">' + e.responseJSON.errors['email_extension'][0] + '</small>');
                }
                if (e.responseJSON.errors['address']) {
                    $('.error-address').html('<small class=" error-message text-danger">' + e.responseJSON.errors['address'][0] + '</small>');
                }
            }
        });
    });
</script>

@endsection
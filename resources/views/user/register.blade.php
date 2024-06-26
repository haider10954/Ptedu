@extends('user.layout')

@section('title' , 'PTEdu | Register')

@section('custom-style')
<style>
    #user_id::-webkit-outer-spin-button,
    #user_id::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    #user_id {
        -moz-appearance: textfield;
    }
</style>
@endsection

@section('content')
<div class="section pt-150">
    <div class="container">
        <div class="m-auto form-register-wrapper">
            <form id="registerForm" type="POST">
                @csrf
                <div class="section-heading">
                    <h5 class="mb-4">회원가입</h5>
                    <div class="mt-2 mb-3">
                        <p class="mb-0">{{ __('translation.It is a professional lecture led by physical therapy & Pilates experts') }}</p>
                        <p class="mb-0">현업에 밀착한 지식을 통해 전문가로서의 성장을 촉진시켜드리겠습니다.</p>
                    </div>
                </div>
                <div class="prompt"></div>
                <div class="row">
                    <div class="col-lg-3 col-4 pr-0">
                        <div class="user-info bottom-border">
                            <div class="d-flex align-items-center justify-content-start" style="height:70px;">
                                <p class="mb-0 user_profile">{{ __('translation.Name') }}<span class="text-danger ml-1">*</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-8 pl-0">
                        <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:71px;">
                            <div>
                                <input type="text" class="form-control" name="name" placeholder="{{ __('translation.Name') }}" value="{{ old('name') }}">
                                <div class="error-name"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-4 pr-0">
                        <div class="user-info bottom-border">
                            <div class="d-flex align-items-center justify-content-start" style="height:69px;">
                                <p class="mb-0 user_profile">{{ __('translation.English Name') }}<span class="text-danger ml-1">*</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-8 pl-0">
                        <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:70px;">
                            <div class="d-flex align-items-center" style="gap: 0.5rem;">
                                <div>
                                    <input type="text" class="form-control" name="first_name" placeholder="{{ __('translation.First Name') }}" value="{{ old('first_name') }}">
                                    <div class="error-first-name"></div>
                                </div>
                                <div>
                                    <input type="text" class="form-control" name="last_name" placeholder="{{ __('translation.Last Name') }}" value="{{ old('last_name') }}">
                                    <div class="error-last-name"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-3 col-4 pr-0">
                        <div class="user-info bottom-border">
                            <div class="d-flex align-items-center justify-content-start" style="height:89px;">
                                <p class="mb-0 user_profile">{{ __('translation.ID') }}<span class="text-danger ml-1">*</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-8 pl-0">
                        <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:89.8px;">
                            <div class="d-flex align-items-start">
                                <div>
                                    <input type="text" class="form-control" id="user_id" name="user_id" placeholder="{{ __('translation.Enter ID') }}" value="{{ old('ID') }}">
                                    <small class="text-dark">{{ __('translation.Combination of English letters and numbers') }}</small>
                                    <div class="error-user-id"></div>
                                </div>
                                <div class="verify_btn">
                                    <button type="button" class="checkUserID btn rounded-0 btn-theme-delete ml-2 text-black">{{ __('translation.Duplicate Verification') }}</button>
                                </div>
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
                        <div class="col-lg-3 col-4 pr-0">
                            <div class="user-info bottom-border">
                                <div class="d-flex align-items-center justify-content-start" style="height:108px;">
                                    <p class="mb-0 user_profile">{{ __('translation.Password') }}<span class="text-danger ml-1">*</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-8 pl-0">
                            <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:108.8px;">
                                <div>
                                    <input type="password" class="form-control" name="password" placeholder="{{ __('translation.Min of 6 character') }}" value="{{ old('password') }}">
                                    <small class="text-dark">{{ __('translation.At least 8 digits in combination of English and numbers') }}</small>
                                    <div class="error-pass"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-4 pr-0">
                            <div class="user-info bottom-border">
                                <div class="d-flex align-items-center justify-content-start" style="height:69px;">
                                    <p class="mb-0 user_profile">{{ __('translation.Confirm Password') }}<span class="text-danger ml-1">*</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-8 pl-0">
                            <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:70px;">
                                <div>
                                    <input type="password" class="form-control" name="confirm_password" placeholder="{{ __('translation.Enter New Password') }}" value="{{ old('confirm_password') }}">
                                    <div class="error-confirm-pass"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-4 pr-0">
                            <div class="user-info bottom-border">
                                <div class="d-flex  justify-content-start align-items-center user_jobs">
                                    <p class="user_profile mb-0">{{ __('translation.Job') }}<span class="text-danger ml-1">*</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-8 pl-0">
                            <div class="d-flex align-items-center bottom-border input_jobs">
                                <div class=" mr-2 mb-1 mb-md-0">
                                    <input type="radio" value="physical therapist" name="job"> 물리치료사
                                </div>
                                <div class=" mr-2 mb-1 mb-md-0">
                                    <input type="radio" value="occupational therapist" name="job"> 작업치료사
                                </div>
                                <div class=" mr-2 mb-1 mb-md-0">
                                    <input type="radio" value="trainer" name="job"> 트레이너
                                </div>
                                <div class=" mr-2 mb-1 mb-md-0">
                                    <input type="radio" value="pilates instructor" name="job"> 필라테스 강사
                                </div>
                                <div class="mr-2 mb-1 mb-md-0">
                                    <input type="radio" value="student" name="job"> 대학생
                                </div>
                                <div class=" mr-2 mb-1 mb-md-0">
                                    <input type="radio" value="office worker" name="job"> 회사원
                                </div>
                                <div class=" mr-2">
                                    <input type="radio" value="ETC" name="job"> 기타
                                </div>
                                <div class="error-job"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-4 pr-0">
                            <div class="user-info bottom-border">
                                <div class="d-flex align-items-center justify-content-start custom_height_phone">
                                    <p class="mb-0 user_profile margin-mobile-left">{{ __('translation.Phone Number') }}<span class="text-danger ml-1">*</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-8 pl-0">
                            <div class="d-flex align-items-center  bottom-border" style="padding-left:10px; height: 71px; padding-top: 10px;">
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
                        <div class="col-lg-3 col-4 pr-0">
                            <div class="user-info bottom-border">
                                <div class="d-flex align-items-center justify-content-start custom_height_email">
                                    <p class="mb-0 user_profile">{{ __('translation.Email') }}<span class="text-danger ml-1">*</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-8 pl-0">
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
                        <div class="col-lg-3 col-4 pr-0">
                            <div class="user-info bottom-border">
                                <div class="d-flex  justify-content-start" style="height:97px;">
                                    <p class="mb-0 user_profile">{{ __('translation.Address') }}<span class="text-danger ml-1">*</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-8 pl-0">
                            <div class="d-flex  bottom-border flex-column" style="padding-left:10px; height:97.5px;">
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
                                {{ __('translation.If you agree to receive marketing, you can receive various benefits and event news from Ipamaster') }}
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center justify-content-center mt-5">
                                <button id="submitForm"  type="submit" class="btn rounded-0 btn-register" style="padding: 5px 30px 5px 30px">등록</button>
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
    // $('.selectAll').on('click', function() {
    //     if ($('.selectAll').is(':checked')) {
    //         $('#submitForm').removeAttr('disabled');
    //         $('.selectCheckBox').prop('checked', true);
    //     } else {
    //         $("#submitForm").attr("disabled", true);
    //         $('.selectCheckBox').prop('checked', false);
    //     }
    // });

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
                    $('html, body').animate({
                        scrollTop: $("html, body").offset().top
                    }, 1000);
                    $('.prompt').show()
                    $('.prompt').html('<div class="alert alert-success">' + res.message + '</div>');
                    setTimeout(function() {
                        $('.prompt').hide()
                    }, 2500);

                } else {
                    $('html, body').animate({
                        scrollTop: $("html, body").offset().top
                    }, 1000);
                    $('.prompt').show()
                    $('.prompt').html('<div class="alert alert-danger">' + res.message + '</div>');
                    setTimeout(function() {
                        $('.prompt').hide()
                    }, 2500);

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
                $("#submitForm").html('<i class="fa fa-spinner fa-spin me-1"></i> 처리');
                $('.error-message').hide();
            },
            success: function(res) {
                if (res.success == true) {
                    $("#submitForm").attr('class', 'btn btn-success');
                    $("#submitForm").html('<i class="fa fa-check me-1"></i>  등록</>');
                    $('.prompt').html('<div class="alert alert-success mb-3">' + res.message + '</div>');
                    $('.prompt').show();
                    setTimeout(function() {
                        $('html, body').animate({
                            scrollTop: $("html, body").offset().top
                        }, 1000);
                    }, 1500);

                    setTimeout(function() {
                        $('.prompt').hide()
                        window.location.href = "{{ route('user_login') }}";
                    }, 4000);

                } else {
                    $("#submitForm").prop('disabled', false);
                    $("#submitForm").html('등록');
                    $('.prompt').html('<div class="alert alert-danger mb-3">' + res.message + '</div>');
                    $('.prompt').show();
                    setTimeout(function() {
                        $('html, body').animate({
                            scrollTop: $("html, body").offset().top
                        }, 1000);
                    }, 1500);
                }
            },
            error: function(e) {
                $("#submitForm").prop('disabled', false);
                $("#submitForm").html('등록');
                setTimeout(function() {
                    $('html, body').animate({
                        scrollTop: $("html, body").offset().top
                    }, 1000);
                }, 1500);
                if (e.responseJSON.errors['name']) {
                    $('.error-name').html('<small class=" error-message text-danger">' + e.responseJSON.errors['name'][0] + '</small>');
                }
                if (e.responseJSON.errors['first_name']) {
                    $('.error-first-name').html('<small class=" error-message text-danger">' + e.responseJSON.errors['first_name'][0] + '</small>');
                }
                if (e.responseJSON.errors['last_name']) {
                    $('.error-last-name').html('<small class=" error-message text-danger">' + e.responseJSON.errors['last_name'][0] + '</small>');
                }
                if (e.responseJSON.errors['user_id']) {
                    $('.error-user-id').html('<small class=" error-message text-danger">' + e.responseJSON.errors['user_id'][0] + '</small>');
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
                if (e.responseJSON.errors['job']) {
                    $('.error-job').html('<small class=" error-message text-danger">' + e.responseJSON.errors['job'][0] + '</small>');
                }
            }
        });
    });
</script>

@endsection

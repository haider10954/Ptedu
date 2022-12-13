@extends('user.layout')

@section('title', 'PTEdu - User Information')

@section('content')
<div class="section pt-125">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 padding-left">
                <div class="page-sidemenu-heading mb-3">
                    <h5 class="mb-0 font-weight-600">User Info</h5>
                    <a href="javscript:void(0)" class="btn btn-dark btn-custom-sm btn-theme-black page-side-menu-toggle">menu</a>
                </div>
                <div class="page-side-menu">
                    <ul class="menu">
                        <li><a href="{{ route('my_classroom') }}">My Classroom</a></li>
                        <li><a href="{{ route('shopping_bag') }}">Shopping Bag</a></li>
                        <li><a href="{{ route('user_info') }}">Modifying Member Info</a></li>
                        <li><a href="{{ route('user_inquiry')  }}">1:1 Inquiry</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="section-heading">
                    <h5 class="mb-4">Modifying Member Info</h5>
                    <div class="mt-2 mb-3">
                        <p class="mb-0">To protect your personal information, please change your password, email, mobile phone number periodically.</p>
                    </div>
                    @if (Session::has('msg'))
                    <div class="alert alert-info" id="responseMessage">{{ Session::get('msg') }}</div>
                    @endif
                    @if (Session::has('error'))
                    <div class="alert alert-danger" id="responseMessage">{{ Session::get('error') }}</div>
                    @endif
                    <div class="error-duplicate"></div>
                </div>
                <form method="POST" enctype="multipart/form-data" action="{{ route('update_user_info') }}">
                    @csrf
                    <input type="hidden" value="{{ auth()->user()->profile_img  }}" name="old_image" />
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
                                <div id="profile_image_view">
                                    @if(auth()->user()->profile_img == null )
                                    <img src="{{ asset('web_assets/images/User_avatar.png') }}" class="user_avatar" />
                                    @else
                                    <img src="{{ asset('storage/student/'.auth()->user()->profile_img ) }}" class="user_avatar" />
                                    @endif
                                </div>
                                <input type="file" class="selectImage d-none" name="user_profile" id="profile_image">
                                <div class="ml-4">
                                    <p class="mb-0">* Please register your profile picture. <br /> * Image file size up to less than 2MB</p>
                                    <div class="d-flex mt-2">
                                        <button type="button" class="btn rounded-0 btn-theme-delete mr-2 uploadImage">Register</button>
                                        <a class="btn rounded-0 btn-theme-delete" id="delete">Delete</a>
                                    </div>
                                </div>
                            </div>
                            @error('user_profile')
                            <small style="color:#d02525;">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3 pr-0">
                            <div class="user-info bottom-border">
                                <div class="d-flex align-items-center justify-content-start" style="height:69px;">
                                    <p class="mb-0 user_profile">Name</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 pl-0">
                            <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:70px;">
                                <div>
                                    <input type="text" class="form-control" name="name" placeholder="Name" value="{{ auth()->user()->name }}">
                                    @error('name')
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
                                    <p class="mb-0 user_profile">English Name</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 pl-0">
                            <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:70px;">
                                <div>
                                    <input type="text" class="form-control" name="en_name" placeholder="English Name" value="{{ auth()->user()->english_name }}">
                                    @error('en_name')
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
                                    <p class="mb-0 user_profile">ID</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 pl-0">
                            <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:70px;">
                                <div>
                                    <input type="text" class="form-control" id="user_id" name="user_id" placeholder="Enter ID" value="{{ auth()->user()->user_id }}">
                                    @error('user_id')
                                    <small style="color:#d02525;">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="verify_btn">
                                    <button class="btn rounded-0 btn-theme-delete ml-2 text-black checkUserID" type="button">Duplicate Verification</button>

                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="verify_mobile mt-2">
                                <button class="btn rounded-0 btn-theme-delete ml-2 checkUserID" type="button">Duplicate Verification</button>
                            </div>
                        </div>
                    </div>



                    <div class="mt-5 top-border">
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
                                        <input type="radio" name="job" value="physical therapist" {{ auth()->user()->job == 'physical therapist'  ? 'checked':''}}> physical therapist
                                    </div>
                                    <div class=" mr-2">
                                        <input type="radio" name="job" value="occupational therapist" {{ auth()->user()->job == 'occupational therapist'  ? 'checked':''}}> occupational therapist
                                    </div>
                                    <div class=" mr-2">
                                        <input type="radio" name="job" value="trainer" {{ auth()->user()->job == 'trainer'  ? 'checked':''}}> trainer
                                    </div>
                                    <div class=" mr-2">
                                        <input type="radio" name="job" value="pilates instructor" {{ auth()->user()->job == 'pilates instructor'  ? 'checked':''}}> pilates instructor
                                    </div>
                                    <div class="mr-2">
                                        <input type="radio" name="job" value="student" {{ auth()->user()->job == 'student'  ? 'checked':''}}> Student
                                    </div>
                                    <div class=" mr-2">
                                        <input type="radio" name="job" value="office worker" {{ auth()->user()->job == 'office worker'  ? 'checked':''}}> office worker
                                    </div>
                                    <div class=" mr-2">
                                        <input type="radio" name="job" value="ETC" {{ auth()->user()->job == 'ETC'  ? 'checked':''}}> ETC
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3 pr-0">
                                <div class="user-info bottom-border">
                                    <div class="d-flex align-items-center justify-content-start" style="height:69px;">
                                        <p class="mb-0 user_profile">Phone number</p>
                                    </div>
                                </div>
                            </div>
                            @php
                            $code=str_split(auth()->user()->mobile_number,3)
                            @endphp

                            <div class="col-9 pl-0">
                                <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:70px;">
                                    <div>
                                        <input type="text" class="form-control custom_width mr-2" name="country_code" placeholder="Country Code" value="{{$code[0] }}">
                                        @error('country_code')
                                        <small style="color:#d02525;">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <input type="text" class="form-control custom_width" name="mobile" placeholder="Mobile Number" value="{{substr(auth()->user()->mobile_number,3)  }}">
                                        @error('mobile')
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
                                        <p class="mb-0 user_profile">Email</p>
                                    </div>
                                </div>
                            </div>
                            @php
                            $split_email = explode('@', auth()->user()->email)
                            @endphp
                            <div class="col-9 pl-0">
                                <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:70px;">
                                    <div>
                                        <input type="text" class="form-control" name="email_name" value="{{ $split_email[0] }}">
                                        @error('email_name')
                                        <small style="color:#d02525;">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <span class="mr-2 ml-2">@</span>
                                    </div>
                                    <div>
                                        <input type="text" class="form-control custom_width" name="email_extension" value="{{ $split_email[1] }}">
                                        @error('email_extension')
                                        <small style="color:#d02525;">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3 pr-0">
                                <div class="user-info bottom-border">
                                    <div class="d-flex align-items-center justify-content-start" style="height:109px;">
                                        <p class="mb-0 user_profile">Address</p>
                                    </div>
                                </div>
                            </div>
                            @php
                            $address = explode('|', auth()->user()->address)
                            @endphp
                            <div class="col-9 pl-0">
                                <div class="d-flex  bottom-border flex-column" style="padding-left:10px; height:110px;">
                                    <div class="mt-2">
                                        <input type="text" class="form-control" name="address" value="{{ $address[0] }}">
                                    </div>
                                    <div class="d-flex">
                                        <input type="text" class="form-control mr-2 mt-1" name="house_no" value="{{ $address[1] }}">
                                        <input type="text" class="form-control mt-1" name="street_no" value="{{ $address[2] }}">
                                    </div>
                                    @error('address')
                                    <small style="color:#d02525;">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex align-items-center justify-content-center mt-4">
                                    <button type="submit" class="btn rounded-0 btn-theme-black text-white" style="padding: 10px 60px; font-size:13px;">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('delete-image') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{ auth()->id() }}">
                    <p>Are you sure to delete profile image.</p>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('custom-script')
<script>
    $('#delete').on("click", function(id) {
        $('#Modal').modal('show');
    });

    $('.page-side-menu-toggle').on('click', function() {
        $('.page-side-menu').slideToggle();
    });

    $('.uploadImage').on('click', function() {
        $('.selectImage').click();
    });

    $("#profile_image").on("change", function(e) {


        f = Array.prototype.slice.call(e.target.files)[0]
        let reader = new FileReader();
        reader.onload = function(e) {

            $("#profile_image_view").html(`<img style="object-fit: cover;"  id="profile_image_view"  src="${e.target.result}" class="img-block- img-fluid w-100 user_avatar">`);
        }
        reader.readAsDataURL(f);
    });
    $('html, body').animate({
        scrollTop: $("html, body").offset().top
    }, 1000);

    $(document).ready(function() {
        setTimeout(function() {
            $("#responseMessage").hide()
        }, 2000);
    });

    $('.checkUserID').on('click', function() {

        $.ajax({
            type: "POST",
            url: "{{ route('check_user_id') }}",
            dataType: 'json',

            data: {
                "_token": "{{ csrf_token() }}",
                user_id: $('#user_id').val(),
            },

            beforeSend: function() {},
            success: function(res) {
                if (res.success) {
                    $('.error-duplicate').html('');
                    $('.error-duplicate').html('<p class="alert alert-success mb-3 text-success">' + res.message + '</p>');
                    $('.error-duplicate').show()
                    setTimeout(function() {
                        $('.error-duplicate').hide()
                    }, 3000);
                } else {
                    $('.error-duplicate').html('<p class="alert alert-danger mb-3">' + res.message + '</p>');

                }
            },
            error: function(e) {

                if (e.responseJSON.errors['user_id']) {
                    $('.error-duplicate').html('');
                    $('.error-duplicate').html('<p class="alert alert-danger text-danger">' + e.responseJSON.errors['user_id'][0] + '</p>');
                    $('.error-duplicate').show()
                    setTimeout(function() {
                        $('.error-duplicate').hide()
                    }, 3000);
                }
            }

        });
    });
</script>
@endsection
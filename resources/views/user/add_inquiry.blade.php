@extends('user.layout')

@section('title', 'PTEdu - Add Inquiry')

@section('content')
<div class="section pt-125">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 padding-left">
                <div class="page-sidemenu-heading mb-3">
                    <h5 class="mb-0 font-weight-600">My Classroom</h5>
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
                    <h5 class="mb-2">1:1 문의</h5>
                    <p class="mb-0">Questions & Answers in PTEdu</p>
                </div>
                <div class="prompt"></div>
                <form id="inquiryForm">
                    @csrf
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
                                    {{ auth()->user()->name }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3 pr-0">
                            <div class="user-info bottom-border">
                                <div class="d-flex align-items-center justify-content-start" style="height:50px;">
                                    <p class="mb-0 user_profile">Phone Number<span class="text-danger">*</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 pl-0">
                            <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:51px;">
                                <div>
                                    {{ auth()->user()->mobile_number }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 top-border">
                        <div class="row">
                            <div class="col-3 pr-0">
                                <div class="user-info bottom-border">
                                    <div class="d-flex align-items-center justify-content-start" style="height:69px;">
                                        <p class="mb-0 user_profile">Title<span class="text-danger">*</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-9 pl-0">
                                <div class="d-flex  bottom-border" style="padding-left:10px; height:70px;">
                                    <div class="w-100 mt-2">
                                        <input type="text" class="form-control" name="title" placeholder="Enter Title" value="{{ old('title') }}">
                                        <div class="error-title"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3 pr-0">
                                <div class="user-info bottom-border">
                                    <div class="d-flex  justify-content-start" style="height:209px;">
                                        <p class="mb-0 user_profile">Content<span class="text-danger">*</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-9 pl-0">
                                <div class="d-flex align-items-center bottom-border" style="padding-left:10px; min-height:210px; width:100%">
                                    <div class="w-100">
                                        <textarea type="text" class="form-control" name="content" rows="6" placeholder="Enter Title" value="{{ old('content') }}"></textarea>
                                        <div class="error-content"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3 pr-0">
                                <div class="user-info bottom-border">
                                    <div class="d-flex justify-content-start custom_height">
                                        <p class="mb-0 user_profile">Attach File</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-9 pl-0">
                                <div class="align-items-center bottom-border custom_min_height" style="padding-left:10px;">
                                    <div class="mt-2 mb-2 d-flex align-items-center">
                                        <div>
                                            <input class="form-control" type="file" name="files[]" multiple>
                                        </div>
                                        <div class="ml-2">
                                            <button type="button" class="btn btn-sm btn-theme-delete rounded-0 text-dark p-0 p-md-2">Upload files</button>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <small>* Maximum of 3 files to be attached, total capacity cannot exceed 10M.</small>
                                        <br>
                                        <small>* Attached files can be registered as jpg, gif, png, ppt, xls, doc, hwp, pdf files.</small>
                                    </div>
                                    <div class="error-image"></div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex align-items-center justify-content-center mt-4">
                                    <a type="button" class="btn rounded-0 btn-theme-black text-white mr-2" style="padding: 5px 30px" href="{{ route('user_inquiry') }}">Back</a>
                                    <button type="submit" id="submitForm" class="btn rounded-0 btn-theme-black text-white " style="padding: 5px 30px">Register</button>
                                </div>
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

    $("#inquiryForm").on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData($("#inquiryForm")[0]);
        $.ajax({
            type: "POST",
            url: "{{ route('add-inquiry') }}",
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            data: formData,
            mimeType: "multipart/form-data",
            beforeSend: function() {
                $("#submitForm").prop('disabled', true);
                $("#submitForm").html('<i class="fa fa-spinner fa-spin me-1"></i> Processing');
            },
            success: function(res) {

                $("#submitForm").attr('class', 'btn btn-success');
                $("#submitForm").html('<i class="fa fa-check me-1"></i> Inquiry Added</>');
                if (res.success) {
                    $('.prompt').html('<div class="alert alert-success mb-3">' + res.message + '</div>');
                    $('html, body').animate({
                        scrollTop: $("html, body").offset().top
                    }, 1000);
                    setTimeout(function() {
                        $('.prompt').hide()
                        window.location.href = "{{ route('user_inquiry') }}";
                    }, 3000);

                } else {
                    $('.prompt').html('<div class="alert alert-danger mb-3">' + res.message + '</div>');
                    $('html, body').animate({
                        scrollTop: $("html, body").offset().top
                    }, 1000);
                    setTimeout(function() {
                        $('.prompt').hide()
                    }, 2000);

                }
            },
            error: function(e) {
                $("#submitForm").prop('disabled', false);
                $("#submitForm").html('Register');
                if (e.responseJSON.errors['title']) {
                    $('.error-title').html('<small class=" error-message text-danger">' + e.responseJSON.errors['title'][0] + '</small>');
                }
                if (e.responseJSON.errors['content']) {
                    $('.error-content').html('<small class=" error-message text-danger">' + e.responseJSON.errors['content'][0] + '</small>');
                }
                if (e.responseJSON.errors['files']) {
                    $('.error-image').html('<small class=" error-message text-danger">' + e.responseJSON.errors['files'][0] + '</small>');
                }
            }
        });
    });
</script>
@endsection
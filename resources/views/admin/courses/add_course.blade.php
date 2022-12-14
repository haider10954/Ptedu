@extends('admin.layout.layout')

@section('title' , 'Add Course')

@section('custom-style')
<style>
    .hr-color {
        border: 1px solid #C4C4C4;
    }

    .btn-register {
        width: 103px;
        height: 37px;

        background: #F0F0F0;
        border: 1.43489px solid #DFE0EB;
        border-radius: 2.86978px;
        color: #6F6F6F;
        font-weight: 400;
        font-size: 14px;
    }

    .course-image-preview {
        width: 150px;
        height: 150px;
        background: #FFFFFF;
        /* grayscale / divider */
        border: 1px solid #DFE0EB;
        border-radius: 2px;
        display: flex;
        justify-content: center;
        align-items: center;

    }

    .course-image-preview img {
        width: 20px;
        height: 20px;
    }

    .btn-upload {
        background: #F0F0F0;
        border: 1px solid #DFE0EB;
        border-radius: 2px;
        color: #6F6F6F;
    }

    .btn-upload:hover {
        background: #F0F0F0;
        border: 1px solid #DFE0EB;
        border-radius: 2px;
        color: #6F6F6F;
    }

    .btn-add-section {
        background: #FFFFFF;
        border: 1px solid #696CFF;
        border-radius: 2px;
        font-weight: 400;
        font-size: 13px;
        line-height: 23px;
        color: #696CFF;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 4px 16px;
    }

    .btn-add-section:hover {
        background: #FFFFFF;
        border: 1px solid #696CFF;
        border-radius: 2px;
        font-weight: 400;
        font-size: 13px;
        line-height: 23px;
        color: #696CFF;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 4px 16px;
    }

    .lecture-form {
        font-weight: 400 !important;
        font-size: 14px !important;
        line-height: 23px !important;
        color: #6F6F6F !important;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0  Card_title">Course List > Add Course</h4>
                </div>
                <hr class="hr-color" />
            </div>
            <div class="col-12">
                <div class="prompt"></div>
                <form id="courseForm">
                    @csrf

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Course Type</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="course_type">
                                <option>Select Option</option>
                                <option value="expert">Expert Course</option>
                                <option value="public">Public Course</option>
                            </select>
                            <div class="error-course-type"></div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Course Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="horizontal-firstname-input" placeholder="Enter Course Title" name="course_title">
                            <div class="error-course-title"></div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Tutor Name</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="tutor_name">
                                <option>Select Option</option>
                                @foreach ($tutor as $t)
                                <option value="{{ $t->id }}">{{ $t->name }}</option>
                                @endforeach
                            </select>
                            <div class="error-tutor-name"></div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Short Description</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter Short Description" name="short_description">
                            <div class="error-short-description"></div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="description" rows="2" placeholder="Enter Description" name="description"></textarea>
                            <div class="error-description"></div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Total number of Lectures</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" placeholder="Enter total number of lectures" name="no_of_lectures"></input>
                            <div class="error-no-of-lectures"></div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Duration of the Course</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Duration of the Course" name="course_duration"></input>
                            <div class="error-course-duration"></div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Price</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" placeholder="Enter price" name="price"></input>
                            <div class="error-prize"></div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Discounted Price</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" placeholder="Enter discounted Price" name="discounted_Price"></input>
                            <div class="error-discounted-prize"></div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Category</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="category">
                                <option>Select Option</option>
                                @foreach ($category as $cat)
                                <option value="{{ $cat->id}}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            <div class="error-category"></div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Upload Video URL</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter video URL" name="video_url"></input>
                            <div class="error-video-url"></div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Upload Video Type(Youtube , Vimeo)</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter Upload Video Type(Youtube , Vimeo)" name="video"></input>
                            <div class="error-video"></div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Upload course Thumbnail image</label>
                        <div class="col-sm-10">
                            <input type="file" name="course_img" id="course_img" class="d-none">
                            <div class="d-flex align-items-end">
                                <div class="course-image-preview" id="thumbnail_image_view">
                                    <img src="{{ asset('assets/images/icons/image.png') }}" />
                                </div>
                                <button type="button" class="btn btn-upload ms-2" onclick="courseImg('#course_img')">upload</button>
                            </div>
                            <div class="error-course-thumbnail"></div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Upload banner image</label>
                        <div class="col-sm-10">
                            <input type="file" name="banner_img" id="banner_img" class="d-none">
                            <div class="d-flex align-items-end">
                                <div class="course-image-preview" id="banner_image_view">
                                    <img src="{{ asset('assets/images/icons/image.png') }}" />
                                </div>
                                <button type="button" class="btn btn-upload ms-2" onclick="courseImg('#banner_img')">upload</button>
                            </div>
                            <div class="error-course-banner"></div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Course Section</label>
                        <div class="col-sm-10">
                            <div class="repeater">
                                <div data-repeater-list="course_sections">
                                    <div data-repeater-item class="row mb-3 align-items-end">
                                        <div class="col-lg-4">
                                            <label for="name">Section Title</label>
                                            <input type="text" class="form-control" name="section_title" placeholder="Enter Section Title" />
                                        </div>

                                        <div class="col-lg-4">
                                            <label>Section Description</label>
                                            <input type="text" class="form-control" placeholder="Enter Section description" name="section_description" />
                                        </div>

                                        <div class="col-lg-2">
                                            <div class="d-flex align-items-center justify-content-start">
                                                <button data-repeater-delete type="button" class="btn btn-lg btn-register" value="Delete">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex gap-2">
                                    <div class="mt-1 mb-2">
                                        <input data-repeater-create type="button" class="btn btn-lg btn-register" value="Add" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button type="submit" id="submitForm" class="btn btn-lg btn-register">Register</button>
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
    $(document).ready(function() {
        $('#description').summernote();
    });

    function courseImg(id) {
        $(id).click();
    }

    $("#courseForm").on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData($("#courseForm")[0]);
        formData = new FormData($("#courseForm")[0]);
        $.ajax({
            type: "POST",
            url: "{{ route('add-course') }}",
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            data: formData,
            mimeType: "multipart/form-data",
            beforeSend: function() {
                $("#submitForm").html('<i class="bi bi-arrow-clockwise"></i>');
                $(".error-message").hide();
            },
            success: function(res) {

                $("#submitForm").html('<class="btn btn-dark">?????? ??????</>');
                if (res.success) {
                    $('.prompt').html('<div class="alert alert-info mb-3">' + res.message + '</div>');
                    $('html, body').animate({
                        scrollTop: $("html, body").offset().top
                    }, 1000);
                    setTimeout(function() {
                        window.location.href = "{{ route('course') }}";
                    }, 1000);
                } else {}
            },
            error: function(e) {
                $("#submitForm").html('<class="btn btn-lg btn-register">Register</>');
                if (e.responseJSON.errors['course_type']) {
                    $('.error-course-type').html('<span class=" error-message text-danger">' + e.responseJSON.errors['course_type'][0] + '</span>');
                }
                if (e.responseJSON.errors['course_title']) {
                    $('.error-course-title').html('<span class=" error-message text-danger">' + e.responseJSON.errors['course_title'][0] + '</span>');
                }
                if (e.responseJSON.errors['tutor_name']) {
                    $('.error-tutor-name').html('<span class=" error-message text-danger">' + e.responseJSON.errors['tutor_name'][0] + '</span>');
                }
                if (e.responseJSON.errors['short_description']) {
                    $('.error-short-description').html('<span class=" error-message text-danger">' + e.responseJSON.errors['short_description'][0] + '</span>');
                }
                if (e.responseJSON.errors['description']) {
                    $('.error-description').html('<span class=" error-message text-danger">' + e.responseJSON.errors['description'][0] + '</span>');
                }
                if (e.responseJSON.errors['no_of_lectures']) {
                    $('.error-no-of-lectures').html('<span class=" error-message text-danger">' + e.responseJSON.errors['no_of_lectures'][0] + '</span>');
                }
                if (e.responseJSON.errors['course_duration']) {
                    $('.error-course-duration').html('<span class=" error-message text-danger">' + e.responseJSON.errors['course_duration'][0] + '</span>');
                }
                if (e.responseJSON.errors['course_duration']) {
                    $('.error-course-duration').html('<span class=" error-message text-danger">' + e.responseJSON.errors['course_duration'][0] + '</span>');
                }
                if (e.responseJSON.errors['price']) {
                    $('.error-prize').html('<span class=" error-message text-danger">' + e.responseJSON.errors['price'][0] + '</span>');
                }
                if (e.responseJSON.errors['discounted_Price']) {
                    $('.error-discounted-prize').html('<span class=" error-message text-danger">' + e.responseJSON.errors['discounted_Price'][0] + '</span>');
                }
                if (e.responseJSON.errors['category']) {
                    $('.error-category').html('<span class=" error-message text-danger">' + e.responseJSON.errors['category'][0] + '</span>');
                }
                if (e.responseJSON.errors['video_url']) {
                    $('.error-video-url').html('<span class=" error-message text-danger">' + e.responseJSON.errors['video_url'][0] + '</span>');
                }
                if (e.responseJSON.errors['video']) {
                    $('.error-video').html('<span class=" error-message text-danger">' + e.responseJSON.errors['video'][0] + '</span>');
                }
                if (e.responseJSON.errors['course_img']) {
                    $('.error-course-thumbnail').html('<span class=" error-message text-danger">' + e.responseJSON.errors['course_img'][0] + '</span>');
                }
                if (e.responseJSON.errors['banner_img']) {
                    $('.error-course-banner').html('<span class=" error-message text-danger">' + e.responseJSON.errors['banner_img'][0] + '</span>');
                }
            }
        });
    });

    $("#course_img").on("change", function(e) {

        f = Array.prototype.slice.call(e.target.files)[0]
        let reader = new FileReader();
        reader.onload = function(e) {

            $("#thumbnail_image_view").html(`<img style="height: 100%; object-fit: contain;"  id="main_image_preview"  src="${e.target.result}" class="main_image_preview img-block- img-fluid w-100">`);
        }
        reader.readAsDataURL(f);
    })

    $("#banner_img").on("change", function(e) {

        f = Array.prototype.slice.call(e.target.files)[0]
        let reader = new FileReader();
        reader.onload = function(e) {

            $("#banner_image_view").html(`<img style="height: 100%; object-fit: contain;"  id="main_image_preview"  src="${e.target.result}" class="main_image_preview img-block- img-fluid w-100">`);
        }
        reader.readAsDataURL(f);
    })
</script>

@endsection

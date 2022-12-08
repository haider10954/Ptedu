@extends('admin.layout.layout')

@section('title', 'Add Course')

@section('custom-style')
    <style>
        .hr-color {
            border: 1px solid #C4C4C4;
        }

        .btn-register {
            background: #F0F0F0;
            border: 1.43489px solid #DFE0EB;
            border-radius: 2.86978px;
            color: #6F6F6F;
            font-weight: 400;
            font-size: 14px;
            padding: 7px 30px;
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
                <div class="col-12 mb-3">
                    <ul class="nav nav-pills nav-justified" role="tablist">
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link active course-tab" data-bs-toggle="tab" href="#course" role="tab" disabled="disabled">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Course</span>
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link section-tab" data-bs-toggle="tab" href="#sections" role="tab" disabled="disabled">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                <span class="d-none d-sm-block">Sections</span>
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link lecture-tab" data-bs-toggle="tab" href="#lectures" role="tab" disabled="disabled">
                                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                <span class="d-none d-sm-block">Lectures</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="course" role="tabpanel">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="prompt"></div>
                                    <form id="courseForm" type="POST">
                                        @csrf
                                        <div class="row mb-4">
                                            <label class="col-sm-2 col-form-label lecture-form">Course Type</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="course_type">
                                                    <option value="">Select Option</option>
                                                    <option value="expert">Expert Course</option>
                                                    <option value="public">Public Course</option>
                                                </select>
                                                <div class="error-course-type"></div>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label class="col-sm-2 col-form-label lecture-form">Course Title</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="horizontal-firstname-input"
                                                    placeholder="Enter Course Title" name="course_title">
                                                <div class="error-course-title"></div>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label class="col-sm-2 col-form-label lecture-form">Tutor Name</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="tutor_name">
                                                    <option value="">Select Option</option>
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
                                                <input type="text" class="form-control"
                                                    placeholder="Enter Short Description" name="short_description">
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
                                            <label class="col-sm-2 col-form-label lecture-form">Total number of
                                                Lectures</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control"
                                                    placeholder="Enter total number of lectures" name="no_of_lectures">
                                                <div class="error-no-of-lectures"></div>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <label class="col-sm-2 col-form-label lecture-form">Duration of the
                                                Course</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control"
                                                    placeholder="Duration of the Course" name="course_duration">
                                                <div class="error-course-duration"></div>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <label class="col-sm-2 col-form-label lecture-form">Price</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" placeholder="Enter price"
                                                    name="price">
                                                <div class="error-prize"></div>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <label class="col-sm-2 col-form-label lecture-form">Discounted Price</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control"
                                                    placeholder="Enter discounted Price" name="discounted_Price">
                                                <div class="error-discounted-prize"></div>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <label class="col-sm-2 col-form-label lecture-form">Category</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="category">
                                                    <option value="">Select Option</option>
                                                    @foreach ($category as $cat)
                                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="error-category"></div>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <label class="col-sm-2 col-form-label lecture-form">Upload Video URL</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" placeholder="Enter video URL"
                                                    name="video_url">
                                                <div class="error-video-url"></div>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <label class="col-sm-2 col-form-label lecture-form">Upload Video Type(Youtube ,
                                                Vimeo)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control"
                                                    placeholder="Enter Upload Video Type(Youtube , Vimeo)" name="video">
                                                <div class="error-video"></div>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <label class="col-sm-2 col-form-label lecture-form">Upload course Thumbnail
                                                image</label>
                                            <div class="col-sm-10">
                                                <input type="file" name="course_img" id="course_img" class="d-none">
                                                <div class="d-flex align-items-end">
                                                    <div class="course-image-preview" id="thumbnail_image_view">
                                                        <img src="{{ asset('assets/images/icons/image.png') }}" />
                                                    </div>
                                                    <button type="button" class="btn btn-upload ms-2"
                                                        onclick="courseImg('#course_img')">upload</button>
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
                                                    <button type="button" class="btn btn-upload ms-2"
                                                        onclick="courseImg('#banner_img')">upload</button>
                                                </div>
                                                <div class="error-course-banner"></div>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-10">
                                                <button type="submit" id="submitForm"
                                                    class="btn btn-lg btn-register">Register</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="sections" role="tabpanel">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="prompt"></div>
                                    <div class="row mb-4">
                                        <div class="col-12 mb-3">
                                            <h5 class="fw-bold">Add Sections</h5>
                                        </div>
                                        <div class="col-12">
                                            <form id="add_section_form">
                                                <div class="repeater">
                                                    <div data-repeater-list="course_sections">
                                                        <div data-repeater-item class="row mb-3 align-items-end">
                                                            <div class="col-lg-4">
                                                                <label for="name">Section Title</label>
                                                                <input type="text" class="form-control"
                                                                    name="section_title"
                                                                    placeholder="Enter Section Title" />
                                                            </div>

                                                            <div class="col-lg-7">
                                                                <label>Section Description</label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Enter Section description"
                                                                    name="section_description" />
                                                            </div>

                                                            <div class="col-lg-1">
                                                                <div
                                                                    class="d-flex align-items-center justify-content-start">
                                                                    <button data-repeater-delete type="button"
                                                                        class="btn btn-danger" value="Delete"><i
                                                                            class="bi bi-trash"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex gap-2">
                                                        <div class="mt-1 mb-2">
                                                            {{-- <input data-repeater-create type="button" class="btn btn-success" value="" /> --}}
                                                            <button type="button" data-repeater-create
                                                                class="btn btn-success"><i class="bi bi-plus"></i> Add
                                                                More</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <button class="btn btn-primary w-25 m-auto">Submit Sections</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="lectures" role="tabpanel">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="section-box">
                                        <div class="d-flex justify-content-between section-box-header align-items-center">
                                            <h3 class="mb-0 section-box-heading">Section-1. <span
                                                    class="section-title">Welcome</span></h3>
                                        </div>
                                        <div class="section-box-content">
                                            <h5 class="section-description mb-4">안녕하세요 바디 밸런스 & 바른 자세 전문가 000 입니다</h5>
                                            <div class="row">
                                                <div class="col-12 mb-3">
                                                    <small class="d-block text-left fw-bold">Add Lectures</small>
                                                </div>
                                                <div class="col-12">
                                                    <div class="repeater">
                                                        <div data-repeater-list="course_sections">
                                                            <div data-repeater-item="" class="row mb-3 align-items-end">
                                                                <div class="col-lg-6">
                                                                    <input type="text" class="form-control"
                                                                        name="course_sections[0][lecture_title]"
                                                                        placeholder="Enter Lecture Title">
                                                                </div>

                                                                <div class="col-lg-5">
                                                                    <input type="file" class="form-control"
                                                                        placeholder="Upload Lecture Video"
                                                                        name="course_sections[0][lecture_description]">
                                                                </div>

                                                                <div class="col-lg-1">
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-start">
                                                                        <button data-repeater-delete="" type="button"
                                                                            class="btn btn-danger" value="Delete"><i
                                                                                class="bi bi-trash"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex gap-2">
                                                            <div class="mt-1 mb-2">

                                                                <button type="button" data-repeater-create=""
                                                                    class="btn btn-success"><i class="bi bi-plus"></i> Add
                                                                    More</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <button class="btn btn-primary w-25 m-auto">Add Lectures</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="section-box">
                                        <div class="d-flex justify-content-between section-box-header align-items-center">
                                            <h3 class="mb-0 section-box-heading">Section-2. <span
                                                    class="section-title">Welcome</span></h3>
                                        </div>
                                        <div class="section-box-content">
                                            <h5 class="section-description">안녕하세요 바디 밸런스 & 바른 자세 전문가 000 입니다</h5>
                                        </div>
                                    </div>
                                    <div class="section-box">
                                        <div class="d-flex justify-content-between section-box-header align-items-center">
                                            <h3 class="mb-0 section-box-heading">Section-3. <span
                                                    class="section-title">Welcome</span></h3>
                                        </div>
                                        <div class="section-box-content">
                                            <h5 class="section-description mb-4">안녕하세요 바디 밸런스 & 바른 자세 전문가 000 입니다</h5>
                                            <ul class="section-lectures">
                                                <li class="section-lecture-record">
                                                    <div class="d-flex align-items-center">
                                                        <i class="bi bi-play-circle-fill me-2"></i>
                                                        <p class="mb-0">1강. 바디 밸런스&바른 자세 100일 솔루션 키트 설명서</p>
                                                    </div>
                                                    <div class="duration">
                                                        <p class="mb-0">30:00</p>
                                                    </div>
                                                </li>
                                                <li class="section-lecture-record">
                                                    <div class="d-flex align-items-center">
                                                        <i class="bi bi-play-circle-fill me-2"></i>
                                                        <p class="mb-0">1강. 바디 밸런스&바른 자세 100일 솔루션 키트 설명서</p>
                                                    </div>
                                                    <div class="duration">
                                                        <p class="mb-0">30:00</p>
                                                    </div>
                                                </li>
                                                <li class="section-lecture-record">
                                                    <div class="d-flex align-items-center">
                                                        <i class="bi bi-play-circle-fill me-2"></i>
                                                        <p class="mb-0">1강. 바디 밸런스&바른 자세 100일 솔루션 키트 설명서</p>
                                                    </div>
                                                    <div class="duration">
                                                        <p class="mb-0">30:00</p>
                                                    </div>
                                                </li>
                                                <li class="section-lecture-record">
                                                    <div class="d-flex align-items-center">
                                                        <i class="bi bi-play-circle-fill me-2"></i>
                                                        <p class="mb-0">1강. 바디 밸런스&바른 자세 100일 솔루션 키트 설명서</p>
                                                    </div>
                                                    <div class="duration">
                                                        <p class="mb-0">30:00</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
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
        // Intializing summer note
        $(document).ready(function() {
            $('#description').summernote();
        });

        function courseImg(id) {
            $(id).click();
        }

        // course img preview
        $("#course_img").on("change", function(e) {

            f = Array.prototype.slice.call(e.target.files)[0]
            let reader = new FileReader();
            reader.onload = function(e) {

                $("#thumbnail_image_view").html(
                    `<img style="height: 100%; object-fit: contain;"  id="main_image_preview"  src="${e.target.result}" class="main_image_preview img-block- img-fluid w-100">`
                );
            }
            reader.readAsDataURL(f);
        });

        // course banner image preview
        $("#banner_img").on("change", function(e) {

            f = Array.prototype.slice.call(e.target.files)[0]
            let reader = new FileReader();
            reader.onload = function(e) {

                $("#banner_image_view").html(
                    `<img style="height: 100%; object-fit: contain;"  id="main_image_preview"  src="${e.target.result}" class="main_image_preview img-block- img-fluid w-100">`
                );
            }
            reader.readAsDataURL(f);
        });

        // course form submit
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
                    $("#submitForm").prop('disabled', true);
                    $("#submitForm").html('<i class="fa fa-spinner fa-spin me-1"></i> Processing');
                    $(".error-message").hide();
                },
                success: function(res) {
                    $("#submitForm").attr('class','btn btn-success');
                    $("#submitForm").html('<i class="fa fa-check me-1"></i>  Course Uploaded</>');
                    if (res.success) {
                        setTimeout(function() {
                            $('html, body').animate({
                                scrollTop: $("html, body").offset().top
                            }, 2000); 
                        }, 1500);
                        setTimeout(function() {
                            $('.course-tab').removeClass('active');
                            $('#course').removeClass('active');
                            $('.section-tab').addClass('active');
                            $('#sections').addClass('active'); 
                        }, 3500);
                    } else {}
                },
                error: function(e) {
                    $("#submitForm").prop('disabled', false);
                    $("#submitForm").html('Register');
                    if (e.responseJSON.errors['course_type']) {
                        $('.error-course-type').html('<small class=" error-message text-danger">' + e
                            .responseJSON.errors['course_type'][0] + '</small>');
                    }
                    if (e.responseJSON.errors['course_title']) {
                        $('.error-course-title').html('<small class=" error-message text-danger">' + e
                            .responseJSON.errors['course_title'][0] + '</small>');
                    }
                    if (e.responseJSON.errors['tutor_name']) {
                        $('.error-tutor-name').html('<small class=" error-message text-danger">' + e
                            .responseJSON.errors['tutor_name'][0] + '</small>');
                    }
                    if (e.responseJSON.errors['short_description']) {
                        $('.error-short-description').html('<small class=" error-message text-danger">' +
                            e.responseJSON.errors['short_description'][0] + '</small>');
                    }
                    if (e.responseJSON.errors['description']) {
                        $('.error-description').html('<small class=" error-message text-danger">' + e
                            .responseJSON.errors['description'][0] + '</small>');
                    }
                    if (e.responseJSON.errors['no_of_lectures']) {
                        $('.error-no-of-lectures').html('<small class=" error-message text-danger">' + e
                            .responseJSON.errors['no_of_lectures'][0] + '</small>');
                    }
                    if (e.responseJSON.errors['course_duration']) {
                        $('.error-course-duration').html('<small class=" error-message text-danger">' + e
                            .responseJSON.errors['course_duration'][0] + '</small>');
                    }
                    if (e.responseJSON.errors['course_duration']) {
                        $('.error-course-duration').html('<small class=" error-message text-danger">' + e
                            .responseJSON.errors['course_duration'][0] + '</small>');
                    }
                    if (e.responseJSON.errors['price']) {
                        $('.error-prize').html('<small class=" error-message text-danger">' + e
                            .responseJSON.errors['price'][0] + '</small>');
                    }
                    if (e.responseJSON.errors['discounted_Price']) {
                        $('.error-discounted-prize').html('<small class=" error-message text-danger">' +
                            e.responseJSON.errors['discounted_Price'][0] + '</small>');
                    }
                    if (e.responseJSON.errors['category']) {
                        $('.error-category').html('<small class=" error-message text-danger">' + e
                            .responseJSON.errors['category'][0] + '</small>');
                    }
                    if (e.responseJSON.errors['video_url']) {
                        $('.error-video-url').html('<small class=" error-message text-danger">' + e
                            .responseJSON.errors['video_url'][0] + '</small>');
                    }
                    if (e.responseJSON.errors['video']) {
                        $('.error-video').html('<small class=" error-message text-danger">' + e
                            .responseJSON.errors['video'][0] + '</small>');
                    }
                    if (e.responseJSON.errors['course_img']) {
                        $('.error-course-thumbnail').html('<small class=" error-message text-danger">' +
                            e.responseJSON.errors['course_img'][0] + '</small>');
                    }
                    if (e.responseJSON.errors['banner_img']) {
                        $('.error-course-banner').html('<small class=" error-message text-danger">' + e
                            .responseJSON.errors['banner_img'][0] + '</small>');
                    }
                }
            });
        });
    </script>

@endsection

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
<div class="loading-bar" style="width: 0;"></div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0  Card_title">{{ __('translation.Course List') }} > {{ __('translation.Add Course')}}</h4>
                </div>
                <hr class="hr-color" />
            </div>
            <div class="col-12 mb-3">
                <ul class="nav nav-pills nav-justified" role="tablist">
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link active course-tab" data-bs-toggle="tab" href="#course" role="tab" disabled="disabled">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">{{ __('translation.Course') }}</span>
                        </a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link section-tab" data-bs-toggle="tab" href="#sections" role="tab" disabled="disabled">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                            <span class="d-none d-sm-block">{{ __('translation.Sections') }}</span>
                        </a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link lecture-tab" data-bs-toggle="tab" href="#lectures" role="tab" disabled="disabled">
                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                            <span class="d-none d-sm-block">{{__('translation.Lectures') }}</span>
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
                                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Course Type') }}</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="course_type">
                                                <option value="">{{ __('translation.Select Option') }}</option>
                                                <option value="expert">{{ __('translation.Expert course') }}</option>
                                                <option value="public">{{ __('translation.Public course')}}</option>
                                            </select>
                                            <div class="error-course-type"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Course Title') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="horizontal-firstname-input" placeholder="{{ __('translation.Enter Course Title') }}" name="course_title">
                                            <div class="error-course-title"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Tutor Name') }}</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="tutor_name">
                                                <option value="">{{ __('translation.Select Option') }}</option>
                                                @foreach ($tutor as $t)
                                                <option value="{{ $t->id }}">{{ $t->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="error-tutor-name"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Short Description')}}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="{{ __('translation.Enter Short Description') }}" name="short_description">
                                            <div class="error-short-description"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Description') }}</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="description" rows="2" placeholder="Enter Description" name="description"></textarea>
                                            <div class="error-description"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Total number of Lectures') }}</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" placeholder="{{ __('translation.Enter total number of lectures') }}" name="no_of_lectures">
                                            <div class="error-no-of-lectures"></div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Duration of the Course') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="{{ __('translation.Duration of the Course') }}" name="course_duration">
                                            <div class="error-course-duration"></div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Price') }}</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" placeholder="{{ __('translation.Enter Price')}}" name="price">
                                            <div class="error-prize"></div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Discounted Price') }}</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" placeholder="{{ __('translation.Enter discounted Price') }}" name="discounted_Price">
                                            <div class="error-discounted-prize"></div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Category') }}</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="category">
                                                <option value="">{{ __('translation.Select Option') }}</option>
                                                @foreach ($category as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="error-category"></div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Upload Video URL') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="{{ __('translation.Enter video URL ( Youtube or Vimeo )') }}" name="video_url">
                                            <div class="error-video-url"></div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Upload course Thumbnail image') }}</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="course_img" id="course_img" class="d-none">
                                            <div class="d-flex align-items-end">
                                                <div class="course-image-preview" id="thumbnail_image_view">
                                                    <img src="{{ asset('assets/images/icons/image.png') }}" />
                                                </div>
                                                <button type="button" class="btn btn-upload ms-2" onclick="courseImg('#course_img')">{{ __('translation.Upload') }}</button>
                                            </div>
                                            <div class="error-course-thumbnail"></div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Upload banner image') }}</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="banner_img" id="banner_img" class="d-none">
                                            <div class="d-flex align-items-end">
                                                <div class="course-image-preview" id="banner_image_view">
                                                    <img src="{{ asset('assets/images/icons/image.png') }}" />
                                                </div>
                                                <button type="button" class="btn btn-upload ms-2" onclick="courseImg('#banner_img')">{{ __('translation.Upload') }}</button>
                                            </div>
                                            <div class="error-course-banner"></div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-10">
                                            <button type="submit" id="submitForm" class="btn btn-lg btn-register">{{ __('translation.Register') }}</button>
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
                                <div class="section_prompt"></div>
                                <div class="row mb-4">
                                    <div class="col-12 mb-3">
                                        <h5 class="fw-bold">{{ __('translation.Add Sections') }}</h5>
                                    </div>
                                    <div class="col-12">
                                        <form id="add_section_form">
                                            @csrf
                                            <input type="hidden" id="course_id" name="course_id">
                                            <div class="repeater">
                                                <div data-repeater-list="course_sections">
                                                    <div data-repeater-item class="row mb-3 align-items-end">
                                                        <div class="col-lg-4">
                                                            <label for="name">{{ __('translation.Section Title') }}</label>
                                                            <input type="text" class="form-control" name="section_title" placeholder="{{ __('translation.Enter Section Title') }}" />
                                                            <div class="error-section-title"></div>
                                                        </div>

                                                        <div class="col-lg-7">
                                                            <label>{{ __('translation.Section Description') }}</label>
                                                            <input type="text" class="form-control" placeholder="{{ __('translation.Enter Section description') }}" name="section_description" />
                                                            <div class="error-section-description"></div>
                                                        </div>

                                                        <div class="col-lg-1">
                                                            <div class="d-flex align-items-center justify-content-start">
                                                                <button data-repeater-delete type="button" class="btn btn-danger" value="Delete"><i class="bi bi-trash"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex gap-2">
                                                    <div class="mt-1 mb-2">
                                                        {{-- <input data-repeater-create type="button" class="btn btn-success" value="" /> --}}
                                                        <button type="button" data-repeater-create class="btn btn-success"><i class="bi bi-plus"></i> {{ __('translation.Add More') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button class="btn btn-primary w-25 m-auto" id="submitSections">{{ __('translation.Submit Sections') }}</button>
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
                                <div class="section-boxes">
                                    {{-- <div class="section-box">
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
                                    </div> --}}
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
                    if (res.success == true) {
                        $("#submitForm").attr('class', 'btn btn-success');
                        $("#submitForm").html('<i class="fa fa-check me-1"></i>  Course Uploaded</>');
                        $('#course_id').val(res.course_id);
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
                    } else {
                        $("#submitForm").prop('disabled', false);
                        $("#submitForm").html('Register');
                        $('html, body').animate({
                            scrollTop: $("html, body").offset().top
                        }, 2000);
                        $('.prompt').html(`<div class="alert alert-danger mb-2">${res.message}</div>`);
                    }
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

        // sections form submit
        $("#add_section_form").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ route('add-sections') }}",
                dataType: 'json',
                data: $('#add_section_form').serialize(),
                beforeSend: function() {
                    $("#submitSections").prop('disabled', true);
                    $("#submitSections").html('<i class="fa fa-spinner fa-spin me-1"></i> Processing');
                    $(".error-message").hide();
                },
                success: function(res) {
                    if (res.success == true) {
                        let sections = res.sections;
                        $('.section_prompt').html('');
                        for (var i = 0; i < sections.length; i++) {
                            if (i == 0) {
                                $('.section-boxes').append(`
                                <div class="section-box" data-section-id="${sections[i].id}" data-position="${(i+1 < sections.length) ? 'initialState' : 'finalState'}">
                                    <div class="d-flex justify-content-between section-box-header align-items-center">
                                        <h3 class="mb-0 section-box-heading">Section-${i+1}. <span
                                                class="section-title">${sections[i].section_title}</span></h3>
                                    </div>
                                    <div class="section-box-content">
                                        <h5 class="section-description">${sections[i].section_description}</h5>
                                        <div class="row section-add-lectures-form mt-2">
                                            <div class="col-12 mb-3">
                                                <small class="d-block text-left fw-bold">Add Lectures</small>
                                            </div>
                                            <div class="col-12">
                                                <form id="add_lectures_form" onsubmit="lectures_submit(event,$(this))">
                                                    <div class="add_lecture_prompt"></div>
                                                    @csrf
                                                    <input type="hidden" name="section_id" value="${sections[i].id}" />
                                                    <div class="repeater">
                                                        <div data-repeater-list="section_lectures">
                                                            <div data-repeater-item class="row align-items-end form-box mb-3">
                                                                <div class="col-lg-12 mb-3">
                                                                    <label for="name">Lecture Title</label>
                                                                    <input type="text" class="form-control"
                                                                        name="lecture_title"
                                                                        placeholder="Enter Lecture Title" />
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <label>Lecture Video</label>
                                                                    <input type="file" class="form-control"
                                                                        placeholder="Select Lecture Video"
                                                                        name="lecture_video" />
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <label for="name">Lecture Video Link</label>
                                                                    <input type="text" class="form-control"
                                                                        name="lecture_video_link"
                                                                        placeholder="Enter Lecture Video Link" />
                                                                </div>
                                                                <button data-repeater-delete type="button" class="btn btn-soft-danger btn-sm repeater-del-btn" value="Delete"><i class="bi bi-x"></i></button>
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
                                                        <button id="submitLectures" type="button" onclick="$(this).parent().parent().submit()" class="btn btn-primary w-25 m-auto">Add Lectures</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `);
                                repeater_initialize();
                            } else {
                                $('.section-boxes').append(`
                                <div class="section-box" data-section-id="${sections[i].id}" data-position="${(i+1 < sections.length) ? 'initialState' : 'finalState'}">
                                    <div class="d-flex justify-content-between section-box-header align-items-center">
                                        <h3 class="mb-0 section-box-heading">Section-${i+1}. <span
                                                class="section-title">${sections[i].section_title}</span></h3>
                                    </div>
                                    <div class="section-box-content">
                                        <h5 class="section-description">${sections[i].section_description}</h5>
                                    </div>
                                </div>
                                `);
                            }
                        }
                        $("#submitSections").attr('class', 'btn btn-success');
                        $("#submitSections").html('<i class="fa fa-check me-1"></i>  Sections Uploaded</>');
                        setTimeout(function() {
                            $('html, body').animate({
                                scrollTop: $("html, body").offset().top
                            }, 2000);
                        }, 1500);
                        setTimeout(function() {
                            $('.section-tab').removeClass('active');
                            $('#sections').removeClass('active');
                            $('.lecture-tab').addClass('active');
                            $('#lectures').addClass('active');
                        }, 3500);
                    } else if (res.error == true) {
                        $("#submitSections").prop('disabled', false);
                        $("#submitSections").html('Submit Sections');
                        $('html, body').animate({
                            scrollTop: $("html, body").offset().top
                        }, 2000);
                        $('.section_prompt').html('<div class="alert alert-warning mb-3">Please make sure to fill all fields with valid values</div>');
                    }
                },
                error: function(e) {}
            });
        });

        // lectures form submit
        function lectures_submit(e, form) {
            e.preventDefault();
            var currentForm = form;
            var formData = new FormData(form[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('add-lectures-submit') }}",
                dataType: 'json',
                cache: false,
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $("#submitLectures").prop('disabled', true);
                    $("#submitLectures").html('<i class="fa fa-spinner fa-spin me-1"></i> Processing');
                },
                success: function(res) {
                    if (res.success == true) {
                        setTimeout(function() {
                            $('.loading-bar').css('transition', 'none');
                            $('.loading-bar').css('width', 0);
                        }, 1500);
                        var lectures = res.lectures;
                        $("#submitLectures").attr('class', 'btn btn-success');
                        $("#submitLectures").html('<i class="fa fa-check me-1"></i>  Lectures Uploaded</>');
                        if (currentForm.parents('.section-box').attr('data-position') == 'finalState') {
                            $('.section-boxes').append(`
                            <div class="mt-3 text-center"><a href="{{ route('course') }}" class="btn btn-primary w-25 m-auto">Go to Listing</a></div>
                            `);
                        }
                        setTimeout(function() {
                            $('html, body').animate({
                                scrollTop: form.parents('.section-box').offset().top - 100
                            }, 2000);
                        }, 1500);
                        setTimeout(function() {
                            var currentSectionBox = currentForm.parents('.section-box');
                            currentForm.parents('.section-add-lectures-form').remove();
                            currentSectionBox.find('.section-box-content').append(`<ul class="section-lectures mt-4"></ul>`);
                            for (var i = 0; i < lectures.length; i++) {
                                currentSectionBox.find('.section-lectures').append(`
                                <li class="section-lecture-record">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-play-circle-fill me-2" data-video="${lectures[i].lecture_video}"></i>
                                        <p class="mb-0">${i+1}강. ${lectures[i].lecture_title}</p>
                                    </div>
                                    <div class="duration">
                                        <p class="mb-0">${(lectures[i].duration == null) ? lectures[i].duration : `<span title="${lectures[i].lecture_video_link}"><i class="bi bi-link"></i></span>`}</p>
                                    </div>
                                </li>
                                `);
                            }
                            currentSectionBox.next('.section-box').find('.section-box-content').append(`
                            <div class="row section-add-lectures-form mt-4">
                                <div class="col-12 mb-3">
                                    <small class="d-block text-left fw-bold">Add Lectures</small>
                                </div>
                                <div class="col-12">
                                    <form id="add_lectures_form" onsubmit="lectures_submit(event,$(this))">
                                        <div class="add_lecture_prompt"></div>
                                        @csrf
                                        <input type="hidden" name="section_id" value="${currentSectionBox.next('.section-box').attr('data-section-id')}" />
                                        <div class="repeater">
                                            <div data-repeater-list="section_lectures">
                                                <div data-repeater-item class="row align-items-end form-box mb-3">
                                                    <div class="col-lg-12 mb-3">
                                                        <label for="name">Lecture Title</label>
                                                        <input type="text" class="form-control"
                                                            name="lecture_title"
                                                            placeholder="Enter Lecture Title" />
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <label>Lecture Video</label>
                                                        <input type="file" class="form-control"
                                                            placeholder="Select Lecture Video"
                                                            name="lecture_video" />
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <label for="name">Lecture Video Link</label>
                                                        <input type="text" class="form-control"
                                                            name="lecture_video_link"
                                                            placeholder="Enter Lecture Video Link" />
                                                    </div>
                                                    <button data-repeater-delete type="button" class="btn btn-soft-danger btn-sm repeater-del-btn" value="Delete"><i class="bi bi-x"></i></button>
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
                                            <button id="submitLectures" type="button" onclick="$(this).parent().parent().submit()" class="btn btn-primary w-25 m-auto">Add Lectures</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            `);
                            repeater_initialize();
                        }, 3500);
                    } else if (res.error == true) {
                        $('.add_lecture_prompt').hide();
                        $("#submitLectures").prop('disabled', false);
                        $("#submitLectures").html('Add Lectures');
                        setTimeout(function() {
                            $('.loading-bar').css('transition', 'none');
                            $('.loading-bar').css('width', 0);
                        }, 1500);
                        $('html, body').animate({
                            scrollTop: form.parents('.section-box').offset().top
                        }, 2000);
                        $('.add_lecture_prompt').html('<div class="alert alert-warning mb-3">' + res.errors + '</div>');
                        $('.add_lecture_prompt').fadeIn();
                    }
                },
                error: function(e) {},
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = 100 * (evt.loaded / evt.total);
                            //Do something with upload progress here
                            postUploadProgress(percentComplete.toFixed(2))
                        }
                    }, false);

                    xhr.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = 100 * (evt.loaded / evt.total);
                            //Do something with download progress
                            postUploadProgress(percentComplete.toFixed(2))

                        }
                    }, false);

                    return xhr;
                }
            });
        }

        // loading bar function
        function postUploadProgress(percentComplete) {
            $('.loading-bar').css('width', percentComplete + '%');
            $('.loading-bar').css('transition', 'all 0.8s');
        }
    </script>

    @endsection
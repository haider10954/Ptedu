@extends('admin.layout.layout')

@section('title', __('translation.Edit Course') )

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
                    <h4 class="mb-sm-0  Card_title">{{ __('translation.Course List') }} > {{ __('translation.Edit Course') }}</h4>
                </div>
                <hr class="hr-color" />
            </div>
            <div class="col-12 mb-3">
                <ul class="nav nav-pills nav-justified" role="tablist">
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link active course-tab" data-bs-toggle="tab" href="#course" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">{{__('translation.Course')}}</span>
                        </a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link section-tab" data-bs-toggle="tab" href="#sections" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                            <span class="d-none d-sm-block">{{__('translation.Sections')}}</span>
                        </a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link lecture-tab" data-bs-toggle="tab" href="#lectures" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                            <span class="d-none d-sm-block">{{__('translation.Lectures')}}</span>
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
                                    <input type="hidden" name="id" value="{{ $course->id }}">
                                    @csrf
                                    <div class="row mb-4">
                                        <label class="col-sm-2 col-form-label lecture-form">{{__('translation.Course Type')}}</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="course_type">
                                                <option value="">{{__('translation.Select Option')}}</option>
                                                <option value="expert" {{ $course->course_type == 'expert' ? 'selected' : '' }}>{{ __('translation.Expert course') }}
                                                </option>
                                                <option value="public" {{ $course->course_type == 'public' ? 'selected' : '' }}>{{ __('translation.Public course') }}
                                                </option>
                                            </select>
                                            <div class="error-course-type"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-sm-2 col-form-label lecture-form">{{__('translation.Course Title')}}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="horizontal-firstname-input" placeholder="{{__('translation.Enter Course Title') }}" name="course_title" value="{{ $course->course_title }}">
                                            <div class="error-course-title"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-sm-2 col-form-label lecture-form">{{__('translation.Tutor Name')}}</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="tutor_name">
                                                <option value="">{{__('translation.Select Option')}}</option>
                                                @foreach ($tutor as $t)
                                                <option value="{{ $t->id }}" {{ $course->tutor_id == $t->id ? 'selected' : '' }}>
                                                    {{ $t->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <div class="error-tutor-name"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-sm-2 col-form-label lecture-form">{{__('translation.Short Description')}}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="{{ __('translation.Enter Short Description') }}" name="short_description" value="{{ $course->short_description }}">
                                            <div class="error-short-description"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-sm-2 col-form-label lecture-form">{{__('translation.Description')}}</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="description" rows="2" placeholder="{{ __('translation.Enter description') }}" name="description">{{ $course->description }}</textarea>
                                            <div class="error-description"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Total number of Lectures') }}</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" placeholder="{{ __('translation.Enter total number of lectures') }}" name="no_of_lectures" value="{{ $course->no_of_lectures }}">
                                            <div class="error-no-of-lectures"></div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Duration of the Course') }}</label>
                                        <div class="col-sm-10">
                                            <div class="row align-items-center">
                                                <div class="col-sm-6">
                                                    <input type="number" class="form-control" placeholder="{{ __('translation.Duration of the Course') }}" name="course_duration" value="{{ $course->duration_of_course }}">
                                                    <div class="error-course-duration"></div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="text-left">
                                                        <p class="mb-0">주</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row mb-4">
                                        <label class="col-sm-2 col-form-label lecture-form">{{__('translation.Price')}}</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" placeholder="{{ __('translation.Enter Price') }}" name="price" value="{{ $course->price }}">
                                            <div class="error-prize"></div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label class="col-sm-2 col-form-label lecture-form">{{__('translation.Discounted Price')}}</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" placeholder="{{__('translation.Enter discounted Price')}}" name="discounted_Price" value="{{ $course->discounted_prize }}">
                                            <div class="error-discounted-prize"></div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label class="col-sm-2 col-form-label lecture-form">{{__('translation.Category')}}</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="category">
                                                <option value="">{{__('translation.Select Option')}}</option>
                                                @foreach ($category as $cat)
                                                <option value="{{ $cat->id }}" {{ $course->category_id == $cat->id ? 'selected' : '' }}>
                                                    {{ $cat->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <div class="error-category"></div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label class="col-sm-2 col-form-label lecture-form">{{__('translation.Upload Video URL')}}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="{{ __('translation.Enter video URL ( Youtube or Vimeo )') }}" name="video_url" value="{{ $course->video_url }}">
                                            <div class="error-video-url"></div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Upload course Thumbnail image') }}</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="course_img" id="course_img" class="d-none">
                                            <div class="d-flex align-items-end">
                                                <div class="course-image-preview" id="thumbnail_image_view">
                                                    <img style="height: 100%; object-fit: contain;" id="main_image_preview" src="{{ asset('storage/course/thumbnail/' . $course->course_thumbnail) }}" class="main_image_preview img-block- img-fluid w-100">
                                                </div>
                                                <button type="button" class="btn btn-upload ms-2" onclick="courseImg('#course_img')">{{__('translation.Upload')}}</button>
                                            </div>
                                            <div class="text-dark old_thumbnail_img_name">
                                                <span class="small badge bg-dark rounded-0">{{ $course->course_thumbnail }}</span>
                                            </div>
                                            <div class="error-course-thumbnail"></div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label class="col-sm-2 col-form-label lecture-form">{{__('translation.Upload banner image')}}</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="banner_img" id="banner_img" class="d-none">
                                            <div class="d-flex align-items-end">
                                                <div class="course-image-preview" id="banner_image_view">
                                                    <img style="height: 100%; object-fit: contain;" id="main_image_preview" src="{{ asset('storage/course/banner/' . $course->course_banner) }}" class="main_image_preview img-block- img-fluid w-100">
                                                </div>
                                                <button type="button" class="btn btn-upload ms-2" onclick="courseImg('#banner_img')">{{ __('translation.Upload') }}</button>
                                            </div>
                                            <div class="text-dark old_thumbnail_img_name">
                                                <span class="small badge bg-dark rounded-0">{{ $course->course_banner }}</span>
                                            </div>
                                            <div class="error-course-banner"></div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-10">
                                            <button type="submit" id="submitForm" class="btn btn-lg btn-register">저장</button>
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
                                    <div class="col-12 mb-3 d-flex align-items-center justify-content-between">
                                        <h5 class="fw-bold">{{__('translation.Sections')}}</h5>
                                        <button class="btn btn-primary btn-sm add_sections_btn" data-course-id="{{ $course->id }}"><i class="fa fa-plus"></i>{{__('translation.Add Sections')}}</button>
                                    </div>
                                    <div class="col-12">
                                        <table class="table table-responsive mb-3" id="sections-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{__('translation.Title')}}</th>
                                                    <th>{{__('translation.Description')}}</th>
                                                    <th>{{__('translation.Action')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sections as $section)
                                                <tr data-section-id="{{ $section->id }}">
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td class="single_section_title">{{ Str::limit($section->section_title,30,'...') }}</td>
                                                    <td class="single_section_description">{{ Str::limit($section->section_description,50,'...') }}</td>
                                                    <td class="d-flex gap-1">
                                                        <a href="javascript:void(0)" data-course-id="{{ $section->course_id }}" data-section-title="{{ $section->section_title }}" data-section-description="{{ $section->section_description }}" onclick="editSection({{ $section->id }},$(this))" class="btn btn-primary btn-sm editSectionBtn"><i class="bi bi-pencil"></i></a>
                                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm del-section-btn" data-bs-toggle="modal" data-bs-target="#delSectionModal" data-del-id="{{ $section->id }}" data-course-id="{{ $section->course_id }}"><i class="bi bi-trash"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="lectures" role="tabpanel">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body section_boxes_view">
                                @include('admin.includes.section-boxes-view')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('modals')
    <div class="modal fade" id="delSectionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('translation.Confirm Delete')}}</h5>
                    <input type="hidden" id="delSectionId">
                    <input type="hidden" id="delSectionCourseId">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="del-section-prompt"></div>
                    <p>{{__('translation.Are you sure to delete ?')}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('translation.Close')}}</button>
                    <button type="button" class="btn btn-danger" id="delSectionBtn">{{__('translation.Delete')}}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editSectionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('translation.Edit Section')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="edit-section-prompt"></div>
                    <input type="hidden" id="editSectionId">
                    <input type="hidden" id="editSectionCourseId">
                    <div class="form-group mb-3">
                        <label for="sectionTitle">{{__('translation.Title')}}</label>
                        <input type="text" class="form-control" id="sectionTitle" placeholder="{{__('translation.Enter Section Title')}}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="sectionDescription">{{__('translation.Description')}}</label>
                        <textarea id="sectionDescription" class="form-control" cols="30" rows="5" placeholder="{{ __('translation.Enter Section description') }}"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('translation.Close')}}</button>
                    <button type="button" class="btn btn-primary" onclick="editSectionAction($(this))">{{__('translation.Edit')}}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addSectionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('translation.Add Sections')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="add-section-prompt"></div>
                    <input type="hidden" id="addSectionId">
                    <div class="form-group mb-3">
                        <label for="addSectionTitle">{{__('translation.Title')}}</label>
                        <input type="text" class="form-control" id="addSectionTitle" name="section_title" placeholder="{{__('translation.Enter Section Title')}}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="addSectionDescription">{{__('translation.Description')}}</label>
                        <textarea id="addSectionDescription" class="form-control" cols="30" rows="5" placeholder="{{ __('translation.Enter Section description') }}"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('translation.Close')}}</button>
                    <button type="button" class="btn btn-success" onclick="addSectionAction($(this))">{{__('translation.Add More')}}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addLectureModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('translation.Add Lectures')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="add_single_lecture_form">
                    <div class="modal-body">
                        <div class="add-lecture-prompt"></div>
                        <input type="hidden" id="addLectureCourseId" name="course_id">
                        <input type="hidden" id="addLectureSectionId" name="section_id">
                        <div class="form-group mb-3">
                            <label for="add_lecture_title">{{__('translation.Lecture Title')}}</label>
                            <input type="text" class="form-control" id="add_lecture_title" name="lecture_title" placeholder="{{__('translation.Enter lecture title')}}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="add_lecture_video">{{__('translation.Lecture Video')}}</label>
                            <input type="file" class="form-control" id="add_lecture_video" name="lecture_video" placeholder="{{__('translation.Add Lecture Video')}}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="add_lecture_video_link">{{ __('translation.Lecture Video Link') }}</label>
                            <input type="text" class="form-control" id="add_lecture_video_link" name="lecture_video_link" placeholder="{{ __('translation.Add Lecture Video Link') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('translation.Close')}}</button>
                        <button type="submit" class="btn btn-success" id="addLectureActionBtn">{{ __('translation.Add Lectures') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delLectureModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('translation.Confirm Delete')}}</h5>
                    <input type="hidden" id="delLectureId">
                    <input type="hidden" id="delLectureCourseId">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="del-lecture-prompt"></div>
                    <p>{{__('translation.Are you sure to delete ?')}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('translation.Close')}}</button>
                    <button type="button" class="btn btn-danger" onclick="delLectureAction($(this))">{{__('translation.Delete')}}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editLectureModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('translation.Edit Lecture')}}</h5>
                    <input type="hidden" id="editLectureId">
                    <input type="hidden" id="editLectureCourseId">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="edit-lecture-prompt"></div>
                    <div class="form-group mb-3">
                        <label for="editLectureTitle">{{__('translation.Lecture Title')}}</label>
                        <input type="text" class="form-control" placeholder="{{__('translation.Enter lecture title')}}" id="editLectureTitle">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
                    <button type="button" class="btn btn-primary" onclick="editLectureAction($(this))">편집</button>
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

        // course img preview
        $("#course_img").on("change", function(e) {
            $('.old_thumbnail_img_name').html('');
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

        // update course
        $("#courseForm").on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData($("#courseForm")[0]);
            formData = new FormData($("#courseForm")[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('edit_course_action') }}",
                dataType: 'json',
                contentType: false,
                processData: false,
                cache: false,
                data: formData,
                mimeType: "multipart/form-data",
                beforeSend: function() {
                    $("#submitForm").prop('disabled', true);
                    $("#submitForm").html('<i class="fa fa-spinner fa-spin me-1"></i> 진행중');
                    $(".error-message").hide();
                },
                success: function(res) {
                    if (res.success) {
                        $("#submitForm").prop('disabled', false);
                        $("#submitForm").html("저장");
                        $('.prompt').html(`<div class="alert alert-success">${res.message}</div>`);
                        $('html, body').animate({
                            scrollTop: $("html, body").offset().top
                        }, 2000);
                        setTimeout(() => {
                            $('.prompt').html('');
                        }, 4000);
                    } else {
                        $("#submitForm").prop('disabled', false);
                        $("#submitForm").html('저장');
                        $('.prompt').html(`<div class="alert alert-warning">${res.message}</div>`);
                        $('html, body').animate({
                            scrollTop: $("html, body").offset().top
                        }, 2000);
                        setTimeout(() => {
                            $('.prompt').html('');
                        }, 4000);
                    }
                },
                error: function(e) {
                    $("#submitForm").prop('disabled', false);
                    $("#submitForm").html('등록하다');
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
                        $('.error-short-description').html(
                            '<small class=" error-message text-danger">' +
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
                        $('.error-course-duration').html('<small class=" error-message text-danger">' +
                            e
                            .responseJSON.errors['course_duration'][0] + '</small>');
                    }
                    if (e.responseJSON.errors['course_duration']) {
                        $('.error-course-duration').html('<small class=" error-message text-danger">' +
                            e
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

        $('.add_sections_btn').on('click', function() {
            $('#addSectionModal').modal('show');
            $('#addSectionId').val($(this).attr('data-course-id'));
        });

        $('.del-section-btn').on('click', function() {
            $('#delSectionCourseId').val($(this).attr('data-course-id'));
            $('#delSectionId').val($(this).attr('data-del-id'));
        });

        function delSectionAction($btn) {
            $('#delSectionCourseId').val($btn.attr('data-course-id'));
            $('#delSectionId').val($btn.attr('data-del-id'));
        }

        var delModal = new bootstrap.Modal(document.getElementById("delSectionModal"), {});

        $('#delSectionBtn').on('click', function() {
            let btn = $(this);
            $.ajax({
                type: "POST",
                url: "{{ route('del_section') }}",
                dataType: 'json',
                data: {
                    'course_id': $('#delSectionCourseId').val(),
                    'section_id': $('#delSectionId').val(),
                    '_token': '{{ csrf_token() }}'
                },
                beforeSend: function() {
                    btn.prop('disabled', true);
                    btn.html('<i class="fa fa-spinner fa-spin me-1"></i> 처리');
                },
                success: function(res) {
                    if (res.success) {
                        btn.prop('disabled', false);
                        btn.html('삭제');
                        $('.del-section-prompt').html(`<div class="alert alert-success">${res.message}</div>`);
                        setTimeout(() => {
                            $('.del-section-prompt').html('');
                            $('#delSectionModal').modal('hide');
                        }, 2000);
                        $('#sections-table tbody tr[data-section-id="' + $('#delSectionId').val() + '"]').remove();
                        $('.section_boxes_view').html(res.html);
                    } else {
                        btn.prop('disabled', false);
                        btn.html('삭제');
                        $('.del-section-prompt').html(`<div class="alert alert-danger">${res.message}</div>`);
                        setTimeout(() => {
                            $('.del-section-prompt').html('');
                            $('#delSectionModal').modal('hide');
                        }, 2000);
                    }
                },
                error: function(e) {}
            });
        });

        function editSection($sectionId, currentBtn) {
            $('#sectionTitle').val(currentBtn.attr('data-section-title'));
            $('#sectionDescription').val(currentBtn.attr('data-section-description'));
            $('#editSectionId').val($sectionId);
            $('#editSectionCourseId').val(currentBtn.attr('data-course-id'));
            $('#editSectionModal').modal('show');
        }

        function editSectionAction($btn) {
            var btn = $btn;
            $.ajax({
                type: "POST",
                url: "{{ route('edit_section') }}",
                dataType: 'json',
                data: {
                    'course_id': $('#editSectionCourseId').val(),
                    'section_id': $('#editSectionId').val(),
                    'section_title': $('#sectionTitle').val(),
                    'section_description': $('#sectionDescription').val(),
                    '_token': '{{ csrf_token() }}'
                },
                beforeSend: function() {
                    btn.prop('disabled', true);
                    btn.html('<i class="fa fa-spinner fa-spin me-1"></i> 처리');
                },
                success: function(res) {
                    if (res.success) {
                        btn.prop('disabled', false);
                        btn.html('Edit');
                        $('.edit-section-prompt').html(`<div class="alert alert-success">${res.message}</div>`);
                        setTimeout(() => {
                            $('.edit-section-prompt').html('');
                            $('#editSectionModal').modal('hide');
                        }, 2000);
                        $('#sections-table tbody tr[data-section-id="' + $('#editSectionId').val() + '"] .single_section_title').html(`${res.section.section_title.slice(0, 30) + (res.section.section_title.length > 30 ? "..." : "")}`);
                        $('#sections-table tbody tr[data-section-id="' + $('#editSectionId').val() + '"] .single_section_description').html(`${res.section.section_description.slice(0, 50) + (res.section.section_description.length > 50 ? "..." : "")}`);

                        $('#sections-table tbody tr[data-section-id="' + $('#editSectionId').val() + '"] .editSectionBtn').attr('data-section-title', res.section.section_title);

                        $('#sections-table tbody tr[data-section-id="' + $('#editSectionId').val() + '"] .editSectionBtn').attr('data-section-description', res.section.section_description);

                        $('.section_boxes_view').html(res.html);
                    } else {
                        btn.prop('disabled', false);
                        btn.html('Edit');
                        $('.edit-section-prompt').html(`<div class="alert alert-danger">${res.message}</div>`);
                        setTimeout(() => {
                            $('.edit-section-prompt').html('');
                        }, 2000);
                    }
                },
                error: function(e) {}
            });
        }

        function addSectionAction($btn) {
            var btn = $btn;
            $.ajax({
                type: "POST",
                url: "{{ route('add_single_section') }}",
                dataType: 'json',
                data: {
                    'course_id': $('#addSectionId').val(),
                    'section_title': $('#addSectionTitle').val(),
                    'section_description': $('#addSectionDescription').val(),
                    '_token': '{{ csrf_token() }}'
                },
                beforeSend: function() {
                    btn.prop('disabled', true);
                    btn.html('<i class="fa fa-spinner fa-spin me-1"></i> 처리');
                },
                success: function(res) {
                    if (res.success) {
                        btn.prop('disabled', false);
                        btn.html('추가하다');
                        $('.add-section-prompt').html(`<div class="alert alert-success">${res.message}</div>`);
                        setTimeout(() => {
                            $('.add-section-prompt').html('');
                            $('#addSectionModal').modal('hide');
                            $('#addSectionTitle').val('');
                            $('#addSectionDescription').val('');
                        }, 1000);
                        $('#sections-table tbody').append(`
                                <tr data-section-id="${res.section.id}">
                                    <td>${ $('#sections-table tbody tr').length + 1 }</td>
                                    <td class="single_section_title">${ res.section.section_title.slice(0, 30) + (res.section.section_title.length > 30 ? "..." : "") }</td>
                                    <td class="single_section_description">${ res.section.section_description.slice(0, 50) + (res.section.section_description.length > 50 ? "..." : "") }</td>
                                    <td class="d-flex gap-1">
                                        <a href="javascript:void(0)" data-course-id="${ res.section.course_id }" data-section-title="${ res.section.section_title }" data-section-description="${ res.section.section_description }" onclick="editSection(${res.section.id},$(this))" class="btn btn-primary btn-sm editSectionBtn"><i class="bi bi-pencil"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm del-section-btn" onclick="delSectionAction($(this))" data-bs-toggle="modal" data-bs-target="#delSectionModal" data-del-id="${res.section.id}"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                            `);
                        $('.section_boxes_view').html(res.html);
                    } else {
                        btn.prop('disabled', false);
                        btn.html('추가하다');
                        $('.add-section-prompt').html(`<div class="alert alert-danger">${res.message}</div>`);
                        setTimeout(() => {
                            $('.add-section-prompt').html('');
                        }, 2000);
                    }
                },
                error: function(e) {}
            });
        }

        function addLecture($btn) {
            $('#addLectureCourseId').val($btn.attr('data-course-id'));
            $('#addLectureSectionId').val($btn.attr('data-section-id'));
            $('#addLectureModal').modal('show');
        }

        $('#add_single_lecture_form').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('add_single_lecture') }}",
                dataType: 'json',
                cache: false,
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $("#addLectureActionBtn").prop('disabled', true);
                    $("#addLectureActionBtn").html('<i class="fa fa-spinner fa-spin me-1"></i> 처리');
                },
                success: function(res) {
                    if (res.Success == true) {
                        setTimeout(function() {
                            $('.loading-bar').css('transition', 'none');
                            $('.loading-bar').css('width', 0);
                        }, 1000);
                        $('.add-lecture-prompt').html(`<div class="alert alert-success">${res.Msg}</div>`);
                        setTimeout(() => {
                            $('.add-lecture-prompt').html('');
                            $('#addLectureModal').modal('hide');
                            $('#add_lecture_title').val('');
                            $('#add_lecture_video').val('');
                            $('#add_lecture_video_link').val('');
                            $("#addLectureActionBtn").prop('disabled', false);
                            $("#addLectureActionBtn").html('강의 추가   ');
                        }, 1000);
                        $('.section_boxes_view').html(res.html);
                    } else {
                        $("#addLectureActionBtn").prop('disabled', false);
                        $("#addLectureActionBtn").html('강의 추가');
                        setTimeout(function() {
                            $('.loading-bar').css('transition', 'none');
                            $('.loading-bar').css('width', 0);
                        }, 1000);
                        $('.add-lecture-prompt').html('<div class="alert alert-warning mb-3">' + res.Msg + '</div>');
                    }
                },
                error: function(e) {
                    $("#addLectureActionBtn").prop('disabled', false);
                    $("#addLectureActionBtn").html('강의 추가');
                },
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
        });

        // loading bar function
        function postUploadProgress(percentComplete) {
            $('.loading-bar').css('width', percentComplete + '%');
            $('.loading-bar').css('transition', 'all 0.8s');
        }

        function delLecture($btn) {
            $('#delLectureId').val($btn.attr('data-lecture-id'));
            $('#delLectureCourseId').val($btn.attr('data-course-id'));
            $('#delLectureModal').modal('show');
        }

        function delLectureAction($btn) {
            let btn = $btn;
            $.ajax({
                type: "POST",
                url: "{{ route('del_single_lecture') }}",
                dataType: 'json',
                data: {
                    'course_id': $('#delLectureCourseId').val(),
                    'lecture_id': $('#delLectureId').val(),
                    '_token': '{{ csrf_token() }}'
                },
                beforeSend: function() {
                    btn.prop('disabled', true);
                    btn.html('<i class="fa fa-spinner fa-spin me-1"></i> 처리');
                },
                success: function(res) {
                    if (res.success) {
                        btn.prop('disabled', false);
                        btn.html('Delete');
                        $('.del-lecture-prompt').html(`<div class="alert alert-success">${res.message}</div>`);
                        setTimeout(() => {
                            $('.del-lecture-prompt').html('');
                            $('#delLectureModal').modal('hide');
                        }, 2000);
                        $('.section_boxes_view').html(res.html);
                    } else {
                        btn.prop('disabled', false);
                        btn.html('삭제');
                        $('.del-lecture-prompt').html(`<div class="alert alert-danger">${res.message}</div>`);
                        setTimeout(() => {
                            $('.del-lecture-prompt').html('');
                            $('#delLectureModal').modal('hide');
                        }, 2000);
                    }
                },
                error: function(e) {}
            });
        }

        function editLecture($btn) {
            $('#editLectureCourseId').val($btn.attr('data-course-id'));
            $('#editLectureId').val($btn.attr('data-lecture-id'));
            $('#editLectureTitle').val($btn.attr('data-lecture-title'));
            $('#editLectureModal').modal('show');
        }

        function editLectureAction($btn) {
            let btn = $btn;
            $.ajax({
                type: "POST",
                url: "{{ route('edit_single_lecture') }}",
                dataType: 'json',
                data: {
                    'course_id': $('#editLectureCourseId').val(),
                    'lecture_id': $('#editLectureId').val(),
                    'lecture_title': $('#editLectureTitle').val(),
                    '_token': '{{ csrf_token() }}'
                },
                beforeSend: function() {
                    btn.prop('disabled', true);
                    btn.html('<i class="fa fa-spinner fa-spin me-1"></i> 처리');
                },
                success: function(res) {
                    if (res.success) {
                        btn.prop('disabled', false);
                        btn.html('Edit');
                        $('.edit-lecture-prompt').html(`<div class="alert alert-success">${res.message}</div>`);
                        setTimeout(() => {
                            $('.edit-lecture-prompt').html('');
                            $('#editLectureModal').modal('hide');
                            $('#editLectureTitle').val('');
                        }, 2000);
                        $('.section_boxes_view').html(res.html);
                    } else {
                        btn.prop('disabled', false);
                        btn.html('편집하다');
                        $('.edit-lecture-prompt').html(`<div class="alert alert-danger">${res.message}</div>`);
                        setTimeout(() => {
                            $('.edit-lecture-prompt').html('');
                        }, 2000);
                    }
                },
                error: function(e) {}
            });
        }
    </script>
    @endsection
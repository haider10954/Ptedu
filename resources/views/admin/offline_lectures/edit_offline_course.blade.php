@extends('admin.layout.layout')

@section('title' , 'Edit Course')

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
        width: 100px;
        height: 100px;
        object-fit: cover;
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
                    <h4 class="mb-sm-0  Card_title">{{__('translation.Course List')}} > {{__('translation.Edit Course')}}</h4>
                </div>
                <hr class="hr-color" />
            </div>
            <div class="col-12">
                <div class="prompt"></div>
                <form id="editOfflineCourseForm">
                    @csrf
                    <input type="hidden" name="id" value="{{ $offline_course->id }}" />
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{__('translation.Course List')}}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="horizontal-firstname-input" placeholder="{{__('translation.Enter Course Title')}}" name="course_title" value="{{ $offline_course->course_title }}">
                            <div class="error-course-title"></div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{__('translation.Tutor Name')}}</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="tutor_name">
                                <option value="">{{__('translation.Select Option')}}</option>
                                @foreach ($tutor as $t)
                                <option value="{{ $t->id }}" {{ $offline_course->tutor_id == $t->id ? 'selected' : ' ' }}>{{ $t->name }}</option>
                                @endforeach
                            </select>
                            <div class="error-tutor-name"></div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{__('translation.Short Description')}}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="{{__('translation.Enter Short Description')}}" name="short_description" value="{{ $offline_course->short_description }}">
                            <div class="error-short-description"></div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{__('translation.Description')}}</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="description" rows="2" placeholder="{{__('translation.Enter description')}}" name="description">{{ $offline_course->description }}</textarea>
                            <div class="error-description"></div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{__('translation.Total number of Lectures')}}</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" placeholder="{{__('translation.Enter total number of lectures')}}" name="no_of_lectures" value="{{ $offline_course->no_of_lectures }}">
                            <div class="error-no-of-lectures"></div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{__('translation.Duration of the Course')}}</label>
                        <div class="col-sm-10">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" placeholder="{{__('translation.Duration of the Course')}}" name="course_duration" value="{{ $offline_course->duration_of_course }}">
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
                            <input type="number" class="form-control" placeholder="{{__('translation.Enter Price')}}" name="price" value="{{ $offline_course->price }}">
                            <div class="error-prize"></div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{__('translation.Discounted Price')}}</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" placeholder="{{__('translation.Enter discounted Price')}}" name="discounted_Price" value="{{ $offline_course->discounted_prize }}">
                            <div class="error-discounted-prize"></div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{__('translation.Category')}}</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="category">
                                <option value="">{{__('translation.Select Option')}}</option>
                                @foreach ($category as $cat)
                                <option value="{{ $cat->id }}" {{ $offline_course->category_id == $cat->id ? 'selected' : ' ' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            <div class="error-category"></div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{__('translation.Upload Video URL')}}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="{{__('translation.Enter video URL ( Youtube or Vimeo )')}}" name="video_url" value="{{ $offline_course->video_url }}">
                            <div class="error-video-url"></div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{__('translation.Upload course Thumbnail image')}} <br> <span class="text-danger">권장 사이즈 (840 * 580) </span></label>
                        <div class="col-sm-10">
                            <input type="file" name="course_img" id="course_img" class="d-none" value="{{ $offline_course->getCourseThumbnail() }}">
                            <div class="d-flex align-items-end">
                                <div class="course-image-preview" id="thumbnail_image_view">
                                    <img src="{{ $offline_course->getCourseThumbnail() }}" />
                                </div>
                                <button type="button" class="btn btn-upload ms-2" onclick="courseImg('#course_img')">{{__('translation.Upload')}}</button>
                            </div>
                            <div class="error-course-thumbnail"></div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{__('translation.Upload banner image')}}</label>
                        <div class="col-sm-10">
                            <input type="file" name="banner_img" id="banner_img" class="d-none" value="{{ $offline_course->getCourseBanner() }}">
                            <div class="d-flex align-items-end">
                                <div class="course-image-preview" id="banner_image_view">
                                    <img src="{{ $offline_course->getCourseBanner() }}" />
                                </div>
                                <button type="button" class="btn btn-upload ms-2" onclick="courseImg('#banner_img')">{{__('translation.Upload')}}</button>
                            </div>
                            <div class="error-course-banner"></div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{__('translation.Total No Of Enrollments')}}</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" placeholder="{{{__('translation.Enter No Of Enrollments') }}}" name="no_of_enrollments" value="{{ $offline_course->no_of_enrollments }}">
                            <div class="error-no-of-enrollments"></div>
                        </div>
                    </div>

                    @if (!empty($offline_course->course_schedule))
                    <div class="row">
                        <label class="col-sm-2 col-form-label lecture-form">강좌 일정</label>
                        <div class="col-sm-10">
                            <div class="inner-repeater mb-4">
                                <div class="course-schedule">
                                    @foreach (json_decode($offline_course->course_schedule) as $key=>$value)
                                    <div class="mb-3 row course-schedule-item">
                                        <div class="col-md-10 col-10">
                                            <input type="text" class="inner form-control" name="course_scheduling[]" placeholder="강좌 일정" value="{{ $value }}" />
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-danger" onclick="getCourseScheduleId('{{ $key }}')" data-bs-toggle="modal" data-bs-target="#deleteCourseScheduleModal"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                                <button type="button" class="btn btn-success AddCourseSchedule">{{ __('translation.Add More') }}</button>
                            </div>
                        </div>

                    </div>
                    @endif

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

<!-- Modal -->
<div class="modal fade" id="deleteCourseScheduleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">강좌 일정</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ __('translation.Are you sure to delete ?')}}
                </div>
                <div class="modal-footer">
                    <form id="deleteCourseSchedule">
                        <input type="hidden" name="course_schedule" id="course_schedule" value="" />
                        @csrf
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('translation.Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{ __('translation.Save changes')}}</button>
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

    $("#editOfflineCourseForm").on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData($("#editOfflineCourseForm")[0]);
        $.ajax({
            type: "POST",
            url: "{{ route('edit-offline-course') }}",
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            data: formData,
            mimeType: "multipart/form-data",
            beforeSend: function() {
                $("#submitForm").html('<i class="bi bi-arrow-clockwise"></i> 저장');
                $(".error-message").hide();
            },
            success: function(res) {

                $("#submitForm").html('저장');
                if (res.success) {
                    $('.prompt').html('<div class="alert alert-info mb-3">' + res.message + '</div>');
                    $('html, body').animate({
                        scrollTop: $("html, body").offset().top
                    }, 1000);
                    setTimeout(function() {
                        window.location.href = "{{ route('offline_lectures_admin') }}";
                    }, 1000);
                } else {}
            },
            error: function(e) {
                $("#submitForm").html('저장');
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
                if (e.responseJSON.errors['no_of_enrollments']) {
                    $('.error-no-of-enrollments').html('<span class=" error-message text-danger">' + e.responseJSON.errors['no_of_enrollments'][0] + '</span>');
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

    $('.AddCourseSchedule').on('click', function() {
            console.log('here');
            $('.course-schedule').append(`<div class="mb-3 row course-schedule-item">
        <div class="col-md-10 col-8 mb-2">
                                                        <input type="text" class="inner form-control" name="course_scheduling[]" placeholder="강좌 일정" />
                                                    </div>
                                                    <div class="col-md-2 col-4">
                                                        <div class="d-grid">
                                                            <button type="button" class="btn btn-primary deleteCourseSchedule" onclick="deleteDiv(this)">Delete</button>
                                                        </div>
                                                    </div>
                                                    </div>`);
        });

        function deleteDiv(element) {
            $(element).closest('.course-schedule-item').remove();
        }

        function getCourseScheduleId(element) {
            $('#course_schedule').val(element);
        }

        // Delete Course Schedule
        $('#deleteCourseSchedule').on('submit', function(e) {
            e.preventDefault();
            var course_id = "{{ $offline_course->id }}";
            var course_schedule_id = $('#course_schedule').val();
            $.ajax({
                type: "POST",
                url: "{{route('delete_offline_course_schedule')}}",
                dataType: 'json',
                data: {
                    course_id: course_id,
                    course_schedule_id: course_schedule_id,
                    _token: '{{csrf_token()}}'
                },
                beforeSend: function() {},
                success: function(res) {
                    if (res.success === true) {
                        $('#deleteCourseScheduleModal').modal('hide');
                        setTimeout(function() {
                            window.location.reload();
                        }, 3000)
                    } else {}
                },
                error: function(e) {}
            });
        });
</script>
@endsection

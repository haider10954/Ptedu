@extends('user.layout')

@section('title', 'ptedu - Lecture Detail')

@section('content')
<div class="section lecture_banner_section">
    <div class="lecture_banner_img" style="background-image: url({{ asset('storage/offline_course/banner/' . $course_info->course_banner) }})"></div>
    <div class="banner_text">
        @if ($embedded_video_url != false)
        {!! $embedded_video_url !!}
        @else
        <h5> <i class="fa fa-exclamation-circle mx-1"></i> {{ __('translation.Video Not Found') }}</h5>
        @endif
    </div>
</div>

<div class="section pt-40 lecture_details">
    <div class="container">
        <div class="w-80 m-auto pb-40 border-bottom-1">
            <div class="row align-items-center">
                <div class="col-lg-9">
                    @if (auth()->check())
                    @if (!empty($reservation))
                    @if ($reservation->status == 'decline')
                    <div class="badge  mt-3 mb-3 p-2" style="background: #F9DFDF; border-radius: 2px; color: #791919;">
                        {{ __('translation.Your Reservation has been decline Apply again to Reserve Course') }}.
                    </div>
                    @endif
                    @endif
                    @else
                    @if ($offline_enrollment_count >= $course_info->no_of_enrollments)
                    <div class="badge  mt-3 mb-3 p-2" style="background: #F9DFDF; border-radius: 2px; color: #791919;">
                        {{ __('translation.Reached maximum limit of enrollments') }} ,
                        {{ __('translation.please login to submit application') }}.
                    </div>
                    @endif
                    @endif
                    <div class="content_wrapper">
                        <h5 class="mb-3 heading">{{ $course_info->course_title }}</h5>
                        <p class="mb-0 text">{{ $course_info->short_description }}</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0 text">{{ __('translation.Course Amount') }}</p>
                        <p class="mb-0 text">{{ number_format($course_info->price) }}{{ __('translation.won') }}</p>
                    </div>
                    @if (auth()->check())
                    @if ($enrolled_user == 0)
                    @if ($offline_enrollment_count >= $course_info->no_of_enrollments)
                    @if (!empty($reservation))
                    @if ($reservation->status == 'applied')
                    <button class="btn btn-danger btn-sm w-100 mb-2 delBtn" style="border-radius: 2rem; background: black; color:white !important;" data-id="{{ $course_info->id }}" data-toggle="modal" data-target="#delReservationModal">{{ __('translation.Decline') }}</button>
                    <button disabled class="btn btn-light btn-sm w-100 border-1 mb-2 disabled" style="border-radius: 2rem; background: black; color:white !important;">{{ __('translation.Waiting For Reservation') }}</button>
                    @elseif($reservation->status == 'reserved')
                    <button class="btn btn-dark btn-sm w-100 mb-2 add-to-cart-btn" style="border-radius: 2rem; background: black; color:white !important;" data-type="offline" data-id="{{ encrypt($course_info) }}">{{ __('translation.Add to cart') }}</button>
                    @elseif($reservation->status == 'decline')
                    <button class="btn btn-light btn-sm w-100 border-1 mb-2 applyBtn" style="border-radius: 2rem; background: black; color:white !important;" data-id="{{ $course_info->id }}" data-toggle="modal" data-target="#reservationModal">{{ __('translation.Apply') }}</button>
                    @endif
                    @else
                    <button class="btn btn-light btn-sm w-100 border-1 mb-2 applyBtn" style="border-radius: 2rem; background: black; color:white !important;" data-id="{{ $course_info->id }}" data-toggle="modal" data-target="#reservationModal">{{ __('translation.Apply') }}</button>
                    @endif
                    @else
                    <button class="btn btn-dark btn-sm w-100 mb-2 add-to-cart-btn" style="border-radius: 2rem; background: black; color:white !important;" data-type="offline" data-id="{{ encrypt($course_info) }}">{{ __('translation.Add to cart') }}</button>
                    @endif
                    @else
                    <button class="btn btn-dark btn-sm w-100 mb-2 disabled" style="border-radius: 2rem; background: black; color:white !important;" disabled>{{ __('translation.Already Enrolled') }}</button>
                    @endif
                    @else
                    @if ($offline_enrollment_count < $course_info->no_of_enrollments)
                        <button class="btn btn-dark btn-sm w-100 mb-2 add-to-cart-btn" style="border-radius: 2rem; background: black; color:white !important;" data-type="offline" data-id="{{ encrypt($course_info) }}">{{ __('translation.Add to cart') }}</button>
                        @else
                        <button class="btn btn-dark btn-sm w-100 mb-2 disabled" style="border-radius: 2rem; background: black; color:white !important;" diabled>Limit Reached</button>
                        @endif
                        @endif
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0 text">{{ __('translation.Course Period') }}</p>
                            <p class="mb-0 text">{{ $course_info->duration_of_course }} 주</p>
                        </div>
                        @if (auth()->check())
                        @if ($liked_course)
                        <button class="btn btn-dark btn-sm w-100 mb-2 dislike_course" style="border-radius: 2rem; background: black;" data-type="offline" data-id="{{ encrypt($course_info->id) }}">Already Liked</button>
                        @else
                        <button class="btn btn-dark btn-sm w-100 mb-2 like_course" style="border-radius: 2rem; background: black;" data-type="offline" data-id="{{ encrypt($course_info->id) }}">Like This Course</button>
                        @endif
                        @endif
                </div>
            </div>
        </div>
        <div class="w-80 m-auto py-4">
            {{-- <ul class="nav nav-pills mb-40 nav_tabs" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                            aria-controls="pills-home" aria-selected="true">{{ __('translation.Course Introduction') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">{{ __('translation.Instructor Introduction') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">{{ __('translation.Lecture Review') }}</a>
            </li>
            </ul> --}}
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    {!! $course_info->description !!}
                </div>
                {{-- <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <p class="mb-0 text font-weight-bold">{{ __('translation.Name') }}</p>
                </td>
                <td>
                    <p class="mb-0 text">{{ $course_info->getTutorName->name }}</p>
                </td>
                </tr>
                <tr>
                    <td>
                        <p class="mb-0 text font-weight-bold">{{ __('translation.Email') }}</p>
                    </td>
                    <td>
                        <p class="mb-0 text">{{ $course_info->getTutorName->email }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="mb-0 text font-weight-bold">{{ __('translation.Phone Number') }} #</p>
                    </td>
                    <td>
                        <p class="mb-0 text">{{ $course_info->getTutorName->mobile_number }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="mb-0 text font-weight-bold">{{ __('translation.Designation') }}</p>
                    </td>
                    <td>
                        <p class="mb-0 text">{{ $course_info->getTutorName->job }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="mb-0 text font-weight-bold">{{ __('translation.Address') }}</p>
                    </td>
                    <td>
                        <p class="mb-0 text">{{ $course_info->getTutorName->address }}</p>
                    </td>
                </tr>
                </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <p class="mb-2 text font-weight-bold">{{ __('translation.Day') }} 1</p>
                <p class="mb-4 text">1. 보행 기초지식: 보행 이해를 위한 기본 운동학, 8개 보행주기의 이해(근육, 관절, 힘)<br>2. 사람 움직임으로서의 보행: 운동조절
                    이론과 보행, 보행의 개인별 다양성<br>3. 질의 응답</p>
                <p class="mb-2 text font-weight-bold">{{ __('translation.Day') }} 2</p>
                <p class="mb-4 text">1. 보행 기초지식: 보행 이해를 위한 기본 운동학, 8개 보행주기의 이해(근육, 관절, 힘)<br>2. 사람 움직임으로서의 보행: 운동조절
                    이론과 보행, 보행의 개인별 다양성<br>3. 질의 응답</p>
            </div> --}}
        </div>
    </div>
</div>
</div>
@endsection

@section('modals')
<div class="modal" id="reservationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('translation.Confirm Reservation') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="prompt"></div>
                <input type="hidden" id="confirmReserveId" name="id">
                <p>{{ __('translation.Are you sure to reserve this course') }}.</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" href="javascript:void(0)" id="confirmReservation">{{ __('translation.Save changes') }}</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('translation.Close') }}</button>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="enrollmentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('translation.Confirm Enrollment') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="prompt"></div>
                <input type="hidden" id="confirmEnrollmentId" name="id">
                <p>{{ __('translation.Are you sure to enroll in this course') }}.</p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" href="javascript:void(0)" id="confirmEnrollment">{{ __('translation.Apply') }}</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('translation.Close') }}</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="delReservationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('translation.Delete Reservation') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                @csrf
                <div class="modal-body">
                    <div class="prompt"></div>
                    <input type="hidden" id="courseId" name="course_id">
                    <p>{{ __('translation.Are you sure to decline your Reservation') }}?</p>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" href="javascript:void(0)" id="delReservation">{{ __('translation.Save changes') }}</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('translation.Close') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
<script>
    $('.applyBtn').on('click', function() {
        $('#confirmReserveId').val($(this).attr('data-id'));

        $('#confirmEnrollmentId').val($(this).attr('data-id'));
    });

    $('.delBtn').on('click', function() {
        $('#courseId').val($(this).attr('data-id'));
    });
    $('#confirmReservation').on('click', function() {
        $("#confirmReservation").html('<i class="fa fa-spinner fa-spin"></i> 진행중');

        $("#confirmReservation").prop('disabled', true);
        $.ajax({
            dataType: 'json',
            url: "{{ route('course_reservation') }}",
            type: 'POST',
            data: {
                id: $('#confirmReserveId').val(),
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                if (res.success) {
                    $(".prompt").show();
                    $(".prompt").html(
                        '<div class="alert alert-success mb-3"><i class="fa fa-check mx-2"></i>' +
                        res.message + '</div>');
                    $(".applyBtn").attr('disabled', true);
                    setTimeout(function() {
                        $(".prompt").hide();
                    }, 2000);
                    window.location.reload();
                } else {
                    $(".prompt").show();
                    $(".prompt").html(
                        '<div class="alert alert-danger mb-3"><i class="fa fa-exclamation-triangle mx-2"></i>' +
                        res.message + '</div>');
                    setTimeout(function() {
                        $("#confirmReservation").html('확인하다');
                        $("#confirmReservation").removeAttr('disabled');
                        $(".prompt").hide();
                    }, 2000);
                }
            }
        });
    });

    $('#confirmEnrollment').on('click', function() {
        $("#confirmEnrollment").html('<i class="fa fa-spinner fa-spin"></i> 진행중');

        $("#confirmEnrollment").prop('disabled', true);
        $.ajax({
            dataType: 'json',
            url: "{{ route('offline_course_enrollment') }}",
            type: 'POST',
            data: {
                id: $('#confirmEnrollmentId').val(),
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                if (res.success) {
                    $(".prompt").show();
                    $(".prompt").html(
                        '<div class="alert alert-success mb-3"><i class="fa fa-check mx-2"></i>' +
                        res.message + '</div>');
                    $(".applyBtn").attr('disabled', true);
                    setTimeout(function() {
                        $(".prompt").hide();
                    }, 2000);
                    window.location.reload();
                } else {
                    $(".prompt").show();
                    $(".prompt").html(
                        '<div class="alert alert-danger mb-3"><i class="fa fa-exclamation-triangle mx-2"></i>' +
                        res.message + '</div>');
                    setTimeout(function() {
                        $("#confirmReservation").html('확인하다');
                        $("#confirmReservation").removeAttr('disabled');
                        $(".prompt").hide();
                    }, 2000);
                }
            }
        });
    });

    $('#delReservation').on('click', function() {
        $("#delReservation").html('<i class="fa fa-spinner fa-spin"></i> 진행중');

        $("#delReservation").attr('disabled', '');
        $.ajax({
            dataType: 'json',
            url: "{{ route('delete_reservation') }}",
            type: 'POST',
            data: {
                course_id: $('#courseId').val(),
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                if (res.success) {
                    $(".prompt").show();
                    $(".prompt").html(
                        '<div class="alert alert-success mb-3"><i class="fa fa-check mx-2"></i>' +
                        res.message + '</div>');
                    $("#delReservation").html('적용된');
                    $("#delReservation").attr('disabled', true);
                    $(".applyBtn").html('예약 대기 중');
                    $(".applyBtn").attr('disabled', true);
                    setTimeout(function() {
                        $(".prompt").hide();
                        $('#delReservationModal').hide();
                    }, 2000);
                    window.location.reload();
                } else {
                    $(".prompt").show();
                    $(".prompt").html(
                        '<div class="alert alert-danger mb-3"><i class="fa fa-exclamation-triangle mx-2"></i>' +
                        res.message + '</div>');
                    setTimeout(function() {
                        $("#delReservation").html('확인하다');
                        $("#delReservation").removeAttr('disabled');
                        $(".prompt").hide();
                    }, 2000);
                }
            }
        });
    });

    $('.add-to-cart-btn').on('click', function() {
        var btn = $(this);
        $.ajax({
            type: "POST",
            url: "{{ route('add_to_cart') }}",
            dataType: 'json',
            data: {
                'course_id': $(this).data('id'),
                'type': $(this).data('type'),
                '_token': '{{ csrf_token() }}'
            },
            beforeSend: function() {
                btn.prop('disabled', true);
                btn.html('<i class="fa fa-spinner fa-spin me-1"></i> 진행중');
            },
            success: function(res) {
                if (res.Success == true) {
                    btn.html('<i class="fa fa-check mx-1"></i> 추가됨</>');
                    $('.shopping_cart_count').attr('data-items-count', res.cart_items_count);
                    $('.shopping_cart_count').html(res.cart_items_count);
                } else {
                    btn.html(`<i class="fa fa-times mx-1"></i> ${res.Msg}`);
                }
            },
            error: function(e) {}
        });
    });

    $('.banner_text iframe').css('width', '100%');
    $('.banner_text iframe').css('height', '100%');
    $('.banner_text iframe').attr('width', '');
    $('.banner_text iframe').attr('height', '');


    $('.like_course').on('click', function(e) {
        e.preventDefault();
        var btn = $(this);
        $.ajax({
            type: "POST",
            url: "{{ route('like-course') }}",
            dataType: 'json',
            data: {
                'course_id': $(this).data('id'),
                'type': $(this).data('type'),
                '_token': '{{ csrf_token() }}'
            },
            beforeSend: function() {
                btn.prop('disabled', true);
                btn.html('<i class="fa fa-spinner fa-spin me-1"></i> 진행중');
            },
            success: function(res) {
                if (res.success == true) {
                    btn.prop('disabled', false);
                    btn.html('Already Liked');
                }
            },
            error: function(e) {}
        });
    });

    $('.dislike_course').on('click', function(e) {
        e.preventDefault();
        var btn = $(this);
        $.ajax({
            type: "POST",
            url: "{{ route('dislike-course') }}",
            dataType: 'json',
            data: {
                'course_id': $(this).data('id'),
                'type': $(this).data('type'),
                '_token': '{{ csrf_token() }}'
            },
            beforeSend: function() {
                btn.prop('disabled', true);
                btn.html('<i class="fa fa-spinner fa-spin me-1"></i> 진행중');
            },
            success: function(res) {
                if (res.success == true) {
                    btn.prop('disabled', false);
                    btn.html('Like This Course');
                }
            },
            error: function(e) {}
        });
    });
</script>
@endsection
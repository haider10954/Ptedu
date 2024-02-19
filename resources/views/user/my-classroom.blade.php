@extends('user.layout')

@section('title', 'ptedu - My Classroom')

@section('content')
    <div class="section pt-125">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 padding-left">
                    <div class="page-sidemenu-heading mb-3">
                        <h5 class="mb-0 font-weight-600">{{ __('translation.My Classroom') }}</h5>
                        <a href="javscript:void(0)"
                           class="btn btn-dark btn-custom-sm btn-theme-black page-side-menu-toggle">{{ __('translation.menu') }}</a>
                    </div>
                    <div class="page-side-menu">
                        <ul class="menu">
                            <li><a href="{{ route('my_classroom') }}">{{ __('translation.My Classroom') }}</a></li>
                            <li><a href="{{ route('shopping_bag') }}">{{ __('translation.Shopping Bag') }}</a></li>
                            <li><a href="{{ route('user_info') }}">{{ __('translation.Modifying Member Info') }}</a>
                            </li>
                            <li><a href="{{ route('user_inquiry') }}">{{ __('translation.Inquiry') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="section-heading mb-3">
                        <h5 class="mb-0">{{ __('translation.My Page') }}</h5>
                    </div>
                    <ul class="nav nav-pills mb-3 custom-tabs" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-toggle="pill"
                                    data-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true">{{ __('translation.Lecture in progress') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-toggle="pill"
                                    data-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                                    aria-selected="false">{{ __('translation.Completed Lecture') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-toggle="pill"
                                    data-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                                    aria-selected="false">{{ __('translation.Lecture on “Like”') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-complete-tab" data-toggle="pill"
                                    data-target="#pills-complete" type="button" role="tab"
                                    aria-controls="pills-complete"
                                    aria-selected="false">{{ __('translation.Related Lectures List') }}</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                             aria-labelledby="pills-home-tab">
                            <div class="custom-tab-content">
                                <h6 class="content-heading">{{ __('translation.Courses in Progress') }}
                                    ({{ $courses_enrolled->count() + $offline_enrolments->count() }})</h6>
                                <div class="row progress_lectures_list">
                                    @if ($courses_enrolled->count() > 0)
                                        @foreach ($courses_enrolled as $item)
                                            @php
                                                $first_lecture_slug = null;
                                                $course_end_date = \Carbon\Carbon::parse($item->created_at)->addWeeks($item->getCourses->duration_of_course + $item->extended_duration);
                                                if ($item->getCourses->getCourseStatus->count() > 0) {
                                                $sections = $item->getCourses->getCourseStatus;
                                                for ($key = 0; $key < $sections->count(); $key++) {
                                                    if ($sections[$key]->getLectures->count() > 0) {
                                                    if (empty($first_lecture_slug)) {
                                                    $first_lecture_slug = $sections[$key]->getLectures[0]->slug;
                                                    }
                                                    }
                                                    }
                                                    }
                                            @endphp
                                            <div class="col-lg-3 col-md-4 col-12">
                                                <div class="lecture-box">
                                                    <img
                                                        src="{{ asset('storage/course/thumbnail/' . $item->getCourses->course_thumbnail) }}"
                                                        class="lecture_img img-fluid" alt="lecture_img">
                                                    <div class="lecture_box_content h-130">
                                                        <h6 class="lecture_title mb-1"><a
                                                                href="{{ route('online_course_detail' , $item->getCourses->id) }}"
                                                                class="text-dark">{{ Str::limit($item->getCourses->course_title,35) }}</a>
                                                        </h6>
                                                        <small
                                                            class="d-block text-muted mb-1 lecture_info">{{ $item->getCourses->getCategoryName->name }}
                                                            l {{ $item->getCourses->getTutorName->name }}</small>
                                                        <small
                                                            class="lecture-duration d-block">{{ $course_end_date->format('Y-m-d') }}</small>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between lecture-box-footer">
                                                            @if($item->access == 1)
                                                                @if($item->created_at->addWeeks($item->getCourses->duration_of_course + $item->extended_duration)->isPast() != true)
                                                                    <div class="d-flex align-items-center">
                                                                        @if ($item->getCourses->live_status == 1)
                                                                            <a href="{{ $item->getCourses->live_link }}"
                                                                               target="_blank"
                                                                               class="btn btn-danger btn-custom-sm btn-theme-live d-flex align-items-center mr-2 font-10">
                                                                                <span class="live-icon mr-1"></span>
                                                                                <span>{{ __('translation.Live') }}</span>
                                                                            </a>
                                                                        @endif

                                                                        @if (!empty($first_lecture_slug))
                                                                            <a href="{{ route('class', [$item->course_id, $first_lecture_slug]) }}"
                                                                               class="btn btn-primary btn-custom-sm btn-theme-blue">{{ __('translation.Take Class') }}</a>
                                                                        @else
                                                                            <a href="javascript:void(0)"
                                                                               class="btn btn-primary btn-custom-sm btn-theme-blue disabled">{{ __('translation.No Lecture') }}</a>
                                                                        @endif
                                                                    </div>
                                                                @else
                                                                    <p class="mb-0 text-white badge bg-secondary">{{ __('translation.Course duration') }}
                                                                        ({{ $item->getCourses->duration_of_course + $item->extended_duration }} {{ ($item->getCourses->duration_of_course > 1) ? __('translation.Weeks') : __('translation.Weeks') }}
                                                                        ) {{ __('translation.is completed') }}</p>
                                                                @endif
                                                            @else
                                                                <p class="mb-0 text-white badge bg-danger"
                                                                   style="font-size: 10px;">{{ __('translation.Admin has blocked your access') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                    @if ($offline_enrolments->count() > 0)
                                        @foreach ($offline_enrolments as $item)
                                            <div class="col-lg-3 col-md-4 col-12">
                                                <div class="lecture-box">
                                                    <img
                                                        src="{{ asset('storage/offline_course/thumbnail/' . $item->getCousreName->course_thumbnail) }}"
                                                        class="lecture_img img-fluid" alt="lecture_img">
                                                    <div class="lecture_box_content h-130">
                                                        <h6 class="lecture_title mb-1"><a
                                                                href="{{ route('online_course_detail' , $item->getCousreName->id) }}"
                                                                class="text-dark">{{ Str::limit($item->getCousreName->course_title,25) }}</a>
                                                        </h6>
                                                        <small
                                                            class="d-block text-muted mb-1 lecture_info">{{ $item->getCousreName->getCategoryName->name }}
                                                            l {{ $item->getCousreName->getTutorName->name }}
                                                            l {{ __('translation.Offline') }}</small>
                                                        <small
                                                            class="lecture-duration d-block">{{ $item->getCousreName->created_at->format('Y-m-d') }}</small>
                                                        <div
                                                            class="d-flex align-items-center justify-content-between lecture-box-footer">
                                                            <div class="d-flex align-items-center">
                                                                    <?php
                                                                    $check_offline_review = Illuminate\Support\Facades\DB::table('reviews')
                                                                        ->where('user_id', auth()->id())
                                                                        ->where('course_id', $item->getCousreName->id)
                                                                        ->first();
                                                                    ?>

                                                                @if($check_offline_review)
                                                                    <a href="javascript:void(0)"
                                                                       onclick="checkReviewModal($(this))"
                                                                       data-rating="{{ $check_offline_review->rating }}"
                                                                       data-course-name="{{ $item->getCousreName->course_title }}"
                                                                       data-title="{{ $check_offline_review->title }}"
                                                                       data-content="{{ $check_offline_review->content }}"
                                                                       class="btn btn-primary btn-custom-sm btn-theme-blue ">{{ __('translation.Review Added') }}</a>
                                                                @else
                                                                    <a href="javascript:void(0)"
                                                                       onclick="reviewModal('{{ $item->getCousreName->id }}',$(this))"
                                                                       data-course-name="{{ $item->getCousreName->course_title }}"
                                                                       data-category-id="{{ $item->getCousreName->category_id }}"
                                                                       data-course-type="offline"
                                                                       class="btn btn-primary btn-custom-sm btn-theme-blue ">{{ __('translation.Write a review') }}</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                    @if ($reservations->count() > 0)
                                        @foreach ($reservations as $item)
                                            @if($item->status == 'applied')
                                                <div class="col-lg-3 col-md-4 col-12">
                                                    <div class="lecture-box">
                                                        <img
                                                            src="{{ asset('storage/offline_course/thumbnail/' . $item->getCourses->course_thumbnail) }}"
                                                            class="lecture_img img-fluid" alt="lecture_img">
                                                        <div class="lecture_box_content h-130">
                                                            <h6 class="lecture_title mb-1"><a
                                                                    href="{{ route('online_course_detail' , $item->getCourses->id) }}"
                                                                    class="text-dark">{{ Str::limit($item->getCourses->course_title,100) }}</a>
                                                            </h6>
                                                            <small
                                                                class="d-block text-muted mb-1 lecture_info">{{ $item->getCourses->getCategoryName->name }}
                                                                l {{ $item->getCourses->getTutorName->name }}
                                                                l {{ __('translation.Offline') }}</small>
                                                            <small
                                                                class="lecture-duration d-block">{{ $item->getCourses->created_at->format('Y-m-d') }}</small>
                                                            <div
                                                                class="d-flex align-items-center justify-content-between lecture-box-footer">
                                                                <div class="d-flex align-items-center">
                                                                    <a href="javascript:void(0)"
                                                                       class="btn btn-dark btn-custom-sm">예약 대기 중</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                             aria-labelledby="pills-profile-tab">
                            <div class="custom-tab-content">
                                <h6 class="content-heading">{{ __('translation.Completed Lectures') }}
                                    ({{ $completed_courses->count() }})</h6>
                                <div class="row">
                                    @if ($completed_courses->count() > 0)
                                        @foreach ($completed_courses as $v)
                                            @php
                                                $completed_course_end_date = \Carbon\Carbon::parse($v->created_at)->addWeeks($v->getCourses->duration_of_course);
                                                $first_lecture_slug = null;
                                                if ($v->getCourses->getCourseStatus->count() > 0) {
                                                $sections = $v->getCourses->getCourseStatus;
                                                for ($key = 0; $key < $sections->count(); $key++) {
                                                    if ($sections[$key]->getLectures->count() > 0) {
                                                    if (empty($first_lecture_slug)) {
                                                    $first_lecture_slug = $sections[$key]->getLectures[0]->slug;
                                                    }
                                                    }
                                                    }
                                                    }
                                            @endphp
                                                <?php
                                                $Data = Illuminate\Support\Facades\DB::table('reviews')
                                                    ->where('user_id', auth()->id())
                                                    ->where('course_id', $v->course_id)
                                                    ->first();
                                                ?>
                                            <div class="col-lg-3 col-md-4 col-12">
                                                <div class="lecture-box">
                                                    <img
                                                        src="{{ asset('storage/course/thumbnail/' . $v->getCourses->course_thumbnail) }}"
                                                        class="lecture_img img-fluid" alt="lecture_img">
                                                    <div class="lecture_box_content completed-lectures-box"
                                                         style="height: auto !important;">
                                                        <h6 class="lecture_title mb-1">{{ Str::limit($v->getCourses->course_title,25) }}</h6>
                                                        <small
                                                            class="d-block text-muted mb-1 lecture_info">{{ $v->getCourses->getCategoryName->name }}
                                                            l
                                                            {{ $v->getCourses->getTutorName->name }}</small>
                                                        <small
                                                            class="lecture-duration mb-4 d-block">{{ $completed_course_end_date->format('Y-m-d') }}</small>
                                                        <div class="d-flex align-items-center justify-content-between">

                                                            @if ($Data)
                                                                <button href="javascript:void(0)"
                                                                        class="btn btn-primary btn-theme-light w-50"
                                                                        style="font-size: 11px; padding: 5px 5px; border-radius: 0;"
                                                                        onclick="checkReviewModal($(this))"
                                                                        data-rating="{{ $Data->rating }}"
                                                                        data-course-name="{{ $v->getCourses->course_title }}"
                                                                        data-title="{{ $Data->title }}"
                                                                        data-content="{{ $Data->content }}"><i
                                                                        class="fas fa-edit"></i>{{ __('translation.Review Added') }}
                                                                </button>
                                                            @else
                                                                <button href="javascript:void(0)"
                                                                        class="btn btn-primary btn-theme-light w-50"
                                                                        style="font-size: 11px; padding: 5px 5px; border-radius: 0;"
                                                                        onclick="reviewModal('{{ $v->getCourses->id }}',$(this))"
                                                                        data-course-name="{{ $v->getCourses->course_title }}"
                                                                        data-category-id="{{ $v->getCourses->category_id }}"
                                                                        data-course-type="online"
                                                                >
                                                                    <i class="fas fa-edit"></i>{{ __('translation.Write a review') }}
                                                                </button>
                                                            @endif


                                                            @if ($v->generate_certificate == 1)
                                                                <a href="javascript:void(0)"
                                                                   class="btn btn-primary btn-theme-black w-48"
                                                                   style="font-size: 11px; padding: 5px 5px !important; border-radius: 0;"
                                                                   onclick="certificate('{{ $v->getCourses->id }}',$(this))"
                                                                   data-course-name="{{ $v->getCourses->course_title }}"
                                                                   id="completed_courses"> <i class="fas fa-medal"></i>
                                                                    {{ __('translation.Review Added') }} </a>
                                                            @else
                                                                <a href="javascript:void(0)"
                                                                   class="btn btn-primary btn-theme-black w-48"
                                                                   style="font-size: 11px; padding: 5px 5px !important; border-radius: 0;"
                                                                   onclick="checkCertificate($(this))"
                                                                   data-course-name="{{ $v->getCourses->course_title }}">
                                                                    <i class="fas fa-medal"></i>
                                                                    {{ __('translation.Certificate') }}</a>
                                                            @endif
                                                        </div>
                                                        @if($v->access == 1)
                                                            @if(!empty($v->getCourses))
                                                                @if(!empty($v->getCourses->duration_of_course))
                                                                    @if(!(\Carbon\Carbon::parse($v->created_at)->addWeeks($v->getCourses->duration_of_course + $v->extended_duration)->isPast()))
                                                                        <div class="mt-2">
                                                                            @if (!empty($first_lecture_slug))
                                                                                <a href="{{ route('class', [$v->getCourses->id, $first_lecture_slug]) }}"
                                                                                   class="btn btn-primary btn-custom-sm btn-theme-blue w-100"
                                                                                   style="padding-top: 5px; padding-bottom: 5px;">{{ __('translation.Take Class') }}</a>
                                                                            @else
                                                                                <a href="javascript:void(0)"
                                                                                   class="btn btn-primary btn-custom-sm btn-theme-blue disabled"
                                                                                   style="padding-top: 5px; padding-bottom: 5px;">{{ __('translation.No Lecture') }}</a>
                                                                            @endif
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @else
                                                            <p class="mb-0 text-white badge bg-danger"
                                                               style="font-size: 10px;">{{ __('translation.Admin has blocked your access') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-12 text-center">
                                            <img src="{{ asset('web_assets/images/no-data-found.png') }}"
                                                 class="img-fluid" alt="img" style="height: 250px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                             aria-labelledby="pills-contact-tab">
                            <div class="custom-tab-content">
                                <h6 class="content-heading">{{ __('translation.Lecture on “Like”') }}
                                    ({{ $liked_courses->count() }})</h6>
                                <div class="row">
                                    @if ($liked_courses->count() > 0)
                                        @foreach ($liked_courses as $liked_course)
                                            @if ($liked_course->type == 'online')
                                                <div class="col-lg-3 col-md-4 col-12">
                                                    <a href="{{ route('online_course_detail',$liked_course->getLikedCourse->id) }}"
                                                       style="color: black;;">
                                                        <div class="lecture-box" style="height: 300px;">
                                                            <img
                                                                src="{{ asset('storage/course/thumbnail/' . $liked_course->getLikedCourse->course_thumbnail) }}"
                                                                class="lecture_img img-fluid" alt="lecture_img">
                                                            <div class="lecture_box_content">
                                                                <h6 class="lecture_title"> {{$liked_course->getLikedCourse->course_title}}</h6>
                                                                <small
                                                                    class="d-block text-muted mb-2 lecture_info">{{ $liked_course->getLikedCourse->getCategoryName->name }}
                                                                    l
                                                                    {{ $liked_course->getLikedCourse->getTutorName->name }}</small>
                                                                <small
                                                                    class="lecture-duration d-block">{{ $liked_course->created_at->format('Y-m-d') }}</small>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @else
                                                <div class="col-lg-3 col-md-4 col-12">
                                                    <a href="{{ route('offline_lecture_detail',$liked_course->getOfflineLikedCourse->id) }}"
                                                       style="color: black;">
                                                        <div class="lecture-box" style="height: 300px;">
                                                            <img
                                                                src="{{ asset('storage/offline_course/thumbnail/' . $liked_course->getOfflineLikedCourse->course_thumbnail) }}"
                                                                class="lecture_img img-fluid" alt="lecture_img">
                                                            <div class="lecture_box_content">
                                                                <h6 class="lecture_title"> {{$liked_course->getOfflineLikedCourse->course_title}}</h6>
                                                                <small
                                                                    class="d-block text-muted mb-2 lecture_info">{{ $liked_course->getOfflineLikedCourse->getCategoryName->name }}
                                                                    l
                                                                    {{ $liked_course->getOfflineLikedCourse->getTutorName->name }}</small>
                                                                <small
                                                                    class="lecture-duration d-block">{{ $liked_course->created_at->format('Y-m-d') }}</small>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <div class="col-lg-12 col-md-12 col-12">
                                            <div class="text-center mt-3 mb-3">No record Found</div>
                                        </div>
                                    @endif


                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-complete" role="tabpanel"
                             aria-labelledby="pills-complete-tab">
                            <div class="custom-tab-content">
                                <h6 class="content-heading">{{ __('translation.Related Lectures') }}</h6>
                                <div class="row">
                                    @if ($related_courses->count() > 0)
                                        @foreach ($related_courses->take(8) as $value)
                                            <div class="col-lg-3 col-md-4 col-12">
                                                <div class="lecture-box">
                                                    <img
                                                        src="{{ asset('storage/course/thumbnail/' . $value->course_thumbnail) }}"
                                                        class="lecture_img img-fluid" alt="lecture_img">
                                                    <div class="lecture_box_content h-130">
                                                        <h6 class="lecture_title">{{ $value->course_title }}</h6>
                                                        <small
                                                            class="d-block text-muted mb-2 lecture_info">{{ $value->getCategoryName->name }}
                                                            l
                                                            {{ $value->getTutorName->name }}</small>
                                                        <small
                                                            class="lecture-duration mb-4 d-block">{{ $value->created_at->format('Y-m-d') }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-12 text-center">
                                            <img src="{{ asset('web_assets/images/no-data-found.png') }}"
                                                 class="img-fluid" alt="img" style="height: 250px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection



@section('modals')
    <div class="modal fade review_modal" id="reviewModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-custom modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center" id="exampleModalLabel"><i
                            class="fas fa-star text-theme-yellow"></i> <span>{{ __('translation.Review') }}</span></h5>
                </div>
                <div class="modal-body">
                    <div class="prompt"></div>
                    <form id="addReview">
                        <input type="hidden" value="" id="course_type" name="course_type">
                        @csrf
                        <input type="hidden" name="categroy_id" id="review_category_id" value="">
                        <input type="hidden" name="course_id" id="course_id">
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-1 rating-stars">
                                <ul class="rate-area">
                                    <input type="radio" id="5-star" name="rating" value="5"/><label for="5-star"
                                                                                                    title="Amazing">5 {{ __('translation.stars') }}</label>
                                    <input type="radio" id="4-star" name="rating" value="4"/><label for="4-star"
                                                                                                    title="Good">4 {{ __('translation.stars') }}</label>
                                    <input type="radio" id="3-star" name="rating" value="3"/><label for="3-star"
                                                                                                    title="Average">3 {{ __('translation.stars') }}</label>
                                    <input type="radio" id="2-star" name="rating" value="2"/><label for="2-star"
                                                                                                    title="Not Good">2 {{ __('translation.stars') }}</label>
                                    <input type="radio" id="1-star" name="rating" value="1"/><label for="1-star"
                                                                                                    title="Bad">1 {{ __('translation.star') }}</label>
                                </ul>
                            </div>
                            <div class="error-rating"></div>
                        </div>
                        <div class="row align-items-center mb-3">
                            <div class="col-lg-2">
                                <label for="course_name mb-0">{{ __('translation.Course Name') }}</label>
                            </div>
                            <div class="col-lg-10">
                                <input type="text" name="course_name" readonly id="course_name" value=""
                                       class="form-control">
                            </div>
                        </div>
                        <div class="row align-items-center mb-3">
                            <div class="col-lg-2">
                                <label for="writer mb-0">{{ __('translation.Writer') }}</label>
                            </div>
                            <div class="col-lg-10">
                                <input type="text" name="writer" id="writer" value="{{ auth()->user()->name }}"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="row align-items-center mb-3">
                            <div class="col-lg-2">
                                <label for="title mb-0">{{ __('translation.Title') }}</label>
                            </div>

                            <div class="col-lg-10">
                                <input type="text" name="title" placeholder="{{ __('translation.Enter Title') }}"
                                       value="{{ old('title') }}" class="form-control">
                                <div class="error-title"></div>
                            </div>
                        </div>
                        <div class="row align-items-center mb-3">
                            <div class="col-lg-2">
                                <label for="contents mb-0">{{ __('translation.Contents') }}</label>
                            </div>
                            <div class="col-lg-10">
                                <input type="text" name="contents"
                                       placeholder="{{ __('translation.Write a review in here') }}" class="form-control"
                                       value="{{ old('content') }}">
                                <div class="error-content"></div>
                            </div>
                        </div>

                        {{-- <div class="row align-items-center mb-3">
                            <div class="col-lg-2">
                                <label for="contents mb-0">{{ __('translation.Video') }}</label>
                            </div>
                            <div class="col-lg-10">
                                <input type="file" name="video" class="form-control" accept=".mp4">
                                <div class="error-video"></div>
                            </div>
                        </div> --}}
                        {{-- <div class="row align-items-center mb-3">
                            <div class="col-lg-2">
                                <label for="contents mb-0">{{ __('translation.Video URL') }}</label>
                            </div>
                            <div class="col-lg-10">
                                <input type="text" name="video_url" placeholder="{{ __('translation.Enter video URL ( Youtube or Vimeo )') }}" class="form-control">
                                <div class="error-video-url"></div>
                            </div>
                        </div> --}}
                        <div class="my-3 d-flex align-items-center justify-content-center">
                            <button type="submit" id="submitForm"
                                    class="btn btn-primary mr-2 rounded-0 btn-theme-black">등록
                            </button>
                            <button type="button" class="btn btn-secondary rounded-0"
                                    data-dismiss="modal">{{ __('translation.Close') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Check Certificate -->
    <div class="modal fade review_modal" id="checkCertificateModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-custom modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center" id="exampleModalLabel"><img
                            class="certificate_icon"
                            src="{{ asset('web_assets/images/certificate_icon.png') }}"/><span>{{ __('translation.Check Certification') }}</span>
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="row align-items-center mb-3">
                        <div class="col-lg-12">
                            <label for="course_name mb-0">{{ __('translation.Course Name') }}</label>
                            <input class="form-control" name="course_name" id="check_certificate">
                        </div>
                    </div>
                    <div class="row align-items-center justify-content-center mb-3">
                        <div class="col-lg-12">
                            <h4 class="certificate_modal_body text-center mt-3">
                                {{ __('translation.The course has not been completed yet') }}.
                                {{ __('translation.Please check again') }}.
                            </h4>
                        </div>
                    </div>
                    <div class="my-3 d-flex align-items-center justify-content-center">
                        <button type="button" class="btn btn-primary mr-2 rounded-0 btn-theme-black"
                                data-dismiss="modal">{{ __('translation.Close') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Certificate Modal -->
    <div class="modal fade review_modal" id="certificateModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-custom modal-lg" role="document">
            <div class="modal-content" style="width: 1052px;">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center" id="exampleModalLabel"><img
                            class="certificate_icon"
                            src="{{ asset('web_assets/images/certificate_icon.png') }}"/><span>{{ __('translation.Check Certification') }}</span>
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="row align-items-center mb-3">
                        <div class="col-lg-12">
                            <label for="course_name mb-0">{{ __('translation.Course Name') }}</label>
                            <input class="form-control" name="course_name" id="completed_course_name" value="">
                        </div>
                    </div>
                    <div class="row align-items-center justify-content-center mb-3">
                        <div class="col-lg-12">
                            <div id="download_certificate">
                                <div class="pdfjs-viewer"></div>
                            </div>
                        </div>
                    </div>
                    <div class="my-3 d-flex align-items-center justify-content-center">
                        <a class="btn btn-primary mr-2 rounded-0 btn-theme-black" id="downlaod_certificate" href="#"
                           downlaod>{{ __('translation.Download') }}</a>
                        <button type="button" class="btn btn-primary mr-2 rounded-0 btn-theme-light"
                                data-dismiss="modal">{{ __('translation.Close') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Check Review -->
    <div class="modal fade review_modal" id="checkReviewModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-custom modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center" id="exampleModalLabel">
                        <span>{{ __('translation.Review') }}</span>
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="row align-items-center mb-3">
                        <div class="col-lg-12">
                            <label for="course_name mb-0">{{ __('translation.Course Name') }}</label>
                            <input class="form-control" id="check_review_certificate">
                        </div>
                    </div>
                    <div class="row align-items-center justify-content-center mb-3">
                        <div class="col-lg-12">
                            <div id="review_rating"></div>
                            <h4 class="certificate_modal_body text-start mt-3" id="check_review_title"></h4>
                            <p id="review_content"></p>
                        </div>
                    </div>
                    <div class="my-3 d-flex align-items-center justify-content-center">
                        <button type="button" class="btn btn-primary mr-2 rounded-0 btn-theme-black"
                                data-dismiss="modal">{{ __('translation.Close') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('custom-script')
    <script>
        var checkModal = new bootstrap.Modal(document.getElementById("checkCertificateModal"), {});
        let download_certificate_url = "{{ route('download_file','hash') }}";

        function checkCertificate(name) {
            $('#check_certificate').val(name.attr('data-course-name'));
            checkModal.show();
        }

        var certificateModal = new bootstrap.Modal(document.getElementById("certificateModal"), {});

        function certificate(id, name) {
            console.log(id);
            $.ajax({
                type: "POST",
                url: "{{ route('completed-courses-certificate') }}",
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                },
                beforeSend: function () {
                    $('#completed_courses').html('<i class="fa fa-spinner me-2"></i> 가공');
                },
                success: function (response) {

                    if (response.success == true) {
                        console.log($('#downlaod_certificate').attr('href').replace('hash', response.hash));
                        //setting up pdf viewer
                        var pdfjsLib = window['pdfjs-dist/build/pdf'];
                        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.worker.min.js';
                        var pdfViewer = new PDFjsViewer($('.pdfjs-viewer'));
                        pdfViewer.loadDocument('{{ asset("path") }}'.replace('path', response.data.certificate));

                        // Dynamic Course Name and Certificate UrL In Modal
                        $('#completed_course_name').val(response.name);
                        var hash = download_certificate_url.replace('hash', response.hash);
                        $('#downlaod_certificate').attr("href", hash);
                        certificateModal.show();

                        $('#completed_courses').html('<i class="fas fa-medal"></i> {{ __("translation.Certificate") }} ');
                    } else {
                        console.log(error)
                    }

                },
                error: function (e) {
                }
            });
        }

        var showModal = new bootstrap.Modal(document.getElementById("reviewModal"), {});

        function reviewModal(id, btn) {
            $('#course_id').val(id);
            $('#review_category_id').val(btn.attr('data-category-id'));
            $('#course_name').val(btn.attr('data-course-name'));
            $('#course_type').val(btn.attr('data-course-type'))
            showModal.show();
        }

        var checkReview = new bootstrap.Modal(document.getElementById("checkReviewModal"), {});

        function checkReviewModal(btn) {
            $('#review_content').text(btn.attr('data-content'));
            $('#check_review_title').text(btn.attr('data-title'));
            var rating = btn.attr('data-rating');
            $('#review_rating').html('');
            if (rating == 5) {
                $('#review_rating').append(
                    `<div class="d-flex align-items-center gap-1 rating-stars">
                    <div>Rating :</div>
                    <ul class="rate-area">
                        <input type="radio" id="5-star" name="rating" value="5" /><label for="5-star" title="Amazing" style="color: gold;">5 {{ __('translation.stars') }}</label>
                        <input type="radio" id="4-star" name="rating" value="4" /><label for="4-star" title="Good" style="color: gold;">4 {{ __('translation.stars') }}</label>
                        <input type="radio" id="3-star" name="rating" value="3" /><label for="3-star" title="Average" style="color: gold;">3 {{ __('translation.stars') }}</label>
                        <input type="radio" id="2-star" name="rating" value="2" /><label for="2-star" title="Not Good" style="color: gold;">2 {{ __('translation.stars') }}</label>
                        <input type="radio" id="1-star" name="rating" value="1" /><label for="1-star" title="Bad"  style="color: gold;">1 {{ __('translation.star') }}</label>
                    </ul>
                </div>`
                );
            } else if (rating == 4) {
                $('#review_rating').append(
                    `<div class="d-flex align-items-center gap-1 rating-stars">
                    <div>Rating :</div>
                    <ul class="rate-area">
                        <input type="radio" id="4-star" name="rating" value="4" /><label for="4-star" title="Good" style="color: gold;">4 {{ __('translation.stars') }}</label>
                        <input type="radio" id="3-star" name="rating" value="3" /><label for="3-star" title="Average" style="color: gold;">3 {{ __('translation.stars') }}</label>
                        <input type="radio" id="2-star" name="rating" value="2" /><label for="2-star" title="Not Good" style="color: gold;">2 {{ __('translation.stars') }}</label>
                        <input type="radio" id="1-star" name="rating" value="1" /><label for="1-star" title="Bad" style="color: gold;">1 {{ __('translation.star') }}</label>
                    </ul>
                </div>`
                );
            } else if (rating == 3) {
                $('#review_rating').append(
                    `<div class="d-flex align-items-center gap-1 rating-stars">
                    <div>Rating :</div>
                    <ul class="rate-area">
                        <input type="radio" id="3-star" name="rating" value="3" /><label for="3-star" title="Average" style="color: gold;">3 {{ __('translation.stars') }}</label>
                        <input type="radio" id="2-star" name="rating" value="2" /><label for="2-star" title="Not Good" style="color: gold;">2 {{ __('translation.stars') }}</label>
                        <input type="radio" id="1-star" name="rating" value="1" /><label for="1-star" title="Bad" style="color: gold;">1 {{ __('translation.star') }}</label>
                    </ul>
                </div>`
                );
            } else if (rating == 2) {
                $('#review_rating').append(
                    `<div class="d-flex align-items-center gap-1 rating-stars">
                    <div>Rating :</div>
                    <ul class="rate-area">
                        <input type="radio" id="2-star" name="rating" value="2" /><label for="2-star" title="Not Good" style="color: gold;">2 {{ __('translation.stars') }}</label>
                        <input type="radio" id="1-star" name="rating" value="1" /><label for="1-star" title="Bad" style="color: gold;">1 {{ __('translation.star') }}</label>
                    </ul>
                </div>`
                );
            } else {
                $('#review_rating').append(
                    `<div class="d-flex align-items-center gap-1 rating-stars">
                    <div>Rating :</div>
                    <ul class="rate-area">
                        <input type="radio" id="2-star" name="rating" value="2" /><label for="2-star" title="Not Good" style="color: gold;">2 {{ __('translation.stars') }}</label>
                        <input type="radio" id="1-star" name="rating" value="1" /><label for="1-star" title="Bad" style="color: gold;">1 {{ __('translation.star') }}</label>
                    </ul>
                </div>`
                );
            }
            $('#check_review_certificate').val(btn.attr('data-course-name'));

            checkReview.show();
        }

        var progressboxHeight = 0;
        $('.progress_lectures_list .lecture-box .lecture_box_content').each(function () {
            if ($(this).height() > progressboxHeight) {
                progressboxHeight = $(this).height();
            }
        });

        $('.progress_lectures_list .lecture-box .lecture_box_content').height(progressboxHeight);

        $('.page-side-menu-toggle').on('click', function () {
            $('.page-side-menu').slideToggle();
        });

        $("#addReview").on('submit', function (e) {
            e.preventDefault();
            var formData = new FormData($("#addReview")[0]);
            formData = new FormData($("#addReview")[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('add-review') }}",
                dataType: 'json',
                contentType: false,
                processData: false,
                cache: false,
                data: formData,
                mimeType: "multipart/form-data",
                beforeSend: function () {
                    $("#submitForm").prop('disabled', true);
                    $("#submitForm").html('<i class="fa fa-spinner fa-spin me-1"></i> 처리');
                    $('.error-message ').hide();
                },
                success: function (res) {
                    $("#submitForm").attr('class', 'btn btn-success');
                    $("#submitForm").html('<i class="fa fa-check me-1"></i>  {{ __("translation.Review Added") }}</>');
                    if (res.success) {
                        $('.prompt').html('<div class="alert alert-success mb-3">' + res.message +
                            '</div>');
                        setTimeout(function () {
                            $('html, body').animate({
                                scrollTop: $("html, body").offset().top
                            }, 1000);
                        }, 1500);

                        setTimeout(function () {
                            $('.prompt').hide()
                            window.location.reload();
                        }, 4000);
                        $('.error-rating').html('');
                        $('.error-title').html('');
                        $('.error-content').html('');
                        $('.error-video').html('');
                        $('.error-video-url').html('');


                    } else {
                    }
                },
                error: function (e) {
                    $("#submitForm").prop('disabled', false);
                    $("#submitForm").html('리뷰 추가');
                    if (e.responseJSON.errors['rating']) {
                        $('.error-rating').html('<small class=" error-message text-danger">' + e
                            .responseJSON.errors['rating'][0] + '</small>');
                    }
                    if (e.responseJSON.errors['title']) {
                        $('.error-title').html('<small class=" error-message text-danger">' + e
                            .responseJSON.errors['title'][0] + '</small>');
                    }
                    if (e.responseJSON.errors['contents']) {
                        $('.error-content').html('<small class=" error-message text-danger">' + e
                            .responseJSON.errors['contents'][0] + '</small>');
                    }
                    if (e.responseJSON.errors['video']) {
                        $('.error-video').html('<small class=" error-message text-danger">' + e
                            .responseJSON.errors['video'][0] + '</small>');
                    }
                    if (e.responseJSON.errors['video_url']) {
                        $('.error-video-url').html('<small class=" error-message text-danger">' + e
                            .responseJSON.errors['video_url'][0] + '</small>');
                    }
                }
            });
        });

        // $(document).ready(function() {
        //     let courseBoxContentHeight = 0;
        //     $('.completed-lectures-box').each(function() {
        //         if (courseBoxContentHeight < $(this).height()) {
        //             courseBoxContentHeight = $(this).height();
        //         }
        //     });
        //     $('.completed-lectures-box').height(courseBoxContentHeight + 15);
        // });
    </script>
@endsection

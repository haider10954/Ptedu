@extends('user.layout')

@section('title', 'ptedu - My Classroom')

@section('content')
<div class="section pt-125">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 padding-left">
                <div class="page-sidemenu-heading mb-3">
                    <h5 class="mb-0 font-weight-600">{{ __('translation.My Classroom') }}</h5>
                    <a href="javscript:void(0)" class="btn btn-dark btn-custom-sm btn-theme-black page-side-menu-toggle">{{ __('translation.menu') }}</a>
                </div>
                <div class="page-side-menu">
                    <ul class="menu">
                        <li><a href="{{ route('my_classroom') }}">{{ __('translation.My Classroom') }}</a></li>
                        <li><a href="{{ route('shopping_bag') }}">{{ __('translation.Shopping Bag') }}</a></li>
                        <li><a href="{{ route('user_info') }}">{{ __('translation.Modifying Member Info') }}</a></li>
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
                        <button class="nav-link active" id="pills-home-tab" data-toggle="pill" data-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">{{ __('translation.Lecture in progress') }}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">{{ __('translation.Completed Lecture') }}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-toggle="pill" data-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">{{ __('translation.Lecture on “Like”') }}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-complete-tab" data-toggle="pill" data-target="#pills-complete" type="button" role="tab" aria-controls="pills-complete" aria-selected="false">{{ __('translation.Related Lectures List') }}</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="custom-tab-content">
                            <h6 class="content-heading">{{ __('translation.Courses in Progress') }}
                                ({{ $courses_enrolled->count() + $offline_enrolments->count() }})</h6>
                            <div class="row progress_lectures_list">
                                @if ($courses_enrolled->count() > 0)
                                @foreach ($courses_enrolled as $item)
                                @php
                                $first_lecture_slug = null;
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
                                            <img src="{{ asset('storage/course/thumbnail/' . $item->getCourses->course_thumbnail) }}" class="lecture_img img-fluid" alt="lecture_img">
                                            <div class="lecture_box_content h-130">
                                                <h6 class="lecture_title mb-1"><a href="{{ route('online_course_detail' , $item->getCourses->id) }}" class="text-dark">{{ Str::limit($item->getCourses->course_title,35) }}</a></h6>
                                                <small class="d-block text-muted mb-1 lecture_info">{{ $item->getCourses->getCategoryName->name }}
                                                    l {{ $item->getCourses->getTutorName->name }}</small>
                                                    <small class="lecture-duration d-block">{{ $item->getCourses->created_at->format('Y-m-d') }}</small>
                                                <div class="d-flex align-items-center justify-content-between lecture-box-footer">
                                                    <div class="d-flex align-items-center">
                                                        @if ($item->getCourses->live_status == 1)
                                                        <a href="{{ $item->getCourses->live_link }}" target="_blank" class="btn btn-danger btn-custom-sm btn-theme-live d-flex align-items-center mr-2 font-10">
                                                            <span class="live-icon mr-1"></span>
                                                            <span>{{ __('translation.Live') }}</span>
                                                        </a>
                                                        @endif

                                                        @if (!empty($first_lecture_slug))
                                                        <a href="{{ route('class', [$item->course_id, $first_lecture_slug]) }}" class="btn btn-primary btn-custom-sm btn-theme-blue">수강중</a>
                                                        @else
                                                        <a href="javascript:void(0)" class="btn btn-primary btn-custom-sm btn-theme-blue disabled">{{ __('translation.No Lecture') }}</a>
                                                        @endif
                                                    </div>
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
                                            <img src="{{ asset('storage/offline_course/thumbnail/' . $item->getCousreName->course_thumbnail) }}" class="lecture_img img-fluid" alt="lecture_img">
                                            <div class="lecture_box_content h-130">
                                                <h6 class="lecture_title mb-1"><a href="{{ route('online_course_detail' , $item->getCousreName->id) }}" class="text-dark">{{ Str::limit($item->getCousreName->course_title,35) }}</a></h6>
                                                <small class="d-block text-muted mb-1 lecture_info">{{ $item->getCousreName->getCategoryName->name }}
                                                    l {{ $item->getCousreName->getTutorName->name }} l {{ __('translation.Offline') }}</small>
                                                    <small class="lecture-duration d-block">{{ $item->getCousreName->created_at->format('Y-m-d') }}</small>
                                                <div class="d-flex align-items-center justify-content-between lecture-box-footer">
                                                    <div class="d-flex align-items-center">
                                                        <a href="javascript:void(0)" class="btn btn-primary btn-custom-sm btn-theme-blue ">예약 확정</a>
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
                                            <img src="{{ asset('storage/offline_course/thumbnail/' . $item->getCourses->course_thumbnail) }}" class="lecture_img img-fluid" alt="lecture_img">
                                            <div class="lecture_box_content h-130">
                                                <h6 class="lecture_title mb-1"><a href="{{ route('online_course_detail' , $item->getCourses->id) }}" class="text-dark">{{ Str::limit($item->getCourses->course_title,100) }}</a></h6>
                                                <small class="d-block text-muted mb-1 lecture_info">{{ $item->getCourses->getCategoryName->name }}
                                                    l {{ $item->getCourses->getTutorName->name }} l {{ __('translation.Offline') }}</small>
                                                <small class="lecture-duration d-block">{{ $item->getCourses->created_at->format('Y-m-d') }}</small>
                                                <div class="d-flex align-items-center justify-content-between lecture-box-footer">
                                                    <div class="d-flex align-items-center">
                                                        <a href="javascript:void(0)" class="btn btn-dark btn-custom-sm">예약 대기 중</a>
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
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="custom-tab-content">
                            <h6 class="content-heading">{{ __('translation.Completed Lectures') }}
                                ({{ $completed_courses->count() }})</h6>
                            <div class="row">
                                @if ($completed_courses->count() > 0)
                                @foreach ($completed_courses as $v)
                                <?php
                                $Data = Illuminate\Support\Facades\DB::table('reviews')
                                    ->where('user_id', auth()->id())
                                    ->where('course_id', $v->course_id)
                                    ->count();
                                ?>
                                <div class="col-lg-3 col-md-4 col-12">
                                    <div class="lecture-box">
                                        <img src="{{ asset('storage/course/thumbnail/' . $v->getCourses->course_thumbnail) }}" class="lecture_img img-fluid" alt="lecture_img">
                                        <div class="lecture_box_content completed-lectures-box">
                                            <h6 class="lecture_title mb-1">{{ $v->getCourses->course_title }}</h6>
                                            <small class="d-block text-muted mb-1 lecture_info">{{ $v->getCourses->getCategoryName->name }}
                                                l
                                                {{ $v->getCourses->getTutorName->name }}</small>
                                            <small class="lecture-duration mb-4 d-block">{{ $v->getCourses->created_at->format('Y-m-d') }}</small>
                                            <div class="d-flex align-items-center justify-content-between">

                                                @if ($Data == 1)
                                                <button href="javascript:void(0)" class="btn btn-primary btn-custom-sm btn-theme-light w-50" disabled> <i class="fas fa-edit"></i>{{ __('translation.Review Added') }}</button>
                                                @else
                                                <button href="javascript:void(0)" class="btn btn-primary btn-custom-sm btn-theme-light w-50" onclick="reviewModal('{{ $v->getCourses->id }}',$(this))" data-course-name="{{ $v->getCourses->course_title }}">
                                                    <i class="fas fa-edit"></i>{{ __('translation.Write a review') }}</button>
                                                @endif


                                                @if ($v->generate_certificate == 1)
                                                <a href="javascript:void(0)" class="btn btn-primary btn-custom-sm btn-theme-black w-48" onclick="certificate('{{ $v->getCourses->id }}',$(this))" data-course-name="{{ $v->getCourses->course_title }}" id="completed_courses"> <i class="fas fa-medal"></i>
                                                    {{ __('translation.Certificate') }}</a>
                                                @else
                                                <a href="javascript:void(0)" class="btn btn-primary btn-custom-sm btn-theme-black w-48" onclick="checkCertificate($(this))" data-course-name="{{ $v->getCourses->course_title }}">
                                                    <i class="fas fa-medal"></i>
                                                    {{ __('translation.Certificate') }}</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <div class="col-12 text-center">
                                    <img src="{{ asset('web_assets/images/no-data-found.png') }}" class="img-fluid" alt="img" style="height: 250px;">
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="custom-tab-content">
                            <h6 class="content-heading">{{ __('translation.Lecture on “Like”') }} (2)</h6>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-12">
                                    <div class="lecture-box">
                                        <img src="{{ asset('web_assets/images/lecture_img.png') }}" class="lecture_img img-fluid" alt="lecture_img">
                                        <div class="lecture_box_content">
                                            <h6 class="lecture_title">[2022 PTedu] pelvic healthe Integration
                                                - Melissa Devidson</h6>
                                            <small class="d-block text-muted mb-2 lecture_info">Physical Teraphy l
                                                Tutor Name</small>
                                            <small class="lecture-duration d-block">2022-10-12 ~ 2022-11-30</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12">
                                    <div class="lecture-box">
                                        <img src="{{ asset('web_assets/images/lecture_img_2.png') }}" class="lecture_img img-fluid" alt="lecture_img">
                                        <div class="lecture_box_content">
                                            <h6 class="lecture_title">[2022 PTedu] pelvic healthe Integration
                                                - Melissa Devidson</h6>
                                            <small class="d-block text-muted mb-2 lecture_info">Physical Teraphy l
                                                Tutor Name</small>
                                            <small class="lecture-duration d-block">2022-10-12 ~ 2022-11-30</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-complete" role="tabpanel" aria-labelledby="pills-complete-tab">
                        <div class="custom-tab-content">
                            <h6 class="content-heading">{{ __('translation.Related Lectures') }}</h6>
                            <div class="row">
                                @if ($related_courses->count() > 0)
                                @foreach ($related_courses->take(8) as $value)
                                <div class="col-lg-3 col-md-4 col-12">
                                    <div class="lecture-box">
                                        <img src="{{ asset('storage/course/thumbnail/' . $value->course_thumbnail) }}" class="lecture_img img-fluid" alt="lecture_img">
                                        <div class="lecture_box_content h-130">
                                            <h6 class="lecture_title">{{ $value->course_title }}</h6>
                                            <small class="d-block text-muted mb-2 lecture_info">{{ $value->getCategoryName->name }}
                                                l
                                                {{ $value->getTutorName->name }}</small>
                                            <small class="lecture-duration mb-4 d-block">{{ $value->created_at->format('Y-m-d') }}</small>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <div class="col-12 text-center">
                                    <img src="{{ asset('web_assets/images/no-data-found.png') }}" class="img-fluid" alt="img" style="height: 250px;">
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
<div class="modal fade review_modal" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-custom modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center" id="exampleModalLabel"><i class="fas fa-star text-theme-yellow"></i> <span>{{ __('translation.Review') }}</span></h5>
            </div>
            <div class="modal-body">
                <div class="prompt"></div>
                <form id="addReview">
                    @csrf
                    <input type="hidden" name="categroy_id" value="1">
                    <input type="hidden" name="course_id" id="course_id">
                    <div class="mb-3">
                        <div class="d-flex align-items-center gap-1 rating-stars">
                            <ul class="rate-area">
                                <input type="radio" id="5-star" name="rating" value="5" /><label for="5-star" title="Amazing">5 {{ __('translation.stars') }}</label>
                                <input type="radio" id="4-star" name="rating" value="4" /><label for="4-star" title="Good">4 {{ __('translation.stars') }}</label>
                                <input type="radio" id="3-star" name="rating" value="3" /><label for="3-star" title="Average">3 {{ __('translation.stars') }}</label>
                                <input type="radio" id="2-star" name="rating" value="2" /><label for="2-star" title="Not Good">2 {{ __('translation.stars') }}</label>
                                <input type="radio" id="1-star" name="rating" value="1" /><label for="1-star" title="Bad">1 {{ __('translation.star') }}</label>
                            </ul>
                        </div>
                        <div class="error-rating"></div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-lg-2">
                            <label for="course_name mb-0">{{ __('translation.Course Name') }}</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" name="course_name" readonly id="course_name" value="" class="form-control">
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-lg-2">
                            <label for="writer mb-0">{{ __('translation.Writer') }}</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" name="writer" id="writer" value="{{ auth()->user()->name }}" class="form-control">
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-lg-2">
                            <label for="title mb-0">{{ __('translation.Title') }}</label>
                        </div>

                        <div class="col-lg-10">
                            <input type="text" name="title" placeholder="{{ __('translation.Enter Title') }}" value="{{ old('title') }}" class="form-control">
                            <div class="error-title"></div>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-lg-2">
                            <label for="contents mb-0">{{ __('translation.Contents') }}</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" name="contents" placeholder="{{ __('translation.Write a review in here') }}" class="form-control" value="{{ old('content') }}">
                            <div class="error-content"></div>
                        </div>
                    </div>

                    <div class="row align-items-center mb-3">
                        <div class="col-lg-2">
                            <label for="contents mb-0">{{ __('translation.Video') }}</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="file" name="video" class="form-control">
                            <div class="error-video"></div>
                        </div>
                    </div>
                    <div class="row align-items-center mb-3">
                        <div class="col-lg-2">
                            <label for="contents mb-0">{{ __('translation.Video URL') }}</label>
                        </div>
                        <div class="col-lg-10">
                            <input type="text" name="video_url" placeholder="{{ __('translation.Enter video URL ( Youtube or Vimeo )') }}" class="form-control">
                            <div class="error-video-url"></div>
                        </div>
                    </div>
                    <div class="my-3 d-flex align-items-center justify-content-center">
                        <button type="submit" id="submitForm" class="btn btn-primary mr-2 rounded-0 btn-theme-black">{{ __('translation.Register') }}</button>
                        <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">{{ __('translation.Close') }}</button>
                    </div>
            </div>
        </div>
        </form>
    </div>
</div>

<!-- Check Certificate -->
<div class="modal fade review_modal" id="checkCertificateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-custom modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center" id="exampleModalLabel"><img class="certificate_icon" src="{{ asset('web_assets/images/certificate_icon.png') }}" /><span>{{ __('translation.Check Certification') }}</span>
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
                    <button type="button" class="btn btn-primary mr-2 rounded-0 btn-theme-black" data-dismiss="modal">{{ __('translation.Close') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Certificate Modal -->
<div class="modal fade review_modal" id="certificateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-custom modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center" id="exampleModalLabel"><img class="certificate_icon" src="{{ asset('web_assets/images/certificate_icon.png') }}" /><span>{{ __('translation.Check Certification') }}</span>
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
                    <div class="col-lg-12" id="download_certificate">
                        <div class="position-relative m-auto" style="width: 68%; background-color: #fff8f0;">
                            <img src="{{ asset('assets/images/icons/frame.png') }}" class="w-100" style="height: 450px;">
                            <div class="position-absolute text-center w-100" style="padding: 40px; top:0;">
                                <div class="w-25 mx-auto">
                                    <img src="{{ asset('assets/images/icons/certificate_header.png') }}" class="w-100">
                                </div>
                                <div class="w-50 mx-auto">
                                    <div class="divider mt-1 mb-1"></div>
                                </div>
                                <div class="certificate_header">CERTIFICATE</div>
                                <div class="certificate_sub_title">OF COMPLETION</div>
                                <div class="w-25 mx-auto">
                                    <img src="{{ asset('assets/images/icons/certificate_bottom.png') }}" class="w-100">
                                </div>
                                <div class="w-50 mx-auto">
                                    <div class="divider mt-1 mb-1"></div>
                                </div>
                                <div class="certificate_name mb-3">
                                    {{ auth()->user()->english_name }}
                                </div>
                                <div class="certificate_description mb-3">
                                    Is hereby cetified as an <span class="font-weight-bold"><span id="c_name"></span> – <br /> <span id="t_name"></span></span> with Full Certification for the half-year period <br />
                                    starting on
                                    <span id="certificate_start_date"></span> and ending on <span id="certificate_end_date"></span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mr-5">
                                    <div>
                                        <img src="{{ asset('assets/images/icons/certificate_logo.png') }}" class="certificate_logo">
                                        <img src="{{ asset('assets/images/index.png') }}" class="footer_logo" />
                                    </div>
                                    <div class="mr-3">
                                        <img src="{{ asset('assets/images/icons/certificate_footer.png') }}" class="certificate_footer" />
                                    </div>
                                    <div class="certificate_date">
                                        <span id="issue_date"></span> <br>
                                        Date
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="my-3 d-flex align-items-center justify-content-center">
                    <button type="button" id="download" class="btn btn-primary mr-2 rounded-0 btn-theme-black">{{ __('translation.Download') }}</button>
                    <button type="button" class="btn btn-primary mr-2 rounded-0 btn-theme-light" data-dismiss="modal">{{ __('translation.Close') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('custom-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js" integrity="sha512-pdCVFUWsxl1A4g0uV6fyJ3nrnTGeWnZN2Tl/56j45UvZ1OMdm9CIbctuIHj+yBIRTUUyv6I9+OivXj4i0LPEYA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var checkModal = new bootstrap.Modal(document.getElementById("checkCertificateModal"), {});

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
            beforeSend: function() {
                $('#completed_courses').html('<i class="fa fa-spinner me-2"></i> 가공');
            },
            success: function(response) {

                console.log(response.data)
                console.log(response.end_date)
                console.log(response.date)
                if (response.success == true) {
                    $('#completed_course_name').val(response.data.get_courses.course_title);
                    $('#c_name').text(response.data.get_courses.course_title);
                    $('#t_name').text(response.data.get_courses.get_tutor_name.english_name);
                    $('#certificate_start_date').text(response.date);
                    $('#certificate_end_date').text(response.end_date);
                    $('#issue_date').text(response.data.issue_date);
                    certificateModal.show();
                    $('#completed_courses').html('<i class="fas fa-medal"></i> {{ __("translation.Certificate") }} ');
                } else {
                    console.log(error)
                }

            },
            error: function(e) {}
        });
    }

    var showModal = new bootstrap.Modal(document.getElementById("reviewModal"), {});

    function reviewModal(id, btn) {
        $('#course_id').val(id);
        $('#course_name').val(btn.attr('data-course-name'));
        showModal.show();
    }

    var progressboxHeight = 0;
    $('.progress_lectures_list .lecture-box .lecture_box_content').each(function() {
        if ($(this).height() > progressboxHeight) {
            progressboxHeight = $(this).height() + 20;
        }
    });

    $('.progress_lectures_list .lecture-box .lecture_box_content').height(progressboxHeight);

    $('.page-side-menu-toggle').on('click', function() {
        $('.page-side-menu').slideToggle();
    });

    $("#addReview").on('submit', function(e) {
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
            beforeSend: function() {
                $("#submitForm").prop('disabled', true);
                $("#submitForm").html('<i class="fa fa-spinner fa-spin me-1"></i> 처리');
                $('.error-message ').hide();
            },
            success: function(res) {
                $("#submitForm").attr('class', 'btn btn-success');
                $("#submitForm").html('<i class="fa fa-check me-1"></i>  리뷰가 추가됨</>');
                if (res.success) {
                    $('.prompt').html('<div class="alert alert-success mb-3">' + res.message +
                        '</div>');
                    setTimeout(function() {
                        $('html, body').animate({
                            scrollTop: $("html, body").offset().top
                        }, 1000);
                    }, 1500);

                    setTimeout(function() {
                        $('.prompt').hide()
                        window.location.reload();
                    }, 4000);
                    $('.error-rating').html('');
                    $('.error-title').html('');
                    $('.error-content').html('');
                    $('.error-video').html('');
                    $('.error-video-url').html('');


                } else {}
            },
            error: function(e) {
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


    function completedCourses(value, id) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "{{ route('completed-courses-certificate') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                id: id,
            },
            beforeSend: function() {},
            success: function(res) {},
            error: function(e) {}
        });
    };


    window.onload = function() {
        document.getElementById("download")
            .addEventListener("click", () => {
                const certificate = this.document.getElementById("download_certificate");
                var opt = {
                    margin: [30, 0, 30, 0],
                    filename: 'certificate.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 0.98
                    },
                    html2canvas: {
                        scrollX: 0,
                        scrollY: 0
                    },
                    jsPDF: {
                        orientation: 'l',
                        unit: 'mm',
                        format: 'a4',
                        putOnlyUsedFonts: true,
                        floatPrecision: 16 // or "smart", default is 16
                    }

                };
                html2pdf().from(certificate).set(opt).save();
            })
    }

    $(document).ready(function(){
        let courseBoxContentHeight = 0;
        $('.completed-lectures-box').each(function(){
            if(courseBoxContentHeight < $(this).height()){
                courseBoxContentHeight = $(this).height();
            }
        });
        $('.completed-lectures-box').height(courseBoxContentHeight);
    });
</script>
@endsection
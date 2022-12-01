@extends('user.layout')
@section('title', 'ptedu - index')

@section('content')
<!-- banner start -->
<div class="banner_area">
    <div class="container">
        <div class="banner-content">
            <div class="banner-content-inner">
                <img src="{{ asset('web_assets/images/banner.gif') }}" class="img-fluid">
            </div>
        </div>
    </div>
</div>
<!-- banner end -->

<!-- interactive section  -->
<div class="interactive-section-1">
    <img src="{{ asset('web_assets/images/about_img_1.png') }}" class="interaction_img" alt="interaction_img">
</div>
<!-- interactive section end -->

<!-- interactive section  -->
<div class="interactive-section-2">
    <img src="{{ asset('web_assets/images/about_img_2.png') }}" class="interaction_img" alt="interaction_img">
</div>
<!-- interactive section end -->

<!-- course detail section -->
<div class="courses-detail section">
    <div class="container">
        <div class="interactive-section-content text-center">
            <div class="swiper courses_detail_carousel">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="row align-items-center">
                            <div class="col-md-4 p-4">
                                <img src="{{ asset('web_assets/images/gait_img.png') }}" class="img-fluid course-detail-img">
                            </div>
                            <div class="col-md-8 p-4">
                                <div class="d-flex align-items-end course-detail-author-content justify-content-between mb-4">
                                    <h3 class="heading-h3">GAIT : Walk A to Z</h3>
                                    <small>Jo Gyu-haeng Teacher</small>
                                </div>
                                <p class="text-left">An essential gait for returning to society from everyday life.How
                                    well do we know about the GAIT that everyone walks and everyone wants to walk? From
                                    basic knowledge of gait to clinical application, problem solving and application of
                                    pathological gait encompassing musculoskeletal and nervous system patients, and
                                    introduction of the latest trend in gait thesis based on evidence-based physical
                                    therapy.A story from A to Z about the parts I knew but missed, GAIT I hadn't thought
                                    of.</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="row align-items-center">
                            <div class="col-md-4 p-4">
                                <img src="{{ asset('web_assets/images/gait_img.png') }}" class="img-fluid course-detail-img">
                            </div>
                            <div class="col-md-8 p-4">
                                <div class="d-flex align-items-end course-detail-author-content justify-content-between mb-4">
                                    <h3 class="heading-h3">GAIT : Walk A to Z</h3>
                                    <small>Jo Gyu-haeng Teacher</small>
                                </div>
                                <p class="text-left">An essential gait for returning to society from everyday life.How
                                    well do we know about the GAIT that everyone walks and everyone wants to walk? From
                                    basic knowledge of gait to clinical application, problem solving and application of
                                    pathological gait encompassing musculoskeletal and nervous system patients, and
                                    introduction of the latest trend in gait thesis based on evidence-based physical
                                    therapy.A story from A to Z about the parts I knew but missed, GAIT I hadn't thought
                                    of.</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="row align-items-center">
                            <div class="col-md-4 p-4">
                                <img src="{{ asset('web_assets/images/gait_img.png') }}" class="img-fluid course-detail-img">
                            </div>
                            <div class="col-md-8 p-4">
                                <div class="d-flex align-items-end course-detail-author-content justify-content-between mb-4">
                                    <h3 class="heading-h3">GAIT : Walk A to Z</h3>
                                    <small>Jo Gyu-haeng Teacher</small>
                                </div>
                                <p class="text-left">An essential gait for returning to society from everyday life.How
                                    well do we know about the GAIT that everyone walks and everyone wants to walk? From
                                    basic knowledge of gait to clinical application, problem solving and application of
                                    pathological gait encompassing musculoskeletal and nervous system patients, and
                                    introduction of the latest trend in gait thesis based on evidence-based physical
                                    therapy.A story from A to Z about the parts I knew but missed, GAIT I hadn't thought
                                    of.</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="row align-items-center">
                            <div class="col-md-4 p-4">
                                <img src="{{ asset('web_assets/images/gait_img.png') }}" class="img-fluid course-detail-img">
                            </div>
                            <div class="col-md-8 p-4">
                                <div class="d-flex align-items-end course-detail-author-content justify-content-between mb-4">
                                    <h3 class="heading-h3">GAIT : Walk A to Z</h3>
                                    <small>Jo Gyu-haeng Teacher</small>
                                </div>
                                <p class="text-left">An essential gait for returning to society from everyday life.How
                                    well do we know about the GAIT that everyone walks and everyone wants to walk? From
                                    basic knowledge of gait to clinical application, problem solving and application of
                                    pathological gait encompassing musculoskeletal and nervous system patients, and
                                    introduction of the latest trend in gait thesis based on evidence-based physical
                                    therapy.A story from A to Z about the parts I knew but missed, GAIT I hadn't thought
                                    of.</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="row align-items-center">
                            <div class="col-md-4 p-4">
                                <img src="{{ asset('web_assets/images/gait_img.png') }}" class="img-fluid course-detail-img">
                            </div>
                            <div class="col-md-8 p-4">
                                <div class="d-flex align-items-end course-detail-author-content justify-content-between mb-4">
                                    <h3 class="heading-h3">GAIT : Walk A to Z</h3>
                                    <small>Jo Gyu-haeng Teacher</small>
                                </div>
                                <p class="text-left">An essential gait for returning to society from everyday life.How
                                    well do we know about the GAIT that everyone walks and everyone wants to walk? From
                                    basic knowledge of gait to clinical application, problem solving and application of
                                    pathological gait encompassing musculoskeletal and nervous system patients, and
                                    introduction of the latest trend in gait thesis based on evidence-based physical
                                    therapy.A story from A to Z about the parts I knew but missed, GAIT I hadn't thought
                                    of.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="courses-detail-pagination"></div>
            </div>
        </div>
    </div>
</div>
<!-- course detail section end -->

<!-- course type section start -->
<div class="courses-type section">
    <div class="container">
        <div class="interactive-section-content text-center mb-5">
            <div class="section-part mb-80">
                <div class="section-title mb-5">
                    <small class="mb-2 text-white">ABOUT COURSE</small>
                    <h3 class="heading-h3 text-white mb-0">Expert Course</h3>
                </div>
                <div class="swiper expert-course-carousel">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide position-relative">
                            <img src="{{ asset('web_assets/images/course_img_1.png') }}" class="img-fluid course-detail-img">
                            <div class="box-overlay">
                                <h5 class="heading-h5 mb-3 text-white text-left">GAIT : 보행 A에서 Z까지</h5>
                                <div class="box-overlay-description text-left">
                                    <p class="mb-0 text-white">고유 수용성 신경근 촉진법, 물리치료사에게 추천하는 기본에 충신한 PNF강의, 그리고 그 이상의 PNF, 필드에서 바로 사용 할 수 있는 쉽고 간단한 입문 개론</p>
                                </div>
                                <p class="mb-0 text-right text-white font-weight-600">강사 조규행</p>
                            </div>
                        </div>
                        <div class="swiper-slide position-relative">
                            <img src="{{ asset('web_assets/images/course_img_2.png') }}" class="img-fluid course-detail-img">
                            <div class="box-overlay">
                                <h5 class="heading-h5 mb-3 text-white text-left">GAIT : 보행 A에서 Z까지</h5>
                                <div class="box-overlay-description text-left">
                                    <p class="mb-0 text-white">고유 수용성 신경근 촉진법, 물리치료사에게 추천하는 기본에 충신한 PNF강의, 그리고 그 이상의 PNF, 필드에서 바로 사용 할 수 있는 쉽고 간단한 입문 개론</p>
                                </div>
                                <p class="mb-0 text-right text-white font-weight-600">강사 조규행</p>
                            </div>
                        </div>
                        <div class="swiper-slide position-relative">
                            <img src="{{ asset('web_assets/images/course_img_1.png') }}" class="img-fluid course-detail-img">
                            <div class="box-overlay">
                                <h5 class="heading-h5 mb-3 text-white text-left">GAIT : 보행 A에서 Z까지</h5>
                                <div class="box-overlay-description text-left">
                                    <p class="mb-0 text-white">고유 수용성 신경근 촉진법, 물리치료사에게 추천하는 기본에 충신한 PNF강의, 그리고 그 이상의 PNF, 필드에서 바로 사용 할 수 있는 쉽고 간단한 입문 개론</p>
                                </div>
                                <p class="mb-0 text-right text-white font-weight-600">강사 조규행</p>
                            </div>
                        </div>
                        <div class="swiper-slide position-relative">
                            <img src="{{ asset('web_assets/images/course_img_2.png') }}" class="img-fluid course-detail-img">
                            <div class="box-overlay">
                                <h5 class="heading-h5 mb-3 text-white text-left">GAIT : 보행 A에서 Z까지</h5>
                                <div class="box-overlay-description text-left">
                                    <p class="mb-0 text-white">고유 수용성 신경근 촉진법, 물리치료사에게 추천하는 기본에 충신한 PNF강의, 그리고 그 이상의 PNF, 필드에서 바로 사용 할 수 있는 쉽고 간단한 입문 개론</p>
                                </div>
                                <p class="mb-0 text-right text-white font-weight-600">강사 조규행</p>
                            </div>
                        </div>
                        <div class="swiper-slide position-relative">
                            <img src="{{ asset('web_assets/images/course_img_1.png') }}" class="img-fluid course-detail-img">
                            <div class="box-overlay">
                                <h5 class="heading-h5 mb-3 text-white text-left">GAIT : 보행 A에서 Z까지</h5>
                                <div class="box-overlay-description text-left">
                                    <p class="mb-0 text-white">고유 수용성 신경근 촉진법, 물리치료사에게 추천하는 기본에 충신한 PNF강의, 그리고 그 이상의 PNF, 필드에서 바로 사용 할 수 있는 쉽고 간단한 입문 개론</p>
                                </div>
                                <p class="mb-0 text-right text-white font-weight-600">강사 조규행</p>
                            </div>
                        </div>
                        <div class="swiper-slide position-relative">
                            <img src="{{ asset('web_assets/images/course_img_2.png') }}" class="img-fluid course-detail-img">
                            <div class="box-overlay">
                                <h5 class="heading-h5 mb-3 text-white text-left">GAIT : 보행 A에서 Z까지</h5>
                                <div class="box-overlay-description text-left">
                                    <p class="mb-0 text-white">고유 수용성 신경근 촉진법, 물리치료사에게 추천하는 기본에 충신한 PNF강의, 그리고 그 이상의 PNF, 필드에서 바로 사용 할 수 있는 쉽고 간단한 입문 개론</p>
                                </div>
                                <p class="mb-0 text-right text-white font-weight-600">강사 조규행</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next expert-course-next"></div>
                <div class="swiper-button-prev expert-course-prev"></div>
            </div>
            <div class="section-part mb-80">
                <div class="section-title mb-5">
                    <small class="mb-2 text-white">ABOUT COURSE</small>
                    <h3 class="heading-h3 text-white mb-0">Public Course</h3>
                </div>
                <div class="swiper public-course-carousel">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="{{ asset('web_assets/images/course_img_1.png') }}" class="img-fluid course-detail-img">
                            <div class="box-overlay">
                                <h5 class="heading-h5 mb-3 text-white text-left">GAIT : 보행 A에서 Z까지</h5>
                                <div class="box-overlay-description text-left">
                                    <p class="mb-0 text-white">고유 수용성 신경근 촉진법, 물리치료사에게 추천하는 기본에 충신한 PNF강의, 그리고 그 이상의 PNF, 필드에서 바로 사용 할 수 있는 쉽고 간단한 입문 개론</p>
                                </div>
                                <p class="mb-0 text-right text-white font-weight-600">강사 조규행</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('web_assets/images/course_img_2.png') }}" class="img-fluid course-detail-img">
                            <div class="box-overlay">
                                <h5 class="heading-h5 mb-3 text-white text-left">GAIT : 보행 A에서 Z까지</h5>
                                <div class="box-overlay-description text-left">
                                    <p class="mb-0 text-white">고유 수용성 신경근 촉진법, 물리치료사에게 추천하는 기본에 충신한 PNF강의, 그리고 그 이상의 PNF, 필드에서 바로 사용 할 수 있는 쉽고 간단한 입문 개론</p>
                                </div>
                                <p class="mb-0 text-right text-white font-weight-600">강사 조규행</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('web_assets/images/course_img_1.png') }}" class="img-fluid course-detail-img">
                            <div class="box-overlay">
                                <h5 class="heading-h5 mb-3 text-white text-left">GAIT : 보행 A에서 Z까지</h5>
                                <div class="box-overlay-description text-left">
                                    <p class="mb-0 text-white">고유 수용성 신경근 촉진법, 물리치료사에게 추천하는 기본에 충신한 PNF강의, 그리고 그 이상의 PNF, 필드에서 바로 사용 할 수 있는 쉽고 간단한 입문 개론</p>
                                </div>
                                <p class="mb-0 text-right text-white font-weight-600">강사 조규행</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('web_assets/images/course_img_2.png') }}" class="img-fluid course-detail-img">
                            <div class="box-overlay">
                                <h5 class="heading-h5 mb-3 text-white text-left">GAIT : 보행 A에서 Z까지</h5>
                                <div class="box-overlay-description text-left">
                                    <p class="mb-0 text-white">고유 수용성 신경근 촉진법, 물리치료사에게 추천하는 기본에 충신한 PNF강의, 그리고 그 이상의 PNF, 필드에서 바로 사용 할 수 있는 쉽고 간단한 입문 개론</p>
                                </div>
                                <p class="mb-0 text-right text-white font-weight-600">강사 조규행</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('web_assets/images/course_img_1.png') }}" class="img-fluid course-detail-img">
                            <div class="box-overlay">
                                <h5 class="heading-h5 mb-3 text-white text-left">GAIT : 보행 A에서 Z까지</h5>
                                <div class="box-overlay-description text-left">
                                    <p class="mb-0 text-white">고유 수용성 신경근 촉진법, 물리치료사에게 추천하는 기본에 충신한 PNF강의, 그리고 그 이상의 PNF, 필드에서 바로 사용 할 수 있는 쉽고 간단한 입문 개론</p>
                                </div>
                                <p class="mb-0 text-right text-white font-weight-600">강사 조규행</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('web_assets/images/course_img_2.png') }}" class="img-fluid course-detail-img">
                            <div class="box-overlay">
                                <h5 class="heading-h5 mb-3 text-white text-left">GAIT : 보행 A에서 Z까지</h5>
                                <div class="box-overlay-description text-left">
                                    <p class="mb-0 text-white">고유 수용성 신경근 촉진법, 물리치료사에게 추천하는 기본에 충신한 PNF강의, 그리고 그 이상의 PNF, 필드에서 바로 사용 할 수 있는 쉽고 간단한 입문 개론</p>
                                </div>
                                <p class="mb-0 text-right text-white font-weight-600">강사 조규행</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next public-course-next"></div>
                <div class="swiper-button-prev public-course-prev"></div>
            </div>
            <div class="section-part mb-80">
                <div class="section-title mb-5">
                    <small class="mb-2 text-white">ABOUT COURSE</small>
                    <h3 class="heading-h3 text-white mb-0">Offline Lecture</h3>
                </div>
                <div class="swiper offline-lecture-carousel">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="{{ asset('web_assets/images/course_img_1.png') }}" class="img-fluid course-detail-img">
                            <div class="box-overlay">
                                <h5 class="heading-h5 mb-3 text-white text-left">GAIT : 보행 A에서 Z까지</h5>
                                <div class="box-overlay-description text-left">
                                    <p class="mb-0 text-white">고유 수용성 신경근 촉진법, 물리치료사에게 추천하는 기본에 충신한 PNF강의, 그리고 그 이상의 PNF, 필드에서 바로 사용 할 수 있는 쉽고 간단한 입문 개론</p>
                                </div>
                                <p class="mb-0 text-right text-white font-weight-600">강사 조규행</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('web_assets/images/course_img_2.png') }}" class="img-fluid course-detail-img">
                            <div class="box-overlay">
                                <h5 class="heading-h5 mb-3 text-white text-left">GAIT : 보행 A에서 Z까지</h5>
                                <div class="box-overlay-description text-left">
                                    <p class="mb-0 text-white">고유 수용성 신경근 촉진법, 물리치료사에게 추천하는 기본에 충신한 PNF강의, 그리고 그 이상의 PNF, 필드에서 바로 사용 할 수 있는 쉽고 간단한 입문 개론</p>
                                </div>
                                <p class="mb-0 text-right text-white font-weight-600">강사 조규행</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('web_assets/images/course_img_1.png') }}" class="img-fluid course-detail-img">
                            <div class="box-overlay">
                                <h5 class="heading-h5 mb-3 text-white text-left">GAIT : 보행 A에서 Z까지</h5>
                                <div class="box-overlay-description text-left">
                                    <p class="mb-0 text-white">고유 수용성 신경근 촉진법, 물리치료사에게 추천하는 기본에 충신한 PNF강의, 그리고 그 이상의 PNF, 필드에서 바로 사용 할 수 있는 쉽고 간단한 입문 개론</p>
                                </div>
                                <p class="mb-0 text-right text-white font-weight-600">강사 조규행</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('web_assets/images/course_img_2.png') }}" class="img-fluid course-detail-img">
                            <div class="box-overlay">
                                <h5 class="heading-h5 mb-3 text-white text-left">GAIT : 보행 A에서 Z까지</h5>
                                <div class="box-overlay-description text-left">
                                    <p class="mb-0 text-white">고유 수용성 신경근 촉진법, 물리치료사에게 추천하는 기본에 충신한 PNF강의, 그리고 그 이상의 PNF, 필드에서 바로 사용 할 수 있는 쉽고 간단한 입문 개론</p>
                                </div>
                                <p class="mb-0 text-right text-white font-weight-600">강사 조규행</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('web_assets/images/course_img_1.png') }}" class="img-fluid course-detail-img">
                            <div class="box-overlay">
                                <h5 class="heading-h5 mb-3 text-white text-left">GAIT : 보행 A에서 Z까지</h5>
                                <div class="box-overlay-description text-left">
                                    <p class="mb-0 text-white">고유 수용성 신경근 촉진법, 물리치료사에게 추천하는 기본에 충신한 PNF강의, 그리고 그 이상의 PNF, 필드에서 바로 사용 할 수 있는 쉽고 간단한 입문 개론</p>
                                </div>
                                <p class="mb-0 text-right text-white font-weight-600">강사 조규행</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('web_assets/images/course_img_2.png') }}" class="img-fluid course-detail-img">
                            <div class="box-overlay">
                                <h5 class="heading-h5 mb-3 text-white text-left">GAIT : 보행 A에서 Z까지</h5>
                                <div class="box-overlay-description text-left">
                                    <p class="mb-0 text-white">고유 수용성 신경근 촉진법, 물리치료사에게 추천하는 기본에 충신한 PNF강의, 그리고 그 이상의 PNF, 필드에서 바로 사용 할 수 있는 쉽고 간단한 입문 개론</p>
                                </div>
                                <p class="mb-0 text-right text-white font-weight-600">강사 조규행</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next offline-lecture-next"></div>
                <div class="swiper-button-prev offline-lecture-prev"></div>
            </div>
            <div class="section-part">
                <div class="section-title mb-5">
                    <small class="mb-2 text-white">ABOUT INSTRUCTOR</small>
                    <h3 class="heading-h3 text-white mb-0">Tutor Introduction</h3>
                </div>
                <div class="row align-items-center justify-content-left">
                    <div class="col-lg-3 col-md-4 col-12 mb-4">
                        <div class="tutor-image-container">
                            <img src="{{ asset('web_assets/images/tutor_img_1.png') }}" class="tutor_img img-fluid">
                            <div class="box-overlay">
                                <h5 class="heading-h5 mb-3 text-white text-left">GAIT : 보행 A에서 Z까지</h5>
                                <div class="box-overlay-description text-left">
                                    <p class="mb-0 text-white">고유 수용성 신경근 촉진법, 물리치료사에게 추천하는 기본에 충신한 PNF강의, 그리고 그 이상의 PNF, 필드에서 바로 사용 할 수 있는 쉽고 간단한 입문 개론</p>
                                </div>
                                <p class="mb-0 text-right text-white font-weight-600">강사 조규행</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-12 mb-4">
                        <div class="tutor-image-container">
                            <img src="{{ asset('web_assets/images/tutor_img_1.png') }}" class="tutor_img img-fluid">
                            <div class="box-overlay">
                                <h5 class="heading-h5 mb-3 text-white text-left">GAIT : 보행 A에서 Z까지</h5>
                                <div class="box-overlay-description text-left">
                                    <p class="mb-0 text-white">고유 수용성 신경근 촉진법, 물리치료사에게 추천하는 기본에 충신한 PNF강의, 그리고 그 이상의 PNF, 필드에서 바로 사용 할 수 있는 쉽고 간단한 입문 개론</p>
                                </div>
                                <p class="mb-0 text-right text-white font-weight-600">강사 조규행</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-12 mb-4">
                        <div class="tutor-image-container">
                            <img src="{{ asset('web_assets/images/tutor_img_1.png') }}" class="tutor_img img-fluid">
                            <div class="box-overlay">
                                <h5 class="heading-h5 mb-3 text-white text-left">GAIT : 보행 A에서 Z까지</h5>
                                <div class="box-overlay-description text-left">
                                    <p class="mb-0 text-white">고유 수용성 신경근 촉진법, 물리치료사에게 추천하는 기본에 충신한 PNF강의, 그리고 그 이상의 PNF, 필드에서 바로 사용 할 수 있는 쉽고 간단한 입문 개론</p>
                                </div>
                                <p class="mb-0 text-right text-white font-weight-600">강사 조규행</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-12 mb-4">
                        <div class="tutor-image-container">
                            <img src="{{ asset('web_assets/images/tutor_img_1.png') }}" class="tutor_img img-fluid">
                            <div class="box-overlay">
                                <h5 class="heading-h5 mb-3 text-white text-left">GAIT : 보행 A에서 Z까지</h5>
                                <div class="box-overlay-description text-left">
                                    <p class="mb-0 text-white">고유 수용성 신경근 촉진법, 물리치료사에게 추천하는 기본에 충신한 PNF강의, 그리고 그 이상의 PNF, 필드에서 바로 사용 할 수 있는 쉽고 간단한 입문 개론</p>
                                </div>
                                <p class="mb-0 text-right text-white font-weight-600">강사 조규행</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-12 mb-4">
                        <div class="tutor-image-container">
                            <img src="{{ asset('web_assets/images/tutor_img_1.png') }}" class="tutor_img img-fluid">
                            <div class="box-overlay">
                                <h5 class="heading-h5 mb-3 text-white text-left">GAIT : 보행 A에서 Z까지</h5>
                                <div class="box-overlay-description text-left">
                                    <p class="mb-0 text-white">고유 수용성 신경근 촉진법, 물리치료사에게 추천하는 기본에 충신한 PNF강의, 그리고 그 이상의 PNF, 필드에서 바로 사용 할 수 있는 쉽고 간단한 입문 개론</p>
                                </div>
                                <p class="mb-0 text-right text-white font-weight-600">강사 조규행</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-12 mb-4">
                        <div class="tutor-image-container">
                            <img src="{{ asset('web_assets/images/tutor_img_1.png') }}" class="tutor_img img-fluid">
                            <div class="box-overlay">
                                <h5 class="heading-h5 mb-3 text-white text-left">GAIT : 보행 A에서 Z까지</h5>
                                <div class="box-overlay-description text-left">
                                    <p class="mb-0 text-white">고유 수용성 신경근 촉진법, 물리치료사에게 추천하는 기본에 충신한 PNF강의, 그리고 그 이상의 PNF, 필드에서 바로 사용 할 수 있는 쉽고 간단한 입문 개론</p>
                                </div>
                                <p class="mb-0 text-right text-white font-weight-600">강사 조규행</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-12 mb-4">
                        <div class="tutor-image-container">
                            <img src="{{ asset('web_assets/images/tutor_img_1.png') }}" class="tutor_img img-fluid">
                            <div class="box-overlay">
                                <h5 class="heading-h5 mb-3 text-white text-left">GAIT : 보행 A에서 Z까지</h5>
                                <div class="box-overlay-description text-left">
                                    <p class="mb-0 text-white">고유 수용성 신경근 촉진법, 물리치료사에게 추천하는 기본에 충신한 PNF강의, 그리고 그 이상의 PNF, 필드에서 바로 사용 할 수 있는 쉽고 간단한 입문 개론</p>
                                </div>
                                <p class="mb-0 text-right text-white font-weight-600">강사 조규행</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-12 mb-4">
                        <div class="tutor-image-container">
                            <img src="{{ asset('web_assets/images/tutor_img_1.png') }}" class="tutor_img img-fluid">
                            <div class="box-overlay">
                                <h5 class="heading-h5 mb-3 text-white text-left">GAIT : 보행 A에서 Z까지</h5>
                                <div class="box-overlay-description text-left">
                                    <p class="mb-0 text-white">고유 수용성 신경근 촉진법, 물리치료사에게 추천하는 기본에 충신한 PNF강의, 그리고 그 이상의 PNF, 필드에서 바로 사용 할 수 있는 쉽고 간단한 입문 개론</p>
                                </div>
                                <p class="mb-0 text-right text-white font-weight-600">강사 조규행</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- course type section end -->

<!-- course review section start -->
<div class="courses-review section">
    <div class="container">
        <div class="interactive-section-content text-center">
            <div class="section-part mb-5">
                <div class="section-title mb-5">
                    <small class="mb-2">ABOUT STUDENTS</small>
                    <h3 class="heading-h3 mb-0">Course Review</h3>
                </div>
                <div class="swiper course-review-carousel">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="{{ asset('web_assets/images/course_review_1.png') }}" class="img-fluid course-review-img">
                            <div class="review_video_box_overlay">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('web_assets/images/icon_play.png') }}" height="60" alt="icon_img">
                                </a>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('web_assets/images/course_review_2.jpg') }}" class="img-fluid course-review-img">
                            <div class="review_video_box_overlay">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('web_assets/images/icon_play.png') }}" height="60" alt="icon_img">
                                </a>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('web_assets/images/course_review_3.png') }}" class="img-fluid course-review-img">
                            <div class="review_video_box_overlay">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('web_assets/images/icon_play.png') }}" height="60" alt="icon_img">
                                </a>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('web_assets/images/course_review_4.png') }}" class="img-fluid course-review-img">
                            <div class="review_video_box_overlay">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('web_assets/images/icon_play.png') }}" height="60" alt="icon_img">
                                </a>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('web_assets/images/course_review_5.png') }}" class="img-fluid course-review-img">
                            <div class="review_video_box_overlay">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('web_assets/images/icon_play.png') }}" height="60" alt="icon_img">
                                </a>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('web_assets/images/course_review_4.png') }}" class="img-fluid course-review-img">
                            <div class="review_video_box_overlay">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('web_assets/images/icon_play.png') }}" height="60" alt="icon_img">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next course-review-next"></div>
                <div class="swiper-button-prev course-review-prev"></div>
            </div>
        </div>
    </div>
</div>
<!-- course review section end -->
@endsection

@section('custom-script')
<script>
    var swiper = new Swiper(".courses_detail_carousel", {
        spaceBetween: 30,
        pagination: {
            el: ".courses-detail-pagination",
            clickable: true,
        },
    });

    var swiper = new Swiper(".expert-course-carousel", {
        slidesPerView: 3,
        spaceBetween: 30,
        slidesPerGroup: 1,
        loop: true,
        loopFillGroupWithBlank: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".expert-course-next",
            prevEl: ".expert-course-prev",
        },
        breakpoints: {
            // when window width is >= 320px
            320: {
                slidesPerView: 1,
                spaceBetween: 10
            },
            // when window width is >= 480px
            480: {
                slidesPerView: 1,
                spaceBetween: 10
            },
            // when window width is >= 640px
            767: {
                slidesPerView: 2,
                spaceBetween: 15
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 20
            }
        }
    });

    var swiper = new Swiper(".public-course-carousel", {
        slidesPerView: 3,
        spaceBetween: 30,
        slidesPerGroup: 1,
        loop: true,
        loopFillGroupWithBlank: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".public-course-next",
            prevEl: ".public-course-prev",
        },
        breakpoints: {
            // when window width is >= 320px
            320: {
                slidesPerView: 1,
                spaceBetween: 10
            },
            // when window width is >= 480px
            480: {
                slidesPerView: 1,
                spaceBetween: 10
            },
            // when window width is >= 640px
            767: {
                slidesPerView: 2,
                spaceBetween: 15
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 20
            }
        }
    });

    var swiper = new Swiper(".offline-lecture-carousel", {
        slidesPerView: 3,
        spaceBetween: 30,
        slidesPerGroup: 1,
        loop: true,
        loopFillGroupWithBlank: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".offline-lecture-next",
            prevEl: ".offline-lecture-prev",
        },
        breakpoints: {
            // when window width is >= 320px
            320: {
                slidesPerView: 1,
                spaceBetween: 10
            },
            // when window width is >= 480px
            480: {
                slidesPerView: 1,
                spaceBetween: 10
            },
            // when window width is >= 640px
            767: {
                slidesPerView: 2,
                spaceBetween: 15
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 20
            }
        }
    });

    var swiper = new Swiper(".course-review-carousel", {
        slidesPerView: 3,
        spaceBetween: 30,
        slidesPerGroup: 1,
        loop: true,
        loopFillGroupWithBlank: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: ".course-review-next",
            prevEl: ".course-review-prev",
        },
        breakpoints: {
            // when window width is >= 320px
            320: {
                slidesPerView: 1,
                spaceBetween: 10
            },
            // when window width is >= 480px
            480: {
                slidesPerView: 1,
                spaceBetween: 10
            },
            // when window width is >= 640px
            767: {
                slidesPerView: 2,
                spaceBetween: 15
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 20
            }
        }
    });

    var distance = $('.interactive-section-1').offset().top;
    var distance2 = $('.interactive-section-2').offset().top;
    var distance3 = $('.courses-detail').offset().top;
    var verticalHeight = $(window).height() * 2;
    var verticalHeight2 = $(window).height() * 5;
    $(window).scroll(function() {
        console.log(distance2);
        if ($(this).scrollTop() >= distance) {
            $('.interactive-section-1').addClass('fixed-section');
        }else{
            $('.interactive-section-1').removeClass('fixed-section');
        }

        if($(this).scrollTop() >= distance2 - verticalHeight){
            $('.interactive-section-2').addClass('fixed-section-2');
        }else{
            $('.interactive-section-2').removeClass('fixed-section-2');
        }

        if($(this).scrollTop() >= distance3 - verticalHeight2){
            $('.courses-detail').addClass('fixed-section-3');
        }else{
            $('.courses-detail').removeClass('fixed-section-3');
        }
    });
</script>
@endsection

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
        <div class="container">
            <div class="interactive-section-content">
                <h2 class="heading-h2"><span class="text-white">We are on the right track</span><br><span
                        class="text-theme-light">From begineer to expert as a professional</span><br><span
                        class="text-white">Increasing Thinking ability</span><br><span class="text-theme-light">Beyond
                        limits</span></h2>
            </div>
        </div>
    </div>
    <!-- interactive section end -->

    <!-- interactive section  -->
    <div class="interactive-section-2">
        <div class="container">
            <div class="interactive-section-content">
                <h3 class="heading-h3 mx-1 text-right"><span class="text-theme-light">Ability for</span><br><span
                        class="text-white">Tailored Individual</span><br><span
                        class="text-theme-light">Intervention</span><br><span class="text-white">For the
                        Client's</span><br><span class="text-theme-light">Quality of Life</span></h3>
                <img src="{{ asset('web_assets/images/box-img.png') }}" class="mx-2" height="170">
                <div class="interactive-section-text mx-1">
                    <h3 class="heading-h3"><span class="text-white">PTEdu<sub>®</sub></span><br><span
                            class="text-theme-light">Off-line education</span><br><span class="text-white">On-line
                            education</span><br><span class="text-theme-light">Health & wellbeing studio</span><br><span
                            class="web_badge">http://ptedu.kr</span></h3>
                </div>
                <img src="{{ asset('web_assets/images/street_light.png') }}" class="mx-2" height="100">
            </div>
        </div>
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
                                    <img src="{{ asset('web_assets/images/course_img.png') }}" class="img-fluid course-detail-img">
                                </div>
                                <div class="col-md-8 p-4">
                                    <div
                                        class="d-flex align-items-end course-detail-author-content justify-content-between mb-4">
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
                                    <img src="{{ asset('web_assets/images/course_img.png') }}" class="img-fluid course-detail-img">
                                </div>
                                <div class="col-md-8 p-4">
                                    <div
                                        class="d-flex align-items-end course-detail-author-content justify-content-between mb-4">
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
                                    <img src="{{ asset('web_assets/images/course_img.png') }}" class="img-fluid course-detail-img">
                                </div>
                                <div class="col-md-8 p-4">
                                    <div
                                        class="d-flex align-items-end course-detail-author-content justify-content-between mb-4">
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
                                    <img src="{{ asset('web_assets/images/course_img.png') }}" class="img-fluid course-detail-img">
                                </div>
                                <div class="col-md-8 p-4">
                                    <div
                                        class="d-flex align-items-end course-detail-author-content justify-content-between mb-4">
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
                                    <img src="{{ asset('web_assets/images/course_img.png') }}" class="img-fluid course-detail-img">
                                </div>
                                <div class="col-md-8 p-4">
                                    <div
                                        class="d-flex align-items-end course-detail-author-content justify-content-between mb-4">
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
                            <div class="swiper-slide">
                                <img src="{{ asset('web_assets/images/course_img.png') }}" class="img-fluid course-detail-img">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('web_assets/images/course_img.png') }}" class="img-fluid course-detail-img">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('web_assets/images/course_img.png') }}" class="img-fluid course-detail-img">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('web_assets/images/course_img.png') }}" class="img-fluid course-detail-img">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('web_assets/images/course_img.png') }}" class="img-fluid course-detail-img">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('web_assets/images/course_img.png') }}" class="img-fluid course-detail-img">
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
                                <img src="{{ asset('web_assets/images/course_img.png') }}" class="img-fluid course-detail-img">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('web_assets/images/course_img.png') }}" class="img-fluid course-detail-img">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('web_assets/images/course_img.png') }}" class="img-fluid course-detail-img">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('web_assets/images/course_img.png') }}" class="img-fluid course-detail-img">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('web_assets/images/course_img.png') }}" class="img-fluid course-detail-img">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('web_assets/images/course_img.png') }}" class="img-fluid course-detail-img">
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
                                <img src="{{ asset('web_assets/images/course_img.png') }}" class="img-fluid course-detail-img">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('web_assets/images/course_img.png') }}" class="img-fluid course-detail-img">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('web_assets/images/course_img.png') }}" class="img-fluid course-detail-img">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('web_assets/images/course_img.png') }}" class="img-fluid course-detail-img">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('web_assets/images/course_img.png') }}" class="img-fluid course-detail-img">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('web_assets/images/course_img.png') }}" class="img-fluid course-detail-img">
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
                        <div class="col-lg-2 col-md-4 col-6 mb-4">
                            <div class="tutor-image-container">
                                <img src="{{ asset('web_assets/images/tutor_img.png') }}" class="tutor_img img-fluid">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-4">
                            <div class="tutor-image-container">
                                <img src="{{ asset('web_assets/images/tutor_img.png') }}" class="tutor_img img-fluid">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-4">
                            <div class="tutor-image-container">
                                <img src="{{ asset('web_assets/images/tutor_img.png') }}" class="tutor_img img-fluid">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-4">
                            <div class="tutor-image-container">
                                <img src="{{ asset('web_assets/images/tutor_img.png') }}" class="tutor_img img-fluid">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-4">
                            <div class="tutor-image-container">
                                <img src="{{ asset('web_assets/images/tutor_img.png') }}" class="tutor_img img-fluid">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-4">
                            <div class="tutor-image-container">
                                <img src="{{ asset('web_assets/images/tutor_img.png') }}" class="tutor_img img-fluid">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-4">
                            <div class="tutor-image-container">
                                <img src="{{ asset('web_assets/images/tutor_img.png') }}" class="tutor_img img-fluid">
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-4">
                            <div class="tutor-image-container">
                                <img src="{{ asset('web_assets/images/tutor_img.png') }}" class="tutor_img img-fluid">
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
                                <img src="{{ asset('web_assets/images/course_img.png') }}" class="img-fluid course-detail-img">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('web_assets/images/course_img.png') }}" class="img-fluid course-detail-img">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('web_assets/images/course_img.png') }}" class="img-fluid course-detail-img">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('web_assets/images/course_img.png') }}" class="img-fluid course-detail-img">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('web_assets/images/course_img.png') }}" class="img-fluid course-detail-img">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('web_assets/images/course_img.png') }}" class="img-fluid course-detail-img">
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
      slidesPerGroup: 3,
      loop: true,
      loopFillGroupWithBlank: true,
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
      slidesPerGroup: 3,
      loop: true,
      loopFillGroupWithBlank: true,
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
      slidesPerGroup: 3,
      loop: true,
      loopFillGroupWithBlank: true,
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
      slidesPerGroup: 3,
      loop: true,
      loopFillGroupWithBlank: true,
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
  </script>
@endsection
@extends('user.layout')
@section('title', 'ptedu - index')

@section('content')
<!-- banner start -->
<div class="banner_area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 col-md-12 banner-left-content">
                <img src="{{ asset('web_assets/images/banner-logo.png') }}" height="60" alt="img-fluid" class="mb-3">
                <p class="text-theme-light-grey">Education is not the learning of facts,<br>but the traning of the mind to think.</p>
            </div>
            <div class="col-lg-8 col-md-12 text-center">
                <img src="{{ asset('web_assets/banner.gif') }}" alt="banner-img" class="img-fluid">
            </div>
        </div>
    </div>
</div>
<!-- banner end -->

<!-- interactive section  -->
<div class="interactive-section-1">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <h2 class="text-white">Increasing thinking ability</h2>
                <p class="text-danger mb-4">Global standard / Evidence based / Job based</p>
            </div>
            <div class="col-lg-12">
            <div class="row align-items-start">
                <div class="col-lg-6" style="border-right: 1px solid #343638">
                    <p class="mb-0 text-white font-25"  style="padding-right: 60px">
                        사람들에게 선한 영향력을 전달하기 위해 정진하는 <br />
                        모든 물리치료사 및 운동 전문가들을 환영합니다. <br />
                        피티에듀는 기초부터 심화 과정까지 올바른 지식을 <br />
                        통해 전문가로 거듭남으로 형태의 변화에 대한 발판을 <br/>
                        제공하는 교육 전문 플랫폼입니다</p>
                </div>
                <div class="col-lg-6">
                    <p class="mb-0 text-white font-25" style="padding-left: 60px">
                        여러 치료사들이 모여 논문과 임상 경험을 베이스로 한 <br />
                        근거 기반 물리치료를 토대로 다양한 정보들을 <br />
                        선별하여 질높은 강의를 제공합니다. <br />
                        분야별 맞춤식 강의를 통해 개인의 역량을 향상시키고 <br />
                        더 나아가 건강한 대한민국을 만드는 데에 이바지합니다</p>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<!-- interactive section end -->


<!-- course type section start -->
<div class="courses-type section">
    <div class="container">
        <div class="interactive-section-content  mb-5">
            @if ($courses->count() > 0)
            <div class="section-part mb-80">
                <div class="section-title mb-5">
                    <h3 class="heading-h3 text-center text-white mb-0">Online Courses</h3>
                </div>
                <div class="swiper expert-course-carousel">
                    <div class="swiper-wrapper">
                        @foreach ($courses as $item)
                        <div class="swiper-slide position-relative">
                            <img src="{{ asset('storage/course/thumbnail/' . $item->course_thumbnail) }}" class="img-fluid course-detail-img">
                            <div class="box-overlay">
                                <a href="{{ route('online_course_detail', $item->id) }}">
                                    <h5 class="heading-h5 mb-3 text-white text-left">{{ $item->course_title }}
                                    </h5>
                                    <div class="box-overlay-description text-left">
                                        <p class="mb-0 text-white">{{ $item->short_description }}</p>
                                    </div>
                                    <p class="mb-0 text-right text-white font-weight-600">
                                        {{ __('translation.Instructor') }}
                                        {{ $item->getTutorName->name }}
                                    </p>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="swiper-button-next expert-course-next"></div>
                <div class="swiper-button-prev expert-course-prev"></div>
            </div>
            @endif
            @if ($offline_courses->count() > 0)
            <div class="section-part mb-80">
                <div class="section-title mb-5">
                    <h3 class="heading-h3 text-center text-white mb-0">Offline Courses</h3>
                </div>
                <div class="swiper offline-lecture-carousel">
                    <div class="swiper-wrapper">
                        @foreach ($offline_courses as $item)
                        <div class="swiper-slide position-relative">
                            <img src="{{ asset('storage/offline_course/thumbnail/' . $item->course_thumbnail) }}" class="img-fluid course-detail-img">
                            <div class="box-overlay">
                                <a href="{{ route('online_course_detail', $item->id) }}">
                                    <h5 class="heading-h5 mb-3 text-white text-left">{{ $item->course_title }}
                                    </h5>
                                    <div class="box-overlay-description text-left">
                                        <p class="mb-0 text-white">{{ $item->short_description }}</p>
                                    </div>
                                    <p class="mb-0 text-right text-white font-weight-600">
                                        {{ __('translation.Instructor') }}
                                        {{ $item->getTutorName->name }}
                                    </p>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="swiper-button-next offline-lecture-next"></div>
                <div class="swiper-button-prev offline-lecture-prev"></div>
            </div>
            @endif
            @if ($special_course->count() > 0)
            <div class="section-part mb-80">
                <div class="section-title mb-5">
                    <h3 class="heading-h3 text-center text-white mb-0">Special Courses</h3>
                </div>
                <div class="swiper special-course-carousel">
                    <div class="swiper-wrapper">
                        @foreach ($special_course as $item)
                        <div class="swiper-slide position-relative">
                            <img src="{{ asset('storage/course/thumbnail/' . $item->course_thumbnail) }}" class="img-fluid course-detail-img">
                            <div class="box-overlay">
                                <a href="{{ route('online_course_detail', $item->id) }}">
                                    <h5 class="heading-h5 mb-3 text-white text-left">{{ $item->course_title }}
                                    </h5>
                                    <div class="box-overlay-description text-left">
                                        <p class="mb-0 text-white">{{ $item->short_description }}</p>
                                    </div>
                                    <p class="mb-0 text-right text-white font-weight-600">
                                        {{ __('translation.Instructor') }}
                                        {{ $item->getTutorName->name }}
                                    </p>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="swiper-button-next special-course-next"></div>
                <div class="swiper-button-prev special-course-prev"></div>
            </div>
            @endif

        </div>
    </div>
</div>
<!-- course type section end -->

@if($reviews->count() > 0)
<!-- review section start -->
<div class="review-section section" style="background-image: url({{ asset('web_assets/images/review_background_image.png') }})">
    <div class="review-section-overlay"></div>
    <div class="container">
        <h3 class="heading-h3 text-white mb-5 text-center">Review</h3>
        <div class="review-section-container m-auto">
            @foreach($reviews as $review)
            <!-- single review start -->
            <div class="single-review">
                <small class="text-theme-light-grey d-block mb-2">{{ $review->getCourse->course_title }}</small>
                <h5 class="heading-h5 mb-2">{{ $review->title }}.</h5>
                <p class="mb-0">{{ $review->content }}</p>
            </div>
            <!-- single review end -->
            @endforeach
        </div>
    </div>
</div>
<!-- review section end -->
@endif
@endsection

@section('custom-script')
<script>
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


    var swiper2 = new Swiper(".offline-lecture-carousel", {
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

    var swiper3 = new Swiper(".special-course-carousel", {
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
            nextEl: ".special-course-next",
            prevEl: ".special-course-prev",
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
    // var distance3 = $('.courses-detail').offset().top;
    var verticalHeight = $(window).height() * 2;
    // var verticalHeight2 = $(window).height() * 5;
    $(window).scroll(function() {
        console.log(distance2);
        if ($(this).scrollTop() >= distance) {
            $('.interactive-section-1').addClass('fixed-section');
        } else {
            $('.interactive-section-1').removeClass('fixed-section');
        }

        if ($(this).scrollTop() >= distance2 - verticalHeight) {
            $('.interactive-section-2').addClass('fixed-section-2');
        } else {
            $('.interactive-section-2').removeClass('fixed-section-2');
        }

        // if ($(this).scrollTop() >= distance3 - verticalHeight2) {
        //     $('.courses-detail').addClass('fixed-section-3');
        // } else {
        //     $('.courses-detail').removeClass('fixed-section-3');
        // }
    });
</script>
@endsection

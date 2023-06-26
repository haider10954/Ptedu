@extends('user.layout')
@section('title', 'ptedu - index')

@section('content')
    <!-- banner start -->
    <div class="banner_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-12 banner-left-content">
                    <img src="{{ asset('web_assets/images/banner-logo.png') }}" height="60" alt="img-fluid" class="mb-3">
                    <p class="text-theme-light-grey">Education is not the learning of facts,<br>but the traning of the mind to think.</p>
                </div>
                <div class="col-lg-7 col-md-12 text-center">
                    <img src="{{ asset('web_assets/images/banner-img.png') }}" alt="banner-img" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    <!-- banner end -->

    <!-- interactive section  -->
    <div class="interactive-section-1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 text-center interactive-section-logo">
                    <img src="{{ asset('web_assets/images/interactive-section-logo.png') }}" height="20" alt="img">
                </div>
                <div class="col-lg-7 interactive-section-content-box">
                    <h2>The beginning of <br> Customized education</h2>
                    <p class="text-danger mb-4">Global standard / Evidence based / Job based</p>
                    <small class="d-block">From beginner to expert as a professor</small>
                </div>
            </div>
        </div>
    </div>
    <!-- interactive section end -->

    <!-- interactive section  -->
    {{-- <div class="interactive-section-2">
        <div class="container">
            <div class="row align-items-top">
                <div class="col-lg-9 interactive-section-content-box">
                    <h2>Increasing thinking ability</h2>
                    <p class="text-danger mb-4">Critical Thinking / Creative Thinking</p>
                    <small class="d-block mb-1">Contribution to the Society</small>
                    <small class="d-block">{{ __('translation.In-depth to fill healthy values in modern people lives.') }}<br>{{ __('translation.Taking the leap to become an expert PTE is with you.') }}</small>
                </div>
                <div class="col-lg-3 text-center interactive-section-logo">
                    <img src="{{ asset('web_assets/images/interactive-section-logo.png') }}" height="20" alt="img">
                </div>
            </div>
        </div>
    </div> --}}
    <!-- interactive section end -->

    <!-- course detail section -->
    {{-- <div class="courses-detail section">
        <div class="container">
            <div class="interactive-section-content text-center">
                @if ($latest_courses->count() > 0)
                    <div class="swiper courses_detail_carousel">
                        <div class="swiper-wrapper">
                            @foreach ($latest_courses as $latest_course)
                                <div class="swiper-slide">
                                    <div class="row align-items-center">
                                        <div class="col-md-4 p-4">
                                            <img src="{{ asset('storage/course/thumbnail/' . $latest_course->course_thumbnail) }}"
                                                class="img-fluid course-detail-img">
                                        </div>
                                        <div class="col-md-8 p-4">
                                            <div
                                                class="d-flex align-items-center course-detail-author-content justify-content-between mb-50">
                                                <h3 class="heading-h3 font-30 text-white"
                                                    style="margin-bottom: 0 !important;">
                                                    {{ $latest_course->course_title }}
                                                </h3>
                                                <small class="text-white">{{ $latest_course->getTutorName->name }}</small>
                                            </div>
                                            <div class="text-left text-white">{{ strip_tags($latest_course->description) }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="courses-detail-pagination"></div>
                    </div>
                @else
                    <h3 class="heading-h3 font-30">No Records Found</h3>
                @endif
            </div>
        </div>
    </div> --}}
    <!-- course detail section end -->

    <!-- course type section start -->
    <div class="courses-type section">
        <div class="container">
            <div class="interactive-section-content text-center mb-5">
                @if ($courses->count() > 0)
                    <div class="section-part mb-80">
                        <div class="section-title mb-5">
                            <h3 class="heading-h3 text-white mb-0">Online Courses</h3>
                        </div>
                        <div class="swiper expert-course-carousel">
                            <div class="swiper-wrapper">
                                @foreach ($courses as $item)
                                    <div class="swiper-slide position-relative">
                                        <img src="{{ asset('storage/course/thumbnail/' . $item->course_thumbnail) }}"
                                            class="img-fluid course-detail-img">
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
                            <h3 class="heading-h3 text-white mb-0">Offline Courses</h3>
                        </div>
                        <div class="swiper public-course-carousel">
                            <div class="swiper-wrapper">
                                @foreach ($offline_courses as $v)
                                    <div class="swiper-slide">
                                        <img src="{{ asset('storage/offline_course/thumbnail/' . $v->course_thumbnail) }}"
                                            class="img-fluid course-detail-img">
                                        <div class="box-overlay">
                                            <a href="{{ route('offline_lecture_detail', $v->id) }}">
                                                <h5 class="heading-h5 mb-3 text-white text-left">{{ $v->course_title }}
                                                </h5>
                                                <div class="box-overlay-description text-left">
                                                    <p class="mb-0 text-white">{{ $v->short_description }}</p>
                                                </div>
                                                <p class="mb-0 text-right text-white font-weight-600">
                                                    {{ __('translation.Instructor') }}
                                                    {{ $v->getTutorName->name }}
                                                </p>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next public-course-next"></div>
                            <div class="swiper-button-prev public-course-prev"></div>
                        </div>
                    </div>
                @endif
                @if ($special_course->count() > 0)
                    <div class="section-part mb-120">
                        <div class="section-title mb-5">
                            <h3 class="heading-h3 text-white mb-0">Special Courses</h3>
                        </div>
                        <div class="swiper expert-course-carousel">
                            <div class="swiper-wrapper">
                                @foreach ($special_course as $item)
                                    <div class="swiper-slide position-relative">
                                        <img src="{{ asset('storage/course/thumbnail/' . $item->course_thumbnail) }}"
                                            class="img-fluid course-detail-img">
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
                {{-- @if ($latest_tutors->count() > 0)
                    <div class="section-part tutor-section">
                        <div class="section-title mb-5">
                            <h3 class="heading-h3 text-white mb-0">Instructor</h3>
                        </div>
                        <div class="w-100 m-auto">
                            <div class="row align-items-center justify-content-center">
                                @foreach ($latest_tutors as $latest_tutor)
                                    <div class="col-lg-3 col-md-4 col-12 mb-4">
                                        <div class="tutor-image-container">
                                            <img src="{{ asset('storage/tutor/' . $latest_tutor->tutor_img) }}"
                                                class="tutor_img img-fluid">
                                            <div class="tutor-box-overlay">
                                                <a href="{{ route('tutor_info', $latest_tutor->id) }}">
                                                    <h5 class="heading-h5 mb-1 text-white text-left">
                                                        {{ $latest_tutor->english_name }}
                                                    </h5>
                                                    <p class="text-theme-light-grey mb-0">PTEdu</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif --}}
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

@extends('user.layout')

@section('title', 'ptedu - Review')

@section('content')
    <div class="section pt-150 review_section">
        <div class="container">
            <div class="section-heading">
                <h5 class="mb-0">{{ __('translation.Review') }}</h5>
            </div>
            <div class="w-65 review_info m-auto py-4">
                <h5 class="heading mb-3 text-center">PTEdu {{ __('translation.Student Reviews') }}</h5>
                <video src="{{ asset('storage/review/video/review_video.mp4') }}" controls="" height="315"
                       style="width: 100%; object-fit: cover;"></video>
            </div>

        </div>
    </div>
    <div class="section course_reviews background-light">
        <div class="container">
            <h5 class="mb-5 text-center heading">PTEdu {{ __('translation.Course Reivew') }}</h5>
            <div class="w-100 m-auto courses_reviews_carousel position-relative">
                <div class="swiper course-reviews-carousel">
                    <div class="swiper-wrapper">
                        @if ($review->count() > 0)
                            @foreach ($review as $r)
                                <div class="swiper-slide">
                                    <div class="course-review-box">
                                        <img src="{{ asset('web_assets/images/quote-img.png') }}" height="25"
                                             class="mb-4" alt="quotes">
                                        <h6 class="heading mb-4">{{ $r->title }}.</h6>
                                        <p class="mb-4">{{ $r->content }}</p>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <small
                                                class="text-muted">{{ __('translation.by') }} {{ mb_substr($r->getUser->name, 0, 1) }}
                                                ** -
                                                {{ \Carbon\Carbon::parse($r->created_at)->format('Y-m-d') }}</small>
                                            <img src="{{ asset('web_assets/images/quote-img.png') }}" height="25"
                                                 alt="img">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center">
                                <img src="{{ asset('web_assets/images/no-data-found.png') }}" alt="img"
                                     class="img-fluid" style="height: 300px;">
                            </div>
                        @endif
                    </div>
                </div>
                <div class="swiper-button-next course-reviews-next"></div>
                <div class="swiper-button-prev course-reviews-prev"></div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <p class="text-beige font-weight-700 text-center mb-2">[{{ $review->count() }}] 건의 수강후기가 있어요!</p>
            <h5 class="heading mb-0 text-center">PTEdu {{ __('translation.Course Review') }}</h5>

            <div class="w-50 review_tabs m-auto py-5">
               @if($review->count() > 0)
                    @foreach($review as $v)
                        <div class="review_box mb-3">
                            <div class="d-flex mb-2 align-items-center justify-content-between">
                                <small
                                    class="text-muted">{{ !empty($v->created_at) ? $v->created_at->format('Y.m.d') : "" }}</small>
                                <div class="d-flex align-items-center gap-1 rating-stars">
                                    @if ($v->rating == 1)
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    @elseif($v->rating == 2)
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    @elseif($v->rating == 3)
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    @elseif($v->rating == 4)
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                    @else
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    @endif
                                </div>
                            </div>
                            <p class="font-weight-600 mb-2">{{ $v->title }}.</p>
                            <p class="mb-0">{{ $v->content }}</p>
                        </div>
                    @endforeach
                @else
                    <div class="text-center">
                        <img src="{{ asset('web_assets/images/no-data-found.png') }}" alt="img"
                             class="img-fluid" style="height: 300px;">
                    </div>
               @endif
            </div>
        </div>
    </div>



@endsection

@section('custom-script')
    <script>
        $('.review_info iframe').attr('width', '');
        $('.review_info iframe').css('width', '100%');
        $('.review_info iframe').attr('height', '315');

        $('.review_info video').css('width', '100%');
        $('.review_info video').css('object-fit', 'cover');
        $('.review_info video').attr('height', '315');
        var swiper = new Swiper(".course-reviews-carousel", {
            slidesPerView: 4,
            spaceBetween: 30,
            slidesPerGroup: 3,
            loop: true,
            loopFillGroupWithBlank: true,
            navigation: {
                nextEl: ".course-reviews-next",
                prevEl: ".course-reviews-prev",
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

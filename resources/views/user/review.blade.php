@extends('user.layout')

@section('title', 'ptedu - Review')

@section('content')
<div class="section pt-150 review_section">
    <div class="container">
        <div class="section-heading">
            <h5 class="mb-0">Review</h5>
        </div>
        <div class="w-65 review_info m-auto py-4">
            <h5 class="heading mb-3 text-center">PTEdu Student Reviews</h5>
            @if( $latest_review->count() > 0)
            {!! $embedded_video !!}
            <p class="mb-1 font-weight-600">{{ $latest_review->getCourse->course_title }} | {{ $latest_review->title }} </p>
            <p class="mb-0">{{ $latest_review->content }} 할 수 있었어요!</p>
            @else
            <div class="text-center">
                <img src="{{ asset('web_assets/images/no-data-found.png') }}" alt="img" class="img-fluid" style="height: 300px;">
            </div>
            @endif
        </div>

    </div>
</div>
</div>
<div class="section course_reviews background-light">
    <div class="container">
        <h5 class="mb-5 text-center heading">PTEdu Course Reivew</h5>
        <div class="w-100 m-auto courses_reviews_carousel position-relative">
            <div class="swiper course-reviews-carousel">
                <div class="swiper-wrapper">
                    @if($review->count() > 0)
                    @foreach($review as $r)
                    <div class="swiper-slide">
                        <div class="course-review-box">
                            <img src="{{ asset('web_assets/images/quote-img.png') }}" height="25" class="mb-4" alt="quotes">
                            <h6 class="heading mb-4">{{ $r->title  }}.</h6>
                            <p class="mb-4">{{ $r->content }}</p>
                            <div class="d-flex align-items-center justify-content-between">
                                <small class="text-muted">by 강** {{\Carbon\Carbon::parse($r->created_at)->format('d M, Y')}}</small>
                                <img src="{{ asset('web_assets/images/quote-img.png') }}" height="25" alt="img">
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="text-center">
                        <img src="{{ asset('web_assets/images/no-data-found.png') }}" alt="img" class="img-fluid" style="height: 300px;">
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
        <p class="text-beige font-weight-700 text-center mb-2">There are {{ $review->count() }} reviews!</p>
        <h5 class="heading mb-0 text-center">PTEdu Course Review</h5>
        <div class="w-50 review_tabs m-auto py-5">
            <ul class="nav nav-pills mb-5 nav_tabs justify-content-center" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Physical Teraphy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Pilates</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="review_box mb-3">
                        <div class="d-flex mb-2 align-items-center justify-content-between">
                            <small class="text-muted">보행 A에서 z까지</small>
                            <div class="d-flex align-items-center gap-1 rating-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                        <p class="font-weight-600 mb-2">동료의 소개로 수강을 하게 되었습니다.</p>
                        <p class="mb-0">믿고 들을 수 있는 강의라 생각되어 모두 듣고 있는 강사입니다! 다소 어려운 내용도 쉽고 재밌게 들을 수 있었고 가이드라인을 정말 잘 만들어주셔서 실제 레슨하며 놓치고 있었던 세밀한 부분까지 체크할 수 있었습니다! 실제 현장레슨에 바로 도움이 많이어 적극 강추합니다! :)</p>
                    </div>
                    <div class="review_box mb-3">
                        <div class="d-flex mb-2 align-items-center justify-content-between">
                            <small class="text-muted">보행 A에서 z까지</small>
                            <div class="d-flex align-items-center gap-1 rating-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                        <p class="font-weight-600 mb-2">동료의 소개로 수강을 하게 되었습니다.</p>
                        <p class="mb-0">믿고 들을 수 있는 강의라 생각되어 모두 듣고 있는 강사입니다! 다소 어려운 내용도 쉽고 재밌게 들을 수 있었고 가이드라인을 정말 잘 만들어주셔서 실제 레슨하며 놓치고 있었던 세밀한 부분까지 체크할 수 있었습니다! 실제 현장레슨에 바로 도움이 많이어 적극 강추합니다! :)</p>
                    </div>
                    <div class="review_box mb-3">
                        <div class="d-flex mb-2 align-items-center justify-content-between">
                            <small class="text-muted">보행 A에서 z까지</small>
                            <div class="d-flex align-items-center gap-1 rating-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                        <p class="font-weight-600 mb-2">동료의 소개로 수강을 하게 되었습니다.</p>
                        <p class="mb-0">믿고 들을 수 있는 강의라 생각되어 모두 듣고 있는 강사입니다! 다소 어려운 내용도 쉽고 재밌게 들을 수 있었고 가이드라인을 정말 잘 만들어주셔서 실제 레슨하며 놓치고 있었던 세밀한 부분까지 체크할 수 있었습니다! 실제 현장레슨에 바로 도움이 많이어 적극 강추합니다! :)</p>
                    </div>
                    <div class="review_box mb-3">
                        <div class="d-flex mb-2 align-items-center justify-content-between">
                            <small class="text-muted">보행 A에서 z까지</small>
                            <div class="d-flex align-items-center gap-1 rating-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                        <p class="font-weight-600 mb-2">동료의 소개로 수강을 하게 되었습니다.</p>
                        <p class="mb-0">믿고 들을 수 있는 강의라 생각되어 모두 듣고 있는 강사입니다! 다소 어려운 내용도 쉽고 재밌게 들을 수 있었고 가이드라인을 정말 잘 만들어주셔서 실제 레슨하며 놓치고 있었던 세밀한 부분까지 체크할 수 있었습니다! 실제 현장레슨에 바로 도움이 많이어 적극 강추합니다! :)</p>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="review_box mb-3">
                        <div class="d-flex mb-2 align-items-center justify-content-between">
                            <small class="text-muted">보행 A에서 z까지</small>
                            <div class="d-flex align-items-center gap-1 rating-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                        <p class="font-weight-600 mb-2">동료의 소개로 수강을 하게 되었습니다.</p>
                        <p class="mb-0">믿고 들을 수 있는 강의라 생각되어 모두 듣고 있는 강사입니다! 다소 어려운 내용도 쉽고 재밌게 들을 수 있었고 가이드라인을 정말 잘 만들어주셔서 실제 레슨하며 놓치고 있었던 세밀한 부분까지 체크할 수 있었습니다! 실제 현장레슨에 바로 도움이 많이어 적극 강추합니다! :)</p>
                    </div>
                    <div class="review_box mb-3">
                        <div class="d-flex mb-2 align-items-center justify-content-between">
                            <small class="text-muted">보행 A에서 z까지</small>
                            <div class="d-flex align-items-center gap-1 rating-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                        <p class="font-weight-600 mb-2">동료의 소개로 수강을 하게 되었습니다.</p>
                        <p class="mb-0">믿고 들을 수 있는 강의라 생각되어 모두 듣고 있는 강사입니다! 다소 어려운 내용도 쉽고 재밌게 들을 수 있었고 가이드라인을 정말 잘 만들어주셔서 실제 레슨하며 놓치고 있었던 세밀한 부분까지 체크할 수 있었습니다! 실제 현장레슨에 바로 도움이 많이어 적극 강추합니다! :)</p>
                    </div>
                    <div class="review_box mb-3">
                        <div class="d-flex mb-2 align-items-center justify-content-between">
                            <small class="text-muted">보행 A에서 z까지</small>
                            <div class="d-flex align-items-center gap-1 rating-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                        <p class="font-weight-600 mb-2">동료의 소개로 수강을 하게 되었습니다.</p>
                        <p class="mb-0">믿고 들을 수 있는 강의라 생각되어 모두 듣고 있는 강사입니다! 다소 어려운 내용도 쉽고 재밌게 들을 수 있었고 가이드라인을 정말 잘 만들어주셔서 실제 레슨하며 놓치고 있었던 세밀한 부분까지 체크할 수 있었습니다! 실제 현장레슨에 바로 도움이 많이어 적극 강추합니다! :)</p>
                    </div>
                    <div class="review_box mb-3">
                        <div class="d-flex mb-2 align-items-center justify-content-between">
                            <small class="text-muted">보행 A에서 z까지</small>
                            <div class="d-flex align-items-center gap-1 rating-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                        <p class="font-weight-600 mb-2">동료의 소개로 수강을 하게 되었습니다.</p>
                        <p class="mb-0">믿고 들을 수 있는 강의라 생각되어 모두 듣고 있는 강사입니다! 다소 어려운 내용도 쉽고 재밌게 들을 수 있었고 가이드라인을 정말 잘 만들어주셔서 실제 레슨하며 놓치고 있었던 세밀한 부분까지 체크할 수 있었습니다! 실제 현장레슨에 바로 도움이 많이어 적극 강추합니다! :)</p>
                    </div>
                </div>
            </div>
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
@extends('user.layout')

@section('title', 'ptedu - Review')

@section('content')
    <div class="section course_reviews background-light">
        <div class="container">
            <h5 class="mb-5 text-center heading">PTEdu {{ __('translation.Course Reivew') }}</h5>
            <div class="w-100 m-auto courses_reviews_carousel position-relative">
                <div class="swiper course-reviews-carousel">
                    <div class="swiper-wrapper">
                        @if ($reviews->count() > 0)
                            @foreach ($reviews as $r)
                                <div class="swiper-slide">
                                    <div class="course-review-box">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <img src="{{ asset('web_assets/images/quote-img.png') }}" height="25"
                                                 class="mb-4" alt="quotes">
                                            <h6 class="heading mb-4">({{ $r->type }}
                                                ) {{ $r->type == 'Online' ? Str::limit($r->getCourse->course_title,50) : Str::limit($r->getCousreName->course_title,50) }}
                                                .</h6>
                                        </div>
                                        <h6 class="heading mb-4">{{ $r->title }}.</h6>
                                        <p class="mb-4">{{ $r->content }}</p>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <small
                                                class="text-muted">{{ __('translation.by') }} {{ !empty($r->getUser) ? mb_substr($r->getUser->name, 0, 1) : 'N/A' }}
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
            <p class="text-beige font-weight-700 text-center mb-2">[{{ $online_reviews->count() }}] 건의 수강후기가 있어요!</p>
            <h5 class="heading mb-0 text-center">PTEdu {{ __('translation.Course Review') }}</h5>
            <div class="w-50 review_tabs m-auto py-5">
                <ul class="nav nav-pills mb-5 nav_tabs justify-content-center" id="online-pills-tab" role="tablist">
                    @foreach ($online_category as $c)
                        <li class="nav-item">
                            <a class="nav-link {{ $loop->index == 0 ? 'active' : '' }}" id="online-pills-{{ $c->id }}"
                               data-toggle="pill" href="#online-pill-{{ $c->id }}" role="tab"
                               aria-controls="online-pills-{{ $c->id }}" aria-selected="true">{{ $c->name }} ({{ $c->type }}
                                )</a>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="online-pills-tabContent">
                    @foreach ($online_category as $r)
                        <div class="tab-pane fade {{ $loop->index == 0 ? 'active show' : '' }}"
                             id="online-pill-{{ $r->id }}" role="tabpanel" aria-labelledby="online-pills-{{ $r->id }}">
                            @if ($r->getReviews->count() > 0)
                                @foreach ($r->getReviews as $v)
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>




    <div class="section">
        <div class="container">
            <p class="text-beige font-weight-700 text-center mb-2">[{{ $offline_reviews->count() }}] 건의 수강후기가 있어요!</p>
            <h5 class="heading mb-0 text-center">PTEdu {{ __('translation.Course Review') }}</h5>
            <div class="w-50 review_tabs m-auto py-5">
                <ul class="nav nav-pills mb-5 nav_tabs justify-content-center" id="offline-pills-tab" role="tablist">
                    @foreach ($off_category as $x)
                        <li class="nav-item">
                            <a class="nav-link {{ $loop->index == 0 ? 'active' : '' }}" id="offline-pills-{{ $x->id }}"
                               data-toggle="pill" href="#offline-pill-{{ $x->id }}" role="tab"
                               aria-controls="offline-pills-{{ $x->id }}" aria-selected="true">{{ $x->name }} ({{ $x->type }}
                                )</a>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="offline-pills-tabContent">
                    @foreach ($off_category as $z)
                        <div class="tab-pane fade {{ $loop->index == 0 ? 'active show' : '' }}"
                             id="offline-pill-{{ $z->id }}" role="tabpanel" aria-labelledby="offline-pills-{{ $z->id }}">
                            @if ($z->getOfflineReviews->count() >0)
                                @foreach ($z->getOfflineReviews as $i)
                                    <div class="review_box mb-3">
                                        <div class="d-flex mb-2 align-items-center justify-content-between">
                                            <small
                                                class="text-muted">{{ !empty($i->created_at) ? $i->created_at->format('Y.m.d') : "" }}</small>
                                            <div class="d-flex align-items-center gap-1 rating-stars">
                                                @if ($i->rating == 1)
                                                    <i class="fas fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                @elseif($i->rating == 2)
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                @elseif($i->rating == 3)
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                    <i class="far fa-star"></i>
                                                @elseif($i->rating == 4)
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
                                        <p class="font-weight-600 mb-2">{{ $i->title }}.</p>
                                        <p class="mb-0">{{ $i->content }}</p>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center">
                                    <img src="{{ asset('web_assets/images/no-data-found.png') }}" alt="img"
                                         class="img-fluid" style="height: 300px;">
                                </div>
                            @endif
                        </div>
                    @endforeach
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
        let swiper = new Swiper(".course-reviews-carousel", {
            slidesPerView: 4,
            spaceBetween: 30,
            slidesPerGroup: 3,
            loop: true,
            autoplay: {
                delay: 3000,
            },
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

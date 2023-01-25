@extends('user.layout')

@section('title', 'ptedu - Lecture Detial')

@section('content')
<div class="section lecture_banner_section">
    <div class="lecture_banner_img" style="background-image: url({{ asset('storage/course/banner/' . $course_info->course_banner) }})"></div>
    <div class="banner_text">
        {!! $embedded_video_url !!}
    </div>
</div>

<div class="section pt-40 lecture_details">
    <div class="container">
        <div class="w-80 m-auto pb-40 border-bottom-1">
            <div class="row align-items-center">
                <div class="col-lg-9">
                    @if ($reservation)
                    @if ($reservation->status == 'decline')
                    <div class="badge  mt-3 mb-3 p-2" style="background: #F9DFDF; border-radius: 2px; color: #791919;">{{ __('translation.Your Reservation has been decline Apply again to Reserve Course') }}.</div>
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
                        <p class="mb-0 text">{{ ($course_info->price - $course_info->discounted_prize) }}{{ __('translation.won') }}</p>
                    </div>
                    <button class="btn btn-dark btn-sm w-100 mb-2 add-to-cart-btn" data-type="online" data-id="{{ encrypt($course_info) }}">{{ __('translation.Add to cart') }}</button>

                </div>
            </div>
        </div>
        <div class="w-80 m-auto py-4">
            <ul class="nav nav-pills mb-40 nav_tabs" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">{{ __('translation.Course Introduction') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">{{ __('translation.Instructor Introduction') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">{{ __('translation.Lecture Review') }}</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    {!! $course_info->description !!}
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
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
                                    <p class="mb-0 text font-weight-bold">{{ __('translation.Phone Number') }}</p>
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
                    @if($reviews->count() > 0)
                    @foreach($reviews as $r)
                    <div class="review_box mb-3">
                        <div class="d-flex mb-2 align-items-center justify-content-between">
                            <small class="text-muted">{{ $r->created_at->format('Y.m.d') }}</small>
                            <div class="d-flex align-items-center gap-1 rating-stars">
                                @if($r->rating == 1)
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                @elseif($r->rating == 2)
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                @elseif($r->rating == 3)
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                @elseif($r->rating == 4)
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
                        <p class="font-weight-600 mb-2">{{ $r->title }}.</p>
                        <p class="mb-0">{{ $r->content }}</p>
                    </div>
                    @endforeach
                    @else
                    <div class="text-center">
                        <img src="{{ asset('web_assets/images/no-data-found.png') }}" alt="img" class="img-fluid" style="height: 300px;">
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
<script>
    $('.banner_text iframe').css('width', '100%');
    $('.banner_text iframe').css('height', '100%');
    $('.banner_text iframe').attr('width', '');
    $('.banner_text iframe').attr('height', '');

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
                btn.html('<i class="fa fa-spinner fa-spin me-1"></i> Processing');
            },
            success: function(res) {
                if (res.Success == true) {
                    btn.html('<i class="fa fa-check mx-1"></i> Added</>');
                    $('.shopping_cart_count').attr('data-items-count', res.cart_items_count);
                    $('.shopping_cart_count').html(res.cart_items_count);
                } else {
                    btn.html('<i class="fa fa-check mx-1"></i> Already Added</>');
                }
            },
            error: function(e) {}
        });
    });
</script>
@endsection
@extends('user.layout')

@section('title', 'ptedu - Lecture detail')

@section('content')
@php
$cart = session()->get('shopping_cart');
$cartBtn = 0;
@endphp
<div class="section lecture_banner_section">
    <div class="lecture_banner_img" style="background-color: #191B1D;"></div>
    <div class="banner_text">
        @if($embedded_video_url != false)
        {!! $embedded_video_url !!}
        @else
        <h5> <i class="fa fa-exclamation-circle mx-1"></i> {{ __('translation.Video Not Found') }}</h5>
        @endif
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
                    <div class="course_detail_box">
                        <p class="mb-0 text">{{ __('translation.Course Amount') }}</p>
                        <p class="mb-0 text text-bold">{{ number_format(!empty($course_info->price) ? $course_info->price : 0) }}{{ __('translation.won') }}</p>
                    </div>
                    <div class="course_detail_box">
                        <p class="mb-0 text">{{ __('translation.Course Period') }}</p>
                        <p class="mb-0 text text-bold">{{ $course_info->duration_of_course }} 주</p>
                    </div>

                    @if (!empty($course_info->course_schedule) || $course_info->course_schedule != null)
                    <div class="mb-2 mt-1">
                        <select class="form-control" id="course_schedule" name="course_schedule" required>
                            <option value="">{{__('translation.Select Option')}}</option>
                            @foreach (json_decode($course_info->course_schedule) as $key=>$value)
                            <option class="dropdown-item" value="{{ $value }}">{{ $value }}</option>
                            @endforeach

                        </select>
                    </div>
                    @endif



                    @if (!empty($cart))
                    @foreach ($cart as $v)
                    @if (($v['type'] == 'online') && ($v['course_id'] == $course_info->id))
                    @php
                    $cartBtn = 0;
                    @endphp
                    @else
                    @php
                    $cartBtn = 1;
                    @endphp
                    @endif
                    @endforeach
                    @else
                    @php
                    $cartBtn = 1;
                    @endphp
                    @endif



                    @if ($cartBtn == 1)
                    <button class="btn btn-dark btn-sm w-100 mb-2 add-to-cart-btn  shopping_cart_btn" style=" background: black;" data-type="online" data-id="{{ $course_info->id }}">{{ __('translation.Add to cart') }}</button>
                    @else
                    <button class="btn btn-dark btn-sm w-100 mb-2 disabled" style=" background: black;" disabled>{{ __('translation.Add to cart') }}</button>
                    @endif

                    @if (auth()->check())

                    <div class="btn_parent">
                        @if ($liked_course)

                        <button onclick="LikeDislike($(this))" class="btn btn-dark btn-sm w-100 mb-2 dislike_course" style=" background: black; font-size: 12px;" data-type="online" data-id="{{ encrypt($course_info->id) }}">이미 찜리스트에 추가되었습니다</button>
                        @else

                        <button onclick="LikeDislike($(this))" class="btn btn-dark btn-sm w-100 mb-2 like_course" style=" background: black;" data-type="online" data-id="{{ encrypt($course_info->id) }}">찜하기</button>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="w-80 m-auto py-4">
            <ul class="nav nav-pills mb-40 nav_tabs" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active text-bold" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">{{ __('translation.Course Introduction') }}</a>
                </li>
                {{-- <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">{{ __('translation.Instructor Introduction') }}</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link text-bold" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">{{ __('translation.Lecture Review') }}</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="note-editing-area">
                        {!! $course_info->description !!}
                    </div>
                </div>
                {{--<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
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
            </div>--}}
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                @if($reviews->count() > 0)
                @foreach($reviews as $r)
                <div class="review_box mb-3">
                    <div class="d-flex mb-2 align-items-center justify-content-between review_box_mobile">
                        <div>
                            <div>
                                <small class="text-muted">{{ $r->getCourse->getCategoryName->name}} | {{ !empty($r->created_at) ? $r->created_at->format('Y.m.d') : '' }}</small>
                                <div class="d-flex">
                                    <p class="font-weight-600 mb-0 mr-2">{{ $r->title }}</p>
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
                                <h5 class="mb-2 mt-2">{{ $r->getCourse->course_title }}</h5>
                                <p class="mb-0">{{ $r->content }}</p>
                            </div>
                        </div>
                        <img src="{{ asset('storage/course/thumbnail/' .$r->getCourse->course_thumbnail)}}" class="review_course_image" />
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
    </div>
</div>
</div>
@php
$liked =1;
if(empty($liked_course))
{
$liked = 0;
}
@endphp
@endsection

@section('custom-script')
<script>
    var like = '{{$liked}}';


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
                'course_schedule': $('#course_schedule').val(),
                '_token': '{{ csrf_token() }}'
            },
            beforeSend: function() {
                btn.prop('disabled', true);
                btn.html('<i class="fa fa-spinner fa-spin me-1"></i> {{ __("translation.Processing") }}');
            },
            success: function(res) {
                if (res.Success == true) {
                    btn.html('<i class="fa fa-check mx-1"></i> {{ __("translation.Added") }}</>');
                    $('.shopping_cart_count').attr('data-items-count', res.cart_items_count);
                    $('.shopping_cart_count').html(res.cart_items_count);
                } else {
                    btn.html(`<i class="fa fa-times mx-1"></i> ${res.Msg}`);
                }
            },
            error: function(e) {}
        });
    });


    function LikeDislike(element)

    {

        var btn = element;

        if (like != 1) {


            $.ajax({
                type: "POST",
                url: "{{ route('like-course') }}",
                dataType: 'json',
                data: {
                    'course_id': element.data('id'),
                    'type': element.data('type'),

                    '_token': '{{ csrf_token() }}'
                },
                beforeSend: function() {
                    btn.html('<i class="fa fa-spinner fa-spin me-1"></i> 진행중');
                },
                success: function(res) {
                    if (res.success == true) {
                        var btn_div = element;
                        btn_div.html('이미 찜리스트에 추가되었습니다');
                        btn_div.css('font-size', '12px');
                        btn_div.addClass('dislike_course');
                        btn_div.removeClass('like_course');
                        // btn_div.attr('data-id', btn.attr('data-id'));

                        like = 1;
                    }
                },
                error: function(e) {}
            });
        } else {
            $.ajax({
                type: "POST",
                url: "{{ route('dislike-course') }}",
                dataType: 'json',
                data: {
                    'course_id': element.data('id'),
                    'type': element.data('type'),
                    '_token': '{{ csrf_token() }}'
                },
                beforeSend: function() {
                    btn.html('<i class="fa fa-spinner fa-spin me-1"></i> 진행중');
                },
                success: function(res) {
                    if (res.success == true) {

                        like = 0;
                        var btn_div = element;
                        btn_div.html('찜하기');
                        btn_div.addClass('like_course');
                        btn_div.removeClass('dislike_course');

                    }
                },
                error: function(e) {}
            });
        }

    }
</script>
@endsection

@extends('admin.layout.layout')

@section('title' , 'Inquiry Answer')

@section('custom-style')
<style>
    .Card_title {
        font-size: 18px !important;
        font-weight: 500 !important;
        color: black;
        text-transform: capitalize !important;
    }

    .date {
        font-weight: 500;
        font-size: 12px;
        line-height: 23px;
        color: #9E9E9E;
    }

    .divider {
        border: 2px solid #000000;
    }

    .course_info {
        font-weight: 400;
        font-size: 12px;
        line-height: 23px;
        color: #6F6F6F;
    }

    .course_details {
        font-weight: 400;
        font-size: 12px;
        line-height: 23px;
        color: black;
    }

    .col-bg {
        background: rgba(242, 243, 250, 0.8);
    }

    .course_info_border {
        border: 2px solid black;
    }

    .payment_info_border {
        border: 1px solid #191B1D;
    }

    .answer {
        font-weight: 700;
        font-size: 15px;
        line-height: 18px;

        color: #000000;
    }
</style>

@endsection


@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            @if (Session::has('error'))
            <div class="alert alert-danger" id="responseMessage">{{ Session::get('error') }}</div>
            @endif
            <div class="col-12 mb-5">
                <div class="row mx-0">
                    <hr class="course_info_border" />
                    <div class="col-3 col-bg">
                        <div class="d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_info">{{ __('translation.Name') }}</h4>
                        </div>
                        <div class=" d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_info">{{ __('translation.Date')}}</h4>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_details">{{ $inquiry->name }}</h4>
                        </div>
                        <div class=" d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_details">{{ Carbon\Carbon::parse($inquiry->created_at)->format('d M, Y')}}</h4>
                        </div>
                    </div>
                </div>
                <hr class="payment_info_border" />

                <div class="row mx-0">
                    <hr class="course_info_border" />
                    <div class="col-3 col-bg">
                        <div class="d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_info">{{__('translation.Title') }}</h4>
                        </div>
                        <div class=" d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_info"> {{ __('translation.Content') }}</h4>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_details">{{ $inquiry->title }}</h4>
                        </div>
                        <div class=" d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_details">{{ $inquiry->content }}</h4>
                        </div>
                    </div>
                </div>
                <hr class="payment_info_border" />

                <h4 class="answer mb-2">{{ __('translation.Answers') }}</h4>
                <form method="POST" action="{{ route('add-answer') }}">
                    @csrf
                    <input type="hidden" value="{{ $inquiry->id}}" name="id">
                    <div class="row mx-0">
                        <hr class="course_info_border" />
                        <div class="col-3 col-bg">
                            <div class="d-flex align-items-center mb-3">
                                <h4 class="mb-sm-0  course_info">{{ __('translation.Contents') }}</h4>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="d-flex align-items-center mb-3">
                                <textarea class="form-control" rows="6" style="resize: none;" placeholder="{{ __('translation.Enter Answer') }}" name="answer">{{ $inquiry->answer }}</textarea>
                            </div>
                        </div>
                    </div>
                    <hr class="payment_info_border" />
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex align-items-center justify-content-center">
                                <button type="submit" class="btn btn-primary">{{ __('translation.Submit') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
<script>
    $(document).ready(function() {
        $('html, body').animate({
            scrollTop: $("html, body").offset().top
        }, 1000);

        setTimeout(function() {
            $("#responseMessage").hide()
        }, 3000);
    });
</script>

@endsection
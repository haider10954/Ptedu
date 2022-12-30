@extends('user.layout')

@section('title', 'PTEdu - Inquiry Not Answered')

@section('content')
<div class="section pt-125">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 padding-left">
                <div class="page-sidemenu-heading mb-3">
                    <h5 class="mb-0 font-weight-600">{{ __('translation.My Classroom') }}</h5>
                    <a href="javscript:void(0)" class="btn btn-dark btn-custom-sm btn-theme-black page-side-menu-toggle">{{ __('translation.menu') }}</a>
                </div>
                <div class="page-side-menu">
                    <ul class="menu">
                        <li><a href="{{ route('my_classroom') }}">{{ __('translation.My Classroom') }}</a></li>
                        <li><a href="{{ route('shopping_bag') }}">{{ __('translation.Shopping Bag') }}</a></li>
                        <li><a href="{{ route('user_info') }}">{{ __('translation.Modifying Member Info') }}</a></li>
                        <li><a href="{{ route('user_inquiry')  }}">1:1 {{ __('translation.Inquiry') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="custom_padding">
                    <div class="section-heading">
                        <h5 class="mb-2">1:1 {{ __('translation.Inquiry') }}</h5>
                        <p class="mb-0">{{ __('translation.Questions & Answers in PTEdu') }}</p>
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-3 pr-0">
                            <div class="user-info bottom-border">
                                <div class="d-flex align-items-center justify-content-start" style="height:50px;">
                                    <p class="mb-0 user_profile">{{ __('translation.Name') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10 col-9  pl-0">
                            <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:51px;">
                                <div class="ml-2">
                                    <p class="mb-0">{{ $inquiry->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2 col-3 pr-0">
                            <div class="user-info bottom-border">
                                <div class="d-flex align-items-center justify-content-start" style="height:50px;">
                                    <p class="mb-0 user_profile">{{ __('translation.Date') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10 col-9 pl-0">
                            <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:51px;">
                                <div class="ml-2">
                                    <p class="mb-0">{{ Carbon\Carbon::parse($inquiry->expired_at)->format('d M, Y')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 top-border">
                        <div class="row">
                            <div class="col-md-2 col-3 pr-0">
                                <div class="user-info bottom-border">
                                    <div class="d-flex align-items-center justify-content-start" style="height:50px;">
                                        <p class="mb-0 user_profile">{{ __('translation.Title') }}<span class="text-danger">*</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10 col-9 pl-0">
                                <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:51px;">
                                    <div class="ml-2">
                                        <p class="mb-0">{{ $inquiry->title }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2 col-3 pr-0">
                                <div class="user-info bottom-border">
                                    <div class="d-flex  justify-content-start" style="height:200px;">
                                        <p class="mb-0 user_profile">{{ __('translation.Content') }}<span class="text-danger">*</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10 col-9 pl-0">
                                <div class="d-flex justify-content-start bottom-border" style="padding-left:10px; min-height:201px; width:100%">
                                    <div class="ml-2 mt-2 mt-md-4">
                                        <p class="mb-0">{{ $inquiry->content }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex align-items-center justify-content-center mt-4">
                                    <a class="btn rounded-0 btn-theme-white" style="padding: 5px 30px 5px 30px" href="{{ route('user_inquiry') }}">{{ __('translation.Go to List') }} </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
<script>
    $('.page-side-menu-toggle').on('click', function() {
        $('.page-side-menu').slideToggle();
    });
</script>
@endsection
@extends('user.layout')

@section('title', 'PTEdu - Inquiry Answered')

@section('content')
<div class="section pt-125">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2">
                <div class="page-sidemenu-heading mb-3">
                    <h5 class="mb-0 font-weight-600">My Classroom</h5>
                    <a href="javscript:void(0)" class="btn btn-dark btn-custom-sm btn-theme-black page-side-menu-toggle">menu</a>
                </div>
                <div class="page-side-menu">
                    <ul class="menu">
                        <li><a href="{{ route('my_classroom') }}">My Classroom</a></li>
                        <li><a href="{{ route('shopping_bag') }}">Shopping Bag</a></li>
                        <li><a href="{{ route('user_info') }}">Modifying Member Info</a></li>
                        <li><a href="{{ route('user_inquiry')  }}">1:1 Inquiry</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="section-heading">
                    <h5 class="mb-2">1:1 문의</h5>
                    <p class="mb-0">Questions & Answers in PTEdu</p>
                </div>
                <div class="row">
                    <div class="col-3 pr-0">
                        <div class="user-info bottom-border">
                            <div class="d-flex align-items-center justify-content-start" style="height:50px;">
                                <p class="mb-0 user_profile">Name<span class="text-danger">*</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-9 pl-0">
                        <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:51px;">
                            <div>
                                <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3 pr-0">
                        <div class="user-info bottom-border">
                            <div class="d-flex align-items-center justify-content-start" style="height:50px;">
                                <p class="mb-0 user_profile">Phone Number<span class="text-danger">*</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-9 pl-0">
                        <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:51px;">
                            <div>
                                <input type="text" class="form-control" name="phone_number" placeholder="Enter Mobile Number" value="{{ old('phone_number') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-5 top-border">
                    <div class="row">
                        <div class="col-3 pr-0">
                            <div class="user-info bottom-border">
                                <div class="d-flex align-items-center justify-content-start" style="height:50px;">
                                    <p class="mb-0 user_profile">Title<span class="text-danger">*</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 pl-0">
                            <div class="d-flex align-items-center bottom-border" style="padding-left:10px; height:51px;">
                                <div class="w-100">
                                    <input type="text" class="form-control" name="title" placeholder="Enter Title" value="{{ old('title') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3 pr-0">
                            <div class="user-info bottom-border">
                                <div class="d-flex  justify-content-start" style="height:200px;">
                                    <p class="mb-0 user_profile">Content<span class="text-danger">*</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 pl-0">
                            <div class="d-flex align-items-center bottom-border" style="padding-left:10px; min-height:201px; width:100%">
                                <div class="w-100">
                                    <textarea type="text" class="form-control" name="content" rows="6" placeholder="Enter Title" value="{{ old('content') }}"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <h5 class="mb-0">Answers</h5>
                </div>
                <div class="mt-2 top-border">
                    <div class="row">
                        <div class="col-3 pr-0">
                            <div class="user-info bottom-border">
                                <div class="d-flex  justify-content-start" style="height:200px;">
                                    <p class="mb-0 user_profile">Content<span class="text-danger">*</span></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-9 pl-0">
                            <div class="d-flex align-items-center bottom-border" style="padding-left:10px; min-height:201px; width:100%">
                                <div class="w-100">
                                    <textarea type="text" class="form-control" name="content" rows="6" placeholder="Enter Title" value="{{ old('content') }}">알려드립니다. 이렇게 하시면 됩니다.</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center justify-content-center mt-4">
                            <a class="btn rounded-0 btn-theme-white" style="padding: 5px 30px 5px 30px" href="{{ route('user_inquiry') }}">Go to List </a>
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

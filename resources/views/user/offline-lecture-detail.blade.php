@extends('user.layout')

@section('title', 'ptedu - Lecture Detial')

@section('content')
    <div class="section lecture_banner_section">
        <div class="lecture_banner_img" style="background-image: url({{ asset('storage/offline_course/banner/'.$course_info->course_banner) }})"></div>
        <div class="banner_text">
            <iframe style="width:100%;height:100%;" src="https://www.youtube.com/embed/{{ $embedded_video_id }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>

    <div class="section pt-40 lecture_details">
        <div class="container">
            <div class="w-80 m-auto pb-40 border-bottom-1">
                <div class="row align-items-center">
                    <div class="col-lg-9">
                        <div class="content_wrapper">
                            <h5 class="mb-3 heading">{{ $course_info->course_title }}</h5>
                            <p class="mb-0 text">{{ $course_info->short_description }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0 text">강좌금액</p>
                            <p class="mb-0 text">{{ $course_info->price }}원</p>
                        </div>
                        <button class="btn btn-danger btn-sm w-100 mb-2">마감</button>
                        <button class="btn btn-light btn-sm w-100 border-1 mb-2">예약대기</button>
                    </div>
                </div>
            </div>
            <div class="w-80 m-auto py-4">
                <ul class="nav nav-pills mb-40 nav_tabs" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                            aria-controls="pills-home" aria-selected="true">강좌 소개</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                            aria-controls="pills-profile" aria-selected="false">강사 소개</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
                            aria-controls="pills-contact" aria-selected="false">강의 후기</a>
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
                                    <td><p class="mb-0 text font-weight-bold">Name</p></td>
                                    <td><p class="mb-0 text">{{ $course_info->getTutorName->name }}</p></td>
                                </tr>
                                <tr>
                                    <td><p class="mb-0 text font-weight-bold">Email</p></td>
                                    <td><p class="mb-0 text">{{ $course_info->getTutorName->email }}</p></td>
                                </tr>
                                <tr>
                                    <td><p class="mb-0 text font-weight-bold">Phone #</p></td>
                                    <td><p class="mb-0 text">{{ $course_info->getTutorName->mobile_number }}</p></td>
                                </tr>
                                <tr>
                                    <td><p class="mb-0 text font-weight-bold">Designation</p></td>
                                    <td><p class="mb-0 text">{{ $course_info->getTutorName->job }}</p></td>
                                </tr>
                                <tr>
                                    <td><p class="mb-0 text font-weight-bold">Address</p></td>
                                    <td><p class="mb-0 text">{{ $course_info->getTutorName->address }}</p></td>
                                </tr>
                            </tbody>
                        </table>    
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <p class="mb-2 text font-weight-bold">Day 1</p>
                        <p class="mb-4 text">1. 보행 기초지식: 보행 이해를 위한 기본 운동학, 8개 보행주기의 이해(근육, 관절, 힘)<br>2. 사람 움직임으로서의 보행: 운동조절
                            이론과 보행, 보행의 개인별 다양성<br>3. 질의 응답</p>
                        <p class="mb-2 text font-weight-bold">Day 2</p>
                        <p class="mb-4 text">1. 보행 기초지식: 보행 이해를 위한 기본 운동학, 8개 보행주기의 이해(근육, 관절, 힘)<br>2. 사람 움직임으로서의 보행: 운동조절
                            이론과 보행, 보행의 개인별 다양성<br>3. 질의 응답</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
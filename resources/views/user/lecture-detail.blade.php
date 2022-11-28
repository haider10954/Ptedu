@extends('user.layout')

@section('title', 'ptedu - Lecture Detial')

@section('content')
    <div class="section lecture_banner_section">
        <div class="banner_text">
            {{-- <h5 class="mb-0">강의 영상 소개</h5> --}}
            <iframe style="width: 100%;height: 100%;" class="mb-3" src="https://www.youtube.com/embed/8SiRTLIXSzE"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
        </div>
    </div>

    <div class="section pt-4 lecture_details">
        <div class="container">
            <div class="w-80 m-auto pb-5 border-bottom-1">
                <h5 class="mb-3 heading">보행 A에서 Z까지</h5>
                <div class="row align-items-center">
                    <div class="col-lg-9">
                        <div class="content_wrapper">
                            <p class="mb-0 text">누구나 걷고 있고, 누구나 걷고 싶어하는 그 GAIT에 대해서 우리는 얼마나 잘 알고 있을까요? 보행에 대한 기초적 지식에서부터
                                임상에서의 적용, 근골격계와 신경계 환자를 아우르는 병적보행의 문제 해결과 응용, 근거 중심 물리치료를 바탕으로 한 최신 경향의 보행 논문 소개까지.<br>알지만
                                놓치고 있었던 부분, 미처 생각하지 못하고 있었던 GAIT에 대한 A~Z이상의 이야기</p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0 text">강좌금액</p>
                            <p class="mb-0 text">250,000원</p>
                        </div>
                        <button class="btn btn-danger btn-sm w-100 mb-2">마감</button>
                        <button class="btn btn-light btn-sm w-100 border-1 mb-2">예약대기</button>
                    </div>
                </div>
            </div>
            <div class="w-80 m-auto py-4">
                <ul class="nav nav-pills mb-5 nav_tabs" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                            aria-controls="pills-home" aria-selected="true">강좌 소개</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                            aria-controls="pills-profile" aria-selected="false">커리큘럼</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
                            aria-controls="pills-contact" aria-selected="false">강사 소개</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
                            aria-controls="pills-contact" aria-selected="false">강의 후기</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <p class="mb-2 text font-weight-bold">Day 1</p>
                        <p class="mb-4 text">1. 보행 기초지식: 보행 이해를 위한 기본 운동학, 8개 보행주기의 이해(근육, 관절, 힘)<br>2. 사람 움직임으로서의 보행: 운동조절
                            이론과 보행, 보행의 개인별 다양성<br>3. 질의 응답</p>
                        <p class="mb-2 text font-weight-bold">Day 2</p>
                        <p class="mb-4 text">1. 보행 기초지식: 보행 이해를 위한 기본 운동학, 8개 보행주기의 이해(근육, 관절, 힘)<br>2. 사람 움직임으로서의 보행: 운동조절
                            이론과 보행, 보행의 개인별 다양성<br>3. 질의 응답</p>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <p class="mb-2 text font-weight-bold">Day 1</p>
                        <p class="mb-4 text">1. 보행 기초지식: 보행 이해를 위한 기본 운동학, 8개 보행주기의 이해(근육, 관절, 힘)<br>2. 사람 움직임으로서의 보행: 운동조절
                            이론과 보행, 보행의 개인별 다양성<br>3. 질의 응답</p>
                        <p class="mb-2 text font-weight-bold">Day 2</p>
                        <p class="mb-4 text">1. 보행 기초지식: 보행 이해를 위한 기본 운동학, 8개 보행주기의 이해(근육, 관절, 힘)<br>2. 사람 움직임으로서의 보행: 운동조절
                            이론과 보행, 보행의 개인별 다양성<br>3. 질의 응답</p>
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

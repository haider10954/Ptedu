@extends('user.layout')

@section('title','ptedu - Online Course')

@section('content')
<div class="section lecture_banner_section">
    <div class="banner_text">
        <h5 class="mb-0">강의 영상 소개</h5>
    </div>
</div>

<div class="section pt-4 lecture_details">
    <div class="container">
        <div class="w-80 m-auto pb-5 border-bottom-1">
            <h5 class="mb-3 heading">보행 A에서 Z까지</h5>
            <div class="row align-items-center">
                <div class="col-lg-9">
                    <div class="content_wrapper">
                        <p class="mb-0 text">(Course introduction - short ver.) 누구나 걷고 있고, 누구나 걷고 싶어하는 그 GAIT에 대해서 우리는 얼마나 잘 알고 있을까요? 보행에 대한 기초적 지식에서부터 임상에서의 적용, 근골격계와 신경계 환자를 아우르는 병적보행의 문제 해결과 응용, 근거 중심 물리치료를 바탕으로 한 최신 경향의 보행 논문 소개까지.알지만 놓치고 있었던 부분, 미처 생각하지 못하고 있었던 GAIT에 대한 A~Z이상의 이야기</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0 text">Price</p>
                        <p class="mb-0 text">250,000원</p>
                    </div>
                    <button class="btn btn-dark btn-sm w-100 border-1 mb-2">수강 신청하기</button>
                </div>
            </div>
        </div>
        <div class="w-80 m-auto py-4">
            <ul class="nav nav-pills mb-5 nav_tabs" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                        aria-controls="pills-home" aria-selected="true">Course Introduction</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                        aria-controls="pills-profile" aria-selected="false">Curriculum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
                        aria-controls="pills-contact" aria-selected="false">Tutor Introduction</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-review-tab" data-toggle="pill" href="#pills-review" role="tab"
                        aria-controls="pills-review" aria-selected="false">Review</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <p class="mb-2 text font-weight-bold">Educational Goals</p>
                    <p class="mb-4 text">신경계 손상 환자의 경우라면 더더욱 떼어놓을 수 없는 보행, 움직임 그 자체로의 보행, 사람에게 있어서 보행과 그에 의미, 어떤 전략을 가지고 접근하면 환자분들의 사회에 구성원으로 복귀시킬 수 있을까 에 대한 생각을 시작으로,보행에 대한 기초적 지식에서부터 임상에서의 적용, 근골격계와 신경계 환자를 아우르는 병적보행의 문제 해결과 응용, 근거 중심 물리치료의 근간인 최신 경향의 논문의 소개까지.알지만 놓치고 있었던 부분들, 미쳐 생각하지 못하고 있었던 세세한 내용들을 많은 근거와 케이스로 업그레이드된 GAIT 특강입니다.</p>
                    <p class="mb-2 text font-weight-bold">Educational Features</p>
                    <p class="mb-4 text">임상에 계신 물리치료사 선생님들을 위해 보행 주기, 패턴, 분석 등 어떤 전략을 가지고 환자분들에게 접근해야 하는지 알아보는 온라인 교육입니다.</p>
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
                    <p class="mb-4 text">신경계 손상 환자의 경우라면 더더욱 떼어놓을 수 없는 보행, 움직임 그 자체로의 보행, 사람에게 있어서 보행과 그에 의미, 어떤 전략을 가지고 접근하면 환자분들의 사회에 구성원으로 복귀시킬 수 있을까 에 대한 생각을 시작으로,보행에 대한 기초적 지식에서부터 임상에서의 적용, 근골격계와 신경계 환자를 아우르는 병적보행의 문제 해결과 응용, 근거 중심 물리치료의 근간인 최신 경향의 논문의 소개까지.알지만 놓치고 있었던 부분들, 미쳐 생각하지 못하고 있었던 세세한 내용들을 많은 근거와 케이스로 업그레이드된 GAIT 특강입니다.</p>
                </div>
                <div class="tab-pane fade" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab">
                    <div class="section-heading d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Total 20건</h5>
                        <ul class="review-filters">
                            <li><a href="javascript:void(0)" class="text-muted review-filter-btn active">Latest Order</a></li>
                            <li><a href="javascript:void(0)" class="text-muted review-filter-btn">Ratings High Order</a></li>
                            <li><a href="javascript:void(0)" class="text-muted review-filter-btn">Ratings Low Order</a></li>
                        </ul>
                    </div>
                    <div class="review-box-wrapper">
                        <div class="left-content">
                            <small class="text-muted mb-2 d-block">Name <span class="mx-2">|</span> 2022.11.08</small>
                            <div class="d-flex align-items-center mb-2">
                                <small class="text-muted">Course Name</small>
                                <div class="d-flex align-items-center gap-1 mx-4 rating-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                            <p class="font-weight-bold text mb-2">Review Title</p>
                            <p>Review contents Review contentsReview contentsReview contentsReview contentsReview contents Review contentsReview contentsReview contentsReview contentsReview contentsReview contents Review contentsReview contentsReview contentsReview contents</p>
                        </div>
                        <div class="right-content">
                            <img src="{{ asset('web_assets/images/image_307.png') }}" alt="img">
                        </div>
                    </div>
                    <div class="review-box-wrapper">
                        <div class="left-content">
                            <small class="text-muted mb-2 d-block">Name <span class="mx-2">|</span> 2022.11.08</small>
                            <div class="d-flex align-items-center mb-2">
                                <small class="text-muted">Course Name</small>
                                <div class="d-flex align-items-center gap-1 mx-4 rating-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                            <p class="font-weight-bold text mb-2">Review Title</p>
                            <p>Review contents Review contentsReview contentsReview contentsReview contentsReview contents Review contentsReview contentsReview contentsReview contentsReview contentsReview contents Review contentsReview contentsReview contentsReview contents</p>
                        </div>
                        <div class="right-content">
                            <img src="{{ asset('web_assets/images/image_307.png') }}" alt="img">
                        </div>
                    </div>
                    <div class="review-box-wrapper">
                        <div class="left-content">
                            <small class="text-muted mb-2 d-block">Name <span class="mx-2">|</span> 2022.11.08</small>
                            <div class="d-flex align-items-center mb-2">
                                <small class="text-muted">Course Name</small>
                                <div class="d-flex align-items-center gap-1 mx-4 rating-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                            <p class="font-weight-bold text mb-2">Review Title</p>
                            <p>Review contents Review contentsReview contentsReview contentsReview contentsReview contents Review contentsReview contentsReview contentsReview contentsReview contentsReview contents Review contentsReview contentsReview contentsReview contents</p>
                        </div>
                        <div class="right-content">
                            <img src="{{ asset('web_assets/images/image_307.png') }}" alt="img">
                        </div>
                    </div>
                    <div class="review-box-wrapper">
                        <div class="left-content">
                            <small class="text-muted mb-2 d-block">Name <span class="mx-2">|</span> 2022.11.08</small>
                            <div class="d-flex align-items-center mb-2">
                                <small class="text-muted">Course Name</small>
                                <div class="d-flex align-items-center gap-1 mx-4 rating-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                            <p class="font-weight-bold text mb-2">Review Title</p>
                            <p>Review contents Review contentsReview contentsReview contentsReview contentsReview contents Review contentsReview contentsReview contentsReview contentsReview contentsReview contents Review contentsReview contentsReview contentsReview contents</p>
                        </div>
                        <div class="right-content">
                            <img src="{{ asset('web_assets/images/image_307.png') }}" alt="img">
                        </div>
                    </div>
                    <div class="review-box-wrapper">
                        <div class="left-content">
                            <small class="text-muted mb-2 d-block">Name <span class="mx-2">|</span> 2022.11.08</small>
                            <div class="d-flex align-items-center mb-2">
                                <small class="text-muted">Course Name</small>
                                <div class="d-flex align-items-center gap-1 mx-4 rating-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                            <p class="font-weight-bold text mb-2">Review Title</p>
                            <p>Review contents Review contentsReview contentsReview contentsReview contentsReview contents Review contentsReview contentsReview contentsReview contentsReview contentsReview contents Review contentsReview contentsReview contentsReview contents</p>
                        </div>
                        <div class="right-content">
                            <img src="{{ asset('web_assets/images/image_307.png') }}" alt="img">
                        </div>
                    </div>
                    <div class="review-box-wrapper">
                        <div class="left-content">
                            <small class="text-muted mb-2 d-block">Name <span class="mx-2">|</span> 2022.11.08</small>
                            <div class="d-flex align-items-center mb-2">
                                <small class="text-muted">Course Name</small>
                                <div class="d-flex align-items-center gap-1 mx-4 rating-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                            <p class="font-weight-bold text mb-2">Review Title</p>
                            <p>Review contents Review contentsReview contentsReview contentsReview contentsReview contents Review contentsReview contentsReview contentsReview contentsReview contentsReview contents Review contentsReview contentsReview contentsReview contents</p>
                        </div>
                        <div class="right-content">
                            <img src="{{ asset('web_assets/images/image_307.png') }}" alt="img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
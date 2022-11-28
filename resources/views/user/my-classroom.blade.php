@extends('user.layout')

@section('title', 'ptedu - My Classroom')

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
                        <li><a href="javascript:void(0)">My Classroom</a></li>
                        <li><a href="javascript:void(0)">Shopping Bag</a></li>
                        <li><a href="javascript:void(0)">Modifying Member Info</a></li>
                        <li><a href="javascript:void(0)">1:1 Inquiry</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="section-heading mb-3">
                    <h5 class="mb-0">마이페이지</h5>
                </div>
                <ul class="nav nav-pills mb-3 custom-tabs" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="pills-home-tab" data-toggle="pill" data-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Lecture in progress</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Completed Lecture</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-contact-tab" data-toggle="pill" data-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Lecture on “Like”</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-complete-tab" data-toggle="pill" data-target="#pills-complete" type="button" role="tab" aria-controls="pills-complete" aria-selected="false">Related Lectures List</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="custom-tab-content">
                            <h6 class="content-heading">Lecture in Progress (6)</h6>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-12">
                                    <div class="lecture-box">
                                        <img src="{{ asset('web_assets/images/lecture_img.png') }}" class="lecture_img img-fluid" alt="lecture_img">
                                        <div class="lecture_box_content">
                                            <h6 class="lecture_title">[2022 PTedu] pelvic healthe Integration
                                                - Melissa Devidson</h6>
                                            <small class="d-block text-muted mb-2 lecture_info">Physical Teraphy   l    Tutor Name</small>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <small class="lecture-duration">2022-10-12 ~ 2022-11-30</small>    
                                                <a href="javascript:void(0)" class="btn btn-primary btn-custom-sm btn-theme-blue">수강중</a>  
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12">
                                    <div class="lecture-box">
                                        <img src="{{ asset('web_assets/images/lecture_img_2.png') }}" class="lecture_img img-fluid" alt="lecture_img">
                                        <div class="lecture_box_content">
                                            <h6 class="lecture_title">[2022 PTedu] pelvic healthe Integration
                                                - Melissa Devidson</h6>
                                            <small class="d-block text-muted mb-2 lecture_info">Physical Teraphy   l    Tutor Name</small>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <small class="lecture-duration">2022-10-12 ~ 2022-11-30</small>    
                                                <a href="javascript:void(0)" class="btn btn-primary btn-custom-sm btn-theme-black">예약대기</a>  
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12">
                                    <div class="lecture-box">
                                        <img src="{{ asset('web_assets/images/lecture_img.png') }}" class="lecture_img img-fluid" alt="lecture_img">
                                        <div class="lecture_box_content">
                                            <h6 class="lecture_title">[2022 PTedu] pelvic healthe Integration
                                                - Melissa Devidson</h6>
                                            <small class="d-block text-muted mb-2 lecture_info">Physical Teraphy   l    Tutor Name</small>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <small class="lecture-duration">2022-10-12 ~ 2022-11-30</small>    
                                                <a href="javascript:void(0)" class="btn btn-primary btn-custom-sm btn-theme-blue">수강중</a>  
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12">
                                    <div class="lecture-box">
                                        <img src="{{ asset('web_assets/images/lecture_img_2.png') }}" class="lecture_img img-fluid" alt="lecture_img">
                                        <div class="lecture_box_content">
                                            <h6 class="lecture_title">[2022 PTedu] pelvic healthe Integration
                                                - Melissa Devidson</h6>
                                            <small class="d-block text-muted mb-2 lecture_info">Physical Teraphy   l    Tutor Name</small>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <small class="lecture-duration">2022-10-12 ~ 2022-11-30</small>    
                                                <a href="javascript:void(0)" class="btn btn-primary btn-custom-sm btn-theme-black">예약대기</a>  
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12">
                                    <div class="lecture-box">
                                        <img src="{{ asset('web_assets/images/lecture_img.png') }}" class="lecture_img img-fluid" alt="lecture_img">
                                        <div class="lecture_box_content">
                                            <h6 class="lecture_title">[2022 PTedu] pelvic healthe Integration
                                                - Melissa Devidson</h6>
                                            <small class="d-block text-muted mb-2 lecture_info">Physical Teraphy   l    Tutor Name</small>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <small class="lecture-duration">2022-10-12 ~ 2022-11-30</small>    
                                                <a href="javascript:void(0)" class="btn btn-primary btn-custom-sm btn-theme-blue">수강중</a>  
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12">
                                    <div class="lecture-box">
                                        <img src="{{ asset('web_assets/images/lecture_img_2.png') }}" class="lecture_img img-fluid" alt="lecture_img">
                                        <div class="lecture_box_content">
                                            <h6 class="lecture_title">[2022 PTedu] pelvic healthe Integration
                                                - Melissa Devidson</h6>
                                            <small class="d-block text-muted mb-2 lecture_info">Physical Teraphy   l    Tutor Name</small>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <small class="lecture-duration">2022-10-12 ~ 2022-11-30</small>    
                                                <a href="javascript:void(0)" class="btn btn-primary btn-custom-sm btn-theme-black">예약대기</a>  
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="custom-tab-content">
                            <h6 class="content-heading">Completed Lectures (2)</h6>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-12">
                                    <div class="lecture-box">
                                        <img src="{{ asset('web_assets/images/lecture_img.png') }}" class="lecture_img img-fluid" alt="lecture_img">
                                        <div class="lecture_box_content">
                                            <h6 class="lecture_title">[2022 PTedu] pelvic healthe Integration
                                                - Melissa Devidson</h6>
                                            <small class="d-block text-muted mb-2 lecture_info">Physical Teraphy   l    Tutor Name</small>
                                            <small class="lecture-duration mb-4 d-block">2022-10-12 ~ 2022-11-30</small>
                                            <div class="d-flex align-items-center justify-content-between">    
                                                <a href="javascript:void(0)" class="btn btn-primary btn-custom-sm btn-theme-light w-50" data-toggle="modal" data-target="#reviewModal"> <i class="fas fa-edit"></i> 후기작성</a>
                                                <a href="javascript:void(0)" class="btn btn-primary btn-custom-sm btn-theme-black w-48"> <i class="fas fa-medal"></i> 수료증발급</a>  
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12">
                                    <div class="lecture-box">
                                        <img src="{{ asset('web_assets/images/lecture_img_2.png') }}" class="lecture_img img-fluid" alt="lecture_img">
                                        <div class="lecture_box_content">
                                            <h6 class="lecture_title">[2022 PTedu] pelvic healthe Integration
                                                - Melissa Devidson</h6>
                                            <small class="d-block text-muted mb-2 lecture_info">Physical Teraphy   l    Tutor Name</small>
                                            <small class="lecture-duration mb-4 d-block">2022-10-12 ~ 2022-11-30</small>
                                            <div class="d-flex align-items-center justify-content-between">    
                                                <a href="javascript:void(0)" class="btn btn-primary btn-custom-sm btn-theme-light w-50" data-toggle="modal" data-target="#reviewModal"> <i class="fas fa-edit"></i> 후기작성</a>
                                                <a href="javascript:void(0)" class="btn btn-primary btn-custom-sm btn-theme-black w-48"> <i class="fas fa-medal"></i> 수료증발급</a>  
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="custom-tab-content">
                            <h6 class="content-heading">Lecture on “Like” (2)</h6>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-12">
                                    <div class="lecture-box">
                                        <img src="{{ asset('web_assets/images/lecture_img.png') }}" class="lecture_img img-fluid" alt="lecture_img">
                                        <div class="lecture_box_content">
                                            <h6 class="lecture_title">[2022 PTedu] pelvic healthe Integration
                                                - Melissa Devidson</h6>
                                            <small class="d-block text-muted mb-2 lecture_info">Physical Teraphy   l    Tutor Name</small>
                                            <small class="lecture-duration d-block">2022-10-12 ~ 2022-11-30</small>  
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12">
                                    <div class="lecture-box">
                                        <img src="{{ asset('web_assets/images/lecture_img_2.png') }}" class="lecture_img img-fluid" alt="lecture_img">
                                        <div class="lecture_box_content">
                                            <h6 class="lecture_title">[2022 PTedu] pelvic healthe Integration
                                                - Melissa Devidson</h6>
                                            <small class="d-block text-muted mb-2 lecture_info">Physical Teraphy   l    Tutor Name</small>
                                            <small class="lecture-duration d-block">2022-10-12 ~ 2022-11-30</small>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-complete" role="tabpanel" aria-labelledby="pills-complete-tab">
                        <div class="custom-tab-content">
                            <h6 class="content-heading">Related Lectures (2)</h6>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-12">
                                    <div class="lecture-box">
                                        <img src="{{ asset('web_assets/images/lecture_img.png') }}" class="lecture_img img-fluid" alt="lecture_img">
                                        <div class="lecture_box_content">
                                            <h6 class="lecture_title">[2022 PTedu] pelvic healthe Integration
                                                - Melissa Devidson</h6>
                                            <small class="d-block text-muted mb-2 lecture_info">Physical Teraphy   l    Tutor Name</small>
                                            <small class="lecture-duration d-block">2022-10-12 ~ 2022-11-30</small>  
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12">
                                    <div class="lecture-box">
                                        <img src="{{ asset('web_assets/images/lecture_img_2.png') }}" class="lecture_img img-fluid" alt="lecture_img">
                                        <div class="lecture_box_content">
                                            <h6 class="lecture_title">[2022 PTedu] pelvic healthe Integration
                                                - Melissa Devidson</h6>
                                            <small class="d-block text-muted mb-2 lecture_info">Physical Teraphy   l    Tutor Name</small>
                                            <small class="lecture-duration d-block">2022-10-12 ~ 2022-11-30</small>    
                                        </div>
                                    </div>
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
    $('.page-side-menu-toggle').on('click',function(){
        $('.page-side-menu').slideToggle();
    });
</script>
@endsection

@section('modals')
<div class="modal fade review_modal" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-custom modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center" id="exampleModalLabel"><i class="fas fa-star text-theme-yellow"></i> <span>Write a Review</span></h5>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <div class="d-flex align-items-center gap-1 rating-stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
            </div>
          </div>
          <div class="row align-items-center mb-3">
            <div class="col-lg-2">
                <label for="course_name mb-0">Course Name</label>
            </div>
            <div class="col-lg-10">
                <input type="text" name="course_name" id="course_name" placeholder="Enter Course Name" value="[2022 PTedu] pelvic healthe Integration - Melissa Devidson" class="form-control">
            </div>
          </div>
          <div class="row align-items-center mb-3">
            <div class="col-lg-2">
                <label for="writer mb-0">Writer</label>
            </div>
            <div class="col-lg-10">
                <input type="text" name="writer" id="writer" placeholder="Enter Writer Name" value="홍길동" class="form-control">
            </div>
          </div>
          <div class="row align-items-center mb-3">
            <div class="col-lg-2">
                <label for="title mb-0">Title</label>
            </div>
            <div class="col-lg-10">
                <input type="text" name="title" id="title" placeholder="Write in a title here" class="form-control">
            </div>
          </div>
          <div class="row align-items-center mb-3">
            <div class="col-lg-2">
                <label for="contents mb-0">Contents</label>
            </div>
            <div class="col-lg-10">
                <input type="text" name="contents" id="contents" placeholder="Write a review in here" class="form-control">
            </div>
          </div>
          <div class="my-3 d-flex align-items-center justify-content-center">
            <button type="button" class="btn btn-primary mr-2 rounded-0 btn-theme-black">Register</button>
            <button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@extends('admin.layout.layout')

@section('title' , 'Add Course')

@section('custom-style')
<style>
    .hr-color {
        border: 1px solid #C4C4C4;
    }

    .btn-register {
        width: 103px;
        height: 37px;

        background: #F0F0F0;
        border: 1.43489px solid #DFE0EB;
        border-radius: 2.86978px;
        color: #6F6F6F;
        font-weight: 400;
        font-size: 14px;
    }

    .course-image-preview {
        width: 150px;
        height: 150px;
        background: #FFFFFF;
        /* grayscale / divider */
        border: 1px solid #DFE0EB;
        border-radius: 2px;
        display: flex;
        justify-content: center;
        align-items: center;

    }

    .course-image-preview img {
        width: 20px;
        height: 20px;
    }

    .btn-upload {
        background: #F0F0F0;
        border: 1px solid #DFE0EB;
        border-radius: 2px;
        color: #6F6F6F;
    }

    .btn-upload:hover {
        background: #F0F0F0;
        border: 1px solid #DFE0EB;
        border-radius: 2px;
        color: #6F6F6F;
    }

    .btn-add-section {
        background: #FFFFFF;
        border: 1px solid #696CFF;
        border-radius: 2px;
        font-weight: 400;
        font-size: 13px;
        line-height: 23px;
        color: #696CFF;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 4px 16px;
    }

    .btn-add-section:hover {
        background: #FFFFFF;
        border: 1px solid #696CFF;
        border-radius: 2px;
        font-weight: 400;
        font-size: 13px;
        line-height: 23px;
        color: #696CFF;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 4px 16px;
    }

    .lecture-form {
        font-weight: 400 !important;
        font-size: 14px !important;
        line-height: 23px !important;
        color: #6F6F6F !important;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0  Card_title">Lecture List > Add Lecture</h4>
                </div>
                <hr class="hr-color" />
            </div>
            <div class="col-12">
                <form>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Course Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="horizontal-firstname-input" placeholder="Enter Course Title" name="course_title">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Tutor Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="horizontal-email-input" placeholder="Enter Tutor Name" name="tutor_name">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Short Description</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="horizontal-password-input" placeholder="Enter Short Description" name="short_description">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="description" rows="2" placeholder="Enter Description" name="description"></textarea>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Total number of Lectures</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" placeholder="Enter total number of lectures" name="no_of_lectures"></input>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Duration of the Course</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Duration of the Course" name="course_duration"></input>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Price</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" placeholder="Enter price" name="price"></input>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Discounted Price</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" placeholder="Enter discounted Price" name="discounted_Price"></input>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Category</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter category" name="category"></input>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Upload Video URL</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter video URL" name="video_url"></input>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Upload Video Type(Youtube , Vimeo)</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter Upload Video Type(Youtube , Vimeo)" name="video_type"></input>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Upload course Thumbnail image</label>
                        <div class="col-sm-10">
                            <input type="file" name="course_img" id="course_img" class="d-none">
                            <div class="d-flex align-items-end">
                                <div class="course-image-preview">
                                    <img src="{{ asset('assets/images/icons/image.png') }}" />
                                </div>
                                <button type="button" class="btn btn-upload ms-2" onclick="courseImg('#course_img')">upload</button>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Upload banner image</label>
                        <div class="col-sm-10">
                            <input type="file" name="banner_img" id="banner_img" class="d-none">
                            <div class="d-flex align-items-end">
                                <div class="course-image-preview">
                                    <img src="{{ asset('assets/images/icons/image.png') }}" />
                                </div>
                                <button type="button" class="btn btn-upload ms-2" onclick="courseImg('#banner_img')">upload</button>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Curriculum</label>
                        <div class="col-sm-10">
                            <div class="d-flex gap-1">
                                <button class="btn btn-sm btn-add-section"><span><i class="bi bi-plus "></i></span>Add Section</button>
                                <button class="btn btn-sm btn-add-section"><span><i class="bi bi-plus "></i></span>Add Lesson</button>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3 px-4 py-3 bg-light">
                                <h3>Section 1.Welcome</h3>
                                <div class="d-flex gap-1">
                                    <button class="btn btn-sm btn-add-section"><span><i class="bi bi-dash "></i></span> Edit</button>
                                    <button class="btn btn-sm btn-add-section"><span><i class="bi bi-x "></i></span> Delete</button>
                                </div>
                            </div>
                            <div class="px-4">
                                <h5 class="py-2 mb-0">Hi there is about aaaa lecture</h5>
                                <ul class="list-group">
                                    <li class="list-group-item border-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div><i class="bi bi-play-circle-fill me-2"></i>Chap1. 바디 밸런스&바른 자세 100일 솔루션 키트 설명서.</div> <span>30:00 </span>
                                        </div>
                                    </li>
                                    <li class="list-group-item border-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div><i class="bi bi-play-circle-fill me-2"></i>Chap2. 바디 밸런스&바른 자세 100일 솔루션 키트 설명서.</div> <span>30:00 </span>
                                        </div>
                                    </li>
                                    <li class="list-group-item border-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div><i class="bi bi-play-circle-fill me-2"></i>chap3. 강. 바디 밸런스&바른 자세 100일 솔루션 키트 설명서.</div> <span>30:00 </span>
                                        </div>
                                    </li>
                                    <li class="list-group-item border-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div><i class="bi bi-play-circle-fill me-2"></i>chap4. 강. 바디 밸런스&바른 자세 100일 솔루션 키트 설명서</div> <span>30:00 </span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-lg btn-register">Register</button>
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
    function courseImg(id) {
        $(id).click();
    }
</script>
@endsection

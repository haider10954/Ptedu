@extends('admin.layout.layout')

@section('title' , 'Add Certificate')

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
                    <h4 class="mb-sm-0  Card_title">Generate a Certificate</h4>
                </div>
                <hr class="hr-color" />
            </div>
            <div class="col-12">
                <form>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Certificate Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="horizontal-firstname-input" name="certificate_number" placeholder="Enter Certificate Number">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="horizontal-email-input" name="name" placeholder="Enter name">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Course Name</label>
                        <div class="col-sm-10">
                            <select type="text" class="form-control" name="course_name">
                                <option>Enter course name</option>
                                <option>Course 1</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Course Period</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="course_period" placeholder="Enter course period"></input>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Issue Date</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="issue_date" placeholder="Enter issue date"></input>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-2 "></div>
                        <div class="col-sm-10">
                            <a href="{{ route('generate_certificate') }}" type="submit" class="btn btn-lg btn-register">Register</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

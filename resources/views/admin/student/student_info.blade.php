@extends('admin.layout.layout')

@section('title' , 'Student Information')

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
                    <h4 class="mb-sm-0  Card_title">Student Info Detail</h4>
                </div>
                <hr class="hr-color" />
            </div>
            <div class="col-12">
                <form>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="horizontal-firstname-input" name="name">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">English Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="horizontal-email-input" name="en_name">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">ID(Email)</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="horizontal-password-input" name="email">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Phone Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="horizontal-email-input" name="phone_numberx">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Job</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="job"></input>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Address</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="address"></input>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Affiliation</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="affiliation"></input>
                        </div>
                    </div>


                    <div class="row mb-4">
                        <div class="col-sm-12 d-flex justify-content-center align-content-center">
                            <button type="submit" class="btn btn-lg btn-register">Ok</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
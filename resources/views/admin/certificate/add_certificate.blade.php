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
                    <h4 class="mb-sm-0  Card_title">{{__('translation.Generate a Certificate')}}</h4>
                </div>
                <hr class="hr-color" />
            </div>
            <div>
                @if (Session::has('success'))
                <p class="alert alert-info" id="responseMessage">{{ Session::get('success') }}</p>
                @endif
                @if (Session::has('error'))
                <p class="alert alert-danger" id="responseMessage">{{ Session::get('error') }}</p>
                @endif
            </div>
            <div class="col-12">
                <form method="post" action="{{ route('generate-certificate') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $certificate->id ?? '' }}">
                    <input type="hidden" name="course_id" value="{{  Request::segment(4) }}">
                    <input type="hidden" name="user_id" value="{{  Request::segment(5) }}">

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{__('translation.Certificate Number')}}</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="horizontal-firstname-input" name="certificate_number" placeholder="{{ __('translation.Enter Certificate Number') }}" value="{{ $certificate->certificate_number }}">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{__('translation.Name')}}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="horizontal-email-input" placeholder="{{__('translation.Enter Name') }}" value="{{ $add_certificate->getUser->name }}">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{__('translation.Course Name')}}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="course_name" value="{{ $add_certificate->getCourses->course_title }}">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{__('translation.Course Period')}}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="course_period" placeholder="{{__('translation.Enter course period')}}" value="{{ $certificate->course_duration }}" />
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Issue Date') }}</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="issue_date" placeholder="{{__('translation.Enter issue date')}}" value="{{ $certificate->issue_date }}" />
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-2 "></div>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-lg btn-register">{{__('translation.Register')}}</button>
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
        setTimeout(function() {
            $("#responseMessage").hide()
        }, 2000);
    });
</script>
@endsection
@extends('admin.layout.layout')

@section('title' , 'Inquiry Answer')

@section('custom-style')
<style>
    .Card_title {
        font-size: 18px !important;
        font-weight: 500 !important;
        color: black;
        text-transform: capitalize !important;
    }

    .date {
        font-weight: 500;
        font-size: 12px;
        line-height: 23px;
        color: #9E9E9E;
    }

    .divider {
        border: 2px solid #000000;
    }

    .course_info {
        font-weight: 400;
        font-size: 12px;
        line-height: 23px;
        color: #6F6F6F;
    }

    .course_details {
        font-weight: 400;
        font-size: 12px;
        line-height: 23px;
        color: black;
    }

    .col-bg {
        background: rgba(242, 243, 250, 0.8);
    }

    .course_info_border {
        border: 2px solid black;
    }

    .payment_info_border {
        border: 1px solid #191B1D;
    }

    .answer {
        font-weight: 700;
        font-size: 15px;
        line-height: 18px;

        color: #000000;
    }
</style>

@endsection


@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12 mb-5">
                <div class="row mx-0">
                    <hr class="course_info_border" />
                    <div class="col-3 col-bg">
                        <div class="d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_info">Name</h4>
                        </div>
                        <div class=" d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_info">Date</h4>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_details">이**</h4>
                        </div>
                        <div class=" d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_details">2022/10/18</h4>
                        </div>
                    </div>
                </div>
                <hr class="payment_info_border" />

                <div class="row mx-0">
                    <hr class="course_info_border" />
                    <div class="col-3 col-bg">
                        <div class="d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_info">Title</h4>
                        </div>
                        <div class=" d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_info">Content</h4>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_details">문의합니다</h4>
                        </div>
                        <div class=" d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_details">수업 신청은 어떻게 하나요? <br> 알려주세요.</h4>
                        </div>
                    </div>
                </div>
                <hr class="payment_info_border" />

                <h4 class="answer mb-2">Answer</h4>
                <div class="row mx-0">
                    <hr class="course_info_border" />
                    <div class="col-3 col-bg">
                        <div class="d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_info">Contents</h4>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_details">알려드립니다.<br> 이렇게 하시면 됩니다.<br>ㅣ</h4>
                        </div>
                    </div>
                </div>
                <hr class="payment_info_border" />
            </div>
        </div>
    </div>
</div>
@endsection

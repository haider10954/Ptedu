@extends('admin.layout.layout')

@section('title' , 'View Payment')

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
        border: 1px solid #000000;
    }

    .payment_info_border {
        border-bottom: 1px solid #DFE0EB;
    }

    tbody tr {
        border-bottom: 1px solid #DFE0EB;
    }

    .td-left {
        background-color: rgba(242, 243, 250, 0.8) !important;
        line-height: 23px;
        width: 15%;
    }

    .table-border-c {
        border-bottom: 2px solid #000000;
    }
</style>

@endsection


@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12 mb-5">
                <div class="page-title-box d-flex align-items-center">
                    <h4 class="mb-sm-0  Card_title">Payment Management (100)</h4>
                    <h6 class="date mb-0 ms-2">2022 - 10 - 13</h6>
                </div>
            </div>
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center">
                    <h4 class="mb-sm-0  Card_title">Course Information</h4>
                </div>
                <hr class="divider" />
            </div>
            <div class="col-12">
                <div class="row mx-0">
                    <div class="col-3 col-bg">
                        <div class="d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_info">Course Name</h4>
                        </div>
                        <div class=" d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_info">Tutor Name</h4>
                        </div>
                        <div class=" d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_info">Duration of the Course</h4>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_details">보행 A에서 Z까지</h4>
                        </div>
                        <div class=" d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_details">조규행</h4>
                        </div>
                        <div class=" d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_details">2022 - 10 - 13 ~ 2022 - 11 - 13 (Duration course : 30days)</h4>
                        </div>
                    </div>
                    <div class="col-3 col-bg">
                        <div class="d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_info">Course Type</h4>
                        </div>
                        <div class=" d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_info">Course composition</h4>
                        </div>
                        <div class=" d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_info">Production Type</h4>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_details">Expert Course</h4>
                        </div>
                        <div class=" d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_details">Total 20 Lecture / 360min</h4>
                        </div>
                        <div class=" d-flex align-items-center mb-3">
                            <h4 class="mb-sm-0  course_details">Video Lecture</h4>
                        </div>
                    </div>
                </div>
                <hr class="course_info_border" />
            </div>
            <div class="col-12 mt-4">
                <div class="page-title-box d-flex align-items-center">
                    <h4 class="mb-sm-0  Card_title">Payment Information</h4>
                </div>
                <hr class="divider" />
                <table class="table table-border-c">
                    <tbody>
                        <tr>
                            <td class="td-left">Payment No</td>
                            <td>A54312388 </td>
                        </tr>
                        <tr>
                            <td class="td-left">Payment Date</td>
                            <td>2022 - 10 - 13</td>
                        </tr>
                        <tr>
                            <td class="td-left">Method Payment</td>
                            <td>a deposit without a bankbook</td>
                        </tr>
                        <tr>
                            <td class="td-left">Payment Price</td>
                            <td>300,000 원</td>
                        </tr>
                        <tr>
                            <td class="td-left">Payment Status</td>
                            <td>Payment success</td>
                        </tr>
                        <tr>
                            <td class="td-left">Virtual Account number</td>
                            <td> Hana Bank 801100-00-000000</td>
                        </tr>
                        <tr>
                            <td class="td-left">Cash receipt number</td>
                            <td>개인 010-0000-0000 </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

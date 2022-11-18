@extends('admin.layout.layout')

@section('title' , 'Payment Management')

@section('custom-style')
<style>
    .Card_title {
        font-size: 18px !important;
        font-weight: 500 !important;
        color: black;
        text-transform: capitalize !important;
    }

    .hr-color {
        border: 1px solid #C4C4C4;
    }

    .t_header {
        font-weight: 400;
        font-size: 12px;
        line-height: 23px;
        color: #6F6F6F;
    }

    .course_name {
        font-weight: 400;
        font-size: 13px;
        line-height: 15px;
        color: #000000;
    }

    .tutor_name {
        font-weight: 400;
        font-size: 13px;
        line-height: 15px;
        color: #9E9E9E;
    }

    .paginate {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .paginate a {
        font-size: 15px;
        color: #9f9f9f;
        margin-left: 15px;
        margin-right: 15px;
    }

    .paginate a.active {
        color: black;
    }

    .paginate a.paginate-btn {
        background: transparent;
        padding: 2px 10px;
        color: #9FA2B4;
        border-radius: 50%;
    }

    .page_navigate_btn {
        color: #000000 !important;
    }

    tbody>tr:nth-child(odd) {
        background-color: rgba(242, 243, 250, 0.8);
    }

    .status-badge {
        background: #DAE6FF;
        border-radius: 2px;
        color: #6780FF;
        height: 19px;
        width: 62px;
        line-height: 15px
    }
</style>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0  Card_title">Payment Management (100)</h4>
                </div>
                <hr class="hr-color" />
            </div>
            <div class="col-lg-12 table-responsive">
                <table class="table align-middle table-nowrap mb-0  table-lectures border-white" id="myTable">
                    <thead>
                        <tr>
                            <td class="align-middle t_header">No</td>
                            <td class="align-middle t_header">Date</td>
                            <td class="align-middle t_header">Buyer</th>
                            <td class="align-middle t_header">Course Name</td>
                            <td class="align-middle t_header">Price</th>
                            <td class="align-middle t_header">Status</td>
                            <td class="align-middle t_header">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                <span class="course_name">2022 - 10 - 13</span>
                            </td>
                            <td><span class="course_name">홍길동</span></td>
                            <td>
                                <span class="course_name">보행 A에서 Z까지</span>
                                <br />
                                <span class="tutor_name">조규행</span>
                            </td>
                            <td><span class="course_name">300,000 원</span></td>
                            <td><span class="badge status-badge ">Success</span></td>

                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('view_payment')}}" class="btn btn-sm btn-warning"><i class="bi bi-eye"></i></a>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>
                                <span class="course_name">2022 - 10 - 13</span>
                            </td>
                            <td><span class="course_name">홍길동</span></td>
                            <td>
                                <span class="course_name">보행 A에서 Z까지</span>
                                <br />
                                <span class="tutor_name">조규행</span>
                            </td>
                            <td><span class="course_name">300,000 원</span></td>
                            <td><span class="badge status-badge ">Success</span></td>

                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('view_payment')}}" class="btn btn-sm btn-warning"><i class="bi bi-eye"></i></a>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>
                                <span class="course_name">2022 - 10 - 13</span>
                            </td>
                            <td><span class="course_name">홍길동</span></td>
                            <td>
                                <span class="course_name">보행 A에서 Z까지</span>
                                <br />
                                <span class="tutor_name">조규행</span>
                            </td>
                            <td><span class="course_name">300,000 원</span></td>
                            <td><span class="badge status-badge ">Success</span></td>

                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('view_payment')}}" class="btn btn-sm btn-warning"><i class="bi bi-eye"></i></a>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td>
                                <span class="course_name">2022 - 10 - 13</span>
                            </td>
                            <td><span class="course_name">홍길동</span></td>
                            <td>
                                <span class="course_name">보행 A에서 Z까지</span>
                                <br />
                                <span class="tutor_name">조규행</span>
                            </td>
                            <td><span class="course_name">300,000 원</span></td>
                            <td><span class="badge status-badge ">Success</span></td>

                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('view_payment')}}" class="btn btn-sm btn-warning"><i class="bi bi-eye"></i></a>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>5</td>
                            <td>
                                <span class="course_name">2022 - 10 - 13</span>
                            </td>
                            <td><span class="course_name">홍길동</span></td>
                            <td>
                                <span class="course_name">보행 A에서 Z까지</span>
                                <br />
                                <span class="tutor_name">조규행</span>
                            </td>
                            <td><span class="course_name">300,000 원</span></td>
                            <td><span class="badge status-badge ">Success</span></td>

                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('view_payment')}}" class="btn btn-sm btn-warning"><i class="bi bi-eye"></i></a>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>6</td>
                            <td>
                                <span class="course_name">2022 - 10 - 13</span>
                            </td>
                            <td><span class="course_name">홍길동</span></td>
                            <td>
                                <span class="course_name">보행 A에서 Z까지</span>
                                <br />
                                <span class="tutor_name">조규행</span>
                            </td>
                            <td><span class="course_name">300,000 원</span></td>
                            <td><span class="badge status-badge ">Success</span></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('view_payment')}}" class="btn btn-sm btn-warning"><i class="bi bi-eye"></i></a>
                                </div>
                            </td>
                        </tr>


                    </tbody>
                </table>

                <div class="paginate mt-4 mb-3">
                    <a href="javascript:void(0)" class="page_navigate_btn"><i class="bi bi-chevron-left"></i></a>

                    <a href="javascript:void(0)" class="active">1</a>
                    <a href="javascript:void(0)">2</a>
                    <a href="javascript:void(0)">3</a>
                    <a href="javascript:void(0)" class="page_navigate_btn"><i class="bi bi-chevron-right"></i></a>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

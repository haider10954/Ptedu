@extends('admin.layout.layout')

@section('title' , 'Completed Student')

@section('custom-style')
<style>
    .Card_title {
        font-size: 18px !important;
        font-weight: 500 !important;
        color: black;
        text-transform: capitalize !important;
    }

    .btn-add-lecture {
        background: #FFFFFF;
        border: 0.8px solid rgba(161, 172, 184, 0.5);
        border-radius: 2px;
        height: 28px;
        padding: 5px 15px 5px 15px;
    }

    .btn-add-lecture:hover {
        background: #FFFFFF;
        border: 0.8px solid rgba(161, 172, 184, 0.5);
        border-radius: 2px;
        height: 28px;
        padding: 5px 15px 5px 15px;
        color: black;
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

    .status-badge {
        background: #E8F9DF;
        border-radius: 2px;
        color: #64C330;
        height: 19px;
        width: 62px;
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

    .btn-status {
        width: 103px;
        height: 37.31px;
        background: #F0F0F0;
        border: 1.43489px solid #DFE0EB;
        border-radius: 2.86978px;
        font-weight: 400;
        font-size: 12px;
        line-height: 15px;
        color: #000000;
    }
</style>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0  Card_title">Student who Completed (120)</h4>
                </div>
                <hr class="hr-color" />
            </div>
            <div class="col-lg-12 table-responsive">
                <table class="table align-middle table-nowrap mb-0  table-lectures border-white" id="myTable">
                    <thead>
                        <tr>
                            <td class="align-middle t_header">No</td>
                            <td class="align-middle t_header">Date</td>
                            <td class="align-middle t_header">Name</td>
                            <td class="align-middle t_header">Course Name</td>
                            <td class="align-middle t_header">Completion status</td>
                            <td class="align-middle t_header">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                <span class="course_name">22 - 10 - 13</span>
                            </td>
                            <td>
                                <span class="course_name">홍길동</span>
                            </td>
                            <td>
                                <span class="course_name">보행 A에서 Z까지</span> <br>
                                <span class="tutor_name">조규행</span>
                            </td>
                            <td><a href="{{ route('add_certificate')}}" class="btn btn-status">Completion</a></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a class="btn btn-sm btn-warning"><i class="bi bi-eye"></i></a>
                                    <a class="btn btn-sm btn-primary" href="{{ route('add_certificate')}}"><i class="bi bi-pencil"></i></a>
                                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>
                                <span class="course_name">22 - 10 - 13</span>
                            </td>
                            <td>
                                <span class="course_name">홍길동</span>
                            </td>
                            <td>
                                <span class="course_name">보행 A에서 Z까지</span> <br>
                                <span class="tutor_name">조규행</span>
                            </td>
                            <td><span class="course_name">On Completion</span></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a class="btn btn-sm btn-warning"><i class="bi bi-eye"></i></a>
                                    <a class="btn btn-sm btn-primary" href="{{ route('add_certificate')}}"><i class="bi bi-pencil"></i></a>
                                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>
                                <span class="course_name">22 - 10 - 13</span>
                            </td>
                            <td>
                                <span class="course_name">홍길동</span>
                            </td>
                            <td>
                                <span class="course_name">보행 A에서 Z까지</span> <br>
                                <span class="tutor_name">조규행</span>
                            </td>
                            <td><span class="course_name">On Completion</span></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a class="btn btn-sm btn-warning"><i class="bi bi-eye"></i></a>
                                    <a class="btn btn-sm btn-primary" href="{{ route('add_certificate')}}"><i class="bi bi-pencil"></i></a>
                                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td>
                                <span class="course_name">22 - 10 - 13</span>
                            </td>
                            <td>
                                <span class="course_name">홍길동</span>
                            </td>
                            <td>
                                <span class="course_name">보행 A에서 Z까지</span> <br>
                                <span class="tutor_name">조규행</span>
                            </td>
                            <td><span class="course_name">On Completion</span></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a class="btn btn-sm btn-warning"><i class="bi bi-eye"></i></a>
                                    <a class="btn btn-sm btn-primary" href="{{ route('add_certificate')}}"><i class="bi bi-pencil"></i></a>
                                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>5</td>
                            <td>
                                <span class="course_name">22 - 10 - 13</span>
                            </td>
                            <td>
                                <span class="course_name">홍길동</span>
                            </td>
                            <td>
                                <span class="course_name">보행 A에서 Z까지</span> <br>
                                <span class="tutor_name">조규행</span>
                            </td>
                            <td><button class="btn btn-status">Completion</button></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a class="btn btn-sm btn-warning"><i class="bi bi-eye"></i></a>
                                    <a class="btn btn-sm btn-primary" href="{{ route('add_certificate')}}"><i class="bi bi-pencil"></i></a>
                                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
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

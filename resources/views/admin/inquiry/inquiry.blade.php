@extends('admin.layout.layout')

@section('title' , 'Inquiry')

@section('custom-style')
<style>
    .hr-color {
        border: 2px solid #191B1D;
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

    thead>tr>td {
        font-weight: 700;
        font-size: 18px;
        line-height: 21px;
        color: #000000;
        border-bottom: 1px solid #191B1D;
    }

    tbody>tr>td {
        font-weight: 700;
        font-size: 18px;
        line-height: 21px;
        color: #000000;
        border-bottom: 1px solid #191B1D;
    }

    .status_btn {
        font-weight: 700;
        font-size: 14px;
        line-height: 16px;
        color: #989898;
        background: #EFEFEF;
    }

    .status_btn:hover {
        font-weight: 700;
        font-size: 14px;
        line-height: 16px;
        color: #989898;
        background: #EFEFEF;
    }

    .status_btn_complete {
        font-weight: 700;
        font-size: 14px;
        line-height: 16px;
        color: #ffffff;
        background: black;
    }

    .status_btn_complete:hover {
        font-weight: 700;
        font-size: 14px;
        line-height: 16px;
        color: #ffffff;
        background: black;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <hr class="hr-color" />
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <td class="align-middle">No</td>
                                <td class="align-middle">Title</td>
                                <td class="align-middle">Writer</td>
                                <td class="align-middle">Date</td>
                                <td class="align-middle">Status</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>문의합니다</td>
                                <td>이**</td>
                                <td>2022.10.13</td>
                                <td><a href="{{ route('inquiry_answer') }}" class="btn status_btn">Waiting for response</a></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>문의합니다</td>
                                <td>이**</td>
                                <td>2022.10.13</td>
                                <td><a href="{{ route('inquiry_answer') }}" class="btn status_btn">Waiting for response</a></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>문의합니다</td>
                                <td>이**</td>
                                <td>2022.10.13</td>
                                <td><a href="{{ route('inquiry_answer') }}" class="btn status_btn">Waiting for response</a></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>문의합니다</td>
                                <td>이**</td>
                                <td>2022.10.13</td>
                                <td><a href="{{ route('inquiry_answer') }}" class="btn status_btn_complete">Answer Complete</a></td>
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
</div>



@endsection

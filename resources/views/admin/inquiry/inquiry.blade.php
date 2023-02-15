@extends('admin.layout.layout')

@section('title' , 'Inquiry')

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
        padding: 5px 15px 5px 15px;
    }

    .btn-add-lecture:hover {
        background: #FFFFFF;
        border: 0.8px solid rgba(161, 172, 184, 0.5);
        border-radius: 2px;
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

    .status-badge-danger {
        background: #F9DFDF;
        border-radius: 2px;
        color: #791919;
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
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0  Card_title">{{ __('translation.1:1 Inquiry list') }}</h4>
                </div>
                <hr class="hr-color" />
            </div>
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table align-middle table-nowrap mb-0  table-lectures border-white">
                        <thead>
                            <tr>
                                <td class="align-middle">{{ __('translation.No') }}</td>
                                <td class="align-middle">제목</td>
                                <td class="align-middle">작성자</td>
                                <td class="align-middle">{{ __('translation.Date') }}</td>
                                <td class="align-middle">상태</td>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($inquiry->count() > 0)
                            @foreach($inquiry as $inq)
                            <tr>
                                <td>{{ $inquiry->firstItem() + $loop->index }}</td>
                                <td>{{ Str::limit($inq->title, 70) }}</td>
                                <td>{{ $inq->getStudentName->name }}</td>
                                <td>{{ Carbon\Carbon::parse($inq->created_at)->format('d M, Y')}}</td>
                                @if($inq->answer == null)
                                <td><a href="{{ route('inquiry_answer',$inq->id) }}" class="btn status_btn">답변대기중</a></td>
                                @else
                                <td><a href="{{ route('inquiry_answer',$inq->id) }}" class="btn status_btn_complete">답변완료</a></td>
                                @endif
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5" class="text-center">
                                    <img src="{{ asset('web_assets/images/no-data-found.png') }}" alt="img" class="img-fluid" style="height: 300px;">
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $inquiry->links('vendor.pagination.custom-pagination-admin') }}
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
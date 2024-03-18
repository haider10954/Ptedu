@extends('admin.layout.layout')

@section('title' , '오프라인 등록')

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

        tbody > tr:nth-child(odd) {
            background-color: rgba(242, 243, 250, 0.8);
        }
    </style>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0  Card_title">오프라인 강좌 등록된 학생 리스트
                            ({{ $offline_enrollments->count()  }})</h4>
                    </div>
                    <hr class="hr-color"/>
                </div>
                <div class="col-lg-12 table-responsive">
                    <table class="table align-middle mb-0 table-lectures border-white table-layout-fixed" id="myTable">
                        <thead>
                        <tr>
                            <td class="align-middle t_header t-width-50">{{ __('translation.No') }}</td>
                            <td class="align-middle t_header t-width-250">{{ __('translation.Course title') }}</td>
                            <td class="align-middle t_header t-width-150">{{ __('translation.Student Name')}}</td>
                            <td class="align-middle t_header t-width-120">{{ __('translation.Original Price') }}</td>
                            <td class="align-middle t_header t-width-120">{{ __('translation.Discounted Price') }}</td>
                            <td class="align-middle t_header t-width-120">{{ __('translation.Is free') }}</td>
                            <td class="align-middle t_header t-width-120">{{ __('translation.Created') }}</td>
                        </tr>
                        </thead>
                        <tbody>
                        @if($offline_enrollments->count() > 0)
                            @foreach($offline_enrollments as $item)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>
                                        <span class="course_name">{{ $item->getCousreName->course_title }}</span>
                                    </td>
                                    <td>
                                        <span class="course_name">{{ $item->getUser->name }}</span>
                                    </td>
                                    <td><span class="course_name">{{ $item->getCousreName->price }}</span></td>
                                    <td><span
                                            class="course_name">{{ (!empty($item->getCousreName->discounted_prize)) ? $item->getCousreName->discounted_prize : 'N/A' }}</span>
                                    </td>
                                    <td>
                                        @php
                                            $records = \Illuminate\Support\Facades\DB::table('student_offline_price_controls')->where('course_id', $item->course_id)->where('user_id',$item->user_id)->first();
                                        @endphp
                                        @if(!empty($records) && $records->is_free == 1)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-danger text-white">No</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}</td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="10">
                                    <img src="{{ asset('web_assets/images/no-data-found.png') }}" alt="img"
                                         class="img-fluid" style="height: 300px;">
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-12">
                    {{ $offline_enrollments->links('vendor.pagination.custom-pagination-admin') }}
                </div>
            </div>
        </div>
    </div>
@endsection

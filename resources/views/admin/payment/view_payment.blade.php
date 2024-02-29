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

@php $order_items = json_decode($order->order_items) @endphp

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12 mb-5">
                <div class="page-title-box d-flex align-items-center">
                    <h4 class="mb-sm-0  Card_title">{{ __('translation.Payment Management') }}</h4>
                </div>
            </div>
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center">
                    <h4 class="mb-sm-0  Card_title">{{ __('translation.Course Information') }}</h4>
                </div>
                <hr class="divider" />
            </div>
            @foreach ($order_items as $item)
                <div class="col-12">
                    <div class="row mx-0">
                        <div class="col-3 col-bg">
                            <div class="d-flex align-items-center mb-3">
                                <h4 class="mb-sm-0  course_info">{{ __('translation.Course Name') }}</h4>
                            </div>
                            <div class=" d-flex align-items-center mb-3">
                                <h4 class="mb-sm-0  course_info">{{ __('translation.Tutor Name') }}</h4>
                            </div>
                            <div class=" d-flex align-items-center mb-3">
                                <h4 class="mb-sm-0  course_info">{{ __('translation.Duration of the Course') }}</h4>
                            </div>
                            <div class=" d-flex align-items-center mb-3">
                                <h4 class="mb-sm-0  course_info">{{ __('translation.Course Schedule') }}</h4>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="d-flex align-items-center mb-3">
                                <h4 class="mb-sm-0  course_details">{{ $item->course->course_title }}</h4>
                            </div>
                            <div class=" d-flex align-items-center mb-3">
                                <h4 class="mb-sm-0  course_details">{{ $item->course->get_tutor_name->name }}</h4>
                            </div>
                            <div class=" d-flex align-items-center mb-3">
                                <h4 class="mb-sm-0  course_details">{{ (int)$item->course->duration_of_course }} {{ __('translation.Weeks') }}</h4>
                            </div>
                            <div class=" d-flex align-items-center mb-3">
                                <h4 class="mb-sm-0  course_details">{{ !empty($item->course_schedule) ? $item->course_schedule : 'N/A' }}</h4>
                            </div>
                        </div>
                        <div class="col-3 col-bg">
                            <div class="d-flex align-items-center mb-3">
                                <h4 class="mb-sm-0  course_info">{{ __('translation.Course Type') }}</h4>
                            </div>
                            <div class=" d-flex align-items-center mb-3">
                                <h4 class="mb-sm-0  course_info">{{ __('translation.Course composition') }}</h4>
                            </div>
                            <div class=" d-flex align-items-center mb-3">
                                <h4 class="mb-sm-0  course_info">{{ __('translation.Production Type') }}</h4>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="d-flex align-items-center mb-3">
                                @if($item->type == 'online')
                                <h4 class="mb-sm-0  course_details">{{ ucfirst($item->course->course_type) }} Course</h4>
                                @else
                                <h4 class="mb-sm-0  course_details">{{ __('translation.Offline Course') }}</h4>
                                @endif
                            </div>
                            <div class=" d-flex align-items-center mb-3">
                                <h4 class="mb-sm-0  course_details">Total {{ $item->course->no_of_lectures }} Lecture</h4>
                            </div>
                            <div class=" d-flex align-items-center mb-3">
                                <h4 class="mb-sm-0  course_details">{{ ($item->type == 'online') ? __('translation.Video Lecture') : __('translation.Offline Lecture') }}</h4>
                            </div>
                        </div>
                    </div>
                    <hr class="course_info_border" />
                </div>
            @endforeach
            <div class="col-12 mt-4">
                <div class="page-title-box d-flex align-items-center">
                    <h4 class="mb-sm-0  Card_title">{{ __('translation.Payment Information') }}</h4>
                </div>
                <hr class="divider" />
                @php
                $payment_response = json_decode($order->getTransaction->payment_response);
                @endphp
                <table class="table table-border-c">
                    <tbody>
                        <tr>
                            <td class="td-left">{{ __('translation.Payment No') }}</td>
                            <td>{{ $payment_response->order_no }}</td>
                        </tr>
                        <tr>
                            <td class="td-left">승인일자</td>
                            <td>{{\Carbon\Carbon::parse($order->getTransaction->created_at)->format('Y-m-d')}}</td>
                        </tr>
                        <tr>
                            <td class="td-left">{{ __('translation.Method Payment') }}</td>
                            <td>{{ __('translation.'.$order->getTransaction->payment_method) }}</td>
                        </tr>
                        <tr>
                            <td class="td-left">{{ __('translation.Payment Price') }}</td>
                            <td>{{ $order->getTransaction->ammount }} 원</td>
                        </tr>
                        <tr>
                            <td class="td-left">{{ __('translation.Payment Status') }}</td>
                            <td>{{ $payment_response->res_msg  }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

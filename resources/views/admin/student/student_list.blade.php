@extends('admin.layout.layout')

@section('title' , 'Student List')

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
</style>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <div>
            @if (Session::has('message'))
            <p class="alert alert-info" id="responseMessage">{{ Session::get('message') }}</p>
            @endif
            @if (Session::has('error'))
            <p class="alert alert-danger" id="responseMessage">{{ Session::get('error') }}</p>
            @endif
        </div>
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0  Card_title">{{ __('translation.Student List') }}</h4>
                    <form method="GET" action="{{ route('apply-student-filter') }}">
                        <div class="d-flex align-items-center gap-2">
                            <input class="form-control" type="text" name="search" placeholder="검색어 입력">
                            <button type="submit" class="btn btn-outline-dark">검색</button>
                        </div>
                    </form>
                </div>
                <hr class="hr-color" />
            </div>
            <div class="col-lg-12 table-responsive">
                <table class="table align-middle mb-0 table-lectures border-white table-layout-fixed" id="myTable">
                    <thead>
                        <tr>
                            <td class="align-middle t_header t-width-50">{{ __('translation.No') }}</td>
                            <td class="align-middle t_header t-width-130">{{ __('translation.Name') }}</td>
                            <td class="align-middle t_header t-width-150">{{ __('translation.Email')}}</td>
                            <td class="align-middle t_header t-width-120">{{ __('translation.Phone Number') }}</td>
                            <td class="align-middle t_header t-width-250">{{ __('translation.List of Courses') }}</td>
                            <td class="align-middle t_header t-width-90">{{ __('translation.Action') }}</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if($student->count() > 0)
                        @foreach($student as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                <span class="course_name">{{ $item->name }}</span>
                            </td>
                            <td>
                                <span class="course_name">{{ $item->email }}</span>
                            </td>
                            <td><span class="course_name">{{ $item->mobile_number }}</span></td>
                            <td>
                                <span class="course_name">
                                    <ul style="list-style: none; padding-left:0px !important;">
                                        @if (($item->getOfflineEnrolments->count() > 0) || ($item->getOnlineEnrolments->count() > 0))
                                        @foreach($item->getOnlineEnrolments as $course)
                                        <li class="border-0 mb-2">
                                            {{ $course->getCourses->course_title }} ({{ __('translation.Online')}})
                                        </li>
                                        @endforeach
                                        @foreach($item->getOfflineEnrolments as $offline_course)
                                        <li class="border-0 mb-2">
                                            {{ $offline_course->getCousreName->course_title ?? '' }} ({{ __('translation.Offline')}})
                                        </li>
                                        @endforeach
                                        @else
                                        <li class="border-0 mb-2">
                                            {{ __('translation.No Enrollment Yet') }}
                                        </li>
                                        @endif
                                    </ul>
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a class="btn btn-warning btn-sm" target="_blank"  href="{{ route('student_course_access_control',$item->id) }}"><i class="bi bi-shield-shaded"></i></a>
                                    <a class="btn btn-sm btn-primary" href="{{ route('student_info',$item->id)}}"><i class="bi bi-pencil"></i></a>
                                    <a class="btn btn-sm btn-danger" onclick="delete_record( '{{ $item->id }}')"><i class="bi bi-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td class="text-center" colspan="6">
                                <img src="{{ asset('web_assets/images/no-data-found.png') }}" alt="img" class="img-fluid" style="height: 300px;">
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                {{ $student->appends(request()->except('page'))->links('vendor.pagination.custom-pagination-admin') }}
            </div>
        </div>
    </div>
</div>

<!-- Delete Record -->
<div class="modal-dialog modal-dialog-centered">
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ __('translation.Confirm Delete') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('delete-student')}}">
                    @csrf
                    <div class="modal-body">
                        <p>{{ __('translation.Are you sure to delete ?') }}</p>
                        <input id="del_id" type="hidden" name="id">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('translation.Close')}}</button>
                        <button type="submit" class="btn btn-danger">{{ __('translation.Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
<script>
    var delModal = new bootstrap.Modal(document.getElementById("staticBackdrop"), {});

    function delete_record(id) {
        $('#del_id').val(id);
        delModal.show();
    }

    $(document).ready(function() {
        setTimeout(function() {
            $("#responseMessage").hide()
        }, 2000);
    });
</script>
@endsection

@extends('admin.layout.layout')

@section('title' , 'Student course access control')

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
                    <h4 class="mb-sm-0  Card_title">{{ __('translation.Student Online Enrollments') }} ({{ $online_courses_enrolled->count()  }})</h4>
                </div>
                <hr class="hr-color" />
            </div>
            <div class="col-lg-12 table-responsive">
                <table class="table align-middle mb-0 table-lectures border-white table-layout-fixed" id="myTable">
                    <thead>
                        <tr>
                            <td class="align-middle t_header t-width-50">{{ __('translation.No') }}</td>
                            <td class="align-middle t_header t-width-250">{{ __('translation.Course title') }}</td>
                            <td class="align-middle t_header t-width-120">{{ __('translation.Total Lectures')}}</td>
                            <td class="align-middle t_header t-width-120">{{ __('translation.Viewed Lectures') }}</td>
                            <td class="align-middle t_header t-width-120">{{ __('translation.Completed Status') }}</td>
                            <td class="align-middle t_header t-width-120">{{ __('translation.End Date') }}</td>
                            <td class="align-middle t_header t-width-120">{{ __('translation.Extended Duration') }}</td>
                            <td class="align-middle t_header t-width-120">{{ __('translation.Access') }}</td>
                            <td class="align-middle t_header t-width-120">{{ __('translation.Action') }}</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if($online_courses_enrolled->count() > 0)
                        @foreach($online_courses_enrolled as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                <span class="course_name">{{ $item->getCourses->course_title }}</span>
                            </td>
                            <td>
                                <span class="course_name">{{ $item->no_of_lectures }}</span>
                            </td>
                            <td><span class="course_name">{{ $item->viewed_lectures }}</span></td>
                            <td>
                                @if($item->status == 1)
                                    <span class="badge bg-success">Completed</span>
                                @else
                                    <span class="badge bg-warning text-white">In-Progress</span>
                                @endif
                            </td>
                            <td><span class="course_name">{{ (!empty($item->getCourses)) ?  \Carbon\Carbon::parse($item->created_at)->addWeeks($item->getCourses->duration_of_course)->format('Y-m-d') : 'N/A' }}</span></td>
                            <td><span class="course_name">{{ $item->extended_duration }}</span></td>
                            <td>
                                @if($item->access == 1)
                                    <span class="badge bg-success">Allowed</span>
                                @else
                                    <span class="badge bg-danger text-white">Forbidden</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-success btn-sm" onclick="extend_duration({{$item->id}}, {{ $item->extended_duration }})"><i class="bi bi-alarm"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="change_access({{$item->id}}, {{ $item->access }})"><i class="bi bi-shield-lock"></i></button>
                                    <button type="button" class="btn btn-sm btn-info" onclick="refund({{$item->id}},{{$item->course_id}})"><i class="bi bi-arrow-return-left"></i></button>
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
            </div>
        </div>
    </div>
</div>

<!-- Extend Course Duration -->
<div class="modal-dialog modal-dialog-centered">
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ __('translation.Extend Duration') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('student_extend_course_duration')}}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="student_id" value="{{ request()->segment(3) }}" required>
                        <input type="hidden" name="record" id="recordId" required>
                        <div class="form-group">
                            <label for="courseDuration">{{ __('translation.Extend Duration') }}</label>
                            <input type="number" name="extended_duration" class="form-control" id="courseDuration" required>
                        </div>
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

<!-- Course Change Access -->
<div class="modal-dialog modal-dialog-centered">
    <div class="modal fade" id="changeAccessModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ __('translation.Change Access') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('student_course_change_access')}}">
                    @csrf
                    <input type="hidden" name="student_id" value="{{ request()->segment(3) }}" required>
                    <div class="modal-body">
                        <p>{{ __('translation.Are you sure you want to change access ?') }}</p>
                        <input type="hidden" name="course_tracking" class="form-control" id="courseTracking" required>
                        <input type="hidden" id="accessType" name="currentAccess" required>
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

<!-- Refund -->
<div class="modal-dialog modal-dialog-centered">
    <div class="modal fade" id="refundModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ __('translation.Refund') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('student_course_refund')}}">
                    @csrf
                    <input type="hidden" name="student_id" value="{{ request()->segment(3) }}" required>
                    <input type="hidden" name="course_tracking_id" id="courseTrackingId">
                    <input type="hidden" name="course_id" id="courseID">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="amount">{{ __('translation.Refund Amount') }}</label>
                            <input type="number" name="amount" class="form-control" placeholder="{{  __('translation.Enter refund amount') }}" required>
                        </div>
                        <p>({{ __('translation.Note : After refunding this enrolment will be deleted') }})</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('translation.Close')}}</button>
                        <button type="submit" class="btn btn-danger">{{ __('translation.Refund')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
<script>
    var extendDurationModal = new bootstrap.Modal(document.getElementById("staticBackdrop"), {});

    function extend_duration(id, duration) {
        $('#recordId').val(id);
        $('#courseDuration').val(duration);
        extendDurationModal.show();
    }

    var changeAccessModal = new bootstrap.Modal(document.getElementById("changeAccessModal"), {});

    function change_access(id, access) {
        $('#accessType').val(access);
        $('#courseTracking').val(id);
        changeAccessModal.show();
    }

    var refundModal = new bootstrap.Modal(document.getElementById("refundModal"), {});

    function refund(id, course_id) {
        $('#courseTrackingId').val(id);
        $('#courseID').val(course_id);
        refundModal.show();
    }

    $(document).ready(function() {
        setTimeout(function() {
            $("#responseMessage").hide()
        }, 2000);
    });
</script>
@endsection

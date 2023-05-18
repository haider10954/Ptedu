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
                    <h4 class="mb-sm-0  Card_title">{{ __('translation.Student who Completed') }} ({{ $completed_courses->count() }})</h4>
                </div>
                <hr class="hr-color" />
            </div>
            <div>
                @if (Session::has('success'))
                <p class="alert alert-info" id="responseMessage">{{ Session::get('success') }}</p>
                @endif
                @if (Session::has('error'))
                <p class="alert alert-danger" id="responseMessage">{{ Session::get('error') }}</p>
                @endif
            </div>
            <div class="col-lg-12 table-responsive">
                <table class="table align-middle table-nowrap mb-0  table-lectures border-white" id="myTable">
                    <thead>
                        <tr>
                            <td class="align-middle t_header">{{ __('translation.No')}}</td>
                            <td class="align-middle t_header">{{ __('translation.Date')}}</td>
                            <td class="align-middle t_header">{{ __('translation.Name') }}</td>
                            <td class="align-middle t_header">{{ __('translation.Course Name') }}</td>
                            <td class="align-middle t_header">{{ __('translation.Status')}}</td>
                            <td class="align-middle t_header">{{ __('translation.Action')}}</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($completed_courses->count() > 0)
                        @foreach ($completed_courses as $course)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>
                                <span class="course_name">{{ \Carbon\Carbon::parse($course->created_at)->format('Y-m-d')}}</span>
                            </td>
                            <td>
                                <span class="course_name">{{ $course->getUser->english_name }}</span>
                            </td>
                            <td>
                                <span class="course_name">{{ $course->getCourses->course_title }}</span> <br>
                                <span class="tutor_name">{{ $course->getCourses->getTutorName->english_name }}</span>
                            </td>
                            @if ($course->generate_certificate == 1)
                            <td><a href="{{ route('certicate-view',$course->course_id) }}" disabled class="btn btn-status">수강완료</a></td>
                            @else
                            <td><a href="{{ route('add_certificate', [$course->getCourses->id , $course->getUser->id] )}}" class="btn btn-status">수료중</a></td>
                            @endif
                            <td>
                                <div class="d-flex gap-1">
                                    <a class="btn btn-sm btn-primary" href="{{ route('add_certificate',[ $course->getCourses->id , $course->getUser->id] )}}"><i class="bi bi-pencil"></i></a>
                                    <a class="btn btn-sm btn-danger" onclick="delete_record( '{{ $course->id }}')"><i class="bi bi-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="7" class="text-center">
                                <img src="{{ asset('web_assets/images/no-data-found.png') }}" alt="img" class="img-fluid" style="height: 300px;">
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                {{ $completed_courses->links('vendor.pagination.custom-pagination-admin') }}
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
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">{{__('translation.Confirm Delete')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('delete-certificate')}}">
                    @csrf
                    <div class="modal-body">
                        <p>{{ __('translation.Are you sure to delete ?') }}</p>
                        <input id="del_id" type="hidden" name="id">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('translation.Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('translation.Save') }}</button>
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
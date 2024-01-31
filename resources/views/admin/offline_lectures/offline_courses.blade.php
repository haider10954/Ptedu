@extends('admin.layout.layout')

@section('title' , 'Offline Lecture list')

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

    .btn-reserve {
        background: #696CFF;
        border-radius: 3px;
        font-weight: 400;
        font-size: 12px;
        line-height: 15px;
        color: #FFFFFF;
    }

    .btn-reserve:hover {
        background: #696CFF;
        border-radius: 3px;
        font-weight: 400;
        font-size: 12px;
        line-height: 15px;
        color: #FFFFFF;
    }
</style>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <div>
            @if (Session::has('msg'))
            <p class="alert alert-info" id="responseMessage">{{ Session::get('msg') }}</p>
            @endif
            @if (Session::has('error'))
            <p class="alert alert-danger" id="responseMessage">{{ Session::get('error') }}</p>
            @endif
        </div>
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0  Card_title">{{ __('translation.Course List') }} > {{ __('translation.Offline Course List') }} ({{ $offline_course->count() }} )</h4>
                    <a class="btn btn-sm btn-add-lecture" href="{{ route('add_offline_course_view')}}">{{ __('translation.Add Course') }}</a>
                </div>
                <hr class="hr-color" />
            </div>
            <div class="col-lg-12 table-responsive">
                <table class="table align-middle mb-0 border-white table-layout-fixed" id="myTable">
                    <thead>
                        <tr>
                            <td class="align-middle t_header t-width-50">{{ __('translation.No') }}</td>
                            <td class="align-middle t_header t-width-290">{{ __('translation.Course Title') }}</td>
                            <td class="align-middle t_header t-width-150">{{ __('translation.Category') }}</th>
                            <td class="align-middle t_header t-width-80">{{ __('translation.Offline')}}</td>
                            <td class="align-middle t_header t-width-100">{{ __('translation.Participants')}}</th>
                            <td class="align-middle t_header t-width-80">{{ __('translation.Waiting') }}</td>
                            <td class="align-middle t_header t-width-100">{{ __('translation.Management') }}</td>
                            <td class="align-middle t_header t-width-120">{{ __('translation.Action') }}</td>
                        </tr>
                    </thead>
                    @if($offline_course->count() > 0)
                    @foreach ($offline_course as $offline_c)
                    @dd($offline_c)
                    <tr>
                        <td>{{ $counter }}</td>
                        <td>
                            <span class="course_name">{{ Str::limit($offline_c->course_title, 40, '...') }}</span> <br />
                            <span class="tutor_name"> {{ $offline_c->getTutorName->name }}</span>
                        </td>
                        <td><span class="course_name">{{ $offline_c->getCategoryName->name}}</span></td>
                        <td><span class="course_name">오프라인</span></td>
                        <td><span class="course_name">{{ $offline_c->no_of_enrollments }}</span></td>
                        <td><span class="course_name">{{ $offline_c->get_reservation_waiting_count }}</span></td>
                        <td><a class="btn btn-sm btn-reserve" href="{{ route('waiting_list' , $offline_c->id) }}">{{ __('translation.Waiting List') }}</a></td>
                        <td>
                            <div class="d-flex gap-1">
                                <a class="btn btn-sm btn-success" href="{{ route('student_offline_course_price_control', $offline_c->id) }}"><i class="bi bi-tags"></i></a>
                                <a class="btn btn-sm btn-primary" href="{{ route('edit_offline_course_view' , $offline_c->id )}}"><i class="bi bi-pencil"></i></a>
                                <a class="btn btn-sm btn-danger" onclick="delete_record( '{{ $offline_c->id }}')"><i class="bi bi-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    @php
                    $counter--;
                    @endphp
                    @endforeach
                    @else
                    <tr>
                        <td colspan="8" class="text-center">No Record Found</td>
                    </tr>
                    @endif

                </table>

                {{ $offline_course->links('vendor.pagination.custom-pagination-admin') }}

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
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ __('translation.Confirm Delete')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('delete-offline-course')}}">
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

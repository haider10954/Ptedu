@extends('admin.layout.layout')

@section('title', 'Course list')

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
                    <h4 class="mb-sm-0  Card_title">{{ __('translation.Course List') }} > {{ __('translation.Online Course List') }} ({{ $course->count() }})</h4>
                    <a class="btn btn-sm btn-add-lecture" href="{{ route('add_course') }}">{{ __('translation.Add Course') }}</a>
                </div>
                <hr class="hr-color" />
            </div>
            <div class="col-lg-12 table-responsive">
                <table class="table align-middle mb-0 table-lectures border-white table-layout-fixed" id="myTable">
                    <thead>
                        <tr>
                            <td class="align-middle t_header t-width-50">{{ __('translation.No') }}</td>
                            <td class="align-middle t_header t-width-290">{{ __('translation.Course Name') }}</td>
                            <td class="align-middle t_header t-width-150">{{ __('translation.Category')}}</td>
                            <td class="align-middle t_header t-width-80">{{ __('translation.Number of Student')}}</td>
                            <td class="align-middle t_header t-width-80">{{ __('translation.Price')}}</td>
                            <td class="align-middle t_header t-width-80">{{ __('translation.Live')}}</td>
                            <td class="align-middle t_header t-width-90">{{ __('translation.Action')}}</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($course->count() > 0)
                        @foreach ($course as $c)
                        <tr>
                            <td>{{ $counter }}</td>
                            <td>
                                <span class="course_name d-block mb-1">{{ Str::limit($c->course_title, 40, '...') }}</span>
                                <span class="tutor_name"> {{ $c->getTutorName->name }}</span>
                            </td>
                            <td><span class="course_name">{{ $c->getCategoryName->name }}</span></td>
                            <td><span class="course_name">{{ $c->getOnlineCourseEnrollment->count() }}</span></td>
                            <td><span class="course_name">{{ $c->price - $c->discounted_prize }} 원</span></td>
                            <td>
                                @if ($c->live_status == 1)
                                <div class="btn btn-sm btn-soft-danger" onclick="liveStatus({{ $c->id }},{{ $c->live_status }},'{{ $c->live_link }}')">
                                    <span class="fas fa-headset"></span> Live
                                </div>
                                @else
                                <div class="btn btn-sm btn-soft-secondary" onclick="liveStatus({{ $c->id }},{{ $c->live_status }},'{{ $c->live_link }}')">
                                    <span class="fas fa-headset"></span> Live
                                </div>
                                @endif

                                {{-- <div class="btn btn-sm btn-soft-secondary"><span class="fas fa-headset"></span> Live</div> --}}
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a class="btn btn-sm btn-success" href="{{ route('student_online_course_price_control', $c->id) }}"><i class="bi bi-tags"></i></a>
                                    <a class="btn btn-sm btn-primary" href="{{ route('edit_course_view', $c->id) }}"><i class="bi bi-pencil"></i></a>
                                    <a class="btn btn-sm btn-danger" onclick="delete_record( '{{ $c->id }}')"><i class="bi bi-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        @php
                            $counter--;
                        @endphp
                        @endforeach
                        @else
                        <tr>
                            <td colspan="7" class="text-center">No Record Found</td>
                        </tr>
                        @endif
                    </tbody>
                </table>

                {{ $course->links('vendor.pagination.custom-pagination-admin') }}

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
                <form method="post" action="{{ route('delete-course') }}">
                    @csrf
                    <div class="modal-body">
                        <p>{{ __('translation.Are you sure to delete ?') }}</p>
                        <input id="del_id" type="hidden" name="id">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('translation.Close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('translation.Delete') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Live Record --}}
<div class="modal-dialog modal-dialog-centered">
    <div class="modal fade" id="live-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ __('translation.Live Status') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="liveForm">
                    @csrf
                    <div class="modal-body">
                        <div class="liveFormPrompt"></div>
                        <input id="live_record_id" type="hidden" name="id">
                        <div class="form-group mb-3">
                            <label for="liveStatus">{{ __('translation.Status') }}</label>
                            <select name="status" id="liveStatus" class="form-control">
                                <option value="0">{{ __('translation.In-Active') }}</option>
                                <option value="1">{{ __('translation.Active')}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="liveLink">{{ __('translation.Live Link') }}</label>
                            <input type="text" class="form-control" name="live_link" id="liveLink" placeholder="{{ __('translation.Enter Live Link') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('translation.Close') }}</button>
                        <button type="button" id="liveFormBtn" class="btn btn-primary">{{ __('translation.Submit') }}</button>
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
    var liveModal = new bootstrap.Modal(document.getElementById("live-modal"), {});

    function delete_record(id) {
        $('#del_id').val(id);
        delModal.show();
    }

    function liveStatus(id, status, link) {
        $('#live_record_id').val(id);
        $('#liveLink').val(link);
        $('#liveStatus option').each(function() {
            if ($(this).attr('value') == status) {
                $(this).prop('selected', true);
            }
        });
        liveModal.show();
    }

    $(document).ready(function() {
        setTimeout(function() {
            $("#responseMessage").hide()
        }, 2000);
    });

    $('#liveFormBtn').on('click', function() {
        $.ajax({
            type: "POST",
            url: "{{ route('course_live_status') }}",
            dataType: 'json',
            data: $('#liveForm').serialize(),
            beforeSend: function() {
                $('#liveFormBtn').prop('disabled', true);
                $('#liveFormBtn').html(`<i class="fa fa-spinner fa-spin me-1"></i> Processing`);
            },
            success: function(res) {
                if (res.Success == true) {
                    $('.liveFormPrompt').html(`<div class="alert alert-success d-flex align-items-center">${res.Message}</div>`);
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                } else {
                    $('.liveFormPrompt').html(`<div class="alert alert-warning d-flex align-items-center">${res.Message}</div>`);
                    $('#liveFormBtn').prop('disabled', false);
                    $('#liveFormBtn').html(`Submit`);
                }
            },
            error: function(e) {},
        });
    });
</script>
@endsection

@extends('admin.layout.layout')

@section('title' , 'Waiting list')

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
</style>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0  Card_title">{{ __('translation.Offline Course List') }} > {{ __('translation.Waiting List') }}</h4>
                </div>
                <div>
                    <h4 class="mb-sm-0 mt-2 Card_title">{{ $reservations->course_title }}</h4>
                </div>
                <hr class="hr-color" />
            </div>
            <div class="prompt"></div>
            <div class="col-lg-12 table-responsive">
                <table class="table align-middle table-nowrap mb-0   border-white" id="myTable">
                    <thead>
                        <tr>
                            <td class="align-middle t_header">{{ __('translation.No') }}</td>
                            <td class="align-middle t_header">{{ __('translation.Name') }}</td>
                            <td class="align-middle t_header">{{ __('translation.Email')}}</td>
                            <td class="align-middle t_header">{{ __('translation.Phone Number')}}</td>
                            <td class="align-middle t_header">{{ __('translation.Course List')}}</td>
                            <td class="align-middle t_header">{{ __('translation.Status')}}</td>
                            <td class="align-middle t_header">{{ __('translation.Confirm/Delete') }}</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if($reservation->count() > 0)
                        @foreach($reservation as $r)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>
                                <span class="course_name">{{ $r->getUser->name }}</span> <br />
                            </td>
                            <td><span class="course_name">{{ $r->getUser->email }}</span></td>
                            <td><span class="course_name">{{ $r->getUser->mobile_number }}</span></td>
                            <td><span class="course_name">{{ $r->getCourses->course_title }}</span></td>
                            <td><span class="course_name text-white badge bg-{{ $r->getStatus() }} p-2">{{ $r->status }}</span></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a class="btn btn-sm btn-success statusBtn" onclick="changeStatus('reserved','{{ $r->id }}')"><i class="bi bi-check2" style="font-size: 1rem;"></i></a>
                                    <a class="btn btn-sm btn-danger" onclick="changeStatus('decline','{{ $r->id }}')"><i class="bi bi-trash"></i></a>
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
                {{ $reservation->links('vendor.pagination.custom-pagination-admin') }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
<script>
    function changeStatus(value, id) {
        $.ajax({
            type: "POST",
            url: "{{ route('update_status') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                status: value,
                id: id,
            },
            beforeSend: function() {},
            success: function(res) {
                if (res.success) {
                    $('.prompt').html('<div class="alert alert-success mb-3">' + res.message + '</div>');
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                    $('.statusBtn').attr('disabled', true);
                } else {
                    $('.prompt').html('<div class="alert alert-danger mb-3">' + res.message + '</div>');
                }
            },

            error: function(e) {
                console.log('error');
            }
        });
    }
</script>
@endsection

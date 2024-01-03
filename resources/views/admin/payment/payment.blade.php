@extends('admin.layout.layout')

@section('title' , 'Payment Management')

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

    .status-badge {
        background: #DAE6FF;
        border-radius: 2px;
        color: #6780FF;
        height: 19px;
        width: 62px;
        line-height: 15px
    }

    .status-badge-warning {
        background: #F7F4CE;
        border-radius: 2px;
        color: #DFB200;
        height: 19px;
        width: 62px;
        line-height: 15px;
    }
</style>
@endsection

@section('content')

<div class="card">
    <div class="card-body">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0  Card_title">{{ __('translation.Payment Management') }}</h4>
                </div>
                <hr class="hr-color" />
            </div>
            <div>
                @if (Session::has('msg'))
                <p class="alert alert-info" id="responseMessage">{{ Session::get('msg') }}</p>
                @endif
                @if (Session::has('error'))
                <p class="alert alert-danger" id="responseMessage">{{ Session::get('error') }}</p>
                @endif
            </div>
            <div class="col-lg-12 table-responsive">
                <table class="table align-middle mb-0 table-lectures border-white table-layout-fixed" id="myTable">
                    <thead>
                        <tr>
                            <td class="align-middle t_header t-width-50">{{ __('translation.No') }}</td>
                            <td class="align-middle t_header t-width-100">{{ __('translation.Date') }}</td>
                            <td class="align-middle t_header t-width-120">{{ __('translation.Buyer') }}</th>
                            <td class="align-middle t_header t-width-250">{{ __('translation.Course Name') }}</td>
                            <td class="align-middle t_header t-width-80">{{ __('translation.Price') }}</th>
                            <td class="align-middle t_header t-width-120">{{ __('translation.Action') }}</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($order->count() > 0)
                        @foreach ($order as $item)
                        @dd($item)
                        <tr>
                            <td>{{ $order->firstitem() + $loop->index }}</td>
                            <td>
                                <span class="course_name">{{\Carbon\Carbon::parse($item->created_at)->format('Y-m-d')}}</span>
                            </td>
                            <td><span class="course_name">{{ $item->getUser->english_name }}</span></td>
                            <td>
                                @foreach (json_decode($item->order_items) as $order_item)
                                <span class="course_name">{{ $order_item->course_name }}</span>
                                <br />
                                @endforeach
                            </td>
                            <td>
                                @if(!empty($item->getTransaction))
                                    <span class="course_name">{{ $item->getTransaction->ammount }} 원</span>
                                @else
                                    <span class="course_name">N/A</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    {{-- <a onclick="change_Status('{{ $item->id }}')" class="btn btn-sm btn-success"><i class="bi bi-pencil"></i></a> --}}
                                    <a onclick="delete_record('{{ $item->id }}')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                                    <a href="{{ route('view_payment',$item->id)}}" class="btn btn-sm btn-warning"><i class="bi bi-eye"></i></a>
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
                {{ $order->links('vendor.pagination.custom-pagination-admin') }}
            </div>
        </div>
    </div>
</div>

@endsection

@section('modals')
<!-- Delete Record -->
<div class="modal-dialog modal-dialog-centered">
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">{{__('translation.Confirm Delete')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('delete-order')}}">
                    @csrf
                    <div class="modal-body">
                        <p>{{ __('translation.Are you sure to delete ?') }}</p>
                        <input id="del_id" type="hidden" name="id" value="">

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


<!-- Change Payment Status -->
<div class="modal-dialog modal-dialog-centered">
    <div class="modal fade" id="changeStatus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">{{__('translation.Change Status')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="changeOrderStatus">
                    <div class="prompt"></div>
                    @csrf
                    <div class="modal-body">
                        <input id="order_id" type="hidden" name="id">
                        <label>{{__('translation.Select Status')}}</label>
                        <select class="form-control" name="orderStatus" id="orderStatus">
                            <option value="">{{__('translation.Select Option')}}</option>
                            <option value="0">{{__('translation.In Process')}}</option>
                            <option value="1">{{__('translation.Completed')}}</option>
                        </select>


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
    var changeStatus = new bootstrap.Modal(document.getElementById("changeStatus"), {});

    function change_Status(id) {
        $('#order_id').val(id);
        changeStatus.show();
    }

    function delete_record(id) {
        $('#del_id').val(id);
        delModal.show();
    }

    $(document).ready(function() {
        setTimeout(function() {
            $("#responseMessage").hide()
        }, 2000);
    });


    $('#changeOrderStatus').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "{{ route('update-order-status')}}",
            dataType: 'json',
            data: {
                id: $('#order_id').val(),
                status: $('#orderStatus').val(),
                _token: '{{csrf_token()}}'
            },
            beforeSend: function() {

            },
            success: function(res) {
                if (res.success == true) {
                    $('.prompt').show()
                    $('.prompt').html('<div class="alert alert-success">' + res.message + '</div>');
                    setTimeout(function() {
                        $('.prompt').hide()
                    }, 1500);
                    window.location.reload();
                } else {
                    $('.prompt').show()
                    $('.prompt').html('<div class="alert alert-danger">' + res.message + '</div>');
                    setTimeout(function() {
                        $('.prompt').hide()
                    }, 1500);
                    window.location.reload();
                }
            },
            error: function(e) {}
        });
    });
</script>
@endsection
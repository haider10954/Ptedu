@extends('admin.layout.layout')

@section('title' , __('translation.Student online course price control'))

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
                    <h4 class="mb-sm-0  Card_title">{{ __('translation.Student online course price control') }} ({{ $records->count()  }})</h4>
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addRecord"><i class="bi bi-plus"></i> Add</button>
                </div>
                <hr class="hr-color" />
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
                            <td class="align-middle t_header t-width-90">{{ __('translation.Action') }}</td>
                        </tr>
                    </thead>
                    <tbody>
                        @if($records->count() > 0)
                        @foreach($records as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>
                                <span class="course_name">{{ $item->getCourses->course_title }}</span>
                            </td>
                            <td>
                                <span class="course_name">{{ $item->getUser->name }}</span>
                            </td>
                            <td><span class="course_name">{{ $item->original_price }}</span></td>
                            <td><span class="course_name">{{ (!empty($item->discounted_price)) ? $item->discounted_price : 'N/A' }}</span></td>
                            <td>
                                @if($item->is_free == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger text-white">In-Active</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="edit_record({{$item->id}}, {{ $item->user_id }}, {{ $item->discounted_price }}, {{ $item->is_free }})"><i class="bi bi-pencil"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="del_record({{$item->id}})"><i class="bi bi-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td class="text-center" colspan="8">
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

<!-- Edit Record Modal -->
<div class="modal-dialog modal-dialog-centered">
    <div class="modal fade" id="editRecord" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ __('translation.Edit Discount Entry') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('edit_student_online_course_price_discount_entry') }}">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ request()->segment(3) }}" required>
                    <input type="hidden" id="editRecordId" name="record_id" required>
                    <div class="modal-body">
                        <input type="hidden" name="user_id" id="editUserId">
                        <div class="form-group mb-3">
                            @php
                            if(!empty($course->discounted_prize)){
                                $original_price = $course->price - $course->discounted_prize;
                            }else{
                                $original_price = $course->price;
                            }    
                            @endphp
                            <label for="original_price">{{ __('translation.Original Price') }}</label>
                            <input type="number" class="form-control" id="edit_original_price" name="original_price" value="{{ $original_price }}" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="edit_discounted_price">{{ __('translation.Discounted Price') }}</label>
                            <input type="number" name="discounted_price" class="form-control" id="edit_discounted_price" placeholder="{{ __('translation.Add discounted price') }}">
                            <span class="small">({{ __('translation.Discounted price must be less than original price') }})</span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="edit_is_free">{{ __('translation.Free Status') }}</label>
                            <select name="is_free" class="form-control" id="edit_is_free">
                                <option value="">{{ __('translation.Select Status') }}</option>
                                <option value="true">{{ __('translation.Active') }}</option>
                                <option value="false">{{ __('translation.In-Active') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('translation.Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{ __('translation.Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Del Record Modal -->
<div class="modal-dialog modal-dialog-centered">
    <div class="modal fade" id="delRecord" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ __('translation.Delete') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('del_student_online_course_price_discount_entry') }}">
                    <input type="hidden" name="record_id" id="delRecordID">
                    <input type="hidden" name="course_id" value="{{ request()->segment(3) }}" required>
                    @csrf
                    <div class="modal-body">
                        <p class="mb-0">{{ __("translation.Are you sure you wan't to delete ?") }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('translation.Close')}}</button>
                        <button type="submit" class="btn btn-danger">{{ __('translation.Delete')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Record Modal -->
<div class="modal-dialog modal-dialog-centered">
    <div class="modal fade" id="addRecord" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ __('translation.Add Discount Entry') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('add_student_online_course_price_discount_entry') }}">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ request()->segment(3) }}" required>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="userId">{{ __('translation.Select Student') }}</label>
                            <select name="user_id" class="form-control" id="userId" required>
                                <option value="">{{ __('translation.Select Student') }}</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            @php
                            if(!empty($course->discounted_prize)){
                                $original_price = $course->price - $course->discounted_prize;
                            }else{
                                $original_price = $course->price;
                            }    
                            @endphp
                            <label for="original_price">{{ __('translation.Original Price') }}</label>
                            <input type="number" class="form-control" id="original_price" name="original_price" value="{{ $original_price }}" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label for="discounted_price">{{ __('translation.Discounted Price') }}</label>
                            <input type="number" name="discounted_price" class="form-control" id="discounted_price" placeholder="{{ __('translation.Add discounted price') }}">
                            <span class="small">({{ __('translation.Discounted price must be less than original price') }})</span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="is_free">{{ __('translation.Free Status') }}</label>
                            <select name="is_free" class="form-control" id="is_free">
                                <option value="">{{ __('translation.Select Status') }}</option>
                                <option value="true">{{ __('translation.Active') }}</option>
                                <option value="false">{{ __('translation.In-Active') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('translation.Close')}}</button>
                        <button type="submit" class="btn btn-success">{{ __('translation.Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom-script')
<script>
    var editRecordModal = new bootstrap.Modal(document.getElementById("editRecord"), {});

    function edit_record(id, user_id, discount_price, is_free) {
        $('#editRecordId').val(id);
        $('#editUserId').val(user_id);
        if(discount_price != null && discount_price != ''){
            $('#edit_discounted_price').val(discount_price);
        }
        if(is_free == 1){
            $('#edit_is_free option').each(function(){
                if($(this).val() == 'true'){
                    $(this).prop('selected', true);
                }
            });
        }else{
            $('#edit_is_free option').each(function(){
                if($(this).val() == 'false'){
                    $(this).prop('selected', true);
                }
            });
        }
        editRecordModal.show();
    }

    var delRecord = new bootstrap.Modal(document.getElementById("delRecord"), {});

    function del_record(id) {
        $('#delRecordID').val(id);
        delRecord.show();
    }

    $(document).ready(function() {
        setTimeout(function() {
            $("#responseMessage").hide()
        }, 2000);
    });
</script>
@endsection

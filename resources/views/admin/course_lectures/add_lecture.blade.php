@extends('admin.layout.layout')

@section('title' , 'Add Course Lectures')

@section('custom-style')
<style>
    .hr-color {
        border: 1px solid #C4C4C4;
    }

    .btn-register {
        width: 103px;
        height: 37px;

        background: #F0F0F0;
        border: 1.43489px solid #DFE0EB;
        border-radius: 2.86978px;
        color: #6F6F6F;
        font-weight: 400;
        font-size: 14px;
    }

    .btn-register:hover {
        width: 103px;
        height: 37px;

        background: #F0F0F0;
        border: 1.43489px solid #DFE0EB;
        border-radius: 2.86978px;
        color: #6F6F6F;
        font-weight: 400;
        font-size: 14px;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0  Card_title">Add Lecture</h4>
                </div>
                <hr class="hr-color" />
            </div>
            <div class="col-12">
                <div>
                    @if (Session::has('msg'))
                    <p class="alert alert-info" id="responseMessage">{{ Session::get('msg') }}</p>
                    @endif
                    @if (Session::has('error'))
                    <p class="alert alert-danger" id="responseMessage">{{ Session::get('error') }}</p>
                    @endif
                </div>
                <form class="repeater" enctype="multipart/form-data" method="POST" action="{{ route('add-course-lecture') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ request()->segment(6) }}" />
                    <div data-repeater-list="lecture_videos">
                        <div data-repeater-item class="row mb-3 align-items-end">
                            <div class="col-lg-4">
                                <label for="name">Lecture Video</label>
                                <input type="file" class="form-control" name="lecture_video" />
                            </div>

                            <div class="col-lg-4">
                                <label>Lecture Title</label>
                                <input type="text" class="form-control" placeholder="Enter lecture title" name="lecture_title" />
                            </div>

                            <div class="col-lg-2">
                                <div class="d-flex align-items-center justify-content-start">
                                    <button data-repeater-delete type="button" class="btn btn-primary" value="Delete">Delete</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="d-flex gap-2">
                        <div class="mt-2 mb-2">
                            <input data-repeater-create type="button" class="btn btn-sm btn-success" value="Add" />
                        </div>
                        <div class="mt-2 mb-2">
                            <button type="submit" class="btn btn-sm btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $("#responseMessage").hide()
        }, 2000);
    });
</script>
@endsection

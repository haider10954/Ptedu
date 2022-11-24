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
                <!-- <form method="POST">
                    @csrf
                    @if (Session::has('msg'))
                    <p class="alert alert-danger mb-2">{{ Session::get('msg') }}</p>
                    @endif
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Lecture Video</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="lecture_video">
                            @error('section_title')
                            <p style="color:#d02525;">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Lecture title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="lecture_title" placeholder="Enter Lecture title">
                            @error('section_description')
                            <p style="color:#d02525;">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-lg btn-register">Submit</button>
                        </div>
                    </div>
                </form> -->

                <form class="repeater" enctype="multipart/form-data">
                    <div data-repeater-list="group-a">
                        <div data-repeater-item class="row mb-3 align-items-end">
                            <div class="col-lg-4">
                                <label for="name">Lecture Video</label>
                                <input type="file" name="untyped-input" class="form-control" />
                            </div>

                            <div class="col-lg-4">
                                <label for="email">Lecture Title</label>
                                <input type="text" class="form-control" placeholder="Enter lecture title" />
                            </div>

                            <div class="col-lg-2">
                                <div class="d-flex align-items-center justify-content-start">
                                    <button data-repeater-delete type="button" class="btn btn-primary" value="Delete">Delete</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <input data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0" value="Add" />
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

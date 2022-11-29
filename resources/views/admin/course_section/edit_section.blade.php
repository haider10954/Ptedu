@extends('admin.layout.layout')

@section('title' , 'Edit Course Section')

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
                    <h4 class="mb-sm-0  Card_title">Edit Section</h4>
                </div>
                <hr class="hr-color" />
            </div>
            <div class="col-12">
                <form method="POST" action="{{ route('edit-course-section') }}">
                    @csrf
                    @if (Session::has('msg'))
                    <p class="alert alert-info mb-2" id="responseMessage">{{ Session::get('msg') }}</p>
                    @endif
                    @if (Session::has('error'))
                    <p class="alert alert-danger mb-2" id="responseMessage">{{ Session::get('erro') }}</p>
                    @endif
                    <input type="hidden" name="id" value="{{ $section->id }}" />
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Section Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="section_title" placeholder="Enter Section Title" value="{{ $section->section_title }}">
                            @error('section_title')
                            <p style="color:#d02525;">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Section Description</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="section_description" placeholder="Enter Section description" value="{{ $section->section_description }}">
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

@extends('admin.layout.layout')

@section('title' , 'Add Category')


@section('custom-style')
<style>
    .hr-color {
        border: 1px solid #C4C4C4;
    }
</style>

@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0  Card_title">Add Category</h4>
                </div>
                <hr class="hr-color" />
            </div>
            <div class="col-12">
                <form>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Category Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="horizontal-firstname-input" placeholder="Enter Category name" name="category_name">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

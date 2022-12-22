@extends('admin.layout.layout')

@section('title' , 'Create Faqs')

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

    .course-image-preview {
        width: 150px;
        height: 150px;
        background: #FFFFFF;
        border: 1px solid #DFE0EB;
        border-radius: 2px;
        display: flex;
        justify-content: center;
        align-items: center;

    }

    .course-image-preview img {
        width: 20px;
        height: 20px;
    }

    .btn-upload {
        background: #F0F0F0;
        border: 1px solid #DFE0EB;
        border-radius: 2px;
        color: #6F6F6F;
    }

    .btn-upload:hover {
        background: #F0F0F0;
        border: 1px solid #DFE0EB;
        border-radius: 2px;
        color: #6F6F6F;
    }

    .btn-add-section {
        background: #FFFFFF;
        border: 1px solid #696CFF;
        border-radius: 2px;
        font-weight: 400;
        font-size: 13px;
        line-height: 23px;
        color: #696CFF;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 4px 16px;
    }

    .btn-add-section:hover {
        background: #FFFFFF;
        border: 1px solid #696CFF;
        border-radius: 2px;
        font-weight: 400;
        font-size: 13px;
        line-height: 23px;
        color: #696CFF;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 4px 16px;
    }

    .lecture-form {
        font-weight: 400 !important;
        font-size: 14px !important;
        line-height: 23px !important;
        color: #6F6F6F !important;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0  Card_title">FAQ > Creating a post (Editor)</h4>
                </div>
                <hr class="hr-color" />
            </div>
            <div class="col-12">
                <form method="POST" action="{{ route('add-faq') }}">
                    @csrf
                    @if (Session::has('msg'))
                    <p class="alert alert-danger mb-2">{{ Session::get('msg') }}</p>
                    @endif
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Question</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="question" placeholder="Enter title" value="{{ old('question') }}">
                            @error('question')
                            <p style="color:#d02525;">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Category</label>
                        <div class="col-sm-10">
                            <select type="text" class="form-control" name="category">
                                <option value="">Select Category</option>
                                @foreach ($category as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                            <p style="color:#d02525;">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">Answer</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="testing" placeholder="Enter content" name="answer">{{ old('answer') }}</textarea>
                            @error('answer')
                            <p style="color:#d02525;">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-lg btn-register">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
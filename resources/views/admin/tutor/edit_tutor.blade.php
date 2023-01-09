@extends('admin.layout.layout')

@section('title' , 'Edit Tutor Information')

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
        /* grayscale / divider */
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

    .display_img {
        height: 200px;
        width: 200px;
        border: 1px solid black;
    }

    .display_img img {
        object-fit: contain;
        height: 100%;
        width: 100%;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0  Card_title">{{ __('translation.Edit Tutor Detail') }}</h4>
                </div>
                <hr class="hr-color" />
            </div>
            <div class="col-12">
                <form method="POST" enctype="multipart/form-data" action="{{ route('edit-tutor') }}">
                    @csrf
                    @if (Session::has('msg'))
                    <p class="alert alert-danger mb-2">{{ Session::get('msg') }}</p>
                    @endif
                    <input type="hidden" name="id" value="{{ $tutor->id }}" />
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Name') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ $tutor->name }}">
                            @error('name')
                            <p style="color:#d02525;">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.English Name') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="en_name" placeholder="Enter English name" value="{{ $tutor->english_name }}">
                            @error('en_name')
                            <p style="color:#d02525;">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Email') }}</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{ $tutor->email }}">
                            @error('email')
                            <p style="color:#d02525;">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Phone Number') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="phone_number" placeholder="Enter Mobile Number" value="{{ $tutor->mobile_number }}">
                            @error('phone_number')
                            <p style="color:#d02525;">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Job') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="job" placeholder="Enter Job" value="{{ $tutor->job }}" />
                            @error('job')
                            <p style="color:#d02525;">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Address') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="address" placeholder="Enter Address" value="{{ $tutor->address }}"></input>
                            @error('address')
                            <p style="color:#d02525;">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Description') }}</label>
                        <div class="col-sm-10">
                            <textarea rows="8" class="form-control" name="description" placeholder="Enter description" style="resize: none;">{{ $tutor->description }}</textarea>
                            @error('description')
                            <p style="color:#d02525;">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Profile Image') }}</label>
                        <div class="col-sm-10">
                            <input type="file" name="image" id="tutor_img" class="d-none" value="{{ $tutor->getTutorImage() }}">
                            <div class="d-flex align-items-end">
                                <div class="display_img" id="tutor_image_view">
                                    <img src="{{ $tutor->getTutorImage() }}" />
                                </div>
                                <button type="button" class="btn btn-upload ms-2" onclick="tutorImg('#tutor_img')">upload</button>
                            </div>
                            @error('description')
                            <p style="color:#d02525;">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-12 d-flex justify-content-center align-content-center">
                            <button type="submit" class="btn btn-lg btn-register">{{ __('translation.Ok') }}</button>
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
    function tutorImg(id) {
        $(id).click();
    }

    $("#tutor_img").on("change", function(e) {

        f = Array.prototype.slice.call(e.target.files)[0]
        let reader = new FileReader();
        reader.onload = function(e) {

            $("#tutor_image_view").html(`<img style="height: 100%; object-fit: contain;"  id="main_image_preview"  src="${e.target.result}" class="main_image_preview img-block- img-fluid w-100">`);
        }
        reader.readAsDataURL(f);
    })
</script>
@endsection
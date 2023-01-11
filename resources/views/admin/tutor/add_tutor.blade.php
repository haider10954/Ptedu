@extends('admin.layout.layout')

@section('title' , 'Tutor Information')

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
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0  Card_title">{{ __('translation.Tutors Info Detail') }}</h4>
                </div>
                <hr class="hr-color" />
            </div>
            <div class="col-12">
                <form method="POST" enctype="multipart/form-data" action="{{ route('add-tutor') }}">
                    @csrf
                    @if (Session::has('msg'))
                    <p class="alert alert-danger mb-2">{{ Session::get('msg') }}</p>
                    @endif
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Name') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="{{ __('translation.Enter Name') }}" value="{{ old('name') }}">
                            @error('name')
                            <p style="color:#d02525;">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.English Name') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="en_name" placeholder="{{ __('translation.Enter English Name') }}" value="{{ old('en_name') }}">
                            @error('en_name')
                            <p style="color:#d02525;">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Email') }}</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" placeholder="{{ __('translation.Enter Email Address') }}" value="{{ old('emial') }}">
                            @error('email')
                            <p style="color:#d02525;">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Phone Number') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="phone_number" placeholder="{{ __('translation.Enter Mobile Number') }}" value="{{ old('phone_number') }}">
                            @error('phone_number')
                            <p style="color:#d02525;">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Job') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="job" placeholder="{{ __('translation.Enter Job') }}" value="{{ old('job') }}">
                            @error('job')
                            <p style="color:#d02525;">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Address') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="address" placeholder="{{ __('translation.Enter Address') }}" value="{{ old('address') }}">
                            @error('address')
                            <p style="color:#d02525;">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Description') }}</label>
                        <div class="col-sm-10">
                            <textarea rows="8" class="form-control" name="description" placeholder="{{ __('translation.Enter description') }}" style="resize: none;">{{ old('description') }}</textarea>
                            @error('description')
                            <p style="color:#d02525;">{{$message}}</p>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Profile Image') }}</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="image">
                            @error('image')
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
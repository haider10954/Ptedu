@extends('admin.layout.layout')

@section('title' , 'Edit Category')


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
                    <h4 class="mb-sm-0  Card_title">{{ __('translation.Edit Category') }}</h4>
                </div>
                <hr class="hr-color" />
            </div>
            <div class="col-12">
                <form method="POST" action="{{ route('edit-category') }}">
                    @csrf
                    @if (Session::has('msg'))
                    <p class="alert alert-danger mb-2">{{ Session::get('msg') }}</p>
                    @endif
                    <input type="hidden" name="id" value="{{ $cat->id}}" />
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Category Name') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="{{ __('translation.Enter Category name') }}" name="category_name" value="{{ $cat->name }}">
                            @error('category_name')
                            <p style="color:#d02525;">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="type" class="col-sm-2 col-form-label lecture-form">{{ __('translation.Type') }}</label>
                        <div class="col-sm-10">

                            <select id="type"  class="form-control" name="type">
                                <option value="">Select Option</option>
                                <option value="online" {{ $cat->type == 'online' ? 'selected' : '' }}>Online</option>
                                <option value="offline" {{ $cat->type == 'offline' ? 'selected' : '' }}>Offline</option>
                            </select>
                            @error('type')
                            <p style="color:#d02525;">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">{{ __('translation.Submit') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

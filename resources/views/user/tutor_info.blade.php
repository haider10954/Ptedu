@extends('user.layout')

@section('title' , 'Ptedu | Tutor Info')

@section('content')
<div class="section pt-150">
    <div class="container mb-80">
        <div class="w-75 m-auto">
            <div class="section-heading">
                <h6 class="mb-0">{{ __('translation.Tutor Introduction')}}</h5>
            </div>
            <div class="row">
                @if($tutor->tutor_thumbnail == null)
                <div class="col-lg-6 col-md-4 col-sm-12">
                    <div class="pt-3">
                        <h5 class="heading mb-3 text-left">{{ $tutor->english_name }}</h5>
                    </div>
                    <div class="pt-2 text-justify">
                        <p class="mb-0 text-dark">{{ $tutor->description }}</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4 col-sm-12">
                    <div class="pt-3 text-center">
                        <img src="{{ asset('storage/tutor/'.$tutor->tutor_img) }}" class="tutor_img">
                    </div>
                </div>
                @else
                <div class="col-lg-12 col-md-4 col-sm-12">
                    <div class="pt-3">
                        <img src="{{ asset('storage/tutor-thumbnail/'.$tutor->tutor_thumbnail) }}" class="w-100">
                    </div>
                </div>
                @endif
            </div>
            <div class="pt-3">
                <h5 class="heading mb-3 text-left">{{ $tutor->english_name }} courses</h5>
            </div>
            <div class="row">
                @if($tutor->getCourseName->count() > 0)
                @foreach ($tutor->getCourseName as $tutor_course)
                <div class="col-lg-4 col-md-4 col-sm-12 mb-3 mb-md-2">
                    <div class="position-relative tutor_info">
                        <img src="{{ asset('storage/course/thumbnail/'.$tutor_course->course_thumbnail) }}" class=" img-fluid course-detail-img">
                        <div class="box-overlay">
                            <a href="{{ route('online_course_detail', $tutor_course->id) }}">
                                <h5 class="heading-h5 mb-3 text-white text-left">{{$tutor_course->course_title }}
                                </h5>
                                <div class="box-overlay-description text-left">
                                    <p class="mb-0 text-white">{{ $tutor_course->short_description }}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="col-lg-12">
                    <div class="text-center">
                        <img src="{{ asset('web_assets/images/no-data-found.png') }}" alt="img" class="img-fluid" style="height: 300px;">
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
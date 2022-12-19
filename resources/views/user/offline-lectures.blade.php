@extends('user.layout')

@section('title', 'ptedu - Offline Lectures')

@section('content')
    <div class="section pt-150 lectures_section bg-grey">
        <div class="container">
            <div class="section-heading">
                <h5 class="mb-0">오프라인 특강</h5>
            </div>
            <div class="row pt-4">
                @foreach ($offline_courses as $item)
                    <div class="col-lg-3">
                        <div class="course-box mb-3">
                            <div class="course-img">
                                <img src="{{ asset('storage/offline_course/thumbnail/'.$item->course_thumbnail) }}" class="img-fluid offline-course-img" alt="img">
                            </div>
                            <div class="course-info">
                                <small class="d-block text-muted mb-1 font-weight-600">{{ $item->created_at->format('Y.m.d') }}</small>
                                <p class="mb-0"><a href="{{ route('offline_lecture_detail',$item->id) }}" class="text-theme-dark">{{ $item->course_title }}</a></p>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-lg-12">
                    {{ $offline_courses->links('vendor.pagination.custom-pagination') }}
                </div>
                
            </div>
        </div>
    </div>
@endsection

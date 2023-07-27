@extends('user.layout')

@section('title', 'ptedu - Special Courses')

@section('content')
<div class="section pt-150 lectures_section bg-white" style="min-height: 70vh;">
    <div class="container">
        <div class="section-heading d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Special Lecture</h5>

            <div class="text-right">
                <input type="text" class="form-control" placeholder="강좌명으로 검색" id="myInput">
            </div>
        </div>
        <div class="lectures_view">
            <div class="row pt-4">
                <div class="no-records d-flex align-items-center justify-content-center w-100"></div>
                @foreach ($specialCourse as $item)
                    <div class="col-lg-3 searchable my-2" data-name="{{ $item->course_title }}">
                        <a href="{{ route('online_course_detail',$item->id) }}">
                            <div class="course-box mb-3">
                                <div class="course-img">
                                    <img src="{{ asset('storage/course/thumbnail/'.$item->course_thumbnail) }}" class="img-fluid offline-course-img" alt="img">
                                </div>
                                <div class="course-info">
                                    <small class="d-block text-muted mb-1 font-weight-600">{{ $item->created_at->format('Y.m.d') }}</small>
                                    <p class="mb-0 text-theme-dark">{{ Str::limit($item->course_title, 40, '...') }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                <div class="col-lg-12">
                    {{ $specialCourse->links('vendor.pagination.custom-pagination') }}
                </div>

            </div>
        </div>

        {{--Mobile View--}}

        <div class="lectures_view_mobile">
            <div class="row pt-4">
                <div class="no-records d-flex align-items-center justify-content-center w-100"></div>
                @foreach ($specialCourse as $item)
                    <div class="col-6 searchable my-2" data-name="{{ $item->course_title }}">
                        <a href="{{ route('offline_lecture_detail',$item->id) }}">
                            <div class="course-box mb-3">
                                <div class="course-img">
                                    <img src="{{ asset('storage/offline_course/thumbnail/'.$item->course_thumbnail) }}" class="img-fluid offline-course-img" alt="img">
                                </div>
                                <div class="course-info">
                                    <small class="d-block text-muted mb-1 font-weight-600">{{ $item->created_at->format('Y.m.d') }}</small>
                                    <p class="mb-0 text-theme-dark">{{ Str::limit($item->course_title, 40, '...') }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                <div class="col-lg-12">
                    {{ $specialCourse->links('vendor.pagination.custom-pagination') }}
                </div>

            </div>
        </div>

    </div>
</div>
@endsection

@section('custom-script')
<script>
    let hiddenCount = 0;
    $("#myInput").on("keyup keypress", function() {
        hiddenCount = 0;
        var value = $(this).val();
        $(".searchable").each(function(index) {
            $row = $(this);
            var id = $row.attr("data-name");
            var name = id.toLowerCase();

            if (name.indexOf(value) != 0) {
                $(this).hide();
                hiddenCount++;
            } else {
                $(this).show();
            }
        });
        if (hiddenCount == $('.searchable').length) {
            $('.no-records').html(`
                    <div id="no_record" class="text-center">
                        <img src="{{ asset('web_assets/images/no-data-found.png') }}" alt="img" class="img-fluid" style="height: 300px;object-fit: cover;">
                    </div>
                `);
        } else {
            $(document).find('.no-records #no_record').remove();
        }
    });
</script>
@endsection

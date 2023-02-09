<div class="section-boxes">
    @if ($sections->count() > 0)
        @foreach ($sections as $v)
        <div class="section-box">
            <div class="d-flex justify-content-between section-box-header align-items-center">
                <h3 class="mb-0 section-box-heading">{{ __('translation.Section')}}-{{ $loop->index+1 }}. <span
                        class="section-title">{{ $v->section_title }}</span></h3>
                        <button class="btn btn-primary btn-sm add_lectures_btn" onclick="addLecture($(this))" data-section-id="{{ $v->id }}" data-course-id="{{ $v->course_id }}"><i class="fa fa-plus"></i>{{ __('translation.Add Lectures') }}</button>
            </div>
            <div class="section-box-content">
                <h5 class="section-description mb-4">{{ $v->section_description }}</h5>
                <ul class="section-lectures px-0">
                    @foreach ($v->getLectures as $lecture)
                    <li class="section-lecture-record">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-play-circle-fill me-2"></i>
                            <p class="mb-0">1강. {{ $lecture->lecture_title }}</p>
                        </div>
                        <div class="duration d-flex align-items-center gap-1 action">
                            {{-- <p class="mb-0">30:00</p> --}}
                            <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="editLecture($(this))" data-lecture-id="{{ $lecture->id }}" data-course-id="{{ $v->course_id }}" data-lecture-title="{{ $lecture->lecture_title }}"><i class="bi bi-pencil"></i></a>
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="delLecture($(this))" data-lecture-id="{{ $lecture->id }}" data-course-id="{{ $v->course_id }}"><i class="bi bi-trash"></i></a>
                        </div>
                    </li>  
                    @endforeach
                </ul>
            </div>
        </div> 
        @endforeach
    @else
        <h5> No Lectures Found </h5>
    @endif
</div>
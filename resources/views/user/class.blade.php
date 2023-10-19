@extends('user.layout')

@section('title', 'ptedu - My Classroom')

@section('custom-style')
<link rel="stylesheet" href="https://cdn.plyr.io/3.7.3/plyr.css" />
@endsection

@section('content')
<div class="lectures-view-wrapper">
    <div class="container-fluid">
        <div class="classroom_box mb-4 mt-2">
            <div class="left-content">
                <div class="content-header px-3">
                    <h6 class="mb-0 text-light font-weight-400">{{ $course->course_title }} ({{ count($lectures) }})</h6>
                    <h3 class="logo">
                        <a class="text-decoration-none text-light" href="javascript:void(0)">PTEdu<sub>®</sub> </a>
                    </h3>
                </div>
                <div class="content lecture_video_section">
                    @if (!empty($lecture->lecture_video))
                    <video id="player" style="height: 100%;width: 100%;" playsinline controls data-poster="{{ asset('storage/course/thumbnail/' . $lecture->getSection->getCourse->course_thumbnail) }}">
                        <!-- Video files -->
                        <source src="{{ asset('storage/lectures/' . $lecture->lecture_video) }}" type="video/mp4" size="576" />
                        <source src="{{ asset('storage/lectures/' . $lecture->lecture_video) }}" type="video/mp4" size="720" />
                        <source src="{{ asset('storage/lectures/' . $lecture->lecture_video) }}" type="video/mp4" size="1080" />
                    </video>
                    @else
                    @php
                    $video_link = $lecture->lecture_video_link;
                    if (preg_match('|^http(s)?://(.*?)vimeo.com|', $video_link)) {
                    $provider = 'vimeo';
                    $video_url_params = parse_url($video_link);
                    $video_id = str_replace('/', '', $video_url_params['path']);
                    } else {
                    $provider = 'youtube';
                    $video_url_params = parse_url($video_link);
                    parse_str($video_url_params['query'], $params);
                    $video_id = $params['v'];
                    }
                    @endphp
                    <div id="player" data-plyr-provider="{{ $provider }}" data-plyr-embed-id="{{ $video_id }}"></div>
                    @endif
                </div>
            </div>
            <div class="right-content">
                <div class="content-header">
                    <h6 class="mb-0 text-dark">{{__('translation.Course Content')}}</h6>
                </div>
                <div class="content" style="width: 84% !important;">
                    <ul class="lectures_list">
                        @foreach ($lectures as $record)
                            @php
                                $lecture_progress = null;
                                if (!empty($record->duration) && !empty($record->viewed_time)) {

                                $record->duration = (float) str_replace(':', '.', $record->duration);
                                $record->viewed_time = (float) str_replace(':', '.', $record->viewed_time);
                                $duration = number_format($record->duration, 2);
                                $viewed_time = number_format($record->viewed_time, 2);
                                $lecture_progress = ($record->viewed_time / $record->duration) * 100;

                                }
                            @endphp
                        @if ($record->slug == $lecture->slug)
                        <li id="playingVideoLink">
                            <a title="{{ $record->lecture_title }}" href="javascript:void(0)" class="d-flex align-items-center justify-content-between"><span>{{ $loop->index + 1 }}강.{{ \Str::limit($record->lecture_title, 25) }}</span>
                                <i class="text-dark font-9 fas fa-pause"></i></a>
                            @if (!empty($lecture_progress))
                            <div class="lecture-progress" style="width:{{ $lecture_progress }}%;"></div>
                            @endif
                        </li>
                        @else
                        <li>
                            <a title="{{ $record->lecture_title }}" href="{{ route('class', [$course->id, $record->slug]) }}">{{ $loop->index + 1 }}강.
                                {{ \Str::limit($record->lecture_title, 25) }}</a>
                            @if (!empty($lecture_progress))
                            <div class="lecture-progress" style="width:{{ $lecture_progress }}%;"></div>
                            @endif
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
                <div class="content-footer px-3 " style="position: static !important;">
                    <a class="btn btn-danger" href="{{ route('my_classroom') }}">수강종료</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('custom-script')
<script src="https://cdn.plyr.io/3.7.3/plyr.js"></script>
<script>
    let player = new Plyr('#player');
    player.on('ready', (event) => {
        // console.log("{{ $lecture->viewed }}");
        setTimeout(() => {
            if (!isEmpty("{{ $lecture->viewed }}")) {
                player.currentTime = durationToSeconds("{{ $lecture->viewed }}");
                player.play();
            }
        }, 2000);
    });

    function isEmpty(str) {
        return (!str || str.length === 0);
    }

    function durationToSeconds(time) {
        var p = time.split(':'),
            s = 0,
            m = 1;

        while (p.length > 0) {
            s += m * parseInt(p.pop(), 10);
            m *= 60;
        }

        return s;
    }

    function formatTime(time) {
        let minutes = Math.floor(time / 60)
        let timeForSeconds = time - (minutes * 60) // seconds without counted minutes
        let seconds = Math.floor(timeForSeconds)
        let secondsReadable = seconds > 9 ? seconds : `0${seconds}` // To change 2:2 into 2:02
        return `${minutes}:${secondsReadable}`
    }
    setInterval(() => {
        // console.log(player.ended);
        if (player.playing === true) {
            $.ajax({
                type: "POST",
                url: "{{ route('lecture_time_track') }}",
                dataType: 'json',
                data: {
                    'viewed_duration': formatTime(player.currentTime),
                    'lecture_id': "{{ $lecture->id }}",
                    'course_id': "{{ $course->id }}",
                    '_token': "{{ csrf_token() }}"
                },
                success: function(res) {
                    if (res.success == true) {
                        // console.log(true);
                    } else {
                        //    console.log(false);
                    }
                },
                error: function(e) {}
            });
        }
        // if (player.ended == true) {
        //     setInterval(() => {
        //         if ($('#playingVideoLink').next('li').find('a').attr('href') !== undefined) {
        //             console.log('working');
        //             window.location.href = $('#playingVideoLink').next('li').find('a').attr('href');
        //         }
        //     }, 2500);
        // }
    }, 5000);
    player.on('ended', (event) => {
        $.ajax({
            type: "POST",
            url: "{{ route('lecture_time_completed') }}",
            dataType: 'json',
            data: {
                'lecture_id': "{{ $lecture->id }}",
                'course_id': "{{ $course->id }}",
                'completed': 1,
                '_token': "{{ csrf_token() }}"
            },
            success: function(res) {
                if (res.success == true) {
                    // setInterval(() => {
                    //     if ($('#playingVideoLink').next('li').find('a').attr('href') !== undefined) {
                    //         console.log('working');
                    //         window.location.href = $('#playingVideoLink').next('li').find('a').attr('href');
                    //     }
                    // }, 2500);
                } else {
                    //    console.log(false);
                }
            },
            error: function(e) {}
        });
        $.ajax({
            type: "POST",
            url: "{{ route('course_completion_action') }}",
            dataType: 'json',
            data: {
                'course_id': "{{ $course->id }}",
                '_token': "{{ csrf_token() }}"
            },
            success: function(res) {
                if (res.success == true) {
                    // setInterval(() => {
                    //     if ($('#playingVideoLink').next('li').find('a').attr('href') !== undefined) {
                    //         console.log('working');
                    //         window.location.href = $('#playingVideoLink').next('li').find('a').attr('href');
                    //     }
                    // }, 2500);
                } else {
                    //    console.log(false);
                }
            },
            error: function(e) {}
        });
    });
</script>
@endsection

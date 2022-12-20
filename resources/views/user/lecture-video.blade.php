@extends('user.layout')

@section('title', 'ptedu - Lecture Detial')

@section('custom-style')
    <link href="https://vjs.zencdn.net/7.20.3/video-js.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="section lecture_banner_section">
        <div class="banner_text">
            {{-- <h5 class="mb-0">강의 영상 소개</h5> --}}
            {{-- <iframe style="width: 100%;height: 100%;" class="mb-3" src="https://www.youtube.com/embed/8SiRTLIXSzE"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe> --}}
            <video id="my-video" class="video-js" preload="auto" controls  style="height: 100%;width: 100%;object-fit:cover;"
                poster="{{ asset('storage/course/thumbnail/16705056921680.jpg') }}" data-setup="{}">
                <source src="{{ asset('storage/lectures/16710003578506.mp4/') }}" type="video/mp4" />
                <p class="vjs-no-js">
                    To view this video please enable JavaScript, and consider upgrading to a
                    web browser that
                    <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                </p>
            </video>
            {{-- <video src="{{ asset('storage/lectures/16710003562004.mp4') }}" id="my-video" preload="auto" controls  style="height: 100%;width: 100%;object-fit:cover;">
            </video> --}}
        </div>
    </div>
@endsection

@section('custom-script')
<script src="https://unpkg.com/video.js@7.10.2/dist/video.min.js"></script>
<script>
    var player = videojs('my-video');
    // player.seeking(false);
    setInterval(() => {
        console.log(player.currentTime()/60);
    }, 2000);
</script>
@endsection

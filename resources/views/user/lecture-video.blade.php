@extends('user.layout')

@section('title', 'ptedu - Lecture Detial')

@section('custom-style')
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.3/plyr.css" />
@endsection

@section('content')
    <div class="section lecture_banner_section">
        <div class="banner_text">
            {{-- <video id="my-video" class="video-js" preload="auto" controls  style="height: 100%;width: 100%;object-fit:cover;"
                poster="{{ asset('storage/course/thumbnail/16705056921680.jpg') }}" data-setup="{}">
                <source src="{{ asset('storage/lectures/16710003578506.mp4/') }}" type="video/mp4" />
                <p class="vjs-no-js">
                    To view this video please enable JavaScript, and consider upgrading to a
                    web browser that
                    <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                </p>
            </video> --}}
            <video id="player" style="height: 100%;width: 100%;" playsinline controls data-poster="{{ asset('storage/course/thumbnail/16705056921680.jpg') }}">
                <!-- Video files -->
                <source
                    src="{{ asset('storage/lectures/16710003578506.mp4/') }}"
                    type="video/mp4"
                    size="576"
                />
                <source
                    src="{{ asset('storage/lectures/16710003578506.mp4/') }}"
                    type="video/mp4"
                    size="720"
                />
                <source
                    src="{{ asset('storage/lectures/16710003578506.mp4/') }}"
                    type="video/mp4"
                    size="1080"
                />
            </video>
        </div>
    </div>
@endsection

@section('custom-script')
    <script src="https://cdn.plyr.io/3.7.3/plyr.js"></script>
    <script>
    const player = new Plyr('#player');
    // console.log(player);
    setInterval(() => {
        console.log(player.currentTime/60);
    }, 1000);
    </script>
@endsection

@extends('user.layout')

@section('title' , 'About Us')

@section('content')

<div class="section">
    <div class="container-fuild d-flex align-items-center justify-content-center">
        <div class="about_us_image">
            <img src="{{ asset('web_assets/images/PTEdu(web).png') }}" class="img-fluid h-100" alt="">
        </div>

        <div class="about_us_image_mobile">
            <img src="{{ asset('web_assets/images/AboutUs(mobile).png') }}" class="img-fluid h-100" alt="">
        </div>
    </div>
</div>
@endsection
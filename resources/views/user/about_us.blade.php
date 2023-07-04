@extends('user.layout')

@section('title' , 'About Us')

@section('content')

<div class="about_us_section">
{{--    <div class="container-fuild d-flex align-items-center justify-content-center">--}}
{{--        <div class="about_us_image">--}}
{{--            <img src="{{ asset('web_assets/images/PTEdu(web).png') }}" class="img-fluid h-100" alt="">--}}
{{--        </div>--}}

{{--        <div class="about_us_image_mobile">--}}
{{--            <img src="{{ asset('web_assets/images/AboutUs(mobile).png') }}" class="img-fluid h-100" style="object-fit: contain;" alt="">--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="about_us_section_1" style="background-image: url('{{ asset('web_assets/images/aboutUs_1.png') }}')">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <h2 class="text-white mb-3"><img src="{{ asset('web_assets/images/PTEduLogo(AboutUs).png') }}"></h2>
                    <p class="text-danger" style="margin-bottom: 3rem; font-size: 20px; font-weight: bold">Spreading Proper Knowledge</p>
                </div>
                <div class="col-lg-12">
                    <div class="row align-items-start">
                        <div class="col-lg-6" style="border-right: 1px solid #343638">
                            <p class="mb-0 text-white font-25 padding-right-60" >
                                사람들에게 선한 영향력을 전달하기 위해 정진하는
                                모든 물리치료사 및 운동 전문가들을 환영합니다.
                                피티에듀는 기초부터 심화 과정까지 올바른 지식을
                                통해 전문가로 거듭남으로 형태의 변화에 대한 발판을
                                제공하는 교육 전문 플랫폼입니다.
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <p class="mb-0 text-white font-25 padding-left-60">
                                여러 치료사들이 모여 논문과 임상 경험을 베이스로 한
                                근거 기반 물리치료를 토대로 다양한 정보들을
                                선별하여 질높은 강의를 제공합니다.
                                분야별 맞춤식 강의를 통해 개인의 역량을 향상시키고
                                더 나아가 건강한 대한민국을 만드는 데에 이바지합니다
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="about_us_section_2" style="background-image: url('{{ asset('web_assets/images/aboutUs_2.png') }}')">
        <div class="container">
            <div class="text-white">
                <span>피티에듀 대표</span>
                <h2 style="margin-bottom: 2rem">조규행</h2>

                <p class="mb-40">
                    근무 <br>
                    1995년~2015년 보건복지부 국립재활원 명예퇴직 <br>
                    2016년~현재 피티에듀 대표
                </p>

                <p class="mb-40">
                    전) 신구대학교 외래 교수, 전) 삼육대학교 외래 교수, 전) 남서울대학교 외래 교수
                </p>

                <p class="mb-40">
                    학력 <br>
                    1995년 신구대학교 물리치료학과 졸업 <br>
                    2002년 한국방송통신대학 행정학 학사 <br>
                    2004년 삼육대학교 물리치료학 석사 <br>
                    2006년 삼육대학교 물리치료학 박사과정 수료 <br>
                </p>

                <p class="mb-40">
                    학회 활동 <br>
                    2008년~2012년 대한고유수용성신경근촉진법학회 서울경기북부지회 회장 <br>
                    2012년~2013년 대한고유수용성신경근촉진법학회 이사장 <br>
                    2014년~2015년 대한고유수용성신경근촉진법학회 중앙회 회장 <br>
                    2014년~2015년 대한물리치료사협회 신경계분과 학회장 <br>
                    2000년~2016년 대한재활의학회 중추신경발달과정 연수 강사 <br>
                </p>

                <p class="mb-40"> 현) International Instructor of PNF Association</p>

                <p class="mb-40">
                    표창 <br>
                    2005년, 2008년 국립재활원 우수공무원 기관장 표창 2회 <br>
                    2010년 보건복지부 장관 표창 <br>
                    2012년 대한민국 대통령표창 <br>
                </p>

                <p>
                    기타 <br>
                    2013년, 2014년, 2015년 한국보건의료인국가시험원 출제위원 <br>
                    2012년~2014년 심사평가원 신경계 임상패널 <br>
                    2008년~2015년 보건복지부 지역사회중심재활 강사 <br>
                </p>
            </div>
        </div>
    </div>
    <div class="about_us_section_3">
        <div class="container">
            <div class="w-100">
                <div class="row">
                    <div class="col-12">
                        <img src="{{asset('web_assets/images/aboutUs_3.png')}}" class="w-100">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 my-2">
                        <div>
                            <img src="{{asset('web_assets/images/aboutUs_4.png')}}" class="w-100 h-100" style="object-fit: cover">
                        </div>
                    </div>
                    <div class="col-4 my-2">
                        <div>
                            <img src="{{asset('web_assets/images/aboutUs_5.png')}}" class="w-100 h-100" style="object-fit: cover">
                        </div>
                    </div>
                    <div class="col-4 my-2">
                        <div>
                            <img src="{{asset('web_assets/images/aboutUs_6.png')}}" class="w-100 h-100" style="object-fit: cover">
                        </div>
                    </div>
                    <div class="col-4 my-2">
                        <div>
                            <img src="{{asset('web_assets/images/aboutUs_7.png')}}" class="w-100 h-100" style="object-fit: cover">
                        </div>
                    </div>
                    <div class="col-4 my-2">
                        <div>
                            <img src="{{asset('web_assets/images/aboutUs_8.png')}}" class="w-100 h-100" style="object-fit: cover">
                        </div>
                    </div>
                    <div class="col-4 my-2">
                        <div>
                            <img src="{{asset('web_assets/images/aboutUs_9.png')}}" class="w-100 h-100" style="object-fit: cover">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="h-100">
                            <img src="{{asset('web_assets/images/aboutUs_10.png')}}" class="w-100 h-100" style="object-fit: cover">
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-2">
                                    <img src="{{asset('web_assets/images/aboutUs_11.png')}}" class="w-100 h-100" style="object-fit: cover">
                                </div>
                            </div>
                            <div class="col-12">
                                <div>
                                    <img src="{{asset('web_assets/images/aboutUs_12.png')}}" class="w-100 h-100" style="object-fit: cover">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@extends('user.layout')

@section('title', 'PTEdu - Inquiry')

@section('content')
<div class="section pt-125">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 padding-left">
                <div class="page-sidemenu-heading mb-3">
                    <h5 class="mb-0 font-weight-600">Inquiry</h5>
                    <a href="javscript:void(0)" class="btn btn-dark btn-custom-sm btn-theme-black page-side-menu-toggle">menu</a>
                </div>
                <div class="page-side-menu">
                    <ul class="menu">
                        <li><a href="{{ route('my_classroom') }}">My Classroom</a></li>
                        <li><a href="{{ route('shopping_bag') }}">Shopping Bag</a></li>
                        <li><a href="{{ route('user_info') }}">Modifying Member Info</a></li>
                        <li><a href="{{ route('user_inquiry')  }}">1:1 Inquiry</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="section-heading mb-3">
                    <h5 class="mb-1">1:1 Inquiry</h5>
                    <p class="mb-0">Questions & Answers in PTEdu</p>
                </div>
                <div class="mt-3">
                    <div class="w-100">
                        <table class="table shopping-table text-center table-responsive">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Title</td>
                                    <td>작성자</td>
                                    <td>등록일</td>
                                    <td>진행상태</td>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>10</td>
                                    <td>문의합니다</td>
                                    <td>이**</td>
                                    <td>2022.10.13</td>
                                    <td><a class="btn btn-sm btn-theme-delete rounded-0" href="{{ route('inquiry_not_answered') }}">답변준비중</a></td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>문의합니다</td>
                                    <td>이**</td>
                                    <td>2022.10.13</td>
                                    <td><a class="btn btn-sm btn-theme-delete rounded-0" href="{{ route('inquiry_not_answered') }}">답변준비중</a></td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>문의합니다</td>
                                    <td>이**</td>
                                    <td>2022.10.13</td>
                                    <td><a class="btn btn-sm btn-theme-black-inquiry text-white rounded-0" href="{{ route('inquiry_answered') }}">답변준비중</a></td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>문의합니다</td>
                                    <td>이**</td>
                                    <td>2022.10.13</td>
                                    <td><a class="btn btn-sm btn-theme-black-inquiry text-white rounded-0" href="{{ route('inquiry_answered') }}">답변준비중</a></td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>문의합니다</td>
                                    <td>이**</td>
                                    <td>2022.10.13</td>
                                    <td><a class="btn btn-sm btn-theme-black-inquiry text-white rounded-0" href="{{ route('inquiry_answered') }}">답변준비중</a></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>문의합니다</td>
                                    <td>이**</td>
                                    <td>2022.10.13</td>
                                    <td><a class="btn btn-sm btn-theme-black-inquiry text-white rounded-0" href="{{ route('inquiry_answered') }}">답변준비중</a></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>문의합니다</td>
                                    <td>이**</td>
                                    <td>2022.10.13</td>
                                    <td><a class="btn btn-sm btn-theme-black-inquiry text-white rounded-0" href="{{ route('inquiry_answered') }}">답변준비중</a></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>문의합니다</td>
                                    <td>이**</td>
                                    <td>2022.10.13</td>
                                    <td><a class="btn btn-sm btn-theme-black-inquiry text-white rounded-0" href="{{ route('inquiry_answered') }}">답변준비중</a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>문의합니다</td>
                                    <td>이**</td>
                                    <td>2022.10.13</td>
                                    <td><a class="btn btn-sm btn-theme-black-inquiry text-white rounded-0" href="{{ route('inquiry_answered') }}">답변준비중</a></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>문의합니다</td>
                                    <td>이**</td>
                                    <td>2022.10.13</td>
                                    <td><a class="btn btn-sm btn-theme-black-inquiry text-white rounded-0" href="{{ route('inquiry_answered') }}">답변준비중</a></td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <div class="text-right margin">
                                            <a class="btn btn-theme-white" href="{{ route('add_inquiry') }}">1:1 문의하기</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="custom-pagination mb-3">
                    <div class="paginate">
                        <a class="paginate-btn">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="javascript:void(0)" class="active">1</a>
                        <a href="javascript:void(0)">2</a>
                        <a href="javascript:void(0)">3</a>
                        <a href="javascript:void(0)">4</a>
                        <a href="javascript:void(0)">5</a>
                        <a class="paginate-btn">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
<script>
    $('.page-side-menu-toggle').on('click', function() {
        $('.page-side-menu').slideToggle();
    });

    $('.select_payment_method').height($('.payment_info').height());
</script>
@endsection

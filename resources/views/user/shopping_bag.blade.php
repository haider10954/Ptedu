@extends('user.layout')

@section('title', 'PTEdu - Shopping Bag')

@section('content')
<div class="section pt-125">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2">
                <div class="page-sidemenu-heading mb-3">
                    <h5 class="mb-0 font-weight-600">Shopping Bag</h5>
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
                    <h5 class="mb-0">Shopping Bag</h5>
                </div>
                <div class="mt-3 mb-3">
                    <button class="btn rounded-0 btn-theme-delete"><i class="fa fa-times"></i><span class="ml-2">Select Delete</span></button>
                </div>
                <div class="mt-3">
                    <div class="shopping-bag-info">
                        <h5 class="shopping-bag-text">Shopping Bag Product Info (3)</h5>
                    </div>
                    <div class="w-100">
                        <table class="table shopping-table">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td class="text-center" style="width: 57%;">Course Name</td>
                                    <td>Quantity</td>
                                    <td>Discount</td>
                                    <td>Price</td>
                                    <td>Buy/Delete</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> <input type="checkbox" class="checkbox" /> </td>
                                    <td>
                                        <span>[전문가 강좌] 보행 A에서 Z까지 </span> <br />
                                        <span>Physical Teraphy l 조규행</span>
                                    </td>
                                    <td>1</td>
                                    <td>-5,000원</td>
                                    <td>
                                        <span class="discounted_Price">200,000원</span> <br />
                                        <span>150,000원</span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <button class="btn rounded-0 btn-theme-delete mb-2">Delete</button>
                                            <button class="btn rounded-0 btn-theme-black text-white">Buy</button>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td> <input type="checkbox" class="checkbox" /> </td>
                                    <td>
                                        <span>[전문가 강좌] 보행 A에서 Z까지 </span> <br />
                                        <span>Physical Teraphy l 조규행</span>
                                    </td>
                                    <td>2</td>
                                    <td>-5,000원</td>
                                    <td>
                                        <span class="discounted_Price">200,000원</span> <br />
                                        <span>150,000원</span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <button class="btn rounded-0 btn-theme-delete mb-2">Delete</button>
                                            <button class="btn rounded-0 btn-theme-black text-white">Buy</button>
                                        </div>
                                    </td>
                                </tr>


                                <tr>
                                    <td> <input type="checkbox" class="checkbox" /> </td>
                                    <td>
                                        <span>[전문가 강좌] 보행 A에서 Z까지 </span> <br />
                                        <span>Physical Teraphy l 조규행</span>
                                    </td>
                                    <td>3</td>
                                    <td>-5,000원</td>
                                    <td>
                                        <span class="discounted_Price">200,000원</span> <br />
                                        <span>150,000원</span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <button class="btn rounded-0 btn-theme-delete mb-2">Delete</button>
                                            <button class="btn rounded-0 btn-theme-black text-white">Buy</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        <div class="cart-total">
                            <div class="row">
                                <div class="col-md-3 flex-column cart-total-price border_right text-center position-relative">
                                    <h5>Total</h5>
                                    <p class="price mb-0">600,000원</p>
                                    <div class="icons">
                                        <i class="fa fa-minus"></i>
                                    </div>
                                </div>
                                <div class="col-md-3 flex-column cart-total-price border_right text-center position-relative">
                                    <h5>Discount</h5>
                                    <p class="price mb-0 text-danger">600,000원</p>
                                    <div class="icons">
                                        <i class="fa fa-plus"></i>
                                    </div>
                                </div>
                                <div class="col-md-3 flex-column cart-total-price border_right text-center position-relative">
                                    <h5>Delivery Fee</h5>
                                    <p class="price mb-0">0</p>
                                    <div class="icons">
                                        <i class="fa fa-equals"></i>
                                    </div>
                                </div>
                                <div class="col-md-3 flex-column cart-total-price  text-center">
                                    <h5>Total estimated payment amount</h5>
                                    <p class="total-price mb-0">58,5000원</p>

                                </div>
                            </div>
                        </div>
                        <div class="mobile-icons">
                            <div class="row">
                                <div class="col-12">
                                    <div class="position">
                                        <div class="p-5 text-center" style="border-bottom: 1px black solid;">
                                            <h5>Total</h5>
                                            <p class="price mb-0">600,000원</p>
                                        </div>
                                        <div class="mobi-icons">
                                            <i class="fa fa-minus"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="position">
                                        <div class="p-5 text-center" style="border-bottom: 1px black solid;">
                                            <h5>Discount</h5>
                                            <p class="price mb-0">600,000원</p>
                                        </div>
                                        <div class="mobi-icons">
                                            <i class="fa fa-equals"></i>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="position">
                                        <div class="p-5 text-center" style="border-bottom: 1px black solid;">
                                            <h5>Delivery Fee</h5>
                                            <p class="price mb-0">0</p>
                                        </div>
                                        <div class="mobi-icons">
                                            <i class="fa fa-plus"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="position">
                                        <div class="p-5 text-center" style="border-bottom: 1px black solid;">
                                            <h5>Total estimated payment amount</h5>
                                            <p class="price mb-0">58,5000원</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex  align-content-center justify-content-center mt-3">
                                <button class="btn btn-theme-delete mx-2"><span class="mr-2">View other courses</span> <i class="fa fa-angle-right"></i> </button>

                                <a href="{{ route('order') }}" class="btn btn-theme-black text-white mx-2"><span class="mr-2">Buy it Now</span> <i class="fa fa-angle-right"></i> </a>
                            </div>
                        </div>
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
</script>
@endsection

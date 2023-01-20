@extends('user.layout')

@section('title', 'PTEdu - Orders')

@section('content')
<div class="section pt-125">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 padding-left">
                <div class="page-sidemenu-heading mb-3">
                    <h5 class="mb-0 font-weight-600">{{ __('translation.My Classroom') }}</h5>
                    <a href="javscript:void(0)" class="btn btn-dark btn-custom-sm btn-theme-black page-side-menu-toggle">menu</a>
                </div>
                <div class="page-side-menu">
                    <ul class="menu">
                        <li><a href="{{ route('my_classroom') }}">{{ __('translation.My Classroom') }}</a></li>
                        <li><a href="{{ route('shopping_bag') }}">{{ __('translation.Shopping Bag') }}</a></li>
                        <li><a href="{{ route('user_info') }}">{{ __('translation.Modifying Member Info') }}</a></li>
                        <li><a href="{{ route('user_inquiry')  }}">{{ __('translation.Inquiry') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="section-heading mb-3">
                    <h5 class="mb-0">{{ __('translation.Order Payment') }}</h5>
                </div>
                <div class="mt-3 mb-3">
                    <button class="btn rounded-0 btn-theme-delete"><i class="fa fa-times"></i><span class="ml-2">{{ __('translation.Delete') }}</span></button>
                </div>
                <div class="mt-3">
                    <div class="shopping-bag-info">
                        <h5 class="shopping-bag-text">{{ __('translation.Shopping Bag Product Info') }} (3)</h5>
                    </div>
                    <div class="w-100">
                        <table class="table shopping-table">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td class="text-center" style="width: 57%;">{{ __('translation.Course Name') }}</td>
                                    <td>{{ __('translation.Quantity') }}</td>
                                    <td>{{ __('translation.Discount') }}</td>
                                    <td>{{ __('translation.Price') }}</td>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> <input type="checkbox" class="checkbox" checked /> </td>
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

                                </tr>

                                <tr>
                                    <td> <input type="checkbox" class="checkbox" checked /> </td>
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

                                </tr>


                                <tr>
                                    <td> <input type="checkbox" class="checkbox" checked /> </td>
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

                                </tr>

                                <tr>
                                    <td colspan="5">
                                        <div class="text-right total_payment">
                                            <p class="mb-0 text-muted">{{ __('translation.Total payment') }}</p>
                                            <span class="font-20 font-weight-700">58,5000원</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 h-100">
                            <div class="select_payment_method border_bottom">
                                <div class="shopping-bag-info">
                                    <h6 class="shopping-bag-text">{{ __('translation.Select payment method') }}</h6>
                                </div>
                                <div class="mt-3">
                                    <p>{{ __('translation.Payment Method') }}</p>
                                </div>
                                <div class="align-items-center radio_select mb-3">
                                    <div class="mr-3 payment_method_card mb-1 mb-md-0">
                                        <input type="radio" name="payment_method" class="payment-method-radio" checked> <span>{{ __('translation.Card') }}</span>
                                    </div>
                                    <div class="mr-3 w-100 mb-1 mb-md-0">
                                        <input type="radio" name="payment_method" class="payment-method-radio"> {{ __('translation.Real-time account transfer') }}
                                    </div>
                                    <div class="mr-3 payment_method_deposit mb-1 mb-md-0">
                                        <input type="radio" name="payment_method" class="payment-method-radio"> {{ __('translation.Make a deposit') }}
                                    </div>
                                    <div class="mr-3 payment_method_mobile mb-1 mb-md-0">
                                        <input type="radio" name="payment_method" class="payment-method-radio" value="cashondelivery"> {{ __('translation.Mobile phone transfer') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 h-100">
                            <div class="payment_info border-1">
                                <div class="shopping-bag-info">
                                    <h6 class="shopping-bag-text">{{ __('translation.Confirmation of final payment') }}</h6>
                                </div>
                                <div class="row p-3 align-items-center">
                                    <div class="col-6 pr-0">
                                        <p>Total</p>
                                        <div class="confirm_payment">
                                            <p class="mb-0">
                                                {{ __('translation.Discount') }}
                                            </p>
                                            <p class="mb-0">
                                                {{ __('translation.Coupon') }}
                                            </p>
                                            <p>
                                                {{ __('translation.Mobile gift Certificate') }}
                                            </p>
                                        </div>
                                        <p>
                                            {{ __('translation.Total Discount') }}
                                        </p>
                                        <p>
                                            {{ __('translation.Total payment account') }}
                                        </p>

                                    </div>
                                    <div class="col-6 text-right pl-0">
                                        <p class="font-20 font-weight-700">
                                            6000000
                                        </p>
                                        <div class="confirm_payment">
                                            <p class="mb-0">
                                                -15,000 {{ __('translation.won') }}
                                            </p>
                                            <p class="mb-0">
                                                0 {{ __('translation.won') }}
                                            </p>
                                            <p>
                                                0 {{ __('translation.won') }}
                                            </p>
                                        </div>
                                        <p class="text-danger">-15,000 {{ __('translation.won') }}</p>

                                        <p class="text-danger font-20 font-weight-700">58,5000 {{ __('translation.won') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 mb-3">
                        <div>
                            <input type="checkbox" name="" class="mr-3" />{{ __('translation.Cancellation/refund regulation has been confirmed') }}.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex  align-content-center justify-content-center mt-3">
                                <a href="{{ route('shopping_bag') }}" class="btn btn-theme-delete mx-2"><span class="mr-2">{{ __('translation.Back/Cancel') }}</span> <i class="fa fa-angle-right"></i> </a>

                                <a href="{{ route('order') }}" class="btn btn-theme-black text-white mx-2 btn-padding"><span class="mr-2">{{ __('translation.Pay') }}</span> <i class="fa fa-angle-right"></i> </a>
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

    $('.select_payment_method').height($('.payment_info').height());
</script>
@endsection

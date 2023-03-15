<div class="shopping-bag-info">
    <h5 class="shopping-bag-text">{{ __('translation.Shopping Bag Product Info') }} ({{ $cart->count() }})</h5>
</div>
<div class="w-100">
    <table class="table shopping-table">
        <thead>
            <tr>
                {{-- <td></td> --}}
                <td class="text-center" style="width: 57%;">{{ __('translation.Course Name') }}</td>
                <td>{{ __('translation.Quantity') }}</td>
                <td>{{ __('translation.Discount') }}</td>
                <td>{{ __('translation.Price') }}</td>

            </tr>
        </thead>
        <tbody>
            @if(count($cart) > 0)
            @foreach ($cart as $v)
            <tr>
                {{-- <td> <input type="checkbox" class="checkbox select_delete" onclick="select_delete_action($(this))" value="{{ encrypt($v) }}" /> </td> --}}
                <td>
                    <span>[{{ ($v['type'] == 'online') ? Str::ucfirst($v['course']->course_type) : 'Offline' }} {{ __('translation.Course') }}] {{ $v['course_name'] }} </span> <br />
                    <span>{{ $v['course']->getCategoryName->name }} | {{ $v['course']->getTutorName->name }}</span>
                </td>
                <td>{{ $v['quantity'] }}</td>
                <td>{{ ($v['course']->discounted_prize > 0) ? '' . number_format($v['course']->discounted_prize).'원' : 'Unavailable' }}</td>
                <td>
                    @if ($v['course']->discounted_prize > 0)
                        <span class="discounted_Price">{{ number_format($v['price']) }}원</span> <br />
                        @php
                        $discouted_prize = ($v['price']) - ($v['course']->discounted_prize)
                        @endphp
                        <span>{{ number_format($discouted_prize) }}원</span>
                    @else
                        <span>{{ number_format($v['price']) }}원</span>
                    @endif
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="5" class="text-center"> 
                    <img src="{{ asset('web_assets/images/no-data-found.png') }}" alt="img" class="img-fluid" style="height: 250px;"> 
                </td> 
            </tr>
            @endif
            <tr>
                <td colspan="5">
                    <div class="text-right total_payment">
                        <p class="mb-0 text-muted">{{ __('translation.Total payment') }}</p>
                        <span class="font-20 font-weight-700">{{ number_format($cart->sum('price')) }}원</span>
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
                <form id="payment_method_form">
                    @csrf
                    <div class="mr-3 payment_method_card mb-1 mb-md-0">
                        <input type="radio" name="payment_method" class="payment-method-radio" value="card" checked> <span>{{ __('translation.Card') }}</span>
                    </div>
                    <div class="mr-3 w-100 mb-1 mb-md-0">
                        <input type="radio" name="payment_method" class="payment-method-radio" value="real_time_acc_transfer"> {{ __('translation.Real-time account transfer') }}
                    </div>
                    <div class="mr-3 payment_method_deposit mb-1 mb-md-0">
                        <input type="radio" name="payment_method" class="payment-method-radio" value="deposit"> {{ __('translation.Make a deposit') }}
                    </div>
                    <div class="mr-3 payment_method_mobile mb-1 mb-md-0">
                        <input type="radio" name="payment_method" class="payment-method-radio" value="mobile_phone_transfer"> {{ __('translation.Mobile phone transfer') }}
                    </div>
                </form>
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
                        {{ number_format($cart->sum('price')) }}{{ __('translation.won') }}
                    </p>
                    <div class="confirm_payment">
                        <p class="mb-0">
                            -{{ number_format($cart->sum('discount')) }} {{ __('translation.won') }}
                        </p>
                        <p class="mb-0">
                            0 {{ __('translation.won') }}
                        </p>
                        <p>
                            0 {{ __('translation.won') }}
                        </p>
                    </div>
                    <p class="text-danger">-{{ number_format($cart->sum('discount')) }} {{ __('translation.won') }}</p>

                    @php
                        $total = ($cart->sum('price')) - ($cart->sum('discount'))
                    @endphp
                    <p class="text-danger font-20 font-weight-700">{{ number_format($total) }}{{ __('translation.won') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
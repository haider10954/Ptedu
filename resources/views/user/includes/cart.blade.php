<div class="shopping-bag-info">
    <h5 class="shopping-bag-text">{{ __('translation.Shopping Bag Product Info') }} ({{ $cart->count() }})</h5>
</div>
<div class="table-responsive">
    <table class="table shopping-table">
        <thead>
            <tr>
                <td style="min-width: 30px"></td>
                <td class="text-center" style="min-width: 200px;">{{ __('translation.Course Name') }}</td>
                <td style="min-width: 60px">{{ __('translation.Quantity') }}</td>
                <td style="min-width: 100px">{{ __('translation.Discount') }}</td>
                <td style="min-width: 100px">{{ __('translation.Price') }}</td>
                <td style="min-width: 150px">{{ __('translation.Buy') }}/{{ __('translation.Delete') }}</td>
            </tr>
        </thead>
        <tbody>
            @if(count($cart) > 0)
            @foreach ($cart as $v)
            <tr>
                <td>
                    <input type="checkbox" class="checkbox select_item" {{ $v['item_selected'] == true ? 'checked' : '' }} onchange="changeAmount(this)" data-id="{{ encrypt($v) }}" data-amount="{{$v['price']}}" data-disc="{{$v['discount']}}" />
                </td>
                <td>
                    <span>[{{ ($v['type'] == 'online') ? Str::ucfirst($v['course']->course_type) : 'Offline' }} {{ __('translation.Course') }}] {{ $v['course_name'] }} </span> <br />
                    <span>{{ $v['course']->getCategoryName->name }} | {{ $v['course']->getTutorName->name }}</span> <br />
                    <span>{{ $v['course_schedule'] }}</span>
                </td>
                <td>{{ $v['quantity'] }}</td>
                <td>{{ ($v['course']->discounted_prize > 0) ? number_format($v['course']->discounted_prize) .'원' : '0원' }}</td>
                <td>
                    @if ($v['course']->discounted_prize > 0)
                        <span class="discounted_Price">{{ number_format($v['price']) }}원</span> <br />
                        @php
                        $discounted_prize = ($v['price']) - ($v['course']->discounted_prize)
                        @endphp
                        <span>{{ number_format($discounted_prize)  }}원</span>
                    @else
                        <span>{{ number_format($v['price']) }}원</span>
                    @endif
                </td>
                <td>
                    <div class="d-flex flex-column">
                        <button class="btn rounded-0 btn-theme-black text-white" data-course="{{ encrypt($v['course_id']) }}" data-type="{{ encrypt($v['type']) }}" onclick="delCartItem($(this))">{{__('translation.delete')}}</button>
                    </div>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="8" class="text-center">
                    <img src="{{ asset('web_assets/images/no-data-found.png') }}" alt="img" class="img-fluid" style="height: 250px;">
                </td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
<div class="mt-3">
    <div class="cart-total">
        <div class="row align-items-center">
            <div class="col-md-3  h-110 border_right">
                <div class="cart-total-price  text-center position-relative">
                    <h5 class="font-weight-700">{{ __('translation.Total') }}</h5>
                    <p class="price mb-0" id="item_price">{{ number_format($cart->where('item_selected',true)->sum('price')) }}원</p>
                    <div class="icons">
                        <i class="fa fa-minus"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 h-110 border_right">
                <div class="cart-total-price  text-center position-relative">
                    <h5 class="font-weight-700">{{ __('translation.Discount') }}</h5>
                    <p class="price mb-0 text-danger" id="item_discount">{{ number_format($cart->where('item_selected',true)->sum('discount')) }}원</p>
                    <div class="icons">
                        <i class="fa fa-plus"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 h-110 border_right">
                <div class="cart-total-price  text-center position-relative  ">
                    <h5 class="font-weight-700">{{ __('translation.Delivery Fee') }}</h5>
                    <p class="price mb-0 text-danger">0원</p>
                    <div class="icons">
                        <i class="fa fa-equals"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="cart-total-price  text-center">
                    <h5 class="font-weight-700">{{ __('translation.Total estimated payment amount') }}</h5>
                    @php
                    $cart_total = ($cart->where('item_selected',true)->sum('price')) - $cart->where('item_selected',true)->sum('discount')
                    @endphp
                    <p class="total-price mb-0" id="total_amount">{{ number_format($cart_total) }}원</p>
                </div>
            </div>
        </div>
    </div>
    <div class="mobile-icons">
        <div class="row">
            <div class="col-12">
                <div class="position">
                    <div class="p-5 text-center" style="border-bottom: 1px black solid;">
                        <h5 class="font-weight-700">{{ __('translation.Total') }}</h5>
                        <p class="price mb-0">{{ $cart->sum('price') }}원</p>
                    </div>
                    <div class="mobi-icons">
                        <i class="fa fa-minus"></i>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="position">
                    <div class="p-5 text-center" style="border-bottom: 1px black solid;">
                        <h5 class="font-weight-700">{{ __('translation.Discount') }}</h5>
                        <p class="price mb-0">{{ $cart->sum('discount') }}원</p>
                    </div>
                    <div class="mobi-icons">
                        <i class="fa fa-equals"></i>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="position">
                    <div class="p-5 text-center" style="border-bottom: 1px black solid;">
                        <h5 class="font-weight-700">{{ __('translation.Delivery Fee') }}</h5>
                        <p class="price mb-0">0원</p>
                    </div>
                    <div class="mobi-icons">
                        <i class="fa fa-plus"></i>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="position">
                    <div class="p-5 text-center" style="border-bottom: 1px black solid;">
                        <h5 class="font-weight-700">{{ __('translation.Total estimated payment amount') }}</h5>
                        <p class="price mb-0">{{ ($cart->sum('price')) - $cart->sum('discount') }}원</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@extends('user.layout')

@section('title', 'PTEdu - Shopping Bag')

@section('content')
    <div class="section pt-125">
        <div class="container">
            <div class="row">

                <div class="col-lg-2 padding-left">
                    <div class="page-sidemenu-heading mb-3">
                        <h5 class="mb-0 font-weight-600">{{ __('translation.Shopping Bag') }}</h5>
                        <a href="javscript:void(0)"
                           class="btn btn-dark btn-custom-sm btn-theme-black page-side-menu-toggle">menu</a>
                    </div>
                    <div class="page-side-menu">
                        <ul class="menu">
                            <li><a href="{{ route('my_classroom') }}">{{ __('translation.My Classroom') }}</a></li>
                            <li><a href="{{ route('shopping_bag') }}">{{ __('translation.Shopping Bag') }}</a></li>
                            <li><a href="{{ route('user_info') }}">{{ __('translation.Modifying Member Info') }}</a>
                            </li>
                            <li><a href="{{ route('user_inquiry') }}">{{ __('translation.Inquiry') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="section-heading mb-3">
                        <h5 class="mb-0">{{ __('translation.Shopping Bag') }}</h5>
                    </div>
                    <div class="mt-3 mb-3 select_delete_btn_box" style="display: none">
                        <button class="btn rounded-0 btn-theme-delete select_delete_btn"><i
                                class="fa fa-times"></i><span class="ml-2">{{ __('translation.Select Delete') }}</span>
                        </button>
                    </div>
                    <div class="mt-3">
                        <div class="shopping-cart-view">
                            @include('user.includes.cart')
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex  align-content-center justify-content-center mt-3">
                                    <a href="{{ route('web-home') }}" class="btn btn-theme-delete mx-2"><span
                                            class="mr-2">{{ __('translation.View other courses') }}</span> <i
                                            class="fa fa-angle-right"></i> </a>

                                    @if(count($cart) > 0)
                                        @php
                                        $cart_total = ($cart->where('item_selected',true)->sum('price')) - $cart->where('item_selected',true)->sum('discount')
                                        @endphp

                                        @if($cart_total > 0)
                                        <a href="{{ route('order') }}" class="btn btn-theme-black text-white mx-2"><span
                                                class="mr-2">{{ __('translation.Buy it Now') }}</span> <i
                                                class="fa fa-angle-right"></i> </a>
                                        @else
                                        <a href="{{ route('proceed_enrolment') }}" class="btn btn-theme-black text-white mx-2"><span
                                            class="mr-2">{{ __('translation.Proceed Enrolment') }}</span> <i
                                            class="fa fa-angle-right"></i> </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modals')
    <div class="modal fade review_modal" id="delModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-custom" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center" id="exampleModalLabel"><i
                            class="fas fa-exclamation text-dark"></i>
                        <span>{{ __('translation.Confirm Delete') }}</span>
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="prompt"></div>
                    <p>{{ __('translation.Are you sure to delete ?')}}</p>
                    <div class="d-flex align-items-center justify-content-end">
                        <button type="submit" id="submitForm"
                                class="btn btn-primary mr-2 rounded-0 btn-theme-black">{{ __('translation.Delete') }}</button>
                        <button type="button" class="btn btn-secondary rounded-0"
                                data-dismiss="modal">{{ __('translation.Close') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script>
        $('.page-side-menu-toggle').on('click', function () {
            $('.page-side-menu').slideToggle();
        });

        function delCartItem($btn) {
            var btn = $btn;
            $.ajax({
                type: "POST",
                url: "{{ route('del_cart_item') }}",
                dataType: 'json',
                data: {
                    'course_id': btn.data('course'),
                    'type': btn.data('type'),
                    '_token': '{{ csrf_token() }}'
                },
                beforeSend: function () {
                    btn.prop('disabled', true);
                    btn.html('<i class="fa fa-spinner fa-spin me-1"></i>');
                },
                success: function (res) {
                    if (res.Success == true) {
                        $('.shopping-cart-view').html(res.html);
                        $('.shopping_cart_count').attr('data-items-count', res.cart_items_count);
                        $('.shopping_cart_count').html(res.cart_items_count);
                    } else {
                        btn.prop('disabled', false);
                        btn.html('다시 시도하십시오');
                    }
                },
                error: function (e) {
                }
            });
        }

        $('.select_delete_btn').on('click', function () {
            var btn = $(this);
            let $values = [];
            $('.select_delete').each(function () {
                if ($(this).prop('checked') == true) {
                    $values.push($(this).val());
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('del_cart_items') }}",
                dataType: 'json',
                data: {
                    'courses': $values,
                    '_token': '{{ csrf_token() }}'
                },
                beforeSend: function () {
                    btn.prop('disabled', true);
                    btn.html('<i class="fa fa-spinner fa-spin me-1"></i>');
                },
                success: function (res) {
                    if (res.Success == true) {
                        $('.shopping-cart-view').html(res.html);
                        $('.shopping_cart_count').attr('data-items-count', res.cart_items_count);
                        $('.shopping_cart_count').html(res.cart_items_count);
                        btn.parent('.select_delete_btn_box').fadeOut();
                        btn.prop('disabled', false);
                        btn.html('<i class="fa fa-times"></i><span class="ml-2">삭제를 선택합니다</span>');
                    } else {
                        btn.prop('disabled', false);
                        btn.html('<i class="fa fa-times"></i><span class="ml-2">다시 시도하십시오</span>');
                    }
                },
                error: function (e) {
                }
            });
        });

        function changeAmount(checkbox) {
            let totalAmount = 0;
            let totalDiscount = 0;

            $('.select_item:checked').each(function () {
                let amount = parseFloat($(this).attr('data-amount'));
                let disc = parseFloat($(this).attr('data-disc'));
                totalAmount += amount;
                totalDiscount += disc;
            });
            $('#cart-loader').show();
            let course = checkbox.getAttribute('data-id');
            $.ajax({
                type: "POST",
                url: "{{ route('check_cart_items') }}",
                dataType: 'json',
                data: {
                    'id': course,
                    'state':checkbox.checked,
                    '_token': '{{ csrf_token() }}'
                },
                beforeSend: function () {
                    // LOADER
                    $('#cart-loader').show();
                },
                success: function (res) {
                    if (res.success === true) {
                        $('#total_amount').text(numberWithCommas(totalAmount - totalDiscount) + '원');
                        $('#item_price').text(numberWithCommas(totalAmount) + '원')
                        $('#item_discount').text(numberWithCommas(totalDiscount) + '원');
                    } else {}
                },
                error: function (e) {},
                complete: function () {
                    $('#cart-loader').hide();
                }
            });
        }

        function numberWithCommas(amount) {
            return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

    </script>
@endsection

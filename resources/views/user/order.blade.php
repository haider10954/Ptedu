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
                {{-- <div class="mt-3 mb-3">
                    <button class="btn rounded-0 btn-theme-delete"><i class="fa fa-times"></i><span class="ml-2">{{ __('translation.Delete') }}</span></button>
                </div> --}}
                <div class="order_cart_view mt-3">
                    @include('user.includes.order')
                </div>
                <div class="mt-3 mb-3">
                    <div>
                        <input type="checkbox" id="terms_check" class="mr-2" />{{ __('translation.Cancellation/refund regulation has been confirmed') }}.
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="prompt">
                            {{-- <div class="alert alert-success">Order completed successfully , you're enrolled in these courses</div> --}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex  align-content-center justify-content-center mt-3">
                            <a href="{{ route('shopping_bag') }}" class="btn btn-theme-delete mx-2"><span class="mr-2">{{ __('translation.Back/Cancel') }}</span> <i class="fa fa-angle-right"></i> </a>

                            <button class="btn btn-theme-black text-white mx-2 btn-padding checkout_btn" disabled="true"><span class="mr-2">{{ __('translation.Pay') }}</span> <i class="fa fa-angle-right"></i> </button>
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

    $('#terms_check').on('change',function(){
        if($(this).prop('checked') == true){
            $('.checkout_btn').prop('disabled',false);
        }else{
            $('.checkout_btn').prop('disabled',true);
        }
    });

    $('.checkout_btn').on('click',function(){
        var btn = $(this);
        $.ajax({
            type: "POST",
            url: "{{ route('proceed_checkout') }}",
            dataType: 'json',
            data: $('#payment_method_form').serialize(),
            beforeSend: function() {
                btn.prop('disabled', true);
                btn.html('<i class="fa fa-spinner fa-spin me-1"></i> Processing');
            },
            success: function(res) {
                if (res.Success == true) {
                    $('.prompt').html(`<div class="alert alert-success">${res.Message}</div>`);
                    setTimeout(() => {
                        window.location.href = "{{ route('my_classroom') }}";
                    }, 1500);
                } else {
                    $('.prompt').html(`<div class="alert alert-danger">${res.Message}</div>`);
                    // setTimeout(() => {
                    //     window.location.href = "{{ route('order') }}";
                    // }, 1500);
                }
            },
            error: function(e) {}
        });
    });
</script>
@endsection

@extends('user.layout')

@section('title', 'PTEdu - Orders')

@section('custom-style')
<style>
    .payment_method_card{
        width: auto;
        margin-bottom: 15px !important;
        margin-right: 25px !important;
    }
</style>
@endsection

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

                            {{-- <button class="btn btn-theme-black text-white mx-2 btn-padding checkout_btn" disabled="true"><span class="mr-2">{{ __('translation.Pay') }}</span> <i class="fa fa-angle-right"></i> </button> --}}

                            <a href="javascript:void(0)" onclick="jsf__pay(document.order_info)" class="btn btn-theme-black text-white mx-2 btn-padding">
                                <span class="mr-2">{{ __('translation.Pay') }}</span> <i class="fa fa-angle-right"></i> 
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
{{-- kcp payment scripts --}}
<script type="text/javascript" src="https://pay.kcp.co.kr/plugin/payplus_web.jsp"></script>
<script type="text/javascript">
        
    /* 표준웹 실행 */
    function jsf__pay( form )
    {
        try
        {
            KCP_Pay_Execute( form ); 
        }
        catch (e)
        {
            /* IE 에서 결제 정상종료시 throw로 스크립트 종료 */ 
        }
    }             
</script>
<script type="text/javascript">
    /****************************************************************/
    /* m_Completepayment  explanation                                      */
    /****************************************************************/
    /* Recursive function upon completion of authentication                                         */
    /* The function name should never be changed.                        */
    /* The location of the function must be declared before payplus.js.    */
    /* Web method, the return value is form come over                   */
    /****************************************************************/
    function m_Completepayment( FormOrJson, closeEvent ) 
    {
        var frm = document.order_info; 
     
        /********************************************************************/
        /* FormOrJsonArbitrary use of silver affiliates is prohibited                               */
        /* frm in value FormOrJson The value is set, you need to use it as the frm value.  */
        /* FormOrJson To use the value to the technical support team Please contact us.       */
        /********************************************************************/
        GetField( frm, FormOrJson ); 

        
        if( frm.res_cd.value == "0000" )
        {
            alert("Before payment authorization request,\n\nAfter the customer completes payment verification in the payment window\n\nreturned ordr_chk and company order information\n\nAfter verifying again, please request payment approval."); //Required checklist when linking with a company.
            /*
                                 Merchant return value processing area
            */
         
            frm.submit(); 
        }
        else
        {
            alert( "[" + frm.res_cd.value + "] " + frm.res_msg.value );
            
            closeEvent();
        }
    }
</script>
{{-- kcp payment end --}}
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
                btn.html('<i class="fa fa-spinner fa-spin me-1"></i> 처리');
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
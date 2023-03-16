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
<script type="text/javascript" src="https://testpay.kcp.co.kr/plugin/payplus_web.jsp"></script>
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
    /* m_Completepayment  설명                                      */
    /****************************************************************/
    /* 인증완료시 재귀 함수                                         */
    /* 해당 함수명은 절대 변경하면 안됩니다.                        */
    /* 해당 함수의 위치는 payplus.js 보다먼저 선언되어여 합니다.    */
    /* Web 방식의 경우 리턴 값이 form 으로 넘어옴                   */
    /****************************************************************/
    function m_Completepayment( FormOrJson, closeEvent ) 
    {
        var frm = document.order_info; 
     
        /********************************************************************/
        /* FormOrJson은 가맹점 임의 활용 금지                               */
        /* frm 값에 FormOrJson 값이 설정 됨 frm 값으로 활용 하셔야 됩니다.  */
        /* FormOrJson 값을 활용 하시려면 기술지원팀으로 문의바랍니다.       */
        /********************************************************************/
        GetField( frm, FormOrJson ); 

        
        if( frm.res_cd.value == "0000" )
        {
            alert("결제 승인 요청 전,\n\n반드시 결제창에서 고객님이 결제 인증 완료 후\n\n리턴 받은 ordr_chk 와 업체 측 주문정보를\n\n다시 한번 검증 후 결제 승인 요청하시기 바랍니다."); //업체 연동 시 필수 확인 사항.
            /*
                                 가맹점 리턴값 처리 영역
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
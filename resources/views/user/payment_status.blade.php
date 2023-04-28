@extends('user.layout')

@section('title', 'PTEdu - Payment Status')

@section('custom-style')
<style>
    .card{
        border: none;
        box-shadow: 0px 0px 10px #f2f2f2;
    }
</style>
@endsection

@section('content')
<div class="section pt-125">
    <div class="container-fluid">
        <div class="row justify-content-center pt-100">
            <div class="col-lg-6 col-md-8 col-12">
                <div class="card">
                    <div class="card-body text-center">
                        @if(\Session::has('status'))
                            @if(\Session::get('status') == true)
                                <img src="{{ asset('web_assets/images/checked.png') }}" height="100" class="mb-4" alt="Done">
                                <h5>Order Completed Successfully</h5>  
                                <p class="mb-0">Order completed successfully, please wait redirecting you to your dashboard ...</p>
                            @else
                                <img src="{{ asset('web_assets/images/remove.png') }}" height="100" class="mb-4" alt="Done">
                                <h5>Error while completing order</h5>  
                                <p class="mb-0">Error while completing order, please wait redirecting you to your dashboard ...</p>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
<script>
    $(document).ready(function(){
        setTimeout(() => {
            window.location.href = "{{ route('my_classroom') }}";
        }, 3000);
    });
</script>
@endsection
@extends('user.layout')

@section('title' , 'PTEdu | Login')

@section('content')
<div class="section pt-150">
    <div class="container">
        <div class="m-auto form-wrapper">
            <h3 class=" heading-h3 mb-4 text-center">Login</h3>
            <form>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Enter Email Address" />
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Enter Password" />
                </div>

                <div class="mb-3">
                    <a href="{{ route('my_classroom') }}" class="btn btn-login">Login</a>
                </div>

                <div class="d-flex align-items-center justify-content-between p-3 mt-0 mb-2" style="border-bottom: 1px solid #191B1D;">
                    <div>
                        <a href="{{ route('user_register') }}" class="text-dark text-decoration-none">Register</a>
                    </div>

                    <div>
                        <a href="{{ route('find_id') }}" class="text-dark text-decoration-none">Find ID</a>
                    </div>

                    <div>
                        <a href="{{ route('find_password') }}" class="text-dark text-decoration-none">Find PW</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

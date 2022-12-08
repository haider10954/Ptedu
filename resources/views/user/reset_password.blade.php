@extends('user.layout')

@section('title' , 'PTEdu | Reset Password')

@section('content')
<div class="section pt-150">
    <div class="container">
        <div class="m-auto form-wrapper">
            <h3 class=" heading-h3 mb-3 text-center">Reset my PW</h3>
            <p class="text-center">Please reset your Password</p>
            <form>
                <div class="form-group">
                    <label class="form-label">New Password</label>
                    <input type="text" class="form-control" placeholder="Enter new password" />
                </div>

                <div class="form-group">
                    <label class="form-label">Confirm Password</label>
                    <input type="text" class="form-control" placeholder="Confirm Password" />
                </div>
                <div class="mb-3">
                    <a href="javascript:void()" class="btn btn-login">Reset my Password</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

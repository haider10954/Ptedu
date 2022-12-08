@extends('user.layout')

@section('title' , 'PTEdu | Find Password')

@section('content')
<div class="section pt-150">
    <div class="container">
        <div class="m-auto form-wrapper">
            <h3 class=" heading-h3 mb-4 text-center">Find PW</h3>
            <form>
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" placeholder="Enter your Name" />
                </div>

                <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input type="text" class="form-control" placeholder="Enter your Phone Number" />
                </div>

                <div class="form-group">
                    <label class="form-label">Your ID</label>
                    <input type="text" class="form-control" placeholder="Enter Your ID" />
                </div>

                <div class="mb-3">
                    <a href="{{ route('reset_password') }}" class="btn btn-login">Find my PW</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

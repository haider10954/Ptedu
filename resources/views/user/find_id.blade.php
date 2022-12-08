@extends('user.layout')

@section('title' , 'PTEdu | find ID')

@section('content')
<div class="section pt-150">
    <div class="container">
        <div class="m-auto form-wrapper">
            <h3 class=" heading-h3 mb-4 text-center">Find ID</h3>
            <form>
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <input type="email" class="form-control" placeholder="Enter your Name" name="name" />
                </div>

                <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input type="password" class="form-control" placeholder="Enter Phone Number" name="phone_number" />
                </div>

                <div class="mb-3">
                    <a href="{{ route('my_classroom') }}" class="btn btn-login">Find my ID</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

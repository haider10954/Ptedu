@extends('user.layout')

@section('title' , 'PTEdu | Login')

@section('content')
<div class="section pt-150">
    <div class="container">
        <div class="m-auto form-wrapper">
            <h3 class=" heading-h3 mb-4 text-center">Login</h3>
            <div class="prompt"></div>
            <form type="POST" id="loginForm">
                @csrf
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Enter Email Address" name="email" />
                    <div class="error-email"></div>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Enter Password" name="password" />
                    <div class="error-password"></div>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-login">Login</a>
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

@section('custom-script')
<script>
    $("#loginForm").on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData($("#loginForm")[0]);
        formData = new FormData($("#loginForm")[0]);
        $.ajax({
            type: "POST",
            url: "{{ route('student_login') }}",
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            data: formData,
            beforeSend: function() {
                $("#submitForm").prop('disabled', true);
                $("#submitForm").html('<i class="fa fa-spinner fa-spin me-1"></i> Processing');
            },
            success: function(res) {
                if (res.success) {
                    $('.prompt').html('<div class="alert alert-success mb-3">' + res.message + '</div>');

                    setTimeout(function() {
                        $('.prompt').hide()
                        window.location.href = "{{ route('my_classroom') }}";
                    }, 2000);

                } else {}
            },
            error: function(e) {
                $("#submitForm").prop('disabled', false);
                $("#submitForm").html('Login');
                if (e.responseJSON.errors['email']) {
                    $('.error-email').html('<small class=" error-message text-danger">' + e.responseJSON.errors['email'][0] + '</small>');
                }
                if (e.responseJSON.errors['password']) {
                    $('.error-password').html('<small class=" error-message text-danger">' + e.responseJSON.errors['password'][0] + '</small>');
                }
            }

        });
    });
</script>
@endsection
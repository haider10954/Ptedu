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
                    <input type="text" class="form-control" placeholder="아이디를 입력해주세요" name="email" />
                    <div class="error-email"></div>
                </div>

                <div class="form-group position-relative">
                    <input type="password" class="form-control" placeholder="{{ __('translation.Enter Password') }}" name="password" id="password" />
                    <i class="fa fa-eye password-icon" id="togglePassword"></i>
                    <div class="error-password"></div>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-login">{{ __('translation.Login') }}</a>
                </div>

                <div class="d-flex align-items-center justify-content-between p-3 mt-0 mb-2" style="border-bottom: 1px solid #191B1D;">
                    <div>
                        <a href="{{ route('user_register') }}" class="text-dark text-decoration-none">{{ __('translation.Register') }}</a>
                    </div>

                    <div>
                        <a href="{{ route('find_id') }}" class="text-dark text-decoration-none">{{ __('translation.Find ID') }}</a>
                    </div>

                    <div>
                        <a href="{{ route('find_password') }}" class="text-dark text-decoration-none">{{ __('translation.Find PW') }}</a>
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
                if (res.error == false) {

                    $('.prompt').show();
                    $('.prompt').html('<div class="alert alert-success mb-3">' + res.message + '</div>');

                    setTimeout(function() {
                        $('.prompt').hide()
                        window.location.href = "{{ route('my_classroom') }}";
                    }, 2000);

                } else {

                    $('.prompt').show();
                    $('.prompt').html('<div class="alert alert-danger mb-3">' + res.message + '</div>');

                    setTimeout(function() {
                        $('.prompt').hide()
                    }, 2000);

                }
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

    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function(e) {
        // toggle the type attribute
        let type;
        if (password.getAttribute('type') === 'password') {
            type = 'text';
            password.setAttribute('type', type);
            this.classList.add('fa-eye-slash');
            this.classList.remove("fa-eye");
        } else {
            type = 'password';
            password.setAttribute('type', type);
            this.classList.add("fa-eye");
            this.classList.remove('fa-eye-slash');
        }
    });
</script>
@endsection
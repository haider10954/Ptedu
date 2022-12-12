@extends('user.layout')

@section('title' , 'PTEdu | Reset Password')

@section('content')
<div class="section pt-150">
    <div class="container">
        <div class="m-auto form-wrapper">
            <h3 class=" heading-h3 mb-3 text-center">Reset my PW</h3>
            <p class="text-center">Please reset your Password</p>
            <form type="POST" id="resetPassword">
                <div class="prompt"></div>
                @csrf
                <div class="form-group">
                    <label class="form-label">New Password</label>
                    <input type="text" class="form-control" placeholder="Enter new password" name="password" />
                    <div class="error-password"></div>
                </div>

                <div class="form-group">
                    <label class="form-label">Confirm Password</label>
                    <input type="text" class="form-control" placeholder="Confirm Password" name="confirm_password" />
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-login">Reset my Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
<script>
    $("#resetPassword").on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData($("#resetPassword")[0]);
        formData = new FormData($("#resetPassword")[0]);
        $.ajax({
            type: "POST",
            url: "{{ route('reset-password') }}",
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
                        window.location.href = "{{ route('user_login') }}";
                    }, 2000);

                } else {
                    $('.prompt').html('<div class="alert alert-danger mb-3">' + res.message + '</div>');

                    setTimeout(function() {
                        $('.prompt').hide()
                    }, 2000);

                }
            },
            error: function(e) {
                $("#submitForm").prop('disabled', false);
                $("#submitForm").html('Finf my PW');
                if (e.responseJSON.errors['password']) {
                    $('.error-password').html('<small class=" error-message text-danger">' + e.responseJSON.errors['password'][0] + '</small>');
                }
            }

        });
    });
</script>

@endsection
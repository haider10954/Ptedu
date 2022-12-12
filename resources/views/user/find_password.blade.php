@extends('user.layout')

@section('title' , 'PTEdu | Find Password')

@section('content')
<div class="section pt-150">
    <div class="container">
        <div class="m-auto form-wrapper">
            <h3 class=" heading-h3 mb-4 text-center">Find PW</h3>
            <div class="prompt"></div>
            <form type="POST" id="findPassword">
                @csrf
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" placeholder="Enter your Name" name="name" />
                    <div class="error-name"></div>
                </div>

                <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input type="text" class="form-control" placeholder="Enter your Phone Number" name="mobile_number" />
                    <div class="error-mobile-number"></div>
                </div>

                <div class="form-group">
                    <label class="form-label">Your ID</label>
                    <input type="text" class="form-control" placeholder="Enter Your ID" name="user_id" />
                    <div class="error-user-id"></div>
                </div>

                <div class="mb-3">
                    <button type="submit" id="submitForm" class="btn btn-login">Find my PW</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('custom-script')
<script>
    $("#findPassword").on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData($("#findPassword")[0]);
        formData = new FormData($("#findPassword")[0]);
        $.ajax({
            type: "POST",
            url: "{{ route('find-password') }}",
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
                        window.location.href = "{{ route('reset_password') }}";
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
                if (e.responseJSON.errors['name']) {
                    $('.error-name').html('<small class=" error-message text-danger">' + e.responseJSON.errors['name'][0] + '</small>');
                }
                if (e.responseJSON.errors['mobile_number']) {
                    $('.error-mobile-number').html('<small class=" error-message text-danger">' + e.responseJSON.errors['mobile_number'][0] + '</small>');
                }
                if (e.responseJSON.errors['user_id']) {
                    $('.error-user-id').html('<small class=" error-message text-danger">' + e.responseJSON.errors['user_id'][0] + '</small>');
                }
            }

        });
    });
</script>

@endsection
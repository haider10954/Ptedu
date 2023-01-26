@extends('user.layout')

@section('title' , 'PTEdu | find ID')

@section('content')
<div class="section pt-150">
    <div class="container">
        <div class="m-auto form-wrapper">
            <h3 class=" heading-h3 mb-4 text-center">{{ __('translation.Find ID') }}</h3>
            <div class="prompt"></div>
            <form type="POST" id="findIdForm">
                @csrf
                <div class="form-group">
                    <label class="form-label">{{ __('translation.Name') }}</label>
                    <input type="text" class="form-control" placeholder="{{ __('translation.Enter your Name') }}" name="name" value="{{ old('name') }}" />
                    <div class="error-name"></div>
                </div>

                <div class="form-group">
                    <label class="form-label">{{ __('translation.Phone Number') }}</label>
                    <input type="text" class="form-control" placeholder="{{ __('translation.Enter Phone Number') }}" name="phone_number" value="{{ old('phone_number') }}" />
                    <div class="error-mobile"></div>
                </div>
                <div id="user_id"></div>
                <div class="mb-3">
                    <div class="btnToggle">
                        <button type="submit" id="submitForm" class="btn btn-login">{{ __('translation.Find my ID') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
<script>
    $("#findIdForm").on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData($("#findIdForm")[0]);
        formData = new FormData($("#findIdForm")[0]);
        $.ajax({
            type: "POST",
            url: "{{ route('find-id') }}",
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
                    $('#user_id').append(' <div class="form-group"><label class="form-label">User ID</label><input type="text" class="form-control" value=' + res.user_id + ' name="phone_number" /><div class="error-mobile"></div></div>')
                    $(".btnToggle").html("<a class='text-white text-decoration-none btn btn-login' href='{{ route('user_login') }}'>Login</a>");
                    $("#submitForm").prop('disabled', false);
                    setTimeout(function() {
                        $('.prompt').hide()
                    }, 2000);
                    $('.error-name').html('');
                    $('.error-mobile').html('');

                } else {
                    $('.prompt').html('<div class="alert alert-danger mb-3">' + res.message + '</div>');

                    setTimeout(function() {
                        $('.prompt').hide()
                    }, 2000);
                    $("#submitForm").html('Find my ID');
                    $("#submitForm").prop('disabled', false);
                }
            },
            error: function(e) {
                $("#submitForm").prop('disabled', false);
                $("#submitForm").html('Finf my ID');
                if (e.responseJSON.errors['name']) {
                    $('.error-name').html('<small class=" error-message text-danger">' + e.responseJSON.errors['name'][0] + '</small>');
                }
                if (e.responseJSON.errors['phone_number']) {
                    $('.error-mobile').html('<small class=" error-message text-danger">' + e.responseJSON.errors['phone_number'][0] + '</small>');
                }
            }

        });
    });
</script>

@endsection
@extends('admin.layout.layout')

@section('title' , 'Student Information')

@section('custom-style')
<style>
    .hr-color {
        border: 1px solid #C4C4C4;
    }

    .btn-register {
        width: 103px;
        height: 37px;

        background: #F0F0F0;
        border: 1.43489px solid #DFE0EB;
        border-radius: 2.86978px;
        color: #6F6F6F;
        font-weight: 400;
        font-size: 14px;
    }

    .course-image-preview {
        width: 150px;
        height: 150px;
        background: #FFFFFF;
        /* grayscale / divider */
        border: 1px solid #DFE0EB;
        border-radius: 2px;
        display: flex;
        justify-content: center;
        align-items: center;

    }

    .course-image-preview img {
        width: 20px;
        height: 20px;
    }

    .btn-upload {
        background: #F0F0F0;
        border: 1px solid #DFE0EB;
        border-radius: 2px;
        color: #6F6F6F;
    }

    .btn-upload:hover {
        background: #F0F0F0;
        border: 1px solid #DFE0EB;
        border-radius: 2px;
        color: #6F6F6F;
    }

    .btn-add-section {
        background: #FFFFFF;
        border: 1px solid #696CFF;
        border-radius: 2px;
        font-weight: 400;
        font-size: 13px;
        line-height: 23px;
        color: #696CFF;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 4px 16px;
    }

    .btn-add-section:hover {
        background: #FFFFFF;
        border: 1px solid #696CFF;
        border-radius: 2px;
        font-weight: 400;
        font-size: 13px;
        line-height: 23px;
        color: #696CFF;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 4px 16px;
    }

    .lecture-form {
        font-weight: 400 !important;
        font-size: 14px !important;
        line-height: 23px !important;
        color: #6F6F6F !important;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0  Card_title">{{ __('translation.Student Info Detail') }}</h4>
                </div>
                <hr class="hr-color" />
            </div>
            <div class="col-12">
                <div class="prompt"></div>
                <form id="editForm">
                    @csrf
                    <input type="hidden" name="id" value="{{ $student->id}}">
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Name') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="horizontal-firstname-input" name="name" value="{{ $student->name }}">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.English Name') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="horizontal-email-input" name="en_name" value="{{ $student->english_name }}">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Email') }}</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="horizontal-password-input" name="email" value="{{ $student->email }}">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Phone Number') }}</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="horizontal-email-input" name="phone_number" value="{{ $student->mobile_number }}">
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Job') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="job" value="{{ $student->job }}">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Address') }}</label>
                        <div class="col-sm-10">
                            <textarea rows="3" type="text" class="form-control" name="address" style="resize: none;">{{ str_replace('|' ,',', $student->address) }}</textarea>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-12 d-flex justify-content-center align-content-center">
                            <button type="submadd-courseit" id="submitForm" class="btn btn-lg btn-register">{{ __('translation.Ok') }}</button>
                        </div>
                    </div>
                </form>
                <div class="row mb-4">
                    <label class="col-sm-2 col-form-label lecture-form">{{ __('translation.Affiliation') }}</label>
                    <div class="col-sm-10">
                        @if($enrolled_courses->count() > 0)
                        <div>
                            <div class="custom-badges gap-2">
                                @foreach ($enrolled_courses as $c)
                                <span class="bagde bg-success text-white rounded p-1">{{ $c->getCourses->course_title }}</span>
                                @endforeach
                            </div>
                            @else
                            <div class="text-right">{{ __('translation.NO Record Found') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
<script>
    $("#editForm").on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData($("#editForm")[0]);
        formData = new FormData($("#editForm")[0]);
        $.ajax({
            type: "POST",
            url: "{{ route('edit_student_info') }}",
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            data: formData,
            beforeSend: function() {
                $("#submitForm").prop('disabled', true);
                $("#submitForm").html('<i class="fa fa-spinner fa-spin me-1"></i>');
            },
            success: function(res) {
                $("#submitForm").attr('class', 'btn btn-success');
                $("#submitForm").html('<i class="fa fa-check me-1"></i>  학생 기록 업데이트됨</>');
                if (res.success) {
                    $('.prompt').html('<div class="alert alert-success mb-3">' + res.message + '</div>');
                    setTimeout(function() {
                        $('html, body').animate({
                            scrollTop: $("html, body").offset().top
                        }, 1000);
                    }, 1500);

                    setTimeout(function() {
                        $('.prompt').hide()
                        window.location.href = "{{ route('student') }}";
                    }, 4000);

                } else {}
            },
            error: function(e) {
                $("#submitForm").prop('disabled', false);
                $("#submitForm").html('제출하다');
                if (e.responseJSON.errors['name']) {
                    $('.error-name').html('<small class=" error-message text-danger">' + e.responseJSON.errors['name'][0] + '</small>');
                }
                if (e.responseJSON.errors['en_name']) {
                    $('.error-en-name').html('<small class=" error-message text-danger">' + e.responseJSON.errors['en_name'][0] + '</small>');
                }
                if (e.responseJSON.errors['mobile']) {
                    $('.error-mobile-number').html('<small class=" error-message text-danger">' + e.responseJSON.errors['mobile'][0] + '</small>');
                }
                if (e.responseJSON.errors['address']) {
                    $('.error-address').html('<small class=" error-message text-danger">' + e.responseJSON.errors['address'][0] + '</small>');
                }
            }

        });
    });
</script>

@endsection
@extends('admin.layout.layout')

@section('title' , 'Settings')

@section('custom-style')
<style>
    .user_avatar {
        width: 94px;
        height: 94px;
        border-radius: 50%;
    }

    .name {
        font-weight: 400;
        font-size: 18px;
        line-height: 10px;
        color: #000000;
    }

    .email {
        font-weight: 400;
        font-size: 15px;
        line-height: 10px;
        color: #9FA2B4;
    }

    .user_info {
        font-weight: 400;
        font-size: 13px;
        line-height: 15px;
        color: #000000;
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


    .btn-register:hover {
        width: 103px;
        height: 37px;

        background: #F0F0F0;
        border: 1.43489px solid #DFE0EB;
        border-radius: 2.86978px;
        color: #6F6F6F;
        font-weight: 400;
        font-size: 14px;
    }
</style>
@endsection

@section('content')
{{ auth('admin')->user()->profile_image}}
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">

                    @if(auth('admin')->user()->profile_img == null)
                    <div>
                        <img src="{{asset('assets/images/icons/user_avatar.png')}}" class="user_avatar">
                    </div>
                    @else
                    <div>
                        <img src="{{ auth('admin')->user()->getAdminProfileImage() }}" class="user_avatar">
                    </div>
                    @endif
                    <div class="ms-3">
                        <div class="mb-1"><span class="name text-capitalize">{{ auth('admin')->user()->name }}</span></div>
                        <div><span class="email"> {{ auth('admin')->user()->email }} </span></div>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="mb-3 user_info">
                        @if( auth('admin')->user()->phone_number == null )
                        {{ __('translation.Phone Number') }} : 01-000-100
                        @else
                        {{ __('translation.Phone Number') }} : {{ auth('admin')->user()->phone_number }}
                        @endif
                    </div>
                    <div class="mb-3 user_info">
                        {{ __('translation.Email') }} : {{ auth('admin')->user()->email }}
                    </div>
                    <div class="mb-3 user_info">
                        {{ __('translation.Account Created') }} : {{ \Carbon\Carbon::parse( auth('admin')->user()->created_at)->format('d M, Y') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div>
                    @if(Session::has('profile_false'))
                    <div class="alert alert-danger mb-3" id="responseMessage">{{ Session::get('profile_false') }}</div>
                    @endif

                    @if(Session::has('profile_true'))
                    <div class="alert alert-success mb-3" id="responseMessage">{{ Session::get('profile_true') }}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <h4 class="card-title">{{ __('translation.Password Settings') }}</h4>
                </div>
                <form method="POST" action="{{ route('update-password') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">{{ __('translation.Current Password') }}</label>
                        <input class="form-control" type="password" placeholder="{{ __('translation.Enter Current Password') }}" name="old_password">
                        @error('old_password')
                        <small style="color:#d02525;">{{$message}}</small>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label class="form-label">{{ __('translation.New Password') }}</label>
                        <input class="form-control" type="password" placeholder="Enter New Password" name="new_password">
                        @error('new_password')
                        <small style="color:#d02525;">{{$message}}</small>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label class="form-label">{{ __('translation.Confirm Password') }}</label>
                        <input class="form-control" type="password" placeholder="Enter New Password" name="confirm_password">
                        @error('confirm_password')
                        <small style="color:#d02525;">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-lg btn-register">{{ __('translation.Change') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div>
                    @if(Session::has('msg'))
                    <div class="alert alert-success mb-3" id="responseMessage">{{ Session::get('msg') }}</div>
                    @endif
                    @if(Session::has('error'))
                    <div class="alert alert-danger mb-3" id="responseMessage">{{ Session::get('error') }}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <h4 class="card-title">{{ __('translation.Edit Profile') }}</h4>
                </div>
                <form method="POST" action="{{ route('update-admin-profile') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">{{ __('translation.Name') }}</label>
                                <input class="form-control" type="text" placeholder="Enter Name" name="name" value="{{ auth('admin')->user()->name }}">
                                @error('name')
                                <small style="color:#d02525;">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('translation.Email') }}</label>
                                <input class="form-control" type="email" placeholder="Enter Email" name="email" value="{{ auth('admin')->user()->email }}">
                                @error('email')
                                <small style="color:#d02525;">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('translation.Job') }}</label>
                                <input class="form-control" type="text" placeholder="Enter Job" name="job" value="{{ auth('admin')->user()->job }}">
                                @error('job')
                                <small style="color:#d02525;">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">{{ __('translation.English Name') }}</label>
                                <input class="form-control" type="text" placeholder="Enter English Name" name="en_name" value="{{ auth('admin')->user()->english_name }}">
                                @error('en_name')
                                <small style="color:#d02525;">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('translation.Phone Number') }}</label>
                                <input class="form-control" type="text" placeholder="Enter phone number" name="phone_number" value="{{ auth('admin')->user()->phone_number }}">
                                @error('phone_number')
                                <small style="color:#d02525;">{{$message}}</small>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label class="form-label">{{ __('translation.Profile Image') }}</label>
                                <input class="form-control" type="file" name="image">
                                @error('image')
                                <small style="color:#d02525;">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">{{ __('translation.Address') }}</label>
                                <input class="form-control" type="text" placeholder="Enter address" name="address" value="{{ auth('admin')->user()->address }}">
                                @error('address')
                                <small style="color:#d02525;">{{$message}}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('translation.Introduction') }}</label>
                                <textarea class="form-control" type="file" rows="7" placeholder="Enter introduction" name="introduction">{{ auth('admin')->user()->introduction }}</textarea>
                                @error('introduction')
                                <small style="color:#d02525;">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-lg btn-register">{{ __('translation.Change') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom-script')
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $("#responseMessage").hide()
        }, 2000);
    });
</script>
@endsection
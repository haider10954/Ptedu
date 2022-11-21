@extends('admin.layout.layout')

@section('title' , 'Settings')

@section('custom-style')
<style>
    .user_avatar {
        width: 94px;
        height: 94px;
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

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <img src="{{ asset('assets/images/icons/user_avatar.png') }}" class="user_avatar">
                    </div>
                    <div class="ms-3">
                        <div class="mb-1"><span class="name">홍길동</span></div>
                        <div><span class="email"> sadh123@naver.com </span></div>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="mb-3 user_info">
                        Phone number : 010-000-000
                    </div>
                    <div class="mb-3 user_info">
                        Email : sadh123@naver.com:
                    </div>
                    <div class="mb-3 user_info">
                        Account Created : 2022.10.13 11:36
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <h4 class="card-title">Password Settings</h4>
                </div>
                <form>
                    <div class="mb-3">
                        <label class="form-label">Current Password</label>
                        <input class="form-control" type="password" placeholder="Enter Current Password">
                    </div>


                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input class="form-control" type="password" placeholder="Enter New Password">
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Confirm New Password</label>
                        <input class="form-control" type="password" placeholder="Enter New Password">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-lg btn-register">Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <h4 class="card-title">Edit Profile</h4>
                </div>
                <form>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input class="form-control" type="text" placeholder="Enter Name" name="name">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input class="form-control" type="email" placeholder="Enter Email" name="email">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Job</label>
                                <input class="form-control" type="text" placeholder="Enter Job" name="job">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">English Name</label>
                                <input class="form-control" type="text" placeholder="Enter English Name" name="en_name">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input class="form-control" type="email" placeholder="Enter phone number" name="phone_number">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Profile Image</label>
                                <input class="form-control" type="file" placeholder="Enter Job" name="image">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input class="form-control" type="text" placeholder="Enter address" name="address">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Introduction</label>
                                <textarea class="form-control" type="file" rows="7" placeholder="Enter address" name="introduction"></textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-lg btn-register">Change</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

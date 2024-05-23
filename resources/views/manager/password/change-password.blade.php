@extends('templates.manager.header')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Account | Change Password</h1>
                </div>
                <div class="col-sm-12 col-lg-12 col-md-12 mb-2">
                    <hr class="border-2 border-primary">
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center align-items-center py-5">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                        <form id="change_password" class="@if(!session('isOTP')) d-block @else d-none @endif" action="{{ route('manager.change-password') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="current_password">Current Password</label>
                                <input type="password" name="current_password" value="{{ old('current_password') }}" id="current_password" class="form-control @error('current_password') is-invalid @enderror">
                            </div>
                            <div class="form-group mb-3">
                                <label for="new_password">New Password</label>
                                <input type="password" name="new_password" value="{{ old('new_password') }}" id="new_password" class="form-control @error('new_password') is-invalid @enderror">
                                @error('new_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="new_password_confirmation">Confirm Password</label>
                                <input type="password" name="new_password_confirmation" value="{{ old('new_password_confirmation') }}" id="new_password_confirmation" class="form-control @error('new_password_confirmation') is-invalid @enderror">
                                @error('new_password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                            </div>
                        </form>

                        <form id="otp_password" class="@if(session('isOTP')) d-block @else d-none @endif" action="{{ route('manager.change-password-otp') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="otp_value">One Time Pin</label>
                                <input type="text" name="otp_value" value="{{ old('otp_value') }}" id="otp_value" class="form-control @error('otp_value') is-invalid @enderror">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary btn-block">Verify OTP</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member | Update Password</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container pt-5 py-5 mt-5">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card border-2">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Update Password</h2>
                        <form action="{{ route('member.update-password') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="account_name">Account Name</label>
                                <input readonly type="text" name="account_name" id="account_name" value="{{ $user->fullname }}" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="new_password">New Password</label>
                                <input type="password" name="new_password" id="new_password" class="form-control @error('new_password') is-invalid @enderror">
                                @error('new_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="new_password_confirmation">Confirm Password</label>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control @error('new_password_confirmation') is-invalid @enderror">
                                @error('new_password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary w-100">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ 'js/bootstrap.bundle.min.js' }}"></script>
</body>

</html>

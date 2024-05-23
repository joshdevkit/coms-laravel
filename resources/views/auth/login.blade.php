<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Construction Management System</title>
    <link href="{{ 'css/bootstrap.min.css' }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        a {
            text-decoration: none;
        }

        .login-page {
            width: 100%;
            height: 100vh;
            display: inline-block;
            display: flex;
            align-items: center;
        }

        .form-right i {
            font-size: 100px;
        }
    </style>
</head>

<body>

    <div class="login-page bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <h3 class="mb-3">CONSTRUCTION MANAGEMENT SYSTEM</h3>
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="bg-white shadow rounded">
                        <div class="row">

                            <div class="col-md-7 pe-0">
                                <div class="form-left h-100 py-5 px-5">
                                    <form action="{{ route('login') }}" method="POST" class="row g-4">
                                        @csrf
                                        <div class="col-12">
                                            <label for="email" class="form-label">Email Address<span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                                <input type="email" id="email" name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="Enter Email" value="{{ old('email') }}">
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="password" class="form-label">Password<span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                                <input type="password" id="password" name="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    placeholder="Enter Password">
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="inlineFormCheck"
                                                    name="remember">
                                                <label class="form-check-label" for="inlineFormCheck">Remember
                                                    me</label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <a href="{{ route('password.request') }}"
                                                class="float-end text-primary">Forgot Password?</a>
                                        </div>


                                        <div class="col-12">
                                            <button type="submit"
                                                class="btn btn-primary w-100 px-4 float-end mt-4">Login</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <div class="col-md-5 ps-0 d-none d-md-block">
                                <div class="form-right h-100 bg-primary text-white text-center pt-5">
                                    <i class="bi bi-bootstrap"></i>
                                    <h2 class="fs-1">Welcome Back!!!</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <p class="text-end text-secondary mt-3">Bootstrap 5 Login Page Design</p> --}}
                </div>
            </div>
        </div>
    </div>
    <script src="{{ 'js/bootstrap.bundle.min.js' }}"></script>
</body>

</html>

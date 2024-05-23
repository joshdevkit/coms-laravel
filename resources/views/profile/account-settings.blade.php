@extends(Auth::user()->type === 1 ? 'templates.admin.header' : (Auth::user()->type === 2 ? 'templates.manager.header' : (Auth::user()->type === 3 ? 'templates.member.header' : (Auth::user()->type === 0 ? 'templates.owner.header' : 'templates.default.header'))))

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Profile</h1>
                </div>
                <div class="col-sm-12 col-lg-12 col-md-12 mb-2">
                    <hr class="border-2 border-primary">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h4>Account Details</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('update-account') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    @if (Auth::user()->type === 1)
                                    <div class="col-md-4 mb-2">
                                        @elseif (Auth::user()->type === 2 || Auth::user()->type === 3  || Auth::user()->type === 0)
                                        <div class="col-md-6 mb-2">
                                    @endif
                                        <div class="form-group">
                                            <label for="avatar">Avatar</label>
                                            <div class="custom-file">
                                                <input type="file" name="avatar" id="avatar"
                                                    class="custom-file-input @error('avatar') is-invalid @enderror"
                                                    accept="image/*">
                                                <label class="custom-file-label" for="avatar">Choose file</label>
                                            </div>
                                            @error('avatar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group d-flex justify-content-center align-items-center">
                                            <img id="avatar-preview" src="{{ asset($user->avatar) }}" alt="Avatar Preview"
                                                class="img-fluid rounded-circle"
                                                style="height: 15vh; width: 15vh; border: 1px solid #dee2e6 !important">
                                        </div>
                                    </div>
                                    @if (Auth::user()->type === 1)
                                        <div class="col-md-4 mb-2">
                                            <div class="col-md-12 mb-3">
                                                <label for="">Current Password</label>
                                                <input type="password" name="current_password"
                                                    class="form-control @error('current_password') is-invalid @enderror">
                                            </div>
                                            @error('current_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <div class="col-md-12 mb-3">
                                                <label for="">New Password</label>
                                                <input type="password" name="new_password"
                                                    class="form-control @error('new_password') is-invalid @enderror">
                                            </div>
                                            @error('new_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            <div class="col-md-12 mb-3">
                                                <label for="">Confirm Password</label>
                                                <input type="password" name="confirm_password"
                                                    class="form-control @error('confirm_password') is-invalid @enderror">
                                            </div>
                                            @error('confirm_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endif

                                    @if (Auth::user()->type === 1)
                                    <div class="col-md-4 mb-2">
                                        @elseif (Auth::user()->type === 2 || Auth::user()->type === 3  || Auth::user()->type === 0)
                                        <div class="col-md-6 mb-2">
                                    @endif
                                        <div class="col-md-12 col-lg-12 col-sm-12 mb-3">
                                            <label for="fullname">Fullname</label>
                                            <input value="{{ $user->fullname }}" type="text" name="fullname"
                                                id="fullname" class="form-control @error('fullname') is-invalid @enderror">
                                        </div>
                                        <div class="col-md-12 col-lg-12 col-sm-12 mb-3">
                                            <label for="emailAddress">Email Address</label>
                                            <input value="{{ $user->email }}" type="text" name="emailAddress"
                                                id="emailAddress"
                                                class="form-control @error('emailAddress') is-invalid @enderror">
                                        </div>
                                        <div class="col-md-12 col-lg-12 col-sm-12 mb-3">
                                            <label for="userType">User Type</label>
                                            <input readonly type="text" name="userType" id="userType"
                                                class="form-control"
                                                placeholder="{{ $user->type == 2 ? 'Manager' : ($user->type == 1 ? 'Admin' : ($user->type == 3 ? 'Project Member' : ($user->type == 0 ? 'Project Owner' : 'Unknown Role'))) }}">
                                        </div>
                                        <div class="col-md-12">
                                            <button class="btn btn-primary float-right" type="submit">Update
                                                Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        document.getElementById('avatar').addEventListener('change', function(event) {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function() {
                var img = document.getElementById('avatar-preview');
                img.src = reader.result;
            };

            reader.readAsDataURL(input.files[0]);
        });
    </script>
@endsection

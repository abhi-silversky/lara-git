<x-admin-master>
    @section('content')
        <h2>{{ $user->name }} profile</h2>
        <div class="row">
            <div class="card-header py-3">
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        <h3>{{ session('error') }}</h3>
                    </div>
                @elseif (session()->has('success'))
                    <div class="alert alert-success">
                        <h3>{{ session('success') }}</h3>
                    </div>
                @elseif (session()->has('warning'))
                    <div class="alert alert-warning">
                        <h3>{{ session('warning') }}</h3>
                    </div>
                @endif
            </div>
            <div class="col-sm-4">
                <form action="{{ route('users.profile.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group mb-4">
                        <img width="100px" class = "img-profile rounded-circle d-block" src="{{ $user->avatar }}" alt="https://upload.wikimedia.org/wikipedia/commons/d/d1/Image_not_available.png">
                    </div>
                    <div class="form-group @error('avatar') is-invalid @enderror">
                        <input type="file" name="avatar" class = "form-control">
                    </div>
                    @error('avatar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="form-group @error('name') is-invalid @enderror">
                        <label for="name">Name</label>
                        <input type="text"
                               class="form-control"
                               name="name"
                               value="{{ $user->name }}"
                        >
                    </div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group @error('username') is-invalid @enderror">
                        <label for="username">username</label>
                        <input type="text"
                               class="form-control"
                               name="username"
                               value="{{ $user->username }}"
                        >
                    </div>
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="form-group @error('email') is-invalid @enderror">
                        <label for="email">Email</label>
                        <input type="email"
                               class="form-control"
                               name="email"
                               value="{{ $user->email }}"
                        >
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="form-group @error('password') is-invalid @enderror">
                        <label for="password">Password</label>
                        <input type="password"
                               class="form-control"
                               name="password"
                        >
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="form-group @error('password_confirmation') is-invalid @enderror">
                        <label for="password">Confirm Password</label>
                        <input type="password"
                               class="form-control"
                               name="password_confirmation"
                        >
                    </div>

                    <div class="form-group">
                        <input type="submit">
                    </div>

                </form>
            </div>
        </div>
    @endsection
</x-admin-master>

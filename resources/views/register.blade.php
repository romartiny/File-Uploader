@extends('layouts.app')
@section('title')
    Register
@endsection
<body>
<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>
                    <div class="card-body">
                        <form action="{{route('register-user')}}" method="post">
                            @csrf
                            @if(Session::has('success'))
                                <div class="alert-success">{{ Session::get('success') }}</div>
                            @endif
                            @if(Session::has('fail'))
                                <div class="alert-danger">{{ Session::get('fail') }}</div>
                            @endif
                            <div class="form-group row">
                                <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="first_name" class="form-control" name="first_name"
                                            value="{{ old('first_name') }}" autofocus>
                                    <span class="text-danger">@error('first_name') {{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="last_name" class="form-control" name="last_name"
                                           value="{{ old('last_name') }}">
                                    <span class="text-danger">@error('last_name') {{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">Email</label>
                                <div class="col-md-6">
                                    <input type="email" id="email_address" class="form-control" name="email"
                                           value="{{ old('email') }}">
                                    <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="conf_email" class="col-md-4 col-form-label text-md-right">Confirm
                                    Email</label>
                                <div class="col-md-6">
                                    <input type="email" id="conf_email" class="form-control" name="confirm_email"
                                           value="{{ old('confirm_email') }}">
                                    <span class="text-danger">@error('confirm_email') {{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" name="password">
                                    <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="conf_password" class="col-md-4 col-form-label text-md-right">Confirm
                                    Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="conf_password" class="form-control" name="confirm_password">
                                    <span class="text-danger">@error('confirm_password') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                                <a href="/" class="btn btn-link">
                                    Have an account?
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>

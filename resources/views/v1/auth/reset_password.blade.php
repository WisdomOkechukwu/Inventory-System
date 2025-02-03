@extends('layouts.auth', ['title' => 'Login'])

@section('content')
    <div class="d-flex flex-column h-100 p-3">
        <div class="d-flex flex-column flex-grow-1">
            <div class="row h-100">
                <div class="col-xxl-7">
                    <div class="row justify-content-center h-100">
                        <div class="col-lg-6 py-lg-5">
                            <div class="d-flex flex-column h-100 justify-content-center">
                                <div class="auth-logo mb-4">
                                    <a href="#" class="logo-dark">
                                        {{-- <img src="/images/logo-dark.png" height="24" alt="logo dark"> --}}
                                    </a>

                                    <a href="#" class="logo-light">
                                        {{-- <img src="/images/logo-light.png" height="24" alt="logo light"> --}}
                                    </a>
                                </div>

                                <h2 class="fw-bold fs-24">Enter New Password</h2>

                                <p class="text-muted mt-1 mb-4">Enter your new password to access dashboard
                                    panel.</p>

                                <div class="mb-5">
                                    <form method="POST" action="{{ route('reset_password') }}" class="authentication-form">
                                        @csrf
                                        @if (sizeof($errors) > 0)
                                            @foreach ($errors->all() as $error)
                                                <div class="alert alert-danger">{{ $error }}</div>
                                            @endforeach
                                        @endif

                                        @if (session('error'))
                                            <div class="alert alert-danger">{{ session('error') }}</div>
                                        @endif
                                        @if (session('success'))
                                            <div class="alert alert-success">{{ session('success') }}</div>
                                        @endif

                                       <input type="hidden" name="email" value="{{ $email }}">

                                        <div class="mb-3">
                                            <label class="form-label" for="example-password">Password</label>
                                            <input type="password" id="example-password" class="form-control"
                                                   placeholder="Enter your password" name="password" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="example-password">Confirm Password</label>
                                            <input type="password" id="example-password" class="form-control"
                                                   placeholder="Enter your password" name="password_confirmation" required>
                                        </div>

                                        <div class="mb-1 text-center d-grid"><button class="btn btn-soft-primary" type="submit">Confirm</button>
                                        </div>
                                    </form>

                                </div>

                                <p class="text-danger text-center">Have an account? <a href="{{ route('login')}}"
                                                                                             class="text-dark fw-bold ms-1">Click Here</a></p>                                                    
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-5 d-none d-xxl-flex">
                    <div class="card h-100 mb-0 overflow-hidden">
                        <div class="d-flex flex-column h-100">
                            <img src="/images/small/img-10.jpg" alt="" class="w-100 h-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

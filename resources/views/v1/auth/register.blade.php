@extends('layouts.auth', ['title' => 'Register'])

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

                                <h2 class="fw-bold fs-24">Sign Up</h2>

                                <p class="text-muted mt-1 mb-4">New to our platform? Sign up now! It only takes a
                                    minute</p>

                                <div>
                                    <form method="POST" action="{{ route('register.store') }}" class="authentication-form">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label" for="example-name">Name</label>
                                            <input type="text" id="example-name" name="name" value="{{ old('name') }}"
                                                   class="form-control" placeholder="Enter your name">
                                            @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="example-email">Email</label>
                                            <input type="email" id="example-email" name="email" value="{{ old('email') }}"
                                                   class="form-control bg-" placeholder="Enter your email">
                                                @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="example-email">Company Name</label>
                                            <input type="text" id="example-email" name="company_name" value="{{ old('company_name') }}"
                                                   class="form-control bg-" placeholder="Enter your company name">
                                                   @if ($errors->has('company_name'))
                                                   <span class="text-danger">{{ $errors->first('company_name') }}</span>
                                                   @endif
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="example-password">Password</label>
                                            <input type="password" id="example-password" class="form-control" name="password"
                                                   placeholder="Enter your password">
                                                   @if ($errors->has('password'))
                                                   <span class="text-danger">{{ $errors->first('password') }}</span>
                                                   @endif
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="example-password">Confirm Password</label>
                                            <input type="password" id="example-password" class="form-control" name="password_confirmation"
                                                   placeholder="Enter your password again">
                                        </div>

                                        <div class="mb-1 text-center d-grid">
                                            <button class="btn btn-soft-primary" type="submit">Sign Up</button>
                                        </div>
                                    </form>
                                </div>

                                <p class="mt-auto text-danger text-center">I already have an account <a
                                        href="{{ route('login') }}" class="text-dark fw-bold ms-1">Login</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-5 d-none d-xxl-flex">
                    <div class="card h-100 mb-0 overflow-hidden">
                        <div class="d-flex flex-column h-100">
                            <img src="/images/small/img-10.jpg" alt="" class="w-100 h-100">
                        </div>
                    </div> <!-- end card -->
                </div>
            </div>
        </div>
    </div>

@endsection

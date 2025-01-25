@extends('layouts.vertical', ['title' => 'Role ' . ($is_create ? 'Create' : 'Edit')])

@section('css')
    @vite(['node_modules/choices.js/public/assets/styles/choices.min.css'])
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Roles Information</h4>
                </div>

                <form method="POST"
                    @if ($is_create) action="{{ route('staff.create') }}" @else action="{{ route('staff.update') }}" @endif>
                    @csrf
                    <div class="card-body">
                        @if (!$is_create)
                            <input type="hidden" name="staff_id" value="{{ $staff->id }}">
                        @endif
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="roles-name" class="form-label">Staff Name</label>
                                    <input type="text" id="roles-name" class="form-control" placeholder="Staff Name"
                                        name="name" value="{{ $is_create ? old('name') : $staff->name }}" required>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="roles-name" class="form-label">Staff Email</label>
                                    <input type="text" id="roles-name" class="form-control" placeholder="Staff Email"
                                        name="email" value="{{ $is_create ? old('email') : $staff->email }}" required>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="workspace" class="form-label">Staff Role</label>
                                    <select class="form-control" id="workspace" data-choices data-choices-groups
                                        name="role" data-placeholder="Select Workspace" required>
                                        <option value="">Select</option>
                                        <option value="staff"
                                            {{ $is_create ?: ($staff->role == 'staff' ? 'selected' : '') }}>Staff
                                        </option>
                                        <option value="admin"
                                            {{ $is_create ?: ($staff->role == 'admin' ? 'selected' : '') }}>Admin
                                        </option>
                                    </select>
                                </div>
                            </div>
                            @if ($is_create)
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="user-name" class="form-label">Staff Password</label>
                                        <input type="password" id="user-name" class="form-control"
                                            placeholder="Enter Password" value="" name="password" required>
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                    <div class="card-footer border-top">
                        <button type="submit"
                            class="btn btn-primary">{{ $is_create ? 'Create Staff' : 'Edit Staff' }}</button>
                    </div>
                </form>
            </div>
        </div>
        @if (!$is_create)
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Update Password</h4>
                    </div>

                    <form method="POST" action="{{ route('staff.update.password') }}">
                        @csrf
                        <div class="card-body">
                            @if (!$is_create)
                                <input type="hidden" name="staff_id" value="{{ $staff->id }}">
                            @endif
                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="user-name" class="form-label">Staff Password</label>
                                        <input type="password" id="user-name" class="form-control"
                                            placeholder="Enter Password" value="" name="password" required>
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="user-name" class="form-label">Confirm Staff Password</label>
                                        <input type="password" id="user-name" class="form-control"
                                            placeholder="Confirm Password" value="" name="password_confirmation"
                                            required>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="card-footer border-top">
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('script-bottom')
    @vite(['resources/js/pages/app-ecommerce-product.js'])
    @vite(['resources/js/components/extended-sweetalert.js'])
@endsection

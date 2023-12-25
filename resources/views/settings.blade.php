@extends('layouts.app')

@section('title')
    Settings
@endsection

@push('css')
    @include('includes.styles.basic')
    <style type="text/css">
        .alert,
        .alert-danger {
            z-index: 1052 !important;
        }
    </style>
@endpush

@section('breadcrumb')
    <h1 class="flex-grow-1 fs-3 fw-bold my-2 my-sm-3">Settings</h1>
    <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Profile</li>
            <li class="breadcrumb-item active" aria-current="page">Settings</li>
        </ol>
    </nav>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-6">
            <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header border-bottom border-2">
                        <h3 class="mb-0 py-1 fs-4 fw-bold">Profile Update</h3>
                    </div>
                    <div class="block-content block-content-full">
                        <form method="POST" action="{{ route('profile_update') }}" class="submit-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="row">
                                        <div class="col-12 mb-4">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name"
                                            value="{{ $user->name }}">
                                        </div>
                                        
                                        <div class="col-12 mb-4">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email"
                                            value="{{ $user->email }}">
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn  btn-outline-primary mb-3">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END Dynamic Table with Export Buttons -->
        </div>

        <div class="col-md-6">
            <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header border-bottom border-2">
                        <h3 class="mb-0 py-1 fs-4 fw-bold">Password Update</h3>
                    </div>
                    <div class="block-content block-content-full">
                        <form method="POST" action="{{ route('password_update') }}" class="submit-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="row">
                                        <div class="col-12 mb-4">
                                            <label class="form-label">New Password</label>
                                            <input type="password" class="form-control" name="password"
                                           />
                                        </div>
                                        
                                        <div class="col-12 mb-4">
                                            <label class="form-label">Confirmed Pasword</label>
                                            <input type="password" class="form-control" name="password_confirmation"
                                            />
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-outline-primary mb-3">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END Dynamic Table with Export Buttons -->
        </div>
    </div>
    
@endsection


@push('js')
    @include('includes.scripts.basic')
@endpush

@push('scripts')
    <script>
    
    </script>
@endpush

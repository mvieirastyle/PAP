@extends('layouts.default')


@section('content')

<section class="d-flex align-items-center justify-content-center" style="min-height: 100vh; background-color: #f0f2f5;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow border-0 rounded-lg">
                        <div class="card-header bg-orange text-white text-center py-4"
                            style="background-color: var(--primary-orange);">
                            <h3 class="mb-0 fw-bold"><i class="fas fa-user-plus me-2"></i>{{__('users.form.create')}}</h3>
                        </div>
                        <div class="card-body p-4">
                            <form method="post" action="/register">
                                @csrf
                                <div class="mb-3">
                                    <label for="regFisrtName" class="form-label">{{__('users.form.first_name')}}</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                            id="regFirstName" name="first_name" value="" maxlength="15" required>
                                        @error('first_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                 <div class="mb-3">
                                    <label for="regLastName" class="form-label">{{__('users.form.last_name')}}</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                            id="regLastName" name="last_name" value="" maxlength="15" required>
                                        @error('first_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="regName" class="form-label">{{__('common.username')}}</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="regName" name="name" value="" required>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="regEmail" class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="regEmail" name="email" value="" required>
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="regPassword" class="form-label">{{__('common.pass')}}</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input type="password" class="form-control  @error('password') is-invalid @enderror" placeholder="••••••••"
                                            id="regPassword" name="password" required>
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="regConfirmPassword" class="form-label">{{__('common.confirm_pass')}}</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input type="password" class="form-control" placeholder="••••••••" id="regConfirmPassword"
                                            name="password_confirmation" required>
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-orange text-white btn-lg"
                                        style="background-color: var(--primary-orange);">{{__('common.register')}}</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center py-3 bg-light">
                            <p class="mb-0 small">{!!__('users.form.have')!!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
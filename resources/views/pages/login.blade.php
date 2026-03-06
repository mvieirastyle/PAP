@extends('layouts.default')

@section('content')

<section class="d-flex align-items-center justify-content-center" style="min-height: 80vh; background-color: #f0f2f5;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow border-0 rounded-lg">
                        <div class="card-header bg-success text-white text-center py-4">
                            <h3 class="mb-0 fw-bold"><i class="fas fa-paw me-2"></i>Login</h3>
                        </div>
                        <div class="card-body p-4">
                            <form method="post" action="/login">
                                @csrf
                                <div class="mb-3">
                                    <label for="loginEmail" class="form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="loginEmail" name="email" placeholder="admin@batalha.pt"
                                            value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="loginPassword" class="form-label">{{__('common.pass')}}</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="loginPassword" name="password" placeholder="••••••••" required>
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                                        <label class="form-check-label" for="rememberMe">
                                            {{__('common.remember')}}
                                        </label>
                                    </div>
                                    <a href="#" class="small text-success text-decoration-none">{{__('common.forgot')}}</a>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success btn-lg">{{__('common.enter')}}</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center py-3 bg-light">
                            <p class="mb-0 small">{!!__('users.form.dont_have')!!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

@endsection
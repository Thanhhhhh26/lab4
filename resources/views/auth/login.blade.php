@extends('layouts.app')

@section('title', 'Đăng Nhập')

@section('content')
<div class="auth-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="auth-card">
                    <div class="auth-logo">
                        <h2><i class="bi bi-newspaper me-2"></i>Tin Tức Việt</h2>
                        <p class="text-muted">Đăng nhập vào tài khoản của bạn</p>
                    </div>

                    @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        {{ $errors->first() }}
                    </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-500">Địa chỉ Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                       placeholder="Nhập email của bạn"
                                       value="{{ old('email') }}" required autofocus>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-500">Mật Khẩu</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password" id="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       placeholder="Nhập mật khẩu" required>
                                <button class="btn btn-outline-secondary" type="button"
                                        onclick="togglePassword('password','eyeIcon')">
                                    <i class="bi bi-eye" id="eyeIcon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label text-muted" for="remember" style="font-size:14px">
                                    Ghi nhớ đăng nhập
                                </label>
                            </div>
                            <a href="{{ route('password.request') }}" class="text-danger text-decoration-none" style="font-size:14px">
                                Quên mật khẩu?
                            </a>
                        </div>

                        <button type="submit" class="btn btn-primary-custom">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Đăng Nhập
                        </button>
                    </form>

                    <hr class="my-4">
                    <p class="text-center text-muted mb-0" style="font-size:14px">
                        Chưa có tài khoản?
                        <a href="{{ route('register') }}" class="text-danger fw-500 text-decoration-none">Đăng ký ngay</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'bi bi-eye';
    }
}
</script>
@endsection

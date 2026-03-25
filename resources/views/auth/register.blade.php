@extends('layouts.app')

@section('title', 'Đăng Ký Tài Khoản')

@section('content')
<div class="auth-wrapper py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="auth-card">
                    <div class="auth-logo">
                        <h2><i class="bi bi-newspaper me-2"></i>Tin Tức Việt</h2>
                        <p class="text-muted">Tạo tài khoản mới để trải nghiệm đầy đủ</p>
                    </div>

                    @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-500">Họ và Tên <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Nhập họ và tên đầy đủ"
                                       value="{{ old('name') }}" required autofocus>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-500">Địa chỉ Email <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                       placeholder="Nhập địa chỉ email"
                                       value="{{ old('email') }}" required>
                            </div>
                            <small class="text-muted">Email sẽ được dùng để kích hoạt tài khoản.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-500">Số Điện Thoại</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                <input type="text" name="phone" class="form-control"
                                       placeholder="Nhập số điện thoại (tùy chọn)"
                                       value="{{ old('phone') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-500">Mật Khẩu <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password" id="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       placeholder="Tối thiểu 6 ký tự" required>
                                <button class="btn btn-outline-secondary" type="button"
                                        onclick="togglePassword('password','eye1')">
                                    <i class="bi bi-eye" id="eye1"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-500">Xác Nhận Mật Khẩu <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" name="password_confirmation" id="password2"
                                       class="form-control"
                                       placeholder="Nhập lại mật khẩu" required>
                                <button class="btn btn-outline-secondary" type="button"
                                        onclick="togglePassword('password2','eye2')">
                                    <i class="bi bi-eye" id="eye2"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms" required>
                                <label class="form-check-label text-muted" for="terms" style="font-size:13px">
                                    Tôi đồng ý với <a href="#" class="text-danger">Điều khoản sử dụng</a>
                                    và <a href="#" class="text-danger">Chính sách bảo mật</a>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary-custom">
                            <i class="bi bi-person-plus me-2"></i>Tạo Tài Khoản
                        </button>
                    </form>

                    <hr class="my-4">
                    <p class="text-center text-muted mb-0" style="font-size:14px">
                        Đã có tài khoản?
                        <a href="{{ route('login') }}" class="text-danger fw-500 text-decoration-none">Đăng nhập ngay</a>
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

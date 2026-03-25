@extends('layouts.app')

@section('title', 'Quên Mật Khẩu')

@section('content')
<div class="auth-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="auth-card">
                    <div class="auth-logo">
                        <h2><i class="bi bi-newspaper me-2"></i>Tin Tức Việt</h2>
                        <p class="text-muted">Đặt lại mật khẩu của bạn</p>
                    </div>

                    <div class="alert alert-info" style="font-size:14px">
                        <i class="bi bi-info-circle me-2"></i>
                        Nhập địa chỉ email đã đăng ký. Chúng tôi sẽ gửi link đặt lại mật khẩu đến email của bạn.
                    </div>

                    @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-circle me-2"></i>{{ $errors->first() }}
                    </div>
                    @endif

                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-500">Địa chỉ Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       placeholder="Nhập email đã đăng ký"
                                       value="{{ old('email') }}" required autofocus>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary-custom">
                            <i class="bi bi-send me-2"></i>Gửi Link Đặt Lại Mật Khẩu
                        </button>
                    </form>

                    <hr class="my-4">
                    <p class="text-center text-muted mb-0" style="font-size:14px">
                        <a href="{{ route('login') }}" class="text-danger text-decoration-none">
                            <i class="bi bi-arrow-left me-1"></i>Quay lại đăng nhập
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

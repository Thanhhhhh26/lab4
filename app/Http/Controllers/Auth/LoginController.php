<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function showForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Vui lòng nhập email.',
            'email.email'       => 'Email không hợp lệ.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ]);

        // Kiểm tra tài khoản tồn tại
        $user = DB::table('users')->where('email', $request->email)->first();

        if (!$user) {
            return back()->withInput()->with('error', 'Email không tồn tại trong hệ thống.');
        }

        if (!$user->is_active) {
            return back()->withInput()->with('error', 'Tài khoản chưa được kích hoạt. Vui lòng kiểm tra email.');
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'))->with('success', 'Đăng nhập thành công! Chào mừng ' . Auth::user()->name);
        }

        return back()->withInput()->with('error', 'Mật khẩu không chính xác.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Đã đăng xuất thành công.');
    }
}

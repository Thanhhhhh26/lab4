<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ActivationMail;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'nullable|string|max:15',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required'      => 'Vui lòng nhập họ tên.',
            'email.required'     => 'Vui lòng nhập email.',
            'email.email'        => 'Email không hợp lệ.',
            'email.unique'       => 'Email này đã được sử dụng.',
            'password.required'  => 'Vui lòng nhập mật khẩu.',
            'password.min'       => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);

        $token = Str::random(60);

        DB::table('users')->insert([
            'name'             => $request->name,
            'email'            => $request->email,
            'phone'            => $request->phone,
            'password'         => Hash::make($request->password),
            'is_active'        => 0,
            'activation_token' => $token,
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);

        // Gửi mail kích hoạt
        try {
            Mail::to($request->email)->send(new ActivationMail($request->name, $token));
            $message = 'Đăng ký thành công! Vui lòng kiểm tra email để kích hoạt tài khoản.';
        } catch (\Exception $e) {
            $message = 'Đăng ký thành công! Không thể gửi email kích hoạt. Vui lòng liên hệ quản trị viên.';
        }

        return redirect()->route('login')->with('success', $message);
    }

    public function activate($token)
    {
        $user = DB::table('users')->where('activation_token', $token)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Liên kết kích hoạt không hợp lệ hoặc đã hết hạn.');
        }

        if ($user->is_active) {
            return redirect()->route('login')->with('info', 'Tài khoản của bạn đã được kích hoạt trước đó.');
        }

        DB::table('users')->where('activation_token', $token)->update([
            'is_active'        => 1,
            'activation_token' => null,
            'email_verified_at' => now(),
            'updated_at'       => now(),
        ]);

        return redirect()->route('login')->with('success', 'Kích hoạt tài khoản thành công! Bạn có thể đăng nhập ngay.');
    }
}

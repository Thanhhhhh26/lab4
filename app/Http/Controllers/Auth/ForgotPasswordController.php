<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordMail;

class ForgotPasswordController extends Controller
{
    // Form nhập email
    public function showForm()
    {
        return view('auth.forgot-password');
    }

    // Gửi link reset
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email'    => 'Email không hợp lệ.',
            'email.exists'   => 'Email này không tồn tại trong hệ thống.',
        ]);

        $token = Str::random(60);

        // Xóa token cũ nếu có
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Lưu token mới
        DB::table('password_reset_tokens')->insert([
            'email'      => $request->email,
            'token'      => Hash::make($token),
            'created_at' => now(),
        ]);

        $user = DB::table('users')->where('email', $request->email)->first();

        try {
            Mail::to($request->email)->send(new ResetPasswordMail($user->name, $token, $request->email));
            return back()->with('success', 'Đã gửi link đặt lại mật khẩu đến email của bạn. Vui lòng kiểm tra hộp thư.');
        } catch (\Exception $e) {
            return back()->with('error', 'Không thể gửi email. Vui lòng thử lại sau.');
        }
    }

    // Form đặt lại mật khẩu
    public function showResetForm(Request $request, $token)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    // Xử lý đặt lại mật khẩu
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'    => 'required|email|exists:users,email',
            'token'    => 'required',
            'password' => 'required|min:6|confirmed',
        ], [
            'email.required'     => 'Vui lòng nhập email.',
            'email.exists'       => 'Email không tồn tại.',
            'token.required'     => 'Token không hợp lệ.',
            'password.required'  => 'Vui lòng nhập mật khẩu mới.',
            'password.min'       => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$record || !Hash::check($request->token, $record->token)) {
            return back()->with('error', 'Token không hợp lệ hoặc đã hết hạn.');
        }

        // Kiểm tra token hết hạn (60 phút)
        if (now()->diffInMinutes($record->created_at) > 60) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->with('error', 'Link đặt lại mật khẩu đã hết hạn. Vui lòng yêu cầu lại.');
        }

        DB::table('users')->where('email', $request->email)->update([
            'password'   => Hash::make($request->password),
            'updated_at' => now(),
        ]);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Đặt lại mật khẩu thành công! Bạn có thể đăng nhập ngay.');
    }
}

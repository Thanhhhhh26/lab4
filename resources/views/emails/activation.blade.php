<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kích Hoạt Tài Khoản</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,.1); }
        .header { background: #c0392b; padding: 30px; text-align: center; }
        .header h1 { color: #fff; margin: 0; font-size: 24px; }
        .header p { color: rgba(255,255,255,.8); margin: 5px 0 0; }
        .body { padding: 35px 40px; }
        .body h2 { color: #333; font-size: 20px; }
        .body p { color: #555; line-height: 1.7; font-size: 15px; }
        .btn { display: inline-block; background: #c0392b; color: #fff !important; padding: 14px 35px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 16px; margin: 20px 0; }
        .note { background: #fff8e1; border-left: 4px solid #f39c12; padding: 12px 15px; border-radius: 4px; font-size: 13px; color: #666; margin-top: 20px; }
        .footer { background: #f8f8f8; padding: 20px 40px; text-align: center; font-size: 12px; color: #999; border-top: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📰 Tin Tức Việt</h1>
            <p>Kích hoạt tài khoản của bạn</p>
        </div>
        <div class="body">
            <h2>Xin chào, {{ $userName }}!</h2>
            <p>Cảm ơn bạn đã đăng ký tài khoản tại <strong>Tin Tức Việt</strong>.</p>
            <p>Để hoàn tất quá trình đăng ký và bắt đầu sử dụng dịch vụ, vui lòng nhấn vào nút bên dưới để kích hoạt tài khoản:</p>

            <div style="text-align:center">
                <a href="{{ $activationUrl }}" class="btn">✅ Kích Hoạt Tài Khoản</a>
            </div>

            <p>Hoặc copy và dán đường link sau vào trình duyệt:</p>
            <p style="word-break:break-all;background:#f5f5f5;padding:10px;border-radius:4px;font-size:13px">
                {{ $activationUrl }}
            </p>

            <div class="note">
                ⚠️ <strong>Lưu ý:</strong> Nếu bạn không thực hiện đăng ký này, vui lòng bỏ qua email này.
                Link kích hoạt chỉ có hiệu lực một lần.
            </div>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} Tin Tức Việt. Bảo lưu mọi quyền.</p>
            <p>Email này được gửi tự động, vui lòng không trả lời.</p>
        </div>
    </div>
</body>
</html>

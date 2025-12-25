<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset mật khẩu</title>
    <style>
        @media only screen and (max-width: 600px) {
            .container {
                width: 100% !important;
                padding: 20px !important;
            }

            .btn {
                width: 100% !important;
            }
        }
    </style>
</head>

<body style="margin:0; padding:0; background:#f2f2f2; font-family:Arial, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f2f2f2; padding:40px 0;">
        <tr>
            <td align="center">
                <table class="container" width="600" cellpadding="0" cellspacing="0"
                    style="background:#ffffff; border-radius:8px; overflow:hidden; padding:40px;">

                    <tr>
                        <td align="center" style="padding-bottom:20px;">
                            <h2 style="margin:0; font-size:24px; color:#333;">Đặt lại mật khẩu</h2>
                        </td>
                    </tr>

                    <tr>
                        <td style="font-size:16px; color:#555; line-height:1.6; padding-bottom:25px;">
                            Chào {{ $user->name }}<br><br>
                            Click vào nút phía dưới để đặt lại mật khẩu
                        </td>
                    </tr>

                    <!-- Button -->
                    <tr>
                        <td align="center" style="padding-bottom:30px;">
                            <a href="{{ $actionLink }}" class="btn"
                                style="background:#4CAF50; color:#ffffff; padding:14px 24px; 
                                  text-decoration:none; border-radius:5px; font-size:16px; 
                                  display:inline-block;">
                                Đặt lại mật khẩu
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td style="font-size:14px; color:#888; line-height:1.5; padding-bottom:20px;">
                            If you did not request a password reset, simply ignore this email.
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="font-size:12px; color:#aaa; padding-top:20px;">
                            <p>&copy;{{ date('Y') }} Blog. All rights reserved.</p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Password Updated</title>

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
                    style="background:#ffffff; border-radius:8px; padding:40px;">

                    <tr>
                        <td align="center" style="padding-bottom:20px;">
                            <h2 style="margin:0; color:#333;">Your Password Has Been Updated</h2>
                        </td>
                    </tr>

                    <tr>
                        <td style="font-size:16px; color:#555; line-height:1.6; padding-bottom:20px;">
                            Hello {{ $user->name }},<br><br>
                            Your password has been successfully updated.
                            Below are your new login details:
                        </td>
                    </tr>

                    <tr>
                        <td
                            style="padding:20px; background:#f9f9f9; border-radius:6px; margin-bottom:25px; border:1px solid #eee;">
                            <p style="font-size:15px; margin:0; color:#333;">
                                <strong>Username / Email:</strong> {{ $user->email }}<br>
                                <strong>New Password:</strong> {{ $new_password }}
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="padding-bottom:30px;">
                            <a href="{{ route('login') }}" class="btn"
                                style="background:#007BFF; color:#ffffff; padding:12px 24px; 
                                  text-decoration:none; border-radius:5px; 
                                  font-size:16px; display:inline-block;">
                                Login Now
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <td style="font-size:14px; color:#888; line-height:1.5; padding-bottom:20px;">
                            If you did not request this change, please contact support immediately.
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="font-size:12px; color:#aaa; padding-top:10px;">
                            © 2025 Your Company. All rights reserved.
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>

</html>

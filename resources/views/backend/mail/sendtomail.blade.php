<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome Email</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f7; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <table width="100%" bgcolor="#f4f4f7" cellpadding="0" cellspacing="0" style="padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="border-radius: 10px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); overflow: hidden;">
                    <!-- Header -->
                    <tr>
                        <td bgcolor="#4f46e5" style="padding: 30px; color: #ffffff; text-align: center;">
                            <h1 style="margin: 0; font-size: 26px;">Congrates from {{ $data['name'] }}</h1>
                            <p style="margin: 10px 0 0;">{{ $data['message'] }}</p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 30px;">
                            <p style="font-size: 16px; color: #333;">
                                Hey <strong></strong>,
                            </p>
                            <p style="font-size: 16px; color: #333;">
                                Thanks for signing up! You’re now part of a community of traders looking to level up their crypto journey.
                            </p>
                            <p style="font-size: 16px; color: #333;">
                                Click the button below to confirm your email and get started:
                            </p>

                            <div style="text-align: center; margin: 30px 0;">
                                <a href="" style="padding: 12px 24px; background-color: #4f46e5; color: #fff; text-decoration: none; font-weight: bold; border-radius: 5px;">
                                    ✅ Confirm Your Email
                                </a>
                            </div>

                            <p style="font-size: 14px; color: #888;">
                                If you didn’t create this account, you can safely ignore this email.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td bgcolor="#f4f4f7" style="padding: 20px; text-align: center; font-size: 13px; color: #aaa;">
                            ©  CryptoLensFi. All rights reserved.<br>
                            Built with 💻 from the CryptoLensFi team.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        /* Reset basic style */
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f6f8;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
        }
        table {
            border-collapse: collapse;
        }
        /* Mobile responsive */
        @media only screen and (max-width: 600px) {
            .container {
                width: 100% !important;
                padding: 10px !important;
            }
            .content {
                padding: 24px !important;
            }
            .button {
                width: 100% !important;
                text-align: center;
            }
        }
    </style>
</head>
<body style="background-color: #f4f6f8; margin: 0; padding: 40px 0;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td align="center">
                <table class="container" role="presentation" width="600" cellspacing="0" cellpadding="0" border="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                    <tr>
                        <td align="center" style="background-color: #4F46E5; padding: 30px 20px;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 24px; font-weight: bold; letter-spacing: 0.5px;">
                                E-Bebas SMK Sakti Gemolong
                            </h1>
                        </td>
                    </tr>
                    <tr>
                        <td class="content" style="padding: 40px 30px; color: #333333; line-height: 1.6;">
                            <h2 style="margin-top: 0; color: #111827; font-size: 20px; font-weight: 600;">
                                Permintaan Reset Password
                            </h2>
                            <p style="font-size: 15px; color: #4B5563; margin-bottom: 24px;">
                                Halo, {{ $nama }}
                            </p>
                            <p style="font-size: 15px; color: #4B5563; margin-bottom: 24px;">
                                Kami menerima permintaan untuk mereset password akun Anda. Silakan klik tombol di bawah ini untuk membuat password baru:
                            </p>

                            <!-- Call to Action Button -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: 30px 0;">
                                <tr>
                                    <td align="center" style="border-radius: 6px;" bgcolor="#4F46E5">
                                        <!-- UBAH URL DI BAWAH INI -->
                                        <a href="{{ $link }}" target="_blank" class="button" style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 6px; padding: 14px 28px; border: 1px solid #4F46E5; display: inline-block; font-weight: bold;">
                                            Reset Password Saya
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="font-size: 14px; color: #6B7280; margin-bottom: 24px;">
                                Tautan/link ini hanya berlaku selama <strong>30 menit</strong>. Jika Anda tidak merasa melakukan permintaan ini, silakan abaikan email ini dan password Anda akan tetap aman.
                            </p>
                            <hr style="border: none; border-top: 1px solid #E5E7EB; margin: 30px 0;">
                            <p style="font-size: 12px; color: #9CA3AF; margin-bottom: 8px;">
                                Mengalami masalah dengan tombol di atas? Salin dan tempel tautan berikut ke browser Anda:
                            </p>
                            <p style="font-size: 12px; color: #4F46E5; word-break: break-all; margin-top: 0;">
                                <a href="{{ $link }}" style="color: #4F46E5; text-decoration: underline;">
                                    {{ $link }}
                                </a>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="background-color: #F9FAFB; padding: 20px; border-top: 1px solid #F3F4F6; font-size: 12px; color: #9CA3AF;">
                            <p style="margin: 0 0 8px 0;">
                                &copy; 2026 Perpusataakn SMK Sakti Gemolong. All rights reserved.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
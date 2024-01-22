<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Website</title>
</head>
<body>
    <table style="width: 100%; max-width: 600px; margin: 0 auto; font-family: 'Arial', sans-serif; background-color: #f5f5f5; padding: 20px;">
        <tr>
            <td style="text-align: center;">
                <h1>Welcome to Our Website!</h1>
            </td>
        </tr>
        <tr>
            <td>
                <p>Dear {{ $user->name }},</p>
                <p>Thank you for joining our community. We are excited to have you on board!</p>
                <p>Feel free to explore our website and make the most of your experience.</p>
            </td>
        </tr>
        <tr>
            <td style="text-align: center;">
                <img src="{{ asset('path/to/your/logo.png') }}" alt="Your Logo" style="max-width: 100%; height: auto;">
            </td>
        </tr>
        <tr>
            <td style="text-align: center;">
                <p>If you have any questions or need assistance, please don't hesitate to contact us.</p>
                <p>Thank you again for choosing our platform!</p>
            </td>
        </tr>
    </table>
</body>
</html>

<?php

require 'vendor/autoload.php';

use PragmaRX\Google2FA\Google2FA;
use BaconQrCode\Renderer\GDLibRenderer;
use BaconQrCode\Writer;

session_start();

// Initialize
$googleOTP = new Google2FA();

// Generate a secret key
$user = [
    'google2fa_secret' => $googleOTP->generateSecretKey(),
    'email' => 'example@example.com'
];

// Store user data in the session
$_SESSION['user'] = $user;

// Provide name of app
$app_name = 'OTP Authenticator Implementation';

// Generate a custom URL from user data
$qrCodeUrl = $googleOTP->getQRCodeUrl($app_name, $user['email'], $user['google2fa_secret']);

// Generate QR Code image with GD
$imageSize = 250;
$writer = new Writer(
    new GDLibRenderer($imageSize)
);

// Create a string with the image base64 data
$encoded_qr_data = base64_encode($writer->writeString($qrCodeUrl));

// Get current OTP (for debugging)
$current_otp = $googleOTP->getCurrentOtp($user['google2fa_secret']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Authenticator with PHP - Avengers Team</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #1e3c72, #2a5298);
            color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            text-align: center;
            width: 90%;
            max-width: 400px;
        }
        h1 {
            font-size: 1.8rem;
            margin-bottom: 20px;
        }
        #qrcode img {
            border: 2px solid #fff;
            border-radius: 8px;
            margin: 20px 0;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input[type="text"] {
            padding: 10px;
            border: none;
            border-radius: 4px;
            margin-bottom: 10px;
            outline: none;
            font-size: 1rem;
        }
        button {
            background-color: #28a745;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
        }
        button:hover {
            background-color: #218838;
        }
        p {
            margin-top: 10px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Google Authenticator</h1>
        <div id="qrcode">
            <p>Current Generated OTP: <?php echo $current_otp; ?></p>
            <img src="data:image/png;base64,<?php echo $encoded_qr_data; ?>" alt="QR Code">
        </div>
        <h2>Verify OTP</h2>
        <form id="verify-form">
            <input type="text" id="otp" placeholder="Enter OTP Code">
            <button type="submit">Verify</button>
        </form>
        <p>Scan the QR Code using Google Authenticator and enter the OTP to verify.</p>
    </div>

    <script>
        $(function() {
            $('#verify-form').on('submit', function(e) {
                e.preventDefault();
                var otp = $('#otp').val();

                if (!otp) {
                    alert('Please input your OTP code!');
                    return false;
                }

                $.ajax({
                    url: 'verify.php',
                    method: 'POST',
                    data: { otp: otp },
                    dataType: 'json',
                    success: function(data) {
                        if (data.result) {
                            alert('OTP successfully verified!');
                            if (data.redirect) {
                                window.location.href = data.redirect;
                            } else {
                                alert('Redirection URL not provided.');
                            }
                        } else {
                            alert(data.message || 'Invalid OTP.');
                        }
                    },
                });
            });
        });
    </script>
</body>
</html>

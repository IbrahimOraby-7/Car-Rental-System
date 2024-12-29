<?php

require 'vendor/autoload.php';
use PragmaRX\Google2FA\Google2FA;

session_start();

// Ensure session data is present
if (!isset($_SESSION['user'], $_SESSION['user']['google2fa_secret'], $_SESSION['user_type'])) {
    echo json_encode([
        'result' => false,
        'message' => 'Session data is incomplete.',
        'debug' => $_SESSION, // Debug the session for troubleshooting
    ]);
    exit();
}

// Retrieve session data
$user_secret = $_SESSION['user']['google2fa_secret'];
$user_type = $_SESSION['user_type'];

// Check if the OTP was provided via POST
if (isset($_POST['otp'])) {
    $otp = $_POST['otp'];

    // Input validation
    if (!preg_match('/^\d{6}$/', $otp)) {
        echo json_encode([
            'result' => false,
            'message' => 'Invalid OTP format. OTP must be a 6-digit number and do not have speacial characters.',
        ]);
        exit();
    }

    // Validate the OTP
    $googleOTP = new Google2FA();
    if ($googleOTP->verifyKey($user_secret, $otp)) {
        // Prepare the redirect URL based on user type
        $redirect_url = null;
        if ($user_type === 'admin') {
            $redirect_url = 'admin_page.php';
        } elseif ($user_type === 'user') {
            $redirect_url = 'user_page.php';
        }

        if ($redirect_url) {
            echo json_encode([
                'result' => true,
                'redirect' => $redirect_url,
            ]);
        } else {
            echo json_encode([
                'result' => false,
                'message' => 'Unknown user type.',
            ]);
        }
    } else {
        echo json_encode([
            'result' => false,
            'message' => 'Invalid OTP.',
        ]);
    }
    exit();
} else {
    echo json_encode([
        'result' => false,
        'message' => 'No OTP provided.',
    ]);
    exit();
}

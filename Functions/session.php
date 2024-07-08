<?php
// Function to generate CSRF token
function generateSessionToken()
{
    if (empty($_SESSION['session_token'])) {
        $_SESSION['session_token'] = bin2hex(random_bytes(32)); // Generate a random token
    }
}

// Function to check token
function checkToken($user_token, $session_token, $redirect_url)
{
    if (!hash_equals($session_token, $user_token)) {
        // Token does not match, redirect to the specified URL
        session_destroy();
        echo '<script>alert("Session issue occurs... Please select the security level again and refresh the page")</script>';
        exit;
    }
}

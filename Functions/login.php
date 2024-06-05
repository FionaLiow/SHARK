<?php
include 'substitution_cipher.php';


//Get data from HTML form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["login_email"];
    $password = $_POST["login_pwsd"];

    checkLogin($email, $password,  $originalChars, $substitutionChars);
} else {
    echo "Error: Invalid request method";
}


function checkLogin($email, $password,  $originalChars, $substitutionChars)
{
    $file_content = file_get_contents("../locale.txt");

    // Split content into lines
    $lines = explode("\n", $file_content);

    // Loop through each line
    foreach ($lines as $line) {
        // Split line into username and password
        list($stored_username, $stored_email, $stored_password) = explode(";;", $line);

        // Trim whitespace
        $stored_username = trim($stored_username);
        $stored_email = trim($stored_email);
        $stored_password = trim($stored_password);

        $decryptedPass = decrypt($stored_password, $originalChars, $substitutionChars);

        // Check if the username and password match
        if ($email === $stored_email && $password === $decryptedPass) {
            header("Location: ../home.php");

            session_start();
            $_SESSION['username'] = $stored_username;

            // Redirect to home.php
            header("Location: ../home.php");
            exit;
        }
    }

    // return false; // Credentials don't match
    echo '<script>alert("Wrong Credentials :( "); window.location.href = "../index.php";</script>';
    exit;
}

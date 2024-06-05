<?php
include 'substitution_cipher.php';
function writedata($data, $originalChars, $substitutionChars)
{
    $data = json_decode($data);

    $username = $data->username;
    $email = $data->email;
    $plaintext = $data->password;

    $ciphertext = encrypt($plaintext, $originalChars, $substitutionChars);

    // Open a text file in append mode and write the data
    $file = fopen("../locale.txt", "a");
    fwrite($file, "$username;;$email;;$ciphertext\n");
    fclose($file);

    echo "Registration successful :)";
}


function checkemail($email)
{
    $email = json_decode($email);
    $file = fopen("../locale.txt", "r");
    while (($line = fgets($file)) !== false) {
        //can use substring function also, then no need decode json
        $parts = explode(";;", $line);
        if (count($parts) > 1 && trim($parts[1]) === $email->email) {
            fclose($file);
            echo "true";
            return;
        }
    }

    fclose($file);
    echo "false";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action === 'writedata') {
            $data = $_POST['data'];
            writedata($data, $originalChars, $substitutionChars);
        } elseif ($action === 'checkemail') {
            $data = $_POST['email'];
            checkemail($data);
        }
    }
}

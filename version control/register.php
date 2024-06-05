<?php
include 'substitution_cipher.php';
$info = [];
$data = json_decode($_POST['data'], true);

$username = $data['username'];
$email = $data['email'];
$plaintext = $data['password'];

$ciphertext = encrypt($plaintext, $originalChars, $substitutionChars);

// Open a text file in append mode and write the data
$file = fopen("../locale.txt", "a");
fwrite($file, "$username;;$email;;$ciphertext\n");
fclose($file);

echo "Registration successful :)";

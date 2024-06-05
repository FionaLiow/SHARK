<?php
// Perfrom cipher substitution
// Define the character set (all possible symbols, alphabets, and numbers on a standard keyboard)
$originalChars = array_merge(
    range('A', 'Z'),
    range('a', 'z'),
    range('0', '9'),
    str_split('!@#$%^&*()_+-=[]{}|;:,.<>?/~`"\'\\')
);

// Shuffle the original characters to create a substitution set
$substitutionChars = $originalChars;
// Set a specific seed value so that shuffle is always same even restart
mt_srand(866619);
shuffle($substitutionChars);


function encrypt($plaintext, $originalChars, $substitutionChars) {
    $ciphertext = '';

    for ($i = 0; $i < strlen($plaintext); $i++) {
        $char = $plaintext[$i];
        $index = array_search($char, $originalChars);

        if ($index !== false) {
            $ciphertext .= $substitutionChars[$index];
        } else {
            $ciphertext .= $char; // Keep the character as is if not found in the original set
        }
    }

    return $ciphertext;
}

function decrypt($ciphertext, $originalChars, $substitutionChars) {
    $plaintext = '';

    for ($i = 0; $i < strlen($ciphertext); $i++) {
        $char = $ciphertext[$i];
        $index = array_search($char, $substitutionChars);

        if ($index !== false) {
            $plaintext .= $originalChars[$index];
        } else {
            $plaintext .= $char; // Keep the character as is if not found in the substitution set
        }
    }

    return $plaintext;
}

?>
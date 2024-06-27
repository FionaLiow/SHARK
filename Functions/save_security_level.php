<?php
session_start();

if (isset($_POST['security'])) {
    $securityLevel = $_POST['security'];
    $_SESSION['securityLevel'] = $securityLevel;
} else {
    echo 'Error: Security level not received';
}
?>

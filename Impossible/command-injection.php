<?php include '../base.php';
session_start();

include '../Functions/session.php';

// Generate CSRF token
generateSessionToken();

$target = '';
$cmd = '';
?>

<div class="body-content">
    <div class="challenge-title" style="display: flex; align-items: center">
        <h1>Command Injection</h1>
        <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #0000D1;">Impossible</span></h2>
    </div>
    <?php include '../Description/description.php';
    $html = ''; ?>
    </br>
    <div class="form_zone">
        <p>Ping a device using IP address :</p>
        <form action="" method="post">
            <input type="hidden" name="user_token" value="<?php echo $_SESSION['session_token']; ?>">
            <input type="text" name="ip" id="ip" placeholder="Enter IP address">
            <button type="submit" name="Submit">Submit</button>
        </form>
    </div>


    <?php

    if (isset($_POST['Submit'])) {
        // Check Anti-CSRF token
        checkToken($_REQUEST['user_token'], $_SESSION['session_token'], 'index.php');

        $target = $_REQUEST['ip'];
        $target = stripslashes($target);

        // Split the IP into 4 octects
        $octet = explode(".", $target);

        // Check IF each octet is an integer
        if ((is_numeric($octet[0])) && (is_numeric($octet[1])) && (is_numeric($octet[2])) && (is_numeric($octet[3])) && (sizeof($octet) == 4)) {
            // If all 4 octets are int's put the IP back together.
            $target = $octet[0] . '.' . $octet[1] . '.' . $octet[2] . '.' . $octet[3];

            if (stristr(php_uname('s'), 'Windows NT')) {
                $cmd = shell_exec('ping  ' . $target);
            } else {
                $cmd = shell_exec('ping  -c 4 ' . $target);
            }

        } else {
            $cmd =  '<pre>ERROR: You have entered an invalid IP.</pre>';
        }
    }

    // Generate Anti-CSRF token
    generateSessionToken();

    ?>

    <div class="form_result">
        <h3>Ping Result</h3>
        <?php echo ("Target : " . $target); ?>
        <?php echo "<pre>{$cmd}</pre>"; ?>
    </div>
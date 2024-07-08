<?php include '../base.php'; 
$target='';
$cmd='';?>

<div class="body-content">
    <div class="challenge-title" style="display: flex; align-items: center">
        <h1>Command Injection</h1>
        <h2>&nbsp;&nbsp;-&nbsp;<span style="color: red;">Low</span></h2>
    </div>
    <?php include '../Description/description.php';
    $html = ''; ?>
</br>
    <div class="form_zone">
        <p>Ping a device using IP address :</p>
        <form action="" method="post">
            <input type="text" name="ip" id="ip" placeholder="Enter IP address">
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>

    <?php

    if (isset($_POST['submit'])) {
        $target = $_POST['ip'];

        // Determine OS and execute the ping command.
        if (stristr(php_uname('s'), 'Windows NT')) {
            // Windows
            $cmd = shell_exec('ping  ' . $target);
        } else {
            // unix
            $cmd = shell_exec('ping  -c 4 ' . $target);
        }

        // Ping result
        // echo "<pre>{$cmd}</pre>";
    }

    ?>

    <div class="form_result">
        <h3>Ping Result</h3>
        <?php echo ("Target : " . $target); ?>
        <?php echo "<pre>{$cmd}</pre>"; ?>
    </div>
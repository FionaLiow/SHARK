<?php include '../base.php';
include '../Functions/session.php';
session_start();

// Generate CSRF token
generateSessionToken(); ?>

<div class="body-content">
    <div class="challenge-title" style="display: flex; align-items: center">
        <h1>Brute Force</h1>
        <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #2CF4EE;">High</span></h2>
    </div>
    <?php include '../Description/description.php';
    include '../sql_users_conn.php';
    $html = '';
    $profilepic = ''; ?>

    <div class="form_zone">
        <p>Cartoon World Login :</p>
        <form action="" method="get">
            <input type="hidden" name="user_token" value="<?php echo $_SESSION['session_token']; ?>">
            <input type="text" name="username" id="username" placeholder="Enter the username">
            <input type="text" name="password" id="password" placeholder="Enter the password">
            <button type="submit" name="brute-force-submit">Login</button>
        </form>
    </div>

    <?php

    if (isset($_GET['brute-force-submit'])) {
        // Check Anti-CSRF token
        checkToken($_REQUEST['user_token'], $_SESSION['session_token'], 'index.php');

        $user = mysqli_real_escape_string($conn, $_GET['username']);
        $user = stripslashes($user); //to remove backslash

        $pass = mysqli_real_escape_string($conn, $_GET['password']);
        $pass = stripslashes($pass);
        $pass = md5($pass);


        $query  = "SELECT * FROM `users` WHERE user_name = '$user' AND password = '$pass';";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $profilepic = $row["profile_pic"];

            // Login successful
            $html = "<p>Welcome to cartoon world, {$user} !</p>";
        } else {
            // Login failed
            sleep(rand(0, 3));
            $html = "<pre><br />Username and/or password incorrect.</pre>";
        }

        mysqli_free_result($result);
        mysqli_close($conn);
    }

    // Generate Anti-CSRF token
    generateSessionToken();
    ?>

    <div class="form_result">
        <h3>User Profile</h3>
        <?php echo $html; ?>
        <img style="width: 400px;" src=<?php echo $profilepic; ?>>
    </div>
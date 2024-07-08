<?php
include '../base.php';
include '../Functions/session.php';
session_start();

// Generate CSRF token 
generateSessionToken();
?>

<div class="body-content">
    <div class="challenge-title" style="display: flex; align-items: center">
        <h1>Brute Force</h1>
        <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #0000D1;">Impossible</span></h2>
    </div>
    <?php include '../Description/description.php';
    include '../sql_users_conn.php';
    $html = '';
    $profilepic = '';
    ?>

    <div class="form_zone">
        <p>Cartoon World Login :</p>
        <form action="" method="post">
            <input type="hidden" name="user_token" value="<?php echo $_SESSION['session_token']; ?>">
            <input type="text" name="username" id="username" placeholder="Enter the username">
            <input type="text" name="password" id="password" placeholder="Enter the password">
            <button type="submit" name="brute-force-submit">Login</button>
        </form>
    </div>

    <?php
    if (isset($_POST['brute-force-submit']) && isset($_POST['username']) && isset($_POST['password'])) {

        // Check Anti-CSRF token
        checkToken($_REQUEST['user_token'], $_SESSION['session_token'], 'index.php');

        $user = mysqli_real_escape_string($conn, $_POST['username']);
        $user = stripslashes($user);
        $pass = mysqli_real_escape_string($conn, $_POST['password']);
        $pass = stripslashes($pass);
        $pass = md5($pass);

        // Default values for account login threshold
        $total_failed_login = 3;
        $lockout_time = 15;
        $account_locked = false;

        // Check the database (Check login information)
        $query = 'SELECT failed_login, last_login FROM users WHERE user_name = ? LIMIT 1;';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $user);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Check to see if the user has been locked out.
        if ($result->num_rows == 1 && $row['failed_login'] >= $total_failed_login) {
            // Calculate when the user would be allowed to login again
            $last_login = strtotime($row['last_login']);
            $timeout = $last_login + ($lockout_time * 60);
            $timenow = time();

            // Check to see if enough time has passed, if it hasn't locked the account
            if ($timenow < $timeout) {
                $account_locked = true;
            }
        }

        // Check the database (if username matches the password)
        $query = 'SELECT * FROM users WHERE user_name = ? AND password = ? LIMIT 1;';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $user, $pass);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // If it's a valid login...
        if ($result->num_rows == 1 && !$account_locked) {
            $profilepic = $row['profile_pic'];

            // Login successful
            $html = "<p>Welcome to cartoon world, {$user}!</p>";

            // Had the account been locked out since last login?
            if ($row['failed_login'] >= $total_failed_login) {
                $html .= "<p><em>Warning</em>: Someone might have been brute-forcing your account.</p>";
                $html .= "<p>Number of login attempts: <em>{$row['failed_login']}</em>. Last login attempt was at: <em>{$row['last_login']}</em>.</p>";
            }

            // Reset bad login count
            $query = 'UPDATE users SET failed_login = 0 WHERE user_name = ? LIMIT 1;';
            $stmt = $conn->prepare($query);
            $stmt->bind_param('s', $user);
            $stmt->execute();
        } else {
            // Login failed
            sleep(rand(2, 4));

            // Give the user some feedback
            $html = "<pre><br />Username and/or password incorrect.<br /><br/>Alternatively, the account has been locked because of too many failed logins. Please try again in {$lockout_time} minutes.</pre>";

            // Update bad login count
            $query = 'UPDATE users SET failed_login = failed_login + 1 WHERE user_name = ? LIMIT 1;';
            $stmt = $conn->prepare($query);
            $stmt->bind_param('s', $user);
            $stmt->execute();
        }

        // Set the last login time
        $query = 'UPDATE users SET last_login = now() WHERE user_name = ? LIMIT 1;';
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $user);
        $stmt->execute();
    }

    // Generate Anti-CSRF token
    generateSessionToken();
    ?>

    <div class="form_result">
        <h3>User Profile</h3>
        <?php echo $html; ?>
        <img style="width: 400px;" src=<?php echo $profilepic; ?>>
    </div>
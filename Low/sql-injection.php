<?php include '../base.php'; ?>

<div class="body-content">
    <div class="challenge-title" style="display: flex; align-items: center">
        <h1>SQL Injection</h1>
        <h2>&nbsp;&nbsp;-&nbsp;<span style="color: red;">Low</span></h2>
    </div>
    <?php include '../Description/description.php';
    include '../sql_users_conn.php';
    $html = ''; ?>

    <div class="form_zone">
        <p>Find user with user ID :</p>
        <form action="" method="post">
            <input type="text" name="user_id" id="user_id" placeholder="Enter the user ID">
            <button type="submit">Submit</button>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['user_id'];

        $query  = "SELECT user_id, user_name, email FROM users WHERE user_id = '$id';";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $user_id = $row["user_id"];
                $user_name = $row["user_name"];
                $email = $row["email"];

                $html .= "<p><span>ID: </span>{$user_id}</p><p><span>Username: </span> {$user_name}</p><p><span>Email: </span> {$email}</p>";
            }
        } else {
            $html = "No user found";
        }
        // Free result set
        mysqli_free_result($result);
    }

    // Close connection
    mysqli_close($conn);
    ?>

    <div class="form_result">
        <h3>User Information</h3>
        <?php echo $html; ?>
    </div>
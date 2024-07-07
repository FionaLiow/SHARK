<?php include '../base.php'; ?>

<div class="body-content">
    <div class="challenge-title" style="display: flex; align-items: center">
        <h1>Blind SQL Injection</h1>
        <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #FFA500;">Medium</span></h2>
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
        $substring_to_remove = array("-", "#", "%");
        $submitted_id = str_replace($substring_to_remove, "", $id);
        $query  = "SELECT user_id, user_name, email FROM users WHERE user_id = '$submitted_id';";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $exists = mysqli_num_rows($result) > 0;

            if ($exists) {
                $html = '<p>User ID <span style="color: #00008B;">EXISTS</span> in the database.</p>';
            } else {
                http_response_code(404);
                $html = '<p>User ID is <span style="color: red;">MISSING</span> from the database.</p>';
            }

            mysqli_free_result($result);
        } else {
            // Query execution error
            $html = "Error: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
    ?>

    <div class="form_result">
        <h3>User Information</h3>
        <?php echo $html; ?>
    </div>
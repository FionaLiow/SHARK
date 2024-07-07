<?php include '../base.php'; ?>

<div class="body-content">
    <div class="challenge-title" style="display: flex; align-items: center">
        <h1>Blind SQL Injection</h1>
        <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #0000D1;">Impossible</span></h2>
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
        if (isset($_POST['user_id']) && is_numeric($_POST['user_id'])) {
            $id = $_POST['user_id'];

            // Prepare SQL statement with placeholders
            $query = "SELECT user_id, user_name, email FROM users WHERE user_id = ?";

            // Prepare the statement
            $stmt = mysqli_prepare($conn, $query);

            if ($stmt) {
                // Bind the parameters
                mysqli_stmt_bind_param($stmt, "i", $id);

                // Execute the statement
                mysqli_stmt_execute($stmt);

                // Get result
                $result = mysqli_stmt_get_result($stmt);

                if ($result) {
                    // Check if user exists
                    if (mysqli_num_rows($result) > 0) {
                        $html = '<p>User ID <span style="color: #00008B;">EXISTS</span> in the database.</p>';
                    } else {
                        http_response_code(404);
                        $html = '<p>User ID is <span style="color: red;">MISSING</span> from the database.</p>';
                    }

                    // Free result set
                    mysqli_free_result($result);
                } else {
                    // Query execution error
                    $error_message = "Error: " . mysqli_stmt_error($stmt);
                }

                // Close statement
                mysqli_stmt_close($stmt);
            } else {
                // Statement preparation error
                $error_message = "Error preparing statement: " . mysqli_error($conn);
            }

            // Close connection
            mysqli_close($conn);
        } else {
            $html = '<p>Please enter a valid user ID.</p>';
        }
    } else {
        $html = '<p>Please enter a valid user ID.</p>';
    }
    ?>

    <div class="form_result">
        <h3>User Information</h3>
        <?php echo $html; ?>
    </div>
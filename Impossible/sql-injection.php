<?php include '../base.php'; ?>

<div class="body-content">
    <div class="challenge-title" style="display: flex; align-items: center">
        <h1>SQL Injection</h1>
        <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #0000D1;">Impossible</span></h2>
    </div>
    <?php include '../Description/description.php';
    include '../sql_users_conn.php' ?>

    <div class="form_zone">
        <p>Find user with user ID :</p>
        <form action="" method="post">
            <input type="text" name="user_id" id="user_id" placeholder="Enter the user ID">
            <button type="submit">Submit</button>
        </form>
    </div>
    <div class="form_result">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user_id = intval($_POST['user_id']);

            // Prepare and execute the SQL statement
            $sql = "SELECT user_id, user_name, email FROM users WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $stmt->bind_result($id, $username, $email);
            $stmt->store_result();

            // Check if any user was found
            if ($stmt->num_rows > 0) {
                while ($stmt->fetch()) {
                    echo "<h3>User Information</h3>";
                    echo "<p><span>ID:</span> " . htmlspecialchars($id) . "</p>";
                    echo "<p><span>Username:</span> " . htmlspecialchars($username) . "</p>";
                    echo "<p><span>Email:</span> " . htmlspecialchars($email) . "</p>";
                }
            } else {
                echo "<p>No user found</p>";
            }

            // Close the statement and connection
            $stmt->close();
            $conn->close();
        }

        ?>

    </div>




</div>
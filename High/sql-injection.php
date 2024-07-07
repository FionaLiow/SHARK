<?php include '../base.php'; ?>

<div class="body-content">
    <div class="challenge-title" style="display: flex; align-items: center">
        <h1>SQL Injection</h1>
        <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #2CF4EE;">High</span></h2>
    </div>
    <?php include '../Description/description.php';
    include '../sql_users_conn.php';
    $html = ''; ?>

    <div class="form_zone">
        <p>Find user with user ID :</p>
        <form action="" method="post">
            <select name="user_id_opt" class="user_id_select">
                <option value="1" <?php if (isset($_POST['user_id_opt']) && $_POST['user_id_opt'] == '1') echo 'selected'; ?>>1</option>
                <option value="2" <?php if (isset($_POST['user_id_opt']) && $_POST['user_id_opt'] == '2') echo 'selected'; ?>>2</option>
                <option value="3" <?php if (isset($_POST['user_id_opt']) && $_POST['user_id_opt'] == '3') echo 'selected'; ?>>3</option>
            </select>
            <button type="submit">Submit</button>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['user_id_opt'];
        $substring_to_remove = array("--", "or");
        $submitted_id = str_replace($substring_to_remove, "", $id);

        $query  = "SELECT user_id, user_name, email FROM users WHERE user_id = '$submitted_id' LIMIT 1;";
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
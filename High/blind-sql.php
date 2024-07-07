<?php include '../base.php'; ?>

<div class="body-content">
    <div class="challenge-title" style="display: flex; align-items: center">
        <h1>Blind SQL Injection</h1>
        <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #2CF4EE;">High</span></h2>
    </div>
    <?php include '../Description/description.php';
    include '../sql_users_conn.php';
    $html = ''; ?>

    <div class="form_zone">
        <p>Find user with user ID :</p>
        <form action="" method="get">
            <select name="user_id_opt" class="user_id_select">
                <option value="1" <?php if (isset($_GET['user_id_opt']) && $_GET['user_id_opt'] == '1') echo 'selected'; ?>>1</option>
                <option value="2" <?php if (isset($_GET['user_id_opt']) && $_GET['user_id_opt'] == '2') echo 'selected'; ?>>2</option>
                <option value="3" <?php if (isset($_GET['user_id_opt']) && $_GET['user_id_opt'] == '3') echo 'selected'; ?>>3</option>
                <option value="4" <?php if (isset($_GET['user_id_opt']) && $_GET['user_id_opt'] == '4') echo 'selected'; ?>>4</option>
                <option value="5" <?php if (isset($_GET['user_id_opt']) && $_GET['user_id_opt'] == '5') echo 'selected'; ?>>5</option>
            </select>
            <button type="submit">Submit</button>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['user_id_opt'])) {
        $id = $_GET['user_id_opt'];
        $substring_to_remove = array("-", "#", "%");
        $submitted_id = str_replace($substring_to_remove, "", $id);
        $query  = "SELECT user_id, user_name, email FROM users WHERE user_id = '$submitted_id' LIMIT 1;";
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
<?php
include '../base.php';
$redirect_url = '';

// PHP logic to handle redirection
if (isset($_GET['redirect']) && !empty($_GET['redirect'])) {
    $redirect_url = $_GET['redirect'];
    header("Location: $redirect_url");
    exit;
}

// If no valid redirect parameter is provided, set HTTP response code and display message
http_response_code(500);
?>

<div class="body-content">
    <div class="challenge-title" style="display: flex; align-items: center">
        <h1>Open HTTP Redirect</h1>
        <h2>&nbsp;&nbsp;-&nbsp;<span style="color: red;">Low</span></h2>
    </div>
    <?php include '../Description/description.php'; ?>
    </br>
    <div class="form_zone">
        <p>
            Below, you'll find two links to insightful food reviews by a renowned food critic
        </p>
        <ul>
            <li><a href='?redirect=http://localhost/SHARK/Profile/food_review/fr1.php'>Food Review 1</a></li>
            <li><a href='?redirect=http://localhost/SHARK/Profile/food_review/fr2.php'>Food Review 2</a></li>
        </ul>
    </div>

</div>
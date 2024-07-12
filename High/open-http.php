<?php
include '../base.php';


if (array_key_exists("redirect", $_GET) && $_GET['redirect'] != "") {
    if (strpos($_GET['redirect'], "fr1.php") !== false || strpos($_GET['redirect'], "fr2.php") !== false) {
        header("location: " . $_GET['redirect']);
        exit;
    } else {
        http_response_code(500);
?>
        <div class="body-content">
            <h2><i class="fa-solid fa-exclamation fa-bounce" style="color: #ff0000;"></i>&nbsp;&nbsp;Absolute URLs not allowed.</h2>
        </div>
<?php
        exit;
    }
}

http_response_code(500);
?>


<div class="body-content">
    <div class="challenge-title" style="display: flex; align-items: center">
        <h1>Open HTTP Redirect</h1>
        <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #2CF4EE;">High</span></h2>
    </div>
    <?php include '../Description/description.php'; ?>
    </br>
    <div class="form_zone">
        <p>
            Below, you'll find two links to insightful food reviews by a renowned food critic
        </p>
        <ul>
            <li><a href='?redirect=../Profile/food_review/fr1.php'>Food Review 1</a></li>
            <li><a href='?redirect=../Profile/food_review/fr2.php'>Food Review 2</a></li>
        </ul>
    </div>
</br>
</div>
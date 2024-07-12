<?php
include '../base.php';
$target = "";

if (array_key_exists("redirect", $_GET) && $_GET['redirect'] != "") {
    switch ($_GET['redirect']) {
        case "../Profile/food_review/fr1.php":
            $target = "../Profile/food_review/fr1.php";
            break;
        case "../Profile/food_review/fr2.php":
            $target = "../Profile/food_review/fr2.php";
            break;
    }
    if ($target != "") {
        header("location: " . $target);
        exit;
    } else {
?>
        <div class="body-content">
            <h2><i class="fa-solid fa-exclamation fa-bounce" style="color: #ff0000;"></i>&nbsp;&nbsp;Unknown redirect target.</h2>
        </div>
    <?php
        exit;
    }
}

?>


<div class="body-content">
    <div class="challenge-title" style="display: flex; align-items: center">
        <h1>Open HTTP Redirect</h1>
        <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #0000D1;">Impossible</span></h2>
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
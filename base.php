<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<link rel="icon" type="image/x-icon" href="Image/shark.ico">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    if (str_contains($_SERVER['REQUEST_URI'], "High") || str_contains($_SERVER['REQUEST_URI'], "Medium") || str_contains($_SERVER['REQUEST_URI'], "Low") || str_contains($_SERVER['REQUEST_URI'], "Impossible")) {
    ?>
        <link rel="stylesheet" type="text/css" href="../Style/home.css">
        <link rel="stylesheet" type="text/css" href="../Style/base.css">
    <?php
    } else {
    ?>
        <link rel="stylesheet" type="text/css" href="Style/home.css">
        <link rel="stylesheet" type="text/css" href="Style/base.css">
    <?php
    }
    ?>
    <title>SHARK</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"> -->
</head>

<body>
    <header>
        <div class="logo-container">
            <?php
            if (str_contains($_SERVER['REQUEST_URI'], "High") || str_contains($_SERVER['REQUEST_URI'], "Medium") || str_contains($_SERVER['REQUEST_URI'], "Low") || str_contains($_SERVER['REQUEST_URI'], "Impossible")) {
            ?>
                <a href="../home.php">
                    <img src="../Image/shark.ico" alt="Website Logo" class="logo">
                    <h1>S.H.A.R.K</h1>
                </a>
            <?php
            } else {
            ?>
                <a href="home.php">
                    <img src="Image/shark.ico" alt="Website Logo" class="logo">
                    <h1>S.H.A.R.K</h1>
                </a>
            <?php
            }
            ?>
        </div>
        <div class="sec-level">
            <form method="POST" id="security-form">
                <label for="security">Security Level:</label>
                <select id="security" name="security">
                    <option value="" class="hidden">
                        <?php echo isset($_SESSION['securityLevel']) ? $_SESSION['securityLevel'] : "Choose an Option"; ?>
                    </option>
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                    <option value="Impossible">Impossible</option>
                </select>
            </form>
            <?php
            if (str_contains($_SERVER['REQUEST_URI'], "High") || str_contains($_SERVER['REQUEST_URI'], "Medium") || str_contains($_SERVER['REQUEST_URI'], "Low") || str_contains($_SERVER['REQUEST_URI'], "Impossible")) {
            ?>
                <script src="../JS/hands-on.js"></script>
            <?php
            } else {
            ?>
                <script src="JS/base.js"></script>
            <?php
            }
            ?>
        </div>
    </header>

    <input type="checkbox" name="" id="check">
    <div class="sidebar-container">
        <div class="nav-btn">
            <label for="check">
                <i class="fas fa-times" id="times"></i>
                <i class="fas fa-bars" id="bars"></i>
            </label>
        </div>
        <div class="head">Menu</div>
        <ol>
            <?php
            if (str_contains($_SERVER['REQUEST_URI'], "High") || str_contains($_SERVER['REQUEST_URI'], "Medium") || str_contains($_SERVER['REQUEST_URI'], "Low") || str_contains($_SERVER['REQUEST_URI'], "Impossible")) {
            ?>
                <li><a href="../profile.php"><i class="fa-solid fa-user"></i>Profile</a></li>
                <li><a href="../hands-on.php"><i class="fa-solid fa-flask"></i>Hands-on</a></li>
                <li><a href="../tutorial.php"><i class="fa-solid fa-wand-sparkles"></i>Tutorials</a></li>
                <li><a href="../tools.php"><i class="fa-solid fa-screwdriver-wrench"></i>Tools</a></li>
                <li><a href="../home.php"><i class="fa-solid fa-circle-info"></i>About</a></li>
                <script src="../JS/sidebar.js"></script>
            <?php
            } else {
            ?>
                <li><a href="profile.php"><i class="fa-solid fa-user"></i>Profile</a></li>
                <li><a href="hands-on.php"><i class="fa-solid fa-flask"></i>Hands-on</a></li>
                <li><a href="tutorial.php"><i class="fa-solid fa-wand-sparkles"></i>Tutorials</a></li>
                <li><a href="tools.php"><i class="fa-solid fa-screwdriver-wrench"></i>Tools</a></li>
                <li><a href="home.php"><i class="fa-solid fa-circle-info"></i>About</a></li>
            <?php
            }
            ?>
        </ol>
    </div>
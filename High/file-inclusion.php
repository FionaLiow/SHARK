<?php include '../base.php'; ?>

<div class="body-content">
    <div class="challenge-title" style="display: flex; align-items: center">
        <h1>File Inclusion</h1>
        <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #2CF4EE;">High</span></h2>
    </div>
    <?php include '../Description/description.php'; ?>
    <br>

    <?php
    if (isset($_GET['page'])) {
        $file = $_GET['page'];
        // Input validation
        if (strpos($file, 'profile') === false) {
            // File name does not contain 'profile'
            echo "ERROR: File not found!";
            exit;
        }
        $verified_file = str_replace(array("http://", "https://"), "", $file);
        $verified_file = str_replace(array("../", "..\\"), "", $file);
    ?>
        <div class="link-container">
            <?php include $verified_file; ?>
            <br>
            <a href="../High/file-inclusion.php">Back</a>
        </div>
    <?php
    } else {
    ?>
        </br>
        <p><span style="font-weight:bold;" class="rainbow-text" ;>HINT!</span> Your final mission is to find the hidden mesage left by those profiles.</p>
        <div class="link-container">
            <h2>View Profile Picture</h2>
            <a href="?page=profile1.php">Profile 1</a>
            <a href="?page=profile2.php">Profile 2</a>
            <a href="?page=profile3.php">Profile 3</a>
        </div>
    <?php
    }
    ?>
</div>
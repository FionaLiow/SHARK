<?php include '../base.php'; ?>

<div class="body-content">
    <div class="challenge-title" style="display: flex; align-items: center">
        <h1>File Inclusion</h1>
        <h2>&nbsp;&nbsp;-&nbsp;<span style="color: red;">Low</span></h2>
    </div>
    <?php include '../Description/description.php'; ?>
    <br>

    <?php
    if (isset($_GET['page'])) {
        $file = $_GET['page'];
    ?>
        <div class="link-container">
            <h1>Profile Picture</h1>
            <?php include $file; ?>
            <br>
            <a href="../Low/file-inclusion.php">Back</a>
        </div>
    <?php
    } else {
    ?>
        <div class="link-container">
            <h2>View Profile Picture</h2>
            <a href="?page=../Profile/profile1.php">Profile 1</a>
            <a href="?page=../Profile/profile2.php">Profile 2</a>
            <a href="?page=../Profile/profile3.php">Profile 3</a>
        </div>
    <?php
    }
    ?>
</div>
<?php include '../base.php'; ?>

<div class="body-content">
    <div class="challenge-title" style="display: flex; align-items: center">
        <h1>File Inclusion</h1>
        <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #0000D1;">Impossible</span></h2>
    </div>
    <?php include '../Description/description.php'; ?>
    <br>

    <?php
    if (isset($_GET['page'])) {
        $file = $_GET['page'];
        $allowed_files = ['profile1.php', 'profile2.php', 'profile3.php'];

        if (!in_array($file, $allowed_files)) {
            // File is not in the whitelist, exit the script
            echo "ERROR: File not found!";
            exit;
        }
    ?>
        <div class="link-container">
            <?php include $file; ?>
            <br>
            <a href="../Impossible/file-inclusion.php">Back</a>
        </div>
    <?php
    } else {
    ?>
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
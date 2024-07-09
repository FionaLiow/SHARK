<?php include '../base.php'; ?>

<div class="body-content">
    <div class="challenge-title" style="display: flex; align-items: center">
        <h1>File Upload</h1>
        <h2>&nbsp;&nbsp;-&nbsp;<span style="color: red;">Low</span></h2>
    </div>
    <?php include '../Description/description.php';
    $html = ''; ?>

    </br>
    <div class="form_zone">
        <p>Upload your image:</p>
        <form action="" method="post" enctype="multipart/form-data">
            <!-- <input type="hidden" name="MAX_FILE_SIZE" value="100000"> -->
            <input type="file" name="image" id="image">
            <button type="submit" name="upload">Upload</button>
        </form>
    </div>


    <?php

    if (isset($_POST['upload'])) {
        $target_path  = "../Uploads/Images/";
        $target_path .= basename($_FILES['image']['name']);

        // Can we move the file to the upload folder?
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
            // No
            $html = '<pre>Your image was not uploaded.</pre>';
        } else {
            // Yes
            $html =  "<pre>{$target_path} succesfully uploaded!</pre>";
        }
    }

    ?>

    <div class="form_result">
        <h3>Upload Information</h3>
        <?php echo $html; ?>
    </div>
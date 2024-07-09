<?php include '../base.php'; ?>

<div class="body-content">
    <div class="challenge-title" style="display: flex; align-items: center">
        <h1>File Upload</h1>
        <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #2CF4EE;">High</span></h2>
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

        $uploaded_name = $_FILES['image']['name'];
        $uploaded_tmp  = $_FILES['image']['tmp_name'];
        $uploaded_ext  = substr($uploaded_name, strrpos($uploaded_name, '.') + 1);
        $uploaded_size = $_FILES['image']['size'];


        if ((strtolower($uploaded_ext) == "jpg" || strtolower($uploaded_ext) == "jpeg" || strtolower($uploaded_ext) == "png") &&
            ($uploaded_size < 10000000000)
        ) {

            if (!move_uploaded_file($uploaded_tmp, $target_path)) {
                $html = '<pre>Your image was not uploaded.</pre>';
            } else {
                $html = "<pre>{$target_path} succesfully uploaded!</pre>";
            }
        } else {
            // Invalid file
            $html = '<pre>Your image was not uploaded. We can only accept JPEG or PNG images.</pre>';
        }
    }

    ?>

    <div class="form_result">
        <h3>Upload Information</h3>
        <?php echo $html; ?>
    </div>
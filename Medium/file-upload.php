<?php include '../base.php'; ?>

<div class="body-content">
    <div class="challenge-title" style="display: flex; align-items: center">
        <h1>File Upload</h1>
        <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #FFA500;">Medium</span></h2>
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
        $target_dir = "../Uploads/Images/";
        $target_path = $target_dir . basename($_FILES['image']['name']);
  
        $uploaded_name = $_FILES['image']['tmp_name'];
        $uploaded_type = $_FILES['image']['type'];
        $uploaded_size = $_FILES['image']['size'];

        if (($uploaded_type == "image/jpeg" || $uploaded_type == "image/png") &&
            ($uploaded_size < 10000000000)
        ) {
            
            if (!move_uploaded_file($uploaded_name, $target_path)) {
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
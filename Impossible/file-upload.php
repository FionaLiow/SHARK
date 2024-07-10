<?php include '../base.php';
include '../Functions/session.php';
generateSessionToken(); ?>

<div class="body-content">
    <div class="challenge-title" style="display: flex; align-items: center">
        <h1>File Upload</h1>
        <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #0000D1;">Impossible</span></h2>
    </div>
    <?php include '../Description/description.php';
    $html = ''; ?>

    </br>
    <div class="form_zone">
        <p>Upload your image:</p>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="image" id="image">
            <input type="hidden" name="user_token" value="<?php echo $_SESSION['session_token']; ?>">
            <button type="submit" name="upload">Upload</button>
        </form>
    </div>




    <?php

    if (isset($_POST['upload'])) {
        // Check Anti-CSRF token
        checkToken($_REQUEST['user_token'], $_SESSION['session_token'], 'index.php');


        // File information
        $uploaded_name = $_FILES['image']['name'];
        $uploaded_ext  = substr($uploaded_name, strrpos($uploaded_name, '.') + 1);
        $uploaded_size = $_FILES['image']['size'];
        $uploaded_type = $_FILES['image']['type'];
        $uploaded_tmp  = $_FILES['image']['tmp_name'];

        $target_path  = "../Uploads/Images/";
        $target_file   =  md5(uniqid() . $uploaded_name) . '.' . $uploaded_ext;
        $temp_file     = ((ini_get('upload_tmp_dir') == '') ? (sys_get_temp_dir()) : (ini_get('upload_tmp_dir')));
        $temp_file    .= DIRECTORY_SEPARATOR . md5(uniqid() . $uploaded_name) . '.' . $uploaded_ext;

        if ((strtolower($uploaded_ext) == 'jpg' || strtolower($uploaded_ext) == 'jpeg' || strtolower($uploaded_ext) == 'png') &&
            ($uploaded_size < 10000000000) &&
            ($uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png')&&getimagesize( $uploaded_tmp )
        ) {

            // Strip any metadata, by re-encoding image (using  php-GD library)
            if ($uploaded_type == 'image/jpeg') {
                $img = imagecreatefromjpeg($uploaded_tmp);
                imagejpeg($img, $temp_file, 9);
            } else {
                $img = imagecreatefrompng($uploaded_tmp);
                imagepng($img, $temp_file, 9);
            }
            imagedestroy($img);

            if (rename($temp_file, (getcwd() . DIRECTORY_SEPARATOR . $target_path . $target_file))) {
                $html = "<pre><a href='{$target_path}{$target_file}'>{$uploaded_name} ({$target_file})</a> successfully uploaded!</pre>";
            } else {
                $html = '<pre>Your image was not uploaded.</pre>';
            }

            // Delete any temp files
            if (file_exists($temp_file))
                unlink($temp_file);
        } else {
            // Invalid file
            $html =  '<pre>Your image was not uploaded. We can only accept JPEG or PNG images.</pre>';
        }
    }

    // Generate Anti-CSRF token
    generateSessionToken();

    ?>

    <div class="form_result">
        <h3>Upload Information</h3>
        <?php echo $html; ?>
    </div>
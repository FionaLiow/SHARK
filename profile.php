<?php include 'base.php'; ?>

<div class="body-content">
    <?php
    // Check if the username session variable is set
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    } else {
        // Redirect to login page or handle case where session variable is not set
        header("Location: ../login.php");
        exit;
    }
    ?>

    <style>
        .heading-border {
            width: 180px;
            height: 15px;
            background-color: #3b3b3b;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            border-top: 1px solid #ccc;
            border-left: 1px solid #ccc;
            border-right: 1px solid #ccc;
            padding: 5px 20px 20px 20px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            color: white;
        }
    </style>

    <h1><span style="font-weight: normal;">Username : </span><?php echo $username; ?></h1></br>
    <h1><span style="font-weight: normal;">Role : # Web Application Security Learner &nbsp # Web Application Security Practitioner </br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp # Web Application Security Hands-on Beginner</span></h1></br></br>


    <h2 class="heading-border">Your Badges</h2>
    <div class="badge" style="width: 100%; padding: 30px; display:flex; flex-direction: column; justify-content: center; margin-bottom: 20px; background-color:#ededed;">

        <div class="badges-img" style="display: flex;">


            <a href="Image/shark_badge.jpg" target="_blank">
                <img src="Image/shark_badge.jpg" alt="Welcome" class="image" style="width: 300px; border-radius:20px; margin-left: 20px; margin-right: 30px;"></br></br>
            </a>

            <a href="Image/shark_badge2.jpg" target="_blank">
                <img src="Image/shark_badge2.jpg" alt="Welcome" class="image" style="width: 300px; border-radius:20px; margin-right: 30px;"></br></br>
            </a>

        </div>

        <p>&nbsp Click to open the badge ...</p>
    </div>

<div class="space" style="padding-top:100px;"></div>
    
    <div class="profile-text" style="font-size: 18px; background-color:#e6e6fa; color:#525252;">
        <p style="margin-left: 100px;">Thank you for taking your first step towards a safer web application.</p>
        <p style="margin-left: 600px;">Together, we can make the web a more secure place.</p>
        <p style="margin-left: 900px;">Your dedication to learning and practicing security principles is commendable. <i class="fa-solid fa-face-grin-wide fa-beat-fade" style="color: #8065d2;"></i>&nbsp<i class="fa-solid fa-thumbs-up fa-shake" style="color: #8065d2;"></i></p>
    </div></br></br>









</div>
</body>

</html>
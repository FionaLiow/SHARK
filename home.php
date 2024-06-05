<?php include 'base.php';
session_start();

// Check if the username session variable is set
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // Redirect to login page or handle case where session variable is not set
    header("Location: ../login.php");
    exit;
}

?>

<div class="body-content">
    <h1>Hi, <?php echo $username; ?> !</h1> <br />
    <h1>Welcome to Super Hackable And Real-hacking Knowledge Web Application !</h1><br />
    <p>Super Hackable And Real-hacking Knowledge Web Application (SHARK) is a PHP/MySQL web application that provides safe and legal way to learn about web application security. It's a web app designed to be intentionally vulnerable, allowing security professionals, developers, and students to practice finding and exploiting common security flaws in a controlled environment.</p>
    <hr />
    <br />

    <h2><i class="fa-solid fa-book-bookmark"></i>&nbsp General Instructions</h2><br />
    <p>There's no specific order you have to follow when using SHARK. You can either work through each vulnerability module at a set difficulty level, or choose any module and try to exploit it at increasing difficulty levels until you reach the highest one. There's no official way to "complete" a module, but you should feel satisfied that you've successfully exploited the vulnerability as much as possible.
    <p>Remember, SHARK has both known and hidden vulnerabilities. You're encouraged to explore and discover as many issues as you can. For each vulnerability, SHARK provides hints and tips, as well as links to learn more about the specific security issue.</p>
    <hr />
    <br />

    <h2><i class="fa-solid fa-triangle-exclamation" style="color: red;"></i>&nbsp WARNING!</h2><br />
    <p>SHARK is designed to be intentionally vulnerable. Do not upload it to your web hosting provider or any public servers, as they will be compromised.</p><br />
    <h2>It is recommended to:</h2><br />
    <p>1. Use a virtual machine (like VirtualBox or VMware) with NAT networking. </br>2. Inside the virtual machine, install XAMPP (web server and database) to run SHARK.</p>
    <br />
    <h2><i class="fa-solid fa-skull-crossbones"></i>&nbsp Disclaimer</h2><br />
    <p>We are not responsible for how users choose to utilize SHARK. It's designed for ethical learning and should not be misused. We've clearly outlined its purpose and implemented safeguards to prevent deployment on live servers. Any compromise of a web server due to SHARK installation is solely the responsibility of the individual who uploaded and installed it.</p>
    <hr />
    <br />
    <div class="Get-started">
        <div class="start-btn">
            <a href="hands-on.php">Get Started !</a>
        </div>
        <img src="Image/shark-welcome.jpg" alt="Welcome" class="image">
    </div>
</div>


</body>

</html>
<?php include 'base.php'; ?>

<link rel="stylesheet" type="text/css" href="Style/hands-on.css">

<div class="body-content">
    <div class="wrapper">
        <h2>Start by setting your desire level of security using the drop down list on the top right corner</h2>
        <h2>Then, you can proceed to any of the following vulnerability ...</h2>
        <div class="container">
            <div class="box">
                <img src="Image/sql_injection.png">
                <h3>SQL Injection</h3>
                <a href="<?php echo isset($_SESSION['securityLevel']) ? $_SESSION['securityLevel']."/sql-injection.php" : "javascript:alert('Please select a security level');" ; ?>" class="btn">Start</a>
            </div>
            <div class="box">
                <img src="Image/sql_injection.png">
                <h3>Blind SQL Injection</h3>
                <a href="<?php echo isset($_SESSION['securityLevel']) ? $_SESSION['securityLevel']."/blind-sql.php" : "javascript:alert('Please select a security level');" ; ?>" class="btn">Start</a>
            </div>
            <div class="box">
                <img src="Image/file_inclusion.png">
                <h3>File inclusion</h3>
                <a href="<?php echo isset($_SESSION['securityLevel']) ? $_SESSION['securityLevel']."/file-inclusion.php" : "javascript:alert('Please select a security level');" ; ?>" class="btn">Start</a>
            </div>
            <div class="box">
                <img src="Image/file_upload.png">
                <h3>File upload</h3>
                <a href="<?php echo isset($_SESSION['securityLevel']) ? $_SESSION['securityLevel']."/file-upload.php" : "javascript:alert('Please select a security level');" ; ?>" class="btn">Start</a>
            </div>
            <div class="box">
                <img src="Image/brute_force.png">
                <h3>Brute Force</h3>
                <a href="<?php echo isset($_SESSION['securityLevel']) ? $_SESSION['securityLevel']."/brute-force.php" : "javascript:alert('Please select a security level');" ; ?>" class="btn">Start</a>
            </div>
            <div class="box">
                <img src="Image/command_injection.png">
                <h3>Command Injection</h3>
                <a href="<?php echo isset($_SESSION['securityLevel']) ? $_SESSION['securityLevel']."/command-injection.php" : "javascript:alert('Please select a security level');" ; ?>" class="btn">Start</a>
            </div>
            <div class="box">
                <img src="Image/open_http.png">
                <h3>Open HTTP redirect</h3>
                <a href="<?php echo isset($_SESSION['securityLevel']) ? $_SESSION['securityLevel']."/open-http.php" : "javascript:alert('Please select a security level');" ; ?>" class="btn">Start</a>
            </div>
        </div>
    </div>
</div>


</body>

</html>
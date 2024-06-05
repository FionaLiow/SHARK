<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Style/login.css">
    <title>Login | Sign Up</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="login">
            <form id="login" method="POST" action="Functions/login.php">
                <label for="chk" aria-hidden="true">LOGIN</label>
                <input type="email" id="login_email" name="login_email" placeholder="Email" required="">
                <input type="password" id="login_pwsd" name="login_pwsd" placeholder="Password" required="">
                <button>Login</button>
            </form>
        </div>
        <div class="signup">
            <!-- <form id="registration" method="POST" action="Functions/register.php"> -->
            <form id="registration">
                <label for="chk" aria-hidden="true">SIGN UP</label>
                <input type="text" name="username" id="username" placeholder="Username" required="">
                <input type="email" name="email" id="email" placeholder="Email" required="">
                <input type="password" name="password" id="pwsd" placeholder="Password" required="">
                <input type="password" id="pwsdc" placeholder="Confirm Password" required="">
                <button type="submit">Sign Up</button>
            </form>
        </div>
        <script src="JS/register.js"></script>
</body>

</html>
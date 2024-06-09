<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Style/home.css">
    <link rel="stylesheet" type="text/css" href="Style/base.css">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <header>
        <div class="logo-container">
            <a href="home.php">
                <img src="Image/shark.ico" alt="Website Logo" class="logo">
                <h1>S.H.A.R.K</h1>
            </a>
        </div>
        <div class="sec-level">
            <form>
                <label for="dropdown">Security Level:</label>
                <select id="dropdown" name="dropdown">
                    <option value="impossible">Impossible</option>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
                <input type="submit" value="Submit">
            </form>
        </div>
    </header>

    <input type="checkbox" name="" id="check">
    <div class="sidebar-container">
        <div class="nav-btn">
            <label for="check">
                <i class="fas fa-times" id="times"></i>
                <i class="fas fa-bars" id="bars"></i>
            </label>
        </div>
        <div class="head">Menu</div>
        <ol>
            <li><a href="#"><i class="fa-solid fa-user"></i>Profile</a></li>
            <li><a href="hands-on.php"><i class="fa-solid fa-flask"></i>Hands-on</a></li>
            <li><a href="#"><i class="fa-solid fa-wand-sparkles"></i>Tutorials</a></li>
            <li><a href="#"><i class="fa-solid fa-screwdriver-wrench"></i>Tools</a></li>
            <li><a href="home.php"><i class="fa-solid fa-circle-info"></i>About</a></li>
        </ol>
    </div>
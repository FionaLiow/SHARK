<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Snippet & Explanations</title>
    <link rel="stylesheet" type="text/css" href="../code-snippet.css">
</head>

<body>
    <h1>Brute Force</h1>
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #2CF4EE;">High</span></h2></br>
    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Code Snippet</h3>
    </div>

    <div class="code-container">
        <pre><code>&lt;div class="form_zone"&gt;
        &lt;p&gt;Cartoon World Login :&lt;/p&gt;
        &lt;form action="" method="get"&gt;
            &lt;input type="hidden" name="user_token" value="&lt;?php echo $_SESSION['session_token']; ?&gt;"&gt;
            &lt;input type="text" name="username" id="username" placeholder="Enter the username"&gt;
            &lt;input type="text" name="password" id="password" placeholder="Enter the password"&gt;
            &lt;button type="submit" name="brute-force-submit"&gt;Login&lt;/button&gt;
        &lt;/form&gt;
    &lt;/div&gt;

    &lt;?php

    <span class="php-keyword">if</span> (isset(<span class="php-variable">$_GET</span>[<span class="php-string">'brute-force-submit'</span>])) {
        <span class="php-comment">// Check Anti-CSRF token</span>
        checkToken(<span class="php-variable">$_REQUEST</span>[<span class="php-string">'user_token'</span>], <span class="php-variable">$_SESSION</span>[<span class="php-string">'session_token'</span>], <span class="php-string">'index.php'</span>);

        <span class="php-variable">$user</span> = mysqli_real_escape_string(<span class="php-variable">$conn</span>, <span class="php-variable">$_GET</span>[<span class="php-string">'username'</span>]);
        <span class="php-variable">$user</span> = stripslashes(<span class="php-variable">$user</span>); <span class="php-comment">//to remove backslash</span>

        <span class="php-variable">$pass</span> = mysqli_real_escape_string(<span class="php-variable">$conn</span>, <span class="php-variable">$_GET</span>[<span class="php-string">'password'</span>]);
        <span class="php-variable">$pass</span> = stripslashes(<span class="php-variable">$pass</span>);
        <span class="php-variable">$pass</span> = md5(<span class="php-variable">$pass</span>);

        <span class="php-variable">$query</span>  = <span class="php-string">"SELECT * FROM `users` WHERE user_name = '$user' AND password = '$pass';"</span>;
        <span class="php-variable">$result</span> = mysqli_query(<span class="php-variable">$conn</span>, <span class="php-variable">$query</span>);

        <span class="php-keyword">if</span> (<span class="php-variable">$result</span> && mysqli_num_rows(<span class="php-variable">$result</span>) == 1) {
            <span class="php-variable">$row</span> = mysqli_fetch_assoc(<span class="php-variable">$result</span>);
            <span class="php-variable">$profilepic</span> = <span class="php-variable">$row</span>[<span class="php-string">"profile_pic"</span>];

            <span class="php-comment">// Login successful</span>
            <span class="php-variable">$html</span> = <span class="php-string">"&lt;p&gt;Welcome to cartoon world, {$user} !&lt;/p&gt;"</span>;
        } <span class="php-keyword">else</span> {
            <span class="php-comment">// Login failed</span>
            sleep(rand(0, 3));
            <span class="php-variable">$html</span> = <span class="php-string">"&lt;pre&gt;&lt;br /&gt;Username and/or password incorrect.&lt;/pre&gt;"</span>;
        }

        mysqli_free_result(<span class="php-variable">$result</span>);
        mysqli_close(<span class="php-variable">$conn</span>);
    }

    <span class="php-comment">// Generate Anti-CSRF token</span>
    generateSessionToken();
    ?&gt;
    </code></pre>
    </div>


    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Explanations</h3>
    </div>
    <div class="explanation">

        <h3>HTML Form Setup:</h3>
        <ul>
            <li><code>&lt;div class="form_zone"&gt;</code>: Creates a styled container for the login form.</li>
            <li><code>&lt;p&gt;Cartoon World Login :&lt;/p&gt;</code>: A paragraph explaining the form's purpose.</li>
            <li><code>&lt;form action="" method="get"&gt;</code>: Defines a form that submits data via the GET method to the same page.</li>
            <li><code>&lt;input type="hidden" name="user_token" value="<?php echo $_SESSION['session_token']; ?>"&gt;</code>: Hidden input field to include the Anti-CSRF token in the form submission.</li>
            <li><code>&lt;input type="text" name="username" id="username" placeholder="Enter the username"&gt;</code>: Text input for the username.</li>
            <li><code>&lt;input type="text" name="password" id="password" placeholder="Enter the password"&gt;</code>: Text input for the password.</li>
            <li><code>&lt;button type="submit" name="brute-force-submit"&gt;Login&lt;/button&gt;</code>: Submit button to send the form data.</li>
        </ul>

        <h3>Processing the Form Submission:</h3>
        <ul>
            <li><code>if (isset($_GET['brute-force-submit'])) { ... }</code>: Checks if the form was submitted via GET with the brute-force-submit parameter.</li>
            <li><code>checkToken($_REQUEST['user_token'], $_SESSION['session_token'], 'index.php');</code>: Calls a function to validate the Anti-CSRF token.</li>
            <li><code>$user = mysqli_real_escape_string($conn, $_GET['username']);</code>: Sanitizes the username to prevent SQL injection.</li>
            <li><code>$user = stripslashes($user);</code>: Removes backslashes from the username.</li>
            <li><code>$pass = mysqli_real_escape_string($conn, $_GET['password']);</code>: Sanitizes the password to prevent SQL injection.</li>
            <li><code>$pass = stripslashes($pass);</code>: Removes backslashes from the password.</li>
            <li><code>$pass = md5($pass);</code>: Hashes the password using MD5 (note: MD5 is not recommended for secure password hashing).</li>
            <li><code>$query = "SELECT * FROM users WHERE user_name = '$user' AND password = '$pass';";</code>: Prepares an SQL query to check the username and password.</li>
            <li><code>$result = mysqli_query($conn, $query);</code>: Executes the query against the database.</li>
        </ul>

        <h3>Handling the Query Result:</h3>
        <ul>
            <li><code>if ($result && mysqli_num_rows($result) == 1) { ... }</code>: Checks if the query returned exactly one row.</li>
            <li><code>$row = mysqli_fetch_assoc($result);</code>: Fetches the result as an associative array.</li>
            <li><code>$profilepic = $row["profile_pic"];</code>: Retrieves the profile picture from the result.</li>
            <li><code>$html = "&lt;p&gt;Welcome to cartoon world, {$user} !&lt;/p&gt;";</code>: Sets a success message if login is successful.</li>
            <li><code>else { ... }</code>: If the login fails:</li>
            <ul>
                <li><code>sleep(rand(0, 3));</code>: Adds a random delay to mitigate brute-force attacks.</li>
                <li><code>$html = "&lt;pre&gt;&lt;br /&gt;Username and/or password incorrect.&lt;/pre&gt;";</code>: Sets a failure message.</li>
            </ul>
            <li><code>mysqli_free_result($result);</code>: Frees the result set to release resources.</li>
            <li><code>mysqli_close($conn);</code>: Closes the database connection.</li>
        </ul>

        <h3>Anti-CSRF Token Generation:</h3>
        <ul>
            <li><code>generateSessionToken();</code>: Calls a function to generate a new Anti-CSRF token.</li>
        </ul>
</br>
        <h3><span style="color: #D10000;">Security Considerations:</span></h3>
        <ul>
            <li><strong>Anti-CSRF Protection:</strong> Uses a token to prevent CSRF attacks.</li>
            <li><strong>Input Sanitization:</strong> Sanitizes user inputs to prevent SQL injection.</li>
            <li><strong>Password Hashing:</strong> Uses MD5 for password hashing (recommendation: use stronger hashing algorithms like bcrypt or Argon2).</li>
            <li><strong>Random Sleep:</strong> Adds a random delay to mitigate brute-force attacks.</li>
        </ul>

    </div>




</body>

</html>
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
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #FFA500;">Medium</span></h2></br>
    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Code Snippet</h3>
    </div>

    <div class="code-container">
        <pre><code>&lt;div class="form_zone"&gt;
    &lt;p&gt;Cartoon World Login :&lt;/p&gt;
    &lt;form action="" method="get"&gt;
        &lt;input type="text" name="username" id="username" placeholder="Enter the username"&gt;
        &lt;input type="text" name="password" id="password" placeholder="Enter the password"&gt;
        &lt;button type="submit" name="brute-force-submit"&gt;Login&lt;/button&gt;
    &lt;/form&gt;
&lt;/div&gt;

&lt;?php
if (isset(<span class="php-variable">$_GET</span>[<span class="php-string">'brute-force-submit'</span>])) { 
    <span class="php-variable">$user</span> = <span class="php-function">mysqli_real_escape_string</span>(<span class="php-variable">$conn</span>, <span class="php-variable">$_GET</span>[<span class="php-string">'username'</span>]);
    <span class="php-variable">$pass</span> = <span class="php-function">mysqli_real_escape_string</span>(<span class="php-variable">$conn</span>, <span class="php-variable">$_GET</span>[<span class="php-string">'password'</span>]);
    <span class="php-variable">$pass</span> = <span class="php-function">md5</span>(<span class="php-variable">$pass</span>);

    <span class="php-variable">$query</span>  = <span class="php-string">"SELECT * FROM `users` WHERE user_name = '$user' AND password = '$pass';"</span>;
    <span class="php-variable">$result</span> = <span class="php-function">mysqli_query</span>(<span class="php-variable">$conn</span>, <span class="php-variable">$query</span>);

    <span class="php-keyword">if</span> (<span class="php-variable">$result</span> && <span class="php-function">mysqli_num_rows</span>(<span class="php-variable">$result</span>) == 1) {
        <span class="php-variable">$row</span> = <span class="php-function">mysqli_fetch_assoc</span>(<span class="php-variable">$result</span>);
        <span class="php-variable">$profilepic</span> = <span class="php-variable">$row</span>[<span class="php-string">"profile_pic"</span>];

        <span class="php-comment">// Login successful</span>
        <span class="php-variable">$html</span> = <span class="php-string">"&lt;p&gt;Welcome to cartoon world, {$user} !&lt;/p&gt;"</span>;
    } else {
        <span class="php-comment">// Login failed</span>
        <span class="php-function">sleep</span>( 2 );
        <span class="php-variable">$html</span> = <span class="php-string">"&lt;pre&gt;&lt;br /&gt;Username and/or password incorrect.&lt;/pre&gt;"</span>;
    }

    <span class="php-function">mysqli_free_result</span>(<span class="php-variable">$result</span>);
    <span class="php-function">mysqli_close</span>(<span class="php-variable">$conn</span>);
}
?&gt;</code></pre>
    </div>




    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Explanations</h3>
    </div>
    <div class="explanation">

        <h3>HTML Form for Login:</h3>
        <ul>
            <li>
                <code>&lt;div class="form_zone"&gt;</code>: Creates a styled container for the form.
            </li>
            <li>
                <code>&lt;p&gt;Cartoon World Login :&lt;/p&gt;</code>: Provides a prompt for the user.
            </li>
            <li>
                <code>&lt;form action="" method="get"&gt;</code>: Sets up a form to submit data via GET to the same page (action="" means the form submits to itself).
            </li>
            <li>
                <code>&lt;input type="text" name="username" id="username" placeholder="Enter the username"&gt;</code>: Allows users to enter their username.
            </li>
            <li>
                <code>&lt;input type="text" name="password" id="password" placeholder="Enter the password"&gt;</code>: Allows users to enter their password.
            </li>
            <li>
                <code>&lt;button type="submit" name="brute-force-submit"&gt;Login&lt;/button&gt;</code>: Is a submit button triggering form submission with the name attribute set to brute-force-submit.
            </li>
        </ul>

        <h3>PHP Handling of Login Form Submission:</h3>
        <ul>
            <li>
                <code>if (isset($_GET['brute-force-submit'])) { ... }</code>: Checks if the form has been submitted using the GET method and if the brute-force-submit button has been clicked.
            </li>
            <li>
                <code>$user = mysqli_real_escape_string($conn, $_GET['username']);</code>: Uses mysqli_real_escape_string() to sanitize and escape the username input for safe use in SQL queries.
            </li>
            <li>
                <code>$pass = mysqli_real_escape_string($conn, $_GET['password']);</code>: Uses mysqli_real_escape_string() to sanitize and escape the password input for safe use in SQL queries.
            </li>
            <li>
                <code>$pass = md5($pass);</code>: Hashes the password using MD5. Note that MD5 is not recommended for password hashing due to its vulnerabilities.
            </li>
            <li>
                <code>$query = "SELECT * FROM users WHERE user_name = '$user' AND password = '$pass';";</code>: Constructs the SQL query to select user information based on the sanitized username and hashed password.
            </li>
            <li>
                <code>$result = mysqli_query($conn, $query);</code>: Executes the SQL query.
            </li>
        </ul>

        <h3>Processing Query Results:</h3>
        <ul>
            <li>
                <code>if ($result && mysqli_num_rows($result) == 1) { ... }</code>: Checks if the query executed successfully and returned exactly one row.
            </li>
            <li>
                If successful:
                <ul>
                    <li><code>$html = "&lt;p&gt;Welcome to cartoon world, {$user} !&lt;/p&gt;";</code>: Displays a welcome message upon successful login.</li>
                </ul>
            </li>
            <li>
                If login fails:
                <ul>
                    <li><code>sleep(2);</code>: Introduces a 2-second delay to simulate brute-force protection or slow down attacks.</li>
                    <li><code>$html = "&lt;pre&gt;&lt;br /&gt;Username and/or password incorrect.&lt;/pre&gt;";</code>: Sets an error message indicating that the username and/or password is incorrect.</li>
                </ul>
            </li>
        </ul>

        <h3>Closing Database Connection:</h3>
        <ul>
            <li>
                <code>mysqli_free_result($result);</code>: Frees the result set to release resources.
            </li>
            <li>
                <code>mysqli_close($conn);</code>: Closes the database connection once operations are complete.
            </li>
        </ul>
</br>
        <h3><span style="color: #D10000;">Security Note:</span></h3>
        <p>
            Sanitizing and escaping user input (<code>mysqli_real_escape_string()</code>) helps prevent SQL injection attacks.
            Using MD5 for password hashing (<code>$pass = md5($pass);</code>) is not secure; consider using stronger algorithms like bcrypt or Argon2.
            Implementing a delay (<code>sleep(2);</code>) as a brute-force protection mechanism is rudimentary and not recommended; instead, use more advanced techniques like account lockout mechanisms or CAPTCHA challenges.
        </p>
</br>
    </div>


</body>

</html>
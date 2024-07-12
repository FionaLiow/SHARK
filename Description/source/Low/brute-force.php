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
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: red;">Low</span></h2></br>
    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Code Snippet</h3>
    </div>

    <div class="code-container">
        <pre><code class="php-keyword">&lt;?php

<span class="php-keyword">if</span> (<span class="php-function">isset</span>(<span class="php-variable">$_GET</span>[<span class="php-string">'brute-force-submit'</span>])) {
    <span class="php-variable">$user</span> = <span class="php-variable">$_GET</span>[<span class="php-string">'username'</span>];
    <span class="php-variable">$pass</span> = <span class="php-variable">$_GET</span>[<span class="php-string">'password'</span>];
    <span class="php-variable">$pass</span> = <span class="php-function">md5</span>(<span class="php-variable">$pass</span>);

    <span class="php-variable">$query</span>  = <span class="php-string">"SELECT * FROM `users` WHERE user_name = '$user' AND password = '$pass';"</span>;
    <span class="php-variable">$result</span> = <span class="php-function">mysqli_query</span>(<span class="php-variable">$conn</span>, <span class="php-variable">$query</span>);

    <span class="php-keyword">if</span> (<span class="php-variable">$result</span> && <span class="php-function">mysqli_num_rows</span>(<span class="php-variable">$result</span>) == 1) {
        <span class="php-variable">$row</span> = <span class="php-function">mysqli_fetch_assoc</span>(<span class="php-variable">$result</span>);
        <span class="php-variable">$profilepic</span> = <span class="php-variable">$row</span>[<span class="php-string">"profile_pic"</span>];

        <span class="php-comment">// Login successful</span>
        <span class="php-variable">$html</span> = <span class="php-string">"&lt;p&gt;Welcome to cartoon world, {$user} !&lt;/p&gt;"</span>;
    } <span class="php-keyword">else</span> {
        <span class="php-comment">// Login failed</span>
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

        <h3>Checking for Form Submission:</h3>
        <ul>
            <li>
                <code>if (isset($_GET['brute-force-submit'])) { ... }</code>: This condition checks if the form with <code>name="brute-force-submit"</code> is submitted. This ensures that the code inside the block executes only when the form is submitted.
            </li>
        </ul>

        <h3>Retrieving and Hashing User Input:</h3>
        <ul>
            <li>
                <code>$user = $_GET['username'];</code>: This line retrieves the <code>username</code> from the GET data.
            </li>
            <li>
                <code>$pass = $_GET['password'];</code>: This line retrieves the <code>password</code> from the GET data.
            </li>
            <li>
                <code>$pass = md5($pass);</code>: This line hashes the password using MD5. Note that MD5 is not considered secure for hashing passwords.
            </li>
        </ul>

        <h3>Database Connection and SQL Preparation:</h3>
        <ul>
            <li>The script assumes a database connection (<code>$conn</code>) has been previously established.</li>
            <li>
                <code>$query = "SELECT * FROM users WHERE user_name = '$user' AND password = '$pass';"</code>: Defines the SQL query to select user information based on the <code>username</code> and hashed <code>password</code>.
            </li>
            <li>
                <code>$result = mysqli_query($conn, $query);</code>: Executes the SQL query. Using direct input like this can lead to SQL injection and should be avoided. Prepared statements should be used instead.
            </li>
        </ul>

        <h3>Processing the Query Results:</h3>
        <ul>
            <li>
                <code>if ($result && mysqli_num_rows($result) == 1) { ... }</code>: Checks if the query executed successfully and returned exactly one row.
            </li>
            <li>
                If the login is successful, <code>$row = mysqli_fetch_assoc($result);</code> fetches the user data, including the <code>profile_pic</code>.
            </li>
            <li>
                Constructs <code>$html = "&lt;p&gt;Welcome to cartoon world, {$user} !&lt;/p&gt;";</code> to display a welcome message.
            </li>
        </ul>

        <h3>Handling Failed Login:</h3>
        <ul>
            <li>
                If the login fails, it sets <code>$html = "&lt;pre&gt;&lt;br /&gt;Username and/or password incorrect.&lt;/pre&gt;";</code> to display an error message.
            </li>
        </ul>

        <h3>Closing Resources:</h3>
        <ul>
            <li>
                <code>mysqli_free_result($result);</code>: Frees the result set to release resources.
            </li>
            <li>
                <code>mysqli_close($conn);</code>: Closes the database connection once the operations are complete.
            </li>
        </ul>
        <br>
        <h3><span style="color: #D10000;">Security Note:</span></h3>
        <p>
            Always sanitize and validate user inputs (<code>$user</code> and <code>$pass</code> in this case) to prevent SQL injection attacks. Using prepared statements (<code>$stmt->prepare()</code>, <code>$stmt->bind_param()</code>) helps mitigate these risks.<br>
            Avoid using MD5 for password hashing. Use stronger hashing algorithms like bcrypt or Argon2.
        </p>

    </div>



</body>

</html>
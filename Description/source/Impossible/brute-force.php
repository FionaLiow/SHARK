<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Snippet & Explanations</title>
    <link rel="stylesheet" type="text/css" href="../code-snippet.css">
</head>

<body>
    <h1>Blind SQL Injection</h1>
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #0000D1;">Impossible</span></h2></br>
    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Code Snippet</h3>
    </div>

    <div class="code-container">
        <pre><code>&lt;div class="form_zone"&gt;
    &lt;p&gt;Cartoon World Login :&lt;/p&gt;
    &lt;form action="" method="post"&gt;
        &lt;input type="hidden" name="user_token" value="&lt;?php echo $_SESSION['session_token']; ?&gt;"&gt;
        &lt;input type="text" name="username" id="username" placeholder="Enter the username"&gt;
        &lt;input type="text" name="password" id="password" placeholder="Enter the password"&gt;
        &lt;button type="submit" name="brute-force-submit"&gt;Login&lt;/button&gt;
    &lt;/form&gt;
&lt;/div&gt;

&lt;?php
<span class="php-keyword">if</span> (isset(<span class="php-variable">$_POST</span>[<span class="php-string">'brute-force-submit'</span>]) &amp;&amp; isset(<span class="php-variable">$_POST</span>[<span class="php-string">'username'</span>]) &amp;&amp; isset(<span class="php-variable">$_POST</span>[<span class="php-string">'password'</span>])) {

    <span class="php-comment">// Check Anti-CSRF token</span>
    checkToken(<span class="php-variable">$_REQUEST</span>[<span class="php-string">'user_token'</span>], <span class="php-variable">$_SESSION</span>[<span class="php-string">'session_token'</span>], <span class="php-string">'index.php'</span>);

    <span class="php-variable">$user</span> = mysqli_real_escape_string(<span class="php-variable">$conn</span>, <span class="php-variable">$_POST</span>[<span class="php-string">'username'</span>]);
    <span class="php-variable">$user</span> = stripslashes(<span class="php-variable">$user</span>);
    <span class="php-variable">$pass</span> = mysqli_real_escape_string(<span class="php-variable">$conn</span>, <span class="php-variable">$_POST</span>[<span class="php-string">'password'</span>]);
    <span class="php-variable">$pass</span> = stripslashes(<span class="php-variable">$pass</span>);
    <span class="php-variable">$pass</span> = md5(<span class="php-variable">$pass</span>);

    <span class="php-comment">// Default values for account login threshold</span>
    <span class="php-variable">$total_failed_login</span> = 3;
    <span class="php-variable">$lockout_time</span> = 15;
    <span class="php-variable">$account_locked</span> = false;

    <span class="php-comment">// Check the database (Check login information)</span>
    <span class="php-variable">$query</span> = <span class="php-string">'SELECT failed_login, last_login FROM users WHERE user_name = ? LIMIT 1;'</span>;
    <span class="php-variable">$stmt</span> = <span class="php-variable">$conn</span>-&gt;prepare(<span class="php-variable">$query</span>);
    <span class="php-variable">$stmt</span>-&gt;bind_param(<span class="php-string">'s'</span>, <span class="php-variable">$user</span>);
    <span class="php-variable">$stmt</span>-&gt;execute();
    <span class="php-variable">$result</span> = <span class="php-variable">$stmt</span>-&gt;get_result();
    <span class="php-variable">$row</span> = <span class="php-variable">$result</span>-&gt;fetch_assoc();

    <span class="php-comment">// Check to see if the user has been locked out.</span>
    <span class="php-keyword">if</span> (<span class="php-variable">$result</span>-&gt;num_rows == 1 &amp;&amp; <span class="php-variable">$row</span>[<span class="php-string">'failed_login'</span>] &gt;= <span class="php-variable">$total_failed_login</span>) {
        <span class="php-comment">// Calculate when the user would be allowed to login again</span>
        <span class="php-variable">$last_login</span> = strtotime(<span class="php-variable">$row</span>[<span class="php-string">'last_login'</span>]);
        <span class="php-variable">$timeout</span> = <span class="php-variable">$last_login</span> + (<span class="php-variable">$lockout_time</span> * 60);
        <span class="php-variable">$timenow</span> = time();

        <span class="php-comment">// Check to see if enough time has passed, if it hasn't locked the account</span>
        <span class="php-keyword">if</span> (<span class="php-variable">$timenow</span> &lt; <span class="php-variable">$timeout</span>) {
            <span class="php-variable">$account_locked</span> = true;
        }
    }

    <span class="php-comment">// Check the database (if username matches the password)</span>
    <span class="php-variable">$query</span> = <span class="php-string">'SELECT * FROM users WHERE user_name = ? AND password = ? LIMIT 1;'</span>;
    <span class="php-variable">$stmt</span> = <span class="php-variable">$conn</span>-&gt;prepare(<span class="php-variable">$query</span>);
    <span class="php-variable">$stmt</span>-&gt;bind_param(<span class="php-string">'ss'</span>, <span class="php-variable">$user</span>, <span class="php-variable">$pass</span>);
    <span class="php-variable">$stmt</span>-&gt;execute();
    <span class="php-variable">$result</span> = <span class="php-variable">$stmt</span>-&gt;get_result();
    <span class="php-variable">$row</span> = <span class="php-variable">$result</span>-&gt;fetch_assoc();

    <span class="php-comment">// If it's a valid login...</span>
    <span class="php-keyword">if</span> (<span class="php-variable">$result</span>-&gt;num_rows == 1 &amp;&amp; !<span class="php-variable">$account_locked</span>) {
        <span class="php-variable">$profilepic</span> = <span class="php-variable">$row</span>[<span class="php-string">'profile_pic'</span>];

        <span class="php-comment">// Login successful</span>
        <span class="php-variable">$html</span> = <span class="php-string">"&lt;p&gt;Welcome to cartoon world, {$user}!&lt;/p&gt;"</span>;

        <span class="php-comment">// Had the account been locked out since last login?</span>
        <span class="php-keyword">if</span> (<span class="php-variable">$row</span>[<span class="php-string">'failed_login'</span>] &gt;= <span class="php-variable">$total_failed_login</span>) {
            <span class="php-variable">$html</span> .= <span class="php-string">"&lt;p&gt;&lt;em&gt;Warning&lt;/em&gt;: Someone might have been brute-forcing your account.&lt;/p&gt;"</span>;
            <span class="php-variable">$html</span> .= <span class="php-string">"&lt;p&gt;Number of login attempts: &lt;em&gt;{$row['failed_login']}&lt;/em&gt;. Last login attempt was at: &lt;em&gt;{$row['last_login']}&lt;/em&gt;.&lt;/p&gt;"</span>;
        }

        <span class="php-comment">// Reset bad login count</span>
        <span class="php-variable">$query</span> = <span class="php-string">'UPDATE users SET failed_login = 0 WHERE user_name = ? LIMIT 1;'</span>;
        <span class="php-variable">$stmt</span> = <span class="php-variable">$conn</span>-&gt;prepare(<span class="php-variable">$query</span>);
        <span class="php-variable">$stmt</span>-&gt;bind_param(<span class="php-string">'s'</span>, <span class="php-variable">$user</span>);
        <span class="php-variable">$stmt</span>-&gt;execute();
    } <span class="php-keyword">else</span> {
        <span class="php-comment">// Login failed</span>
        sleep(rand(2, 4));

        <span class="php-comment">// Give the user some feedback</span>
        <span class="php-variable">$html</span> = <span class="php-string">"&lt;pre&gt;&lt;br /&gt;Username and/or password incorrect.&lt;br /&gt;&lt;br/&gt;Alternatively, the account has been locked because of too many failed logins. Please try again in {$lockout_time} minutes.&lt;/pre&gt;"</span>;

        <span class="php-comment">// Update bad login count</span>
        <span class="php-variable">$query</span> = <span class="php-string">'UPDATE users SET failed_login = failed_login + 1 WHERE user_name = ? LIMIT 1;'</span>;
        <span class="php-variable">$stmt</span> = <span class="php-variable">$conn</span>-&gt;prepare(<span class="php-variable">$query</span>);
        <span class="php-variable">$stmt</span>-&gt;bind_param(<span class="php-string">'s'</span>, <span class="php-variable">$user</span>);
        <span class="php-variable">$stmt</span>-&gt;execute();
    }

    <span class="php-comment">// Set the last login time</span>
    <span class="php-variable">$query</span> = <span class="php-string">'UPDATE users SET last_login = now() WHERE user_name = ? LIMIT 1;'</span>;
    <span class="php-variable">$stmt</span> = <span class="php-variable">$conn</span>-&gt;prepare(<span class="php-variable">$query</span>);
    <span class="php-variable">$stmt</span>-&gt;bind_param(<span class="php-string">'s'</span>, <span class="php-variable">$user</span>);
    <span class="php-variable">$stmt</span>-&gt;execute();
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

        <h3>Checking Request Method:</h3>
        <ul>
            <li>
                <code>if ($_SERVER["REQUEST_METHOD"] == "POST") { ... }</code>: This condition checks if the current request method is POST. This ensures that the code inside the block executes only when the form with <code>method="post"</code> is submitted.
            </li>
        </ul>

        <h3>Sanitizing User Input:</h3>
        <ul>
            <li>
                <code>$user_id = intval($_POST['user_id']);</code>: This line retrieves the <code>user_id</code> from the POST data and converts it to an integer using <code>intval()</code> to ensure it's safe for database queries.
            </li>
        </ul>

        <h3>Database Connection and SQL Preparation:</h3>
        <ul>
            <li>The script assumes a database connection (<code>$conn</code>) has been previously established.</li>
            <li>
                <code>$sql = "SELECT user_id, user_name, email FROM users WHERE user_id = ?";</code>: Defines the SQL query to select user information based on the <code>user_id</code>.
            </li>
            <li>
                <code>$stmt = $conn->prepare($sql);</code>: Prepares the SQL statement for execution.
            </li>
        </ul>

        <h3>Binding Parameters and Executing the Query:</h3>
        <ul>
            <li>
                <code>$stmt->bind_param("i", $user_id);</code>: Binds the <code>user_id</code> parameter to the prepared SQL statement (<code>i</code> indicates it's an integer).
            </li>
            <li>
                <code>$stmt->execute();</code>: Executes the prepared statement with the bound parameter.
            </li>
        </ul>

        <h3>Binding Results and Storing Them:</h3>
        <ul>
            <li>
                <code>$stmt->bind_result($id, $username, $email);</code>: Binds variables (<code>$id</code>, <code>$username</code>, <code>$email</code>) to the prepared statement to store the result.
            </li>
            <li>
                <code>$stmt->store_result();</code>: Stores the result set from the prepared statement.
            </li>
        </ul>

        <h3>Processing the Query Results:</h3>
        <ul>
            <li>
                <code>if ($stmt->num_rows > 0) { ... }</code>: Checks if any rows were returned by the query.
            </li>
            <li>
                <code>while ($stmt->fetch()) { ... }</code>: Iterates through the result set. Assuming only one user is expected (based on <code>user_id</code> uniqueness), it retrieves and prints user information.
            </li>
        </ul>

        <h3>Outputting User Information:</h3>
        <ul>
            <li>
                Inside the <code>while</code> loop, it echoes HTML to display user information (ID, Username, Email). <code>htmlspecialchars()</code> is used to prevent XSS (cross-site scripting) attacks by escaping special characters in the output.
            </li>
        </ul>

        <h3>Handling No Results:</h3>
        <ul>
            <li>
                If no user is found (<code>$stmt->num_rows <= 0</code>), it outputs a message indicating no user was found with the provided <code>user_id</code>.
            </li>
        </ul>

        <h3>Closing Resources:</h3>
        <ul>
            <li>
                <code>$stmt->close();</code>: Closes the prepared statement to free up resources.
            </li>
            <li>
                <code>$conn->close();</code>: Closes the database connection once the operations are complete.
            </li>
        </ul>
        </br>
        <h3><span style="color: #D10000;">Security Note:</span></h3>
        <p>
            Always sanitize and validate user inputs (<code>$user_id</code> in this case) to prevent SQL injection attacks. Using prepared statements (<code>$stmt->prepare()</code>, <code>$stmt->bind_param()</code>) helps mitigate these risks.
        </p>

    </div>


</body>

</html>
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

        <h3>HTML Form (<code>&lt;div class="form_zone"&gt;...&lt;/form&gt;</code>):</h3>
        <ul>
            <li>Provides a login form where users can input their username, password, and includes a hidden field for CSRF protection.</li>
        </ul>

        <h3>PHP Logic for Processing Login (<code>if (isset($_POST['brute-force-submit']) && isset($_POST['username']) && isset($_POST['password']))</code>):</h3>
        <ul>
            <li><strong>Checks if the login form has been submitted</strong> (<code>$_POST['brute-force-submit']</code>).</li>
            <li><strong>Retrieves and validates the username</strong> (<code>$user</code>) <strong>and password</strong> (<code>$pass</code>) <strong>from the form.</strong></li>
            <li><strong>CSRF Protection</strong> (<code>checkToken($_REQUEST['user_token'], $_SESSION['session_token'], 'index.php')</code>): Ensures CSRF protection by comparing the token submitted in the form (<code>$_REQUEST['user_token']</code>) with the token stored in the session (<code>$_SESSION['session_token']</code>).</li>
            <li><strong>Database Interaction:</strong>
                <ul>
                    <li><strong>Fetching Failed Login Attempts:</strong> Queries the database to retrieve the number of failed login attempts (<code>$row['failed_login']</code>) and the last login timestamp (<code>$row['last_login']</code>).</li>
                    <li><strong>Validating Username and Password:</strong> Executes a prepared SQL statement to verify if the entered username and password match a record in the database.</li>
                    <li><strong>Handling Failed Login Attempts:</strong> Increments the failed login count (<code>failed_login</code>) in the database for the respective user if the login fails. Delays response (<code>sleep(rand(2, 4))</code>) to mitigate brute-force attacks.</li>
                    <li><strong>Update Last Login Time:</strong> Updates the <code>last_login</code> timestamp in the database to track the latest login attempt time, regardless of success or failure.</li>
                </ul>
            </li>
            <li><strong>Output (<code>$html</code>):</strong> Displays appropriate messages based on the login attempt outcome: successful login message with personalized greeting, error messages for incorrect credentials, or account lockout due to too many failed attempts.</li>
        </ul>
</br>
        <h3><span style="color: #D10000;">Security Measures:</span></h3>
        <ul>
            <li><strong>Prepared Statements:</strong> Utilizes prepared statements with parameter binding (<code>$stmt->bind_param</code>) to prevent SQL injection attacks.</li>
            <li><strong>Password Hashing:</strong> Uses md5() hashing for passwords (note: MD5 is not recommended for secure hashing in production environments; consider using stronger algorithms like bcrypt).</li>
            <li><strong>CSRF Protection:</strong> Implements CSRF token validation to prevent cross-site request forgery attacks.</li>
            <li><strong>Brute-Force Protection:</strong> Implements an account lockout mechanism (<code>$total_failed_login</code> and <code>$lockout_time</code>) to prevent brute-force attacks.</li>
        </ul>

    </div>



</body>

</html>
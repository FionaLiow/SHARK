<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Snippet & Explanations</title>
    <link rel="stylesheet" type="text/css" href="../code-snippet.css">
</head>

<body>
    <h1>Command Injection</h1>
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #0000D1;">Impossible</span></h2></br>
    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Code Snippet</h3>
    </div>

    <div class="code-container">
        <pre><code>&lt;div class="form_zone"&gt;
    &lt;p&gt;Ping a device using IP address :&lt;/p&gt;
    &lt;form action="" method="post"&gt;
        &lt;input type="hidden" name="user_token" value="&lt;?php echo $_SESSION['session_token']; ?&gt;"&gt;
        &lt;input type="text" name="ip" id="ip" placeholder="Enter IP address"&gt;
        &lt;button type="submit" name="Submit"&gt;Submit&lt;/button&gt;
    &lt;/form&gt;
&lt;/div&gt;

&lt;?php

<span class="php-keyword">if</span> (isset(<span class="php-variable">$_POST</span>[<span class="php-string">'Submit'</span>])) {
    <span class="php-comment">// Check Anti-CSRF token</span>
    checkToken(<span class="php-variable">$_REQUEST</span>[<span class="php-string">'user_token'</span>], <span class="php-variable">$_SESSION</span>[<span class="php-string">'session_token'</span>], <span class="php-string">'index.php'</span>);

    <span class="php-variable">$target</span> = <span class="php-variable">$_REQUEST</span>[<span class="php-string">'ip'</span>];
    <span class="php-variable">$target</span> = stripslashes(<span class="php-variable">$target</span>);

    <span class="php-comment">// Split the IP into 4 octects</span>
    <span class="php-variable">$octet</span> = explode(<span class="php-string">"."</span>, <span class="php-variable">$target</span>);

    <span class="php-comment">// Check IF each octet is an integer</span>
    <span class="php-keyword">if</span> ((is_numeric(<span class="php-variable">$octet</span>[<span class="php-number">0</span>])) &amp;&amp; (is_numeric(<span class="php-variable">$octet</span>[<span class="php-number">1</span>])) &amp;&amp; (is_numeric(<span class="php-variable">$octet</span>[<span class="php-number">2</span>])) &amp;&amp; (is_numeric(<span class="php-variable">$octet</span>[<span class="php-number">3</span>])) &amp;&amp; (sizeof(<span class="php-variable">$octet</span>) == <span class="php-number">4</span>)) {
        <span class="php-comment">// If all 4 octets are int's put the IP back together.</span>
        <span class="php-variable">$target</span> = <span class="php-variable">$octet</span>[<span class="php-number">0</span>] . <span class="php-string">'.'</span> . <span class="php-variable">$octet</span>[<span class="php-number">1</span>] . <span class="php-string">'.'</span> . <span class="php-variable">$octet</span>[<span class="php-number">2</span>] . <span class="php-string">'.'</span> . <span class="php-variable">$octet</span>[<span class="php-number">3</span>];

        <span class="php-keyword">if</span> (stristr(php_uname(<span class="php-string">'s'</span>), <span class="php-string">'Windows NT'</span>)) {
            <span class="php-variable">$cmd</span> = shell_exec(<span class="php-string">'ping  '</span> . <span class="php-variable">$target</span>);
        } else {
            <span class="php-variable">$cmd</span> = shell_exec(<span class="php-string">'ping  -c 4 '</span> . <span class="php-variable">$target</span>);
        }

    } else {
        <span class="php-variable">$cmd</span> =  <span class="php-string">'&lt;pre&gt;ERROR: You have entered an invalid IP.&lt;/pre&gt;'</span>;
    }
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
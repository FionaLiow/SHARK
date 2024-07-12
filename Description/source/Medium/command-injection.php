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
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #FFA500;">Medium</span></h2></br>
    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Code Snippet</h3>
    </div>

    <div class="code-container">
        <pre><code>&lt;div class="form_zone"&gt;
    &lt;p&gt;Ping a device using IP address :&lt;/p&gt;
    &lt;form action="" method="post"&gt;
        &lt;input type="text" name="ip" id="ip" placeholder="Enter IP address"&gt;
        &lt;button type="submit" name="Submit"&gt;Submit&lt;/button&gt;
    &lt;/form&gt;
&lt;/div&gt;

&lt;?php

if (isset(<span class="php-variable">$_POST</span>[<span class="php-string">'Submit'</span>])) {
    <span class="php-variable">$target</span> = <span class="php-variable">$_REQUEST</span>[<span class="php-string">'ip'</span>];

    // Set blacklist
    <span class="php-variable">$substitutions</span> = <span class="php-keyword">array</span>(
        <span class="php-string">'&&'</span> => <span class="php-string">''</span>,
        <span class="php-string">';'</span>  => <span class="php-string">''</span>,
    );

    <span class="php-variable">$target</span> = <span class="php-function">str_replace</span>(<span class="php-function">array_keys</span>(<span class="php-variable">$substitutions</span>), <span class="php-variable">$substitutions</span>, <span class="php-variable">$target</span>);

    // Determine OS and execute the ping command.
    <span class="php-keyword">if</span> (<span class="php-function">stristr</span>(<span class="php-function">php_uname</span>(<span class="php-string">'s'</span>), <span class="php-string">'Windows NT'</span>)) {
        <span class="php-variable">$cmd</span> = <span class="php-function">shell_exec</span>(<span class="php-string">'ping  '</span> . <span class="php-variable">$target</span>);
    } <span class="php-keyword">else</span> {
        <span class="php-variable">$cmd</span> = <span class="php-function">shell_exec</span>(<span class="php-string">'ping  -c 4 '</span> . <span class="php-variable">$target</span>);
    }

}
?&gt;</code></pre>
    </div>


    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Explanations</h3>
    </div>
    <div class="explanation">

        <h3>HTML Form Submission:</h3>
        <ul>
            <li>
                This HTML code defines a form that submits data using the POST method to the same URL (action="" means it submits to the current page).
            </li>
            <li>
                Inside the form, there's a <code>&lt;select&gt;</code> element (user_id_opt) with three <code>&lt;option&gt;</code> elements, each representing a user ID (1, 2, 3).
            </li>
            <li>
                The <code>&lt;button&gt;</code> element triggers the form submission when clicked.
            </li>
        </ul>

        <h3>PHP Condition (<code>if ($_SERVER["REQUEST_METHOD"] == "POST")</code>):</h3>
        <ul>
            <li>
                Checks if the form has been submitted using the POST method.
            </li>
        </ul>

        <h3>Retrieve <code>user_id_opt</code> from <code>$_POST</code>:</h3>
        <ul>
            <li>
                Retrieves the selected <code>user_id_opt</code> from the form submission.
            </li>
        </ul>

        <h3>SQL Query (<code>$query</code>):</h3>
        <ul>
            <li>
                Constructs an SQL query to select <code>user_id</code>, <code>user_name</code>, and <code>email</code> from the <code>users</code> table where <code>user_id</code> matches the selected value.
            </li>
            <li>
                Executes the SQL query using <code>mysqli_query()</code> with the connection <code>$conn</code>. Direct input like this can lead to SQL injection and should be avoided; prepared statements should be used instead.
            </li>
        </ul>

        <h3>Fetch Results (<code>mysqli_fetch_assoc()</code>):</h3>
        <ul>
            <li>
                If the query returns results (<code>$result</code>), iterates through each row using <code>mysqli_fetch_assoc()</code> to fetch an associative array (<code>$row</code>) containing user data.
            </li>
        </ul>

        <h3>Format HTML Output:</h3>
        <ul>
            <li>
                Formats the fetched data into HTML format using string concatenation (<code>$html .= ...</code>).
            </li>
        </ul>

        <h3>Handle No Results:</h3>
        <ul>
            <li>
                If no user is found (<code>$result</code> is empty), sets <code>$html</code> to "No user found".
            </li>
        </ul>

        <h3>Free Result Set (<code>mysqli_free_result()</code>):</h3>
        <ul>
            <li>
                Frees memory associated with the result set.
            </li>
        </ul>

        <h3>Close Database Connection (<code>mysqli_close()</code>):</h3>
        <ul>
            <li>
                Closes the database connection (<code>$conn</code>) to free resources.
            </li>
        </ul>

        <h3><span style="color: #D10000;">Security Note:</span></h3>
        <p>
            Always sanitize and validate user inputs (<code>$user_id_opt</code> in this case) to prevent SQL injection attacks. Using prepared statements (<code>$stmt-&gt;prepare()</code>, <code>$stmt-&gt;bind_param()</code>) helps mitigate these risks effectively.
        </p>

    </div>


</body>

</html>
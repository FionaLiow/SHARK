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
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #2CF4EE;">High</span></h2></br>
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

    <span class="php-keyword">if</span> (isset(<span class="php-variable">$_POST</span>[<span class="php-string">'Submit'</span>])) {
        <span class="php-variable">$target</span> = trim(<span class="php-variable">$_REQUEST</span>[<span class="php-string">'ip'</span>]);

        <span class="php-comment">// Set blacklist</span>
        <span class="php-variable">$substitutions</span> = array(
            <span class="php-string">'&amp;'</span>  =&gt; <span class="php-string">''</span>,
            <span class="php-string">';'</span>  =&gt; <span class="php-string">''</span>,
            <span class="php-string">'| '</span> =&gt; <span class="php-string">''</span>,
            <span class="php-string">'-'</span>  =&gt; <span class="php-string">''</span>,
            <span class="php-string">'$'</span>  =&gt; <span class="php-string">''</span>,
            <span class="php-string">'('</span>  =&gt; <span class="php-string">''</span>,
            <span class="php-string">')'</span>  =&gt; <span class="php-string">''</span>,
            <span class="php-string">'`'</span>  =&gt; <span class="php-string">''</span>,
            <span class="php-string">'||'</span> =&gt; <span class="php-string">''</span>,
        );

        <span class="php-variable">$target</span> = str_replace(array_keys(<span class="php-variable">$substitutions</span>), <span class="php-variable">$substitutions</span>, <span class="php-variable">$target</span>);

        <span class="php-comment">// Determine OS and execute the ping command.</span>
        <span class="php-keyword">if</span> (stristr(php_uname(<span class="php-string">'s'</span>), <span class="php-string">'Windows NT'</span>)) {
            <span class="php-variable">$cmd</span> = shell_exec(<span class="php-string">'ping  '</span> . <span class="php-variable">$target</span>);
        } <span class="php-keyword">else</span> {
            <span class="php-variable">$cmd</span> = shell_exec(<span class="php-string">'ping  -c 4 '</span> . <span class="php-variable">$target</span>);
        }

    }

    ?&gt;
    </code></pre>
    </div>



    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Explanations</h3>
    </div>
    <div class="explanation">

        <h3>Form Handling:</h3>
        <ul>
            <li>
                The form uses the POST method, so when the form is submitted, the PHP script checks if the request method is POST.
            </li>
        </ul>

        <h3>Sanitization:</h3>
        <ul>
            <li>
                The selected user ID is retrieved from the form submission (<code>$id = $_POST['user_id_opt'];</code>).
            </li>
            <li>
                To prevent SQL injection attacks, certain substrings ("--" and "or") are removed from the submitted user ID using <code>str_replace</code>.
            </li>
        </ul>

        <h3>SQL Query:</h3>
        <ul>
            <li>
                An SQL query is constructed to select the <code>user_id</code>, <code>user_name</code>, and <code>email</code> from the <code>users</code> table where the <code>user_id</code> matches the sanitized user ID. The <code>LIMIT 1</code> clause ensures that only one result is returned.
            </li>
        </ul>

        <h3>Executing the Query:</h3>
        <ul>
            <li>
                The query is executed using <code>mysqli_query</code>.
            </li>
            <li>
                If the query is successful and there are results (<code>mysqli_num_rows($result) > 0</code>), a loop iterates through the results and retrieves the user information.
            </li>
        </ul>

        <h3>Display Results:</h3>
        <ul>
            <li>
                The retrieved user information is formatted as HTML and appended to the <code>$html</code> variable.
            </li>
            <li>
                If no user is found, the <code>$html</code> variable is set to display a "No user found" message.
            </li>
        </ul>

        <h3>Resource Management:</h3>
        <ul>
            <li>
                The memory associated with the result set is freed using <code>mysqli_free_result($result)</code>.
            </li>
            <li>
                The database connection is closed using <code>mysqli_close($conn)</code>.
            </li>
        </ul>

        <h3><span style="color: #D10000;">Security Note:</span></h3>
        <p>
            Always sanitize and validate user inputs, such as <code>$user_id_opt</code> in this case, to prevent SQL injection attacks. Simply removing characters like "--" and "or" is not sufficient; consider the following:
        </p>
        <ul>
            <li>
                <strong>Use Prepared Statements:</strong> Prefer prepared statements and parameterized queries to separate SQL logic from data and prevent malicious input from altering query structure.
            </li>
            <li>
                <strong>Input Validation:</strong> Validate user inputs to ensure they conform to expected formats and ranges before using them in SQL queries. This prevents both SQL injection and other input-related vulnerabilities.
            </li>
            <li>
                <strong>Escape Special Characters:</strong> If constructing SQL queries manually, use appropriate escaping functions (e.g., <code>mysqli_real_escape_string</code>) specific to your database to prevent special characters from being interpreted as part of the query.
            </li>
            <li>
                <strong>Limit Privileges:</strong> Restrict database user privileges to minimize potential impact of a successful attack. Grant only necessary permissions for each user role.
            </li>
        </ul>
        <p>
            Implementing these practices ensures robust protection against SQL injection and enhances overall application security.
        </p>


    </div>


</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Snippet & Explanations</title>
    <link rel="stylesheet" type="text/css" href="../code-snippet.css">
</head>

<body>
    <h1>SQL Injection</h1>
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #2CF4EE;">High</span></h2></br>
    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Code Snippet</h3>
    </div>

    <div class="code-container">
        <pre><code>&lt;form action="" method="post"&gt;
    &lt;select name="user_id_opt" class="user_id_select"&gt;
        &lt;option value="1"&gt;1&lt;/option&gt;
        &lt;option value="2"&gt;2&lt;/option&gt;
        &lt;option value="3"&gt;3&lt;/option&gt;
    &lt;/select&gt;
    &lt;button type="submit"&gt;Submit&lt;/button&gt;
&lt;/form&gt;
</code></pre>
        <br><br>

        <pre><code>&lt;?php
<span class="php-keyword">if</span> (<span class="php-variable">$_SERVER</span>[<span class="php-string">"REQUEST_METHOD"</span>] == <span class="php-string">"POST"</span>) {
    <span class="php-variable">$id</span> = <span class="php-variable">$_POST</span>[<span class="php-string">'user_id_opt'</span>];
    <span class="php-variable">$substring_to_remove</span> = <span class="php-keyword">array</span>(<span class="php-string">"--"</span>, <span class="php-string">"or"</span>);
    <span class="php-variable">$submitted_id</span> = <span class="php-function">str_replace</span>(<span class="php-variable">$substring_to_remove</span>, <span class="php-string">""</span>, <span class="php-variable">$id</span>);

    <span class="php-variable">$query</span> = <span class="php-string">"SELECT user_id, user_name, email FROM users WHERE user_id = '$submitted_id' LIMIT 1;"</span>;
    <span class="php-variable">$result</span> = <span class="php-function">mysqli_query</span>(<span class="php-variable">$conn</span>, <span class="php-variable">$query</span>);

    <span class="php-keyword">if</span> (<span class="php-variable">$result</span> && <span class="php-function">mysqli_num_rows</span>(<span class="php-variable">$result</span>) > 0) {
        <span class="php-keyword">while</span> (<span class="php-variable">$row</span> = <span class="php-function">mysqli_fetch_assoc</span>(<span class="php-variable">$result</span>)) {
            <span class="php-variable">$user_id</span> = <span class="php-variable">$row</span>[<span class="php-string">"user_id"</span>];
            <span class="php-variable">$user_name</span> = <span class="php-variable">$row</span>[<span class="php-string">"user_name"</span>];
            <span class="php-variable">$email</span> = <span class="php-variable">$row</span>[<span class="php-string">"email"</span>];

            <span class="php-variable">$html</span> .= <span class="php-string">"&lt;p&gt;&lt;span&gt;ID: &lt;/span&gt;{$user_id}&lt;/p&gt;&lt;p&gt;&lt;span&gt;Username: &lt;/span&gt; {$user_name}&lt;/p&gt;&lt;p&gt;&lt;span&gt;Email: &lt;/span&gt; {$email}&lt;/p&gt;"</span>;
        }
    } <span class="php-keyword">else</span> {
        <span class="php-variable">$html</span> = <span class="php-string">"No user found"</span>;
    }

    <span class="php-comment">// Free result set</span>
    <span class="php-function">mysqli_free_result</span>(<span class="php-variable">$result</span>);
}

<span class="php-comment">// Close connection</span>
<span class="php-function">mysqli_close</span>(<span class="php-variable">$conn</span>);
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
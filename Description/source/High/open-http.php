<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Snippet & Explanations</title>
    <link rel="stylesheet" type="text/css" href="../code-snippet.css">
</head>

<body>
    <h1>Open HTTP Redirect</h1>
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #2CF4EE;">High</span></h2></br>
    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Code Snippet</h3>
    </div>

    <div class="code-container">
        <pre><code>&lt;?php
<span class="php-keyword">if</span> (array_key_exists(<span class="php-string">"redirect"</span>, <span class="php-variable">$_GET</span>) && <span class="php-variable">$_GET</span>[<span class="php-string">'redirect'</span>] != <span class="php-string">""</span>) {
    <span class="php-keyword">if</span> (strpos(<span class="php-variable">$_GET</span>[<span class="php-string">'redirect'</span>], <span class="php-string">"fr1.php"</span>) !== <span class="php-keyword">false</span> || strpos(<span class="php-variable">$_GET</span>[<span class="php-string">'redirect'</span>], <span class="php-string">"fr2.php"</span>) !== <span class="php-keyword">false</span>) {
        header(<span class="php-string">"location: "</span> . <span class="php-variable">$_GET</span>[<span class="php-string">'redirect'</span>]);
        exit;
    } <span class="php-keyword">else</span> {
        http_response_code(500);
?&gt;
        &lt;div class="body-content"&gt;
            &lt;h2&gt;&lt;i class="fa-solid fa-exclamation fa-bounce" style="color: #ff0000;"&gt;&lt;/i&gt;&nbsp;&nbsp;Absolute URLs not allowed.&lt;/h2&gt;
        &lt;/div&gt;
&lt;?php
        exit;
    }
}

http_response_code(500);
?&gt;


&lt;div class="body-content"&gt;
    &lt;div class="challenge-title" style="display: flex; align-items: center"&gt;
        &lt;h1&gt;Open HTTP Redirect&lt;/h1&gt;
        &lt;h2&gt;&nbsp;&nbsp;-&nbsp;&lt;span style="color: #2CF4EE;"&gt;High&lt;/span&gt;&lt;/h2&gt;
    &lt;/div&gt;
    &lt;/br&gt;
    &lt;div class="form_zone"&gt;
        &lt;p&gt;
            Below, you'll find two links to insightful food reviews by a renowned food critic
        &lt;/p&gt;
        &lt;ul&gt;
            &lt;li&gt;&lt;a href='?redirect=../Profile/food_review/fr1.php'&gt;Food Review 1&lt;/a&gt;&lt;/li&gt;
            &lt;li&gt;&lt;a href='?redirect=../Profile/food_review/fr2.php'&gt;Food Review 2&lt;/a&gt;&lt;/li&gt;
        &lt;/ul&gt;
    &lt;/div&gt;

&lt;/div&gt;
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
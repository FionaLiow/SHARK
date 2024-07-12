<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Snippet & Explanations</title>
    <link rel="stylesheet" type="text/css" href="../code-snippet.css">
</head>

<body>
    <h1>File Upload</h1>
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #2CF4EE;">High</span></h2></br>
    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Code Snippet</h3>
    </div>

    <div class="code-container">
        <pre><code>&lt;div class="form_zone"&gt;
        &lt;p&gt;Upload your image:&lt;/p&gt;
        &lt;form action="" method="post" enctype="multipart/form-data"&gt;
            &lt;input type="file" name="image" id="image"&gt;
            &lt;button type="submit" name="upload"&gt;Upload&lt;/button&gt;
        &lt;/form&gt;
    &lt;/div&gt;

    &lt;?php

    <span class="php-keyword">if</span> (isset(<span class="php-variable">$_POST</span>[<span class="php-string">'upload'</span>])) {
        <span class="php-variable">$target_path</span>  = <span class="php-string">"../Uploads/Images/"</span>;
        <span class="php-variable">$target_path</span> .= basename(<span class="php-variable">$_FILES</span>[<span class="php-string">'image'</span>][<span class="php-string">'name'</span>]);

        <span class="php-variable">$uploaded_name</span> = <span class="php-variable">$_FILES</span>[<span class="php-string">'image'</span>][<span class="php-string">'name'</span>];
        <span class="php-variable">$uploaded_tmp</span>  = <span class="php-variable">$_FILES</span>[<span class="php-string">'image'</span>][<span class="php-string">'tmp_name'</span>];
        <span class="php-variable">$uploaded_ext</span>  = substr(<span class="php-variable">$uploaded_name</span>, strrpos(<span class="php-variable">$uploaded_name</span>, <span class="php-string">'.'</span>) + 1);
        <span class="php-variable">$uploaded_size</span> = <span class="php-variable">$_FILES</span>[<span class="php-string">'image'</span>][<span class="php-string">'size'</span>];

        <span class="php-keyword">if</span> ((strtolower(<span class="php-variable">$uploaded_ext</span>) == <span class="php-string">"jpg"</span> || strtolower(<span class="php-variable">$uploaded_ext</span>) == <span class="php-string">"jpeg"</span> || strtolower(<span class="php-variable">$uploaded_ext</span>) == <span class="php-string">"png"</span>) &&
            (<span class="php-variable">$uploaded_size</span> &lt; 10000000000)&&getimagesize( <span class="php-variable">$uploaded_tmp</span> )
        ) {

            <span class="php-keyword">if</span> (!move_uploaded_file(<span class="php-variable">$uploaded_tmp</span>, <span class="php-variable">$target_path</span>)) {
                <span class="php-variable">$html</span> = <span class="php-string">'&lt;pre&gt;Your image was not uploaded.&lt;/pre&gt;'</span>;
            } <span class="php-keyword">else</span> {
                <span class="php-variable">$html</span> = <span class="php-string">'&lt;pre&gt;{$target_path} succesfully uploaded!&lt;/pre&gt;'</span>;
            }
        } <span class="php-keyword">else</span> {
            <span class="php-comment">// Invalid file</span>
            <span class="php-variable">$html</span> = <span class="php-string">'&lt;pre&gt;Your image was not uploaded. We can only accept JPEG or PNG images.&lt;/pre&gt;'</span>;
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
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
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #2CF4EE;">High</span></h2></br>
    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Code Snippet</h3>
    </div>

    <div class="code-container">
        <pre><code>&lt;div class="form_zone"&gt;
    &lt;p&gt;Find user with user ID :&lt;/p&gt;
    &lt;form action="" method="get"&gt;
        &lt;select name="user_id_opt" class="user_id_select"&gt;
            &lt;option value="1"&gt;1&lt;/option&gt;
            &lt;option value="2"&gt;2&lt;/option&gt;
            &lt;option value="3"&gt;3&lt;/option&gt;
            &lt;option value="4"&gt;4&lt;/option&gt;
            &lt;option value="5"&gt;5&lt;/option&gt;
        &lt;/select&gt;
        &lt;button type="submit"&gt;Submit&lt;/button&gt;
    &lt;/form&gt;
&lt;/div&gt;</code></pre>
        <br><br>

        <pre><code class="php-keyword">&lt;?php
<span class="php-keyword">if</span> (<span class="php-variable">$_SERVER</span>[<span class="php-string">"REQUEST_METHOD"</span>] == <span class="php-string">"GET"</span> &amp;&amp; <span class="php-function">isset</span>(<span class="php-variable">$_GET</span>[<span class="php-string">'user_id_opt'</span>])) {
    <span class="php-variable">$id</span> = <span class="php-variable">$_GET</span>[<span class="php-string">'user_id_opt'</span>];
    <span class="php-variable">$substring_to_remove</span> = <span class="php-keyword">array</span>(<span class="php-string">"-"</span>, <span class="php-string">"#"</span>, <span class="php-string">"%"</span>);
    <span class="php-variable">$submitted_id</span> = <span class="php-function">str_replace</span>(<span class="php-variable">$substring_to_remove</span>, <span class="php-string">""</span>, <span class="php-variable">$id</span>);
    <span class="php-variable">$query</span>  = <span class="php-string">"SELECT user_id, user_name, email FROM users WHERE user_id = '$submitted_id' LIMIT 1;"</span>;
    <span class="php-variable">$result</span> = <span class="php-function">mysqli_query</span>(<span class="php-variable">$conn</span>, <span class="php-variable">$query</span>);

    <span class="php-keyword">if</span> (<span class="php-variable">$result</span>) {
        <span class="php-variable">$exists</span> = <span class="php-function">mysqli_num_rows</span>(<span class="php-variable">$result</span>) &gt; 0;
        <span class="php-keyword">if</span> (<span class="php-variable">$exists</span>) {
            <span class="php-variable">$html</span> = <span class="php-string">'&lt;p&gt;User ID &lt;span style="color: #00008B;"&gt;EXISTS&lt;/span&gt; in the database.&lt;/p&gt;'</span>;
        } <span class="php-keyword">else</span> {
            <span class="php-function">http_response_code</span>(<span class="php-string">404</span>);
            <span class="php-variable">$html</span> = <span class="php-string">'&lt;p&gt;User ID is &lt;span style="color: red;"&gt;MISSING&lt;/span&gt; from the database.&lt;/p&gt;'</span>;
        }

        <span class="php-function">mysqli_free_result</span>(<span class="php-variable">$result</span>);
    } <span class="php-keyword">else</span> {
        <span class="php-variable">$html</span> = <span class="php-string">"Error: " . mysqli_error($conn)</span>;
    }

    <span class="php-function">mysqli_close</span>(<span class="php-variable">$conn</span>);
}
?&gt;</code></pre>
    </div>



    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Explanations</h3>
    </div>
    <div class="explanation">

        <h3>HTML Form Setup:</h3>
        <ul>
            <li><code>&lt;div class="form_zone"&gt;</code>: Creates a styled container for the form.</li>
            <li><code>&lt;p&gt;Find user with user ID :&lt;/p&gt;</code>: A paragraph explaining the form's purpose.</li>
            <li><code>&lt;form action="" method="get"&gt;</code>: Defines a form that submits data via the GET method to the same page.</li>
            <li><code>&lt;select name="user_id_opt" class="user_id_select"&gt;</code>: Provides a dropdown menu with user ID options.</li>
            <li><code>&lt;option value="1"&gt;1&lt;/option&gt;</code> through <code>&lt;option value="5"&gt;5&lt;/option&gt;</code>: Dropdown options for user IDs 1 through 5.</li>
            <li><code>&lt;button type="submit"&gt;Submit&lt;/button&gt;</code>: Submit button to send the form data.</li>
        </ul>

        <h3>Processing the Form Submission:</h3>
        <ul>
            <li><code>if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['user_id_opt'])) { ... }</code>: Checks if the form was submitted via GET and the user_id_opt parameter is set.</li>
            <li><code>$id = $_GET['user_id_opt'];</code>: Retrieves the selected user ID from the GET request.</li>
            <li><code>$substring_to_remove = array("-", "#", "%");</code>: Defines substrings to remove for sanitization.</li>
            <li><code>$submitted_id = str_replace($substring_to_remove, "", $id);</code>: Removes the defined substrings from the user ID.</li>
            <li><code>$query = "SELECT user_id, user_name, email FROM users WHERE user_id = '$submitted_id' LIMIT 1;";</code>: Prepares an SQL query to fetch user details for the sanitized user ID.</li>
            <li><code>$result = mysqli_query($conn, $query);</code>: Executes the query against the database.</li>
        </ul>

        <h3>Handling the Query Result:</h3>
        <ul>
            <li><code>if ($result) { ... }</code>: Checks if the query executed successfully.</li>
            <li><code>$exists = mysqli_num_rows($result) > 0;</code>: Determines if any rows were returned.</li>
            <li><strong>If the user ID exists:</strong></li>
            <ul>
                <li><code>$html = '&lt;p&gt;User ID &lt;span style="color: #00008B;"&gt;EXISTS&lt;/span&gt; in the database.&lt;/p&gt;';</code>: Sets a message indicating the user ID exists.</li>
            </ul>
            <li><strong>If the user ID does not exist:</strong></li>
            <ul>
                <li><code>http_response_code(404);</code>: Sets the HTTP response code to 404.</li>
                <li><code>$html = '&lt;p&gt;User ID is &lt;span style="color: red;"&gt;MISSING&lt;/span&gt; from the database.&lt;/p&gt;';</code>: Sets a message indicating the user ID is missing.</li>
            </ul>
            <li><code>mysqli_free_result($result);</code>: Frees the result set to release resources.</li>
            <li><strong>If the query failed:</strong></li>
            <ul>
                <li><code>$html = "Error: " . mysqli_error($conn);</code>: Sets an error message with the MySQL error.</li>
            </ul>
            <li><code>mysqli_close($conn);</code>: Closes the database connection.</li>
        </ul>
</br>
        <h3><span style="color: #D10000;">Security Considerations:</span></h3>
        <ul>
            <li><strong>Input Sanitization:</strong> Removes potentially dangerous characters from user input to prevent SQL injection.</li>
            <li><strong>Using Prepared Statements:</strong> Recommended to use prepared statements to prevent SQL injection fully.</li>
            <li><strong>Error Handling:</strong> Displays user-friendly error messages and sets appropriate HTTP response codes.</li>
        </ul>

    </div>



</body>

</html>
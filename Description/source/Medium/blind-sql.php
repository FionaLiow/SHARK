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
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #FFA500;">Medium</span></h2></br>
    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Code Snippet</h3>
    </div>

    <div class="code-container">
        <pre><code>&lt;div class="form_zone"&gt;
    &lt;p&gt;Find user with user ID :&lt;/p&gt;
    &lt;form action="" method="post"&gt;
        &lt;input type="text" name="user_id" id="user_id" placeholder="Enter the user ID"&gt;
        &lt;button type="submit"&gt;Submit&lt;/button&gt;
    &lt;/form&gt;
&lt;/div&gt;

&lt;?php
if (<span class="php-variable">$_SERVER</span>[<span class="php-string">"REQUEST_METHOD"</span>] == <span class="php-string">"POST"</span>) {
    <span class="php-variable">$id</span> = <span class="php-variable">$_POST</span>[<span class="php-string">'user_id'</span>];
    <span class="php-variable">$substring_to_remove</span> = <span class="php-keyword">array</span>(<span class="php-string">"-"</span>, <span class="php-string">"#"</span>, <span class="php-string">"%"</span>);
    <span class="php-variable">$submitted_id</span> = <span class="php-function">str_replace</span>(<span class="php-variable">$substring_to_remove</span>, <span class="php-string">""</span>, <span class="php-variable">$id</span>);
    <span class="php-variable">$query</span>  = <span class="php-string">"SELECT user_id, user_name, email FROM users WHERE user_id = '$submitted_id';"</span>;
    <span class="php-variable">$result</span> = <span class="php-function">mysqli_query</span>(<span class="php-variable">$conn</span>, <span class="php-variable">$query</span>);

    <span class="php-keyword">if</span> (<span class="php-variable">$result</span>) {
        <span class="php-variable">$exists</span> = <span class="php-function">mysqli_num_rows</span>(<span class="php-variable">$result</span>) > 0;

        <span class="php-keyword">if</span> (<span class="php-variable">$exists</span>) {
            <span class="php-variable">$html</span> = <span class="php-string">'&lt;p&gt;User ID &lt;span style="color: #00008B;"&gt;EXISTS&lt;/span&gt; in the database.&lt;/p&gt;'</span>;
        } <span class="php-keyword">else</span> {
            <span class="php-function">http_response_code</span>(404);
            <span class="php-variable">$html</span> = <span class="php-string">'&lt;p&gt;User ID is &lt;span style="color: red;"&gt;MISSING&lt;/span&gt; from the database.&lt;/p&gt;'</span>;
        }

        <span class="php-function">mysqli_free_result</span>(<span class="php-variable">$result</span>);
    } <span class="php-keyword">else</span> {
        <span class="php-comment">// Query execution error</span>
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

        <h3>HTML Form for User ID Submission:</h3>
        <ul>
            <li>
                <code>&lt;div class="form_zone"&gt;</code>: Creates a styled container for the form.
            </li>
            <li>
                <code>&lt;p&gt;Find user with user ID :&lt;/p&gt;</code>: Provides a prompt for the user.
            </li>
            <li>
                <code>&lt;form action="" method="post"&gt;</code>: Sets up a form to submit data via POST to the same page (action="" means the form submits to itself).
            </li>
            <li>
                <code>&lt;input type="text" name="user_id" id="user_id" placeholder="Enter the user ID"&gt;</code>: Allows users to enter a user ID for searching.
            </li>
            <li>
                <code>&lt;button type="submit"&gt;Submit&lt;/button&gt;</code>: Is a submit button triggering form submission.
            </li>
        </ul>

        <h3>PHP Handling of Form Submission:</h3>
        <ul>
            <li>
                <code>if ($_SERVER["REQUEST_METHOD"] == "POST") { ... }</code>: Checks if the form has been submitted using the POST method.
            </li>
            <li>
                <code>$id = $_POST['user_id'];</code>: Retrieves the user_id from the POST data.
            </li>
            <li>
                <code>$substring_to_remove = array("-", "#", "%");</code>: Defines an array of characters to be removed from the user_id.
            </li>
            <li>
                <code>$submitted_id = str_replace($substring_to_remove, "", $id);</code>: Removes characters specified in <code>$substring_to_remove</code> from <code>$id</code> to sanitize the input.
            </li>
            <li>
                <code>$query = "SELECT user_id, user_name, email FROM users WHERE user_id = '$submitted_id';";</code>: Constructs the SQL query to select user information based on the sanitized user_id.
            </li>
            <li>
                <code>$result = mysqli_query($conn, $query);</code>: Executes the SQL query.
            </li>
        </ul>

        <h3>Processing Query Results:</h3>
        <ul>
            <li>
                <code>if ($result) { ... }</code>: Checks if the query executed successfully.
            </li>
            <li>
                If rows exist:
                <ul>
                    <li><code>$html = '&lt;p&gt;User ID &lt;span style="color: #00008B;"&gt;EXISTS&lt;/span&gt; in the database.&lt;/p&gt;';</code>: Indicates that the user ID exists in the database.</li>
                </ul>
            </li>
            <li>
                If no rows exist:
                <ul>
                    <li><code>http_response_code(404); $html = '&lt;p&gt;User ID is &lt;span style="color: red;"&gt;MISSING&lt;/span&gt; from the database.&lt;/p&gt;';</code>: Sets the HTTP response code to 404 and indicates that the user ID is missing from the database.</li>
                </ul>
            </li>
        </ul>

        <h3>Handling Query Execution Errors:</h3>
        <ul>
            <li>
                If the query execution fails:
                <ul>
                    <li><code>$html = "Error: " . mysqli_error($conn);</code>: Captures and displays the error message.</li>
                </ul>
            </li>
        </ul>

        <h3>Closing Database Connection:</h3>
        <ul>
            <li>
                <code>mysqli_free_result($result);</code>: Frees the result set to release resources.
            </li>
            <li>
                <code>mysqli_close($conn);</code>: Closes the database connection once operations are complete.
            </li>
        </ul>

        <h3><span style="color: #D10000;">Security Note:</span></h3>
        <p>
            Sanitizing user input (<code>$id</code>) using <code>str_replace()</code> to remove unwanted characters helps prevent SQL injection and ensures safer database queries.
            Always handle and display errors gracefully (<code>mysqli_error($conn)</code> in this case) to provide meaningful feedback to users and administrators in case of query failures.
        </p>
</br>
    </div>



</body>

</html>
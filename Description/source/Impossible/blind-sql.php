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
    &lt;p&gt;Find user with user ID :&lt;/p&gt;
    &lt;form action="" method="post"&gt;
        &lt;input type="text" name="user_id" id="user_id" placeholder="Enter the user ID"&gt;
        &lt;button type="submit"&gt;Submit&lt;/button&gt;
    &lt;/form&gt;
&lt;/div&gt;

&lt;?php
<span class="php-keyword">if</span> (<span class="php-variable">$_SERVER</span>[<span class="php-string">"REQUEST_METHOD"</span>] == <span class="php-string">"POST"</span>) {
    <span class="php-keyword">if</span> (isset(<span class="php-variable">$_POST</span>[<span class="php-string">'user_id'</span>]) && is_numeric(<span class="php-variable">$_POST</span>[<span class="php-string">'user_id'</span>])) {
        <span class="php-variable">$id</span> = <span class="php-variable">$_POST</span>[<span class="php-string">'user_id'</span>];

        <span class="php-comment">// Prepare SQL statement with placeholders</span>
        <span class="php-variable">$query</span> = <span class="php-string">"SELECT user_id, user_name, email FROM users WHERE user_id = ?"</span>;

        <span class="php-comment">// Prepare the statement</span>
        <span class="php-variable">$stmt</span> = mysqli_prepare(<span class="php-variable">$conn</span>, <span class="php-variable">$query</span>);

        <span class="php-keyword">if</span> (<span class="php-variable">$stmt</span>) {
            <span class="php-comment">// Bind the parameters</span>
            mysqli_stmt_bind_param(<span class="php-variable">$stmt</span>, <span class="php-string">"i"</span>, <span class="php-variable">$id</span>);

            <span class="php-comment">// Execute the statement</span>
            mysqli_stmt_execute(<span class="php-variable">$stmt</span>);

            <span class="php-comment">// Get result</span>
            <span class="php-variable">$result</span> = mysqli_stmt_get_result(<span class="php-variable">$stmt</span>);

            <span class="php-keyword">if</span> (<span class="php-variable">$result</span>) {
                <span class="php-comment">// Check if user exists</span>
                <span class="php-keyword">if</span> (mysqli_num_rows(<span class="php-variable">$result</span>) &gt; 0) {
                    <span class="php-variable">$html</span> = <span class="php-string">'&lt;p&gt;User ID &lt;span style="color: #00008B;"&gt;EXISTS&lt;/span&gt; in the database.&lt;/p&gt;'</span>;
                } <span class="php-keyword">else</span> {
                    http_response_code(404);
                    <span class="php-variable">$html</span> = <span class="php-string">'&lt;p&gt;User ID is &lt;span style="color: red;"&gt;MISSING&lt;/span&gt; from the database.&lt;/p&gt;'</span>;
                }

                <span class="php-comment">// Free result set</span>
                mysqli_free_result(<span class="php-variable">$result</span>);
            } <span class="php-keyword">else</span> {
                <span class="php-comment">// Query execution error</span>
                <span class="php-variable">$error_message</span> = <span class="php-string">"Error: "</span> . mysqli_stmt_error(<span class="php-variable">$stmt</span>);
            }

            <span class="php-comment">// Close statement</span>
            mysqli_stmt_close(<span class="php-variable">$stmt</span>);
        } <span class="php-keyword">else</span> {
            <span class="php-comment">// Statement preparation error</span>
            <span class="php-variable">$error_message</span> = <span class="php-string">"Error preparing statement: "</span> . mysqli_error(<span class="php-variable">$conn</span>);
        }

        <span class="php-comment">// Close connection</span>
        mysqli_close(<span class="php-variable">$conn</span>);
    } <span class="php-keyword">else</span> {
        <span class="php-variable">$html</span> = <span class="php-string">'&lt;p&gt;Please enter a valid user ID.&lt;/p&gt;'</span>;
    }
} <span class="php-keyword">else</span> {
    <span class="php-variable">$html</span> = <span class="php-string">'&lt;p&gt;Please enter a valid user ID.&lt;/p&gt;'</span>;
}
?&gt;
    </code></pre>
    </div>

    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Explanations</h3>
    </div>
    <div class="explanation">

        <h3>HTML Form (<code>&lt;div class="form_zone"&gt;...&lt;/form&gt;</code>):</h3>
        <ul>
            <li>Displays a form where users can enter a user ID to find corresponding information from the database.</li>
        </ul>

        <h3>PHP Logic for Processing Form Submission:</h3>
        <ul>
            <li><strong>Request Method Check (<code>if ($_SERVER["REQUEST_METHOD"] == "POST")</code>):</strong> Ensures the form data is being submitted via POST method.</li>
            <li><strong>Input Validation (<code>if (isset($_POST['user_id']) && is_numeric($_POST['user_id']))</code>):</strong> Checks if the 'user_id' parameter is set and is numeric to prevent SQL injection and ensure valid input.</li>
            <li><strong>Preparing SQL Statement:</strong> Uses a prepared statement to avoid SQL injection vulnerabilities. The query selects user information based on the provided user ID.</li>
            <li><strong>Binding Parameters and Execution:</strong> Binds the user ID parameter to the prepared statement and executes it.</li>
            <li><strong>Handling Result:</strong> Retrieves the result set using <code>mysqli_stmt_get_result()</code> and checks if any rows are returned.</li>
            <li><strong>Error Handling:</strong> Handles potential errors during statement preparation, execution, or result retrieval. Errors are logged or displayed for debugging purposes (<code>$error_message</code>).</li>
            <li><strong>Connection Management:</strong> Closes the prepared statement and database connection after processing.</li>
            <li><strong>Fallback for Initial Load or Invalid Input:</strong> If the form is loaded initially (GET request) or if the submitted user ID is invalid, it prompts the user to enter a valid user ID.</li>
        </ul>
</br>

        <h3><span style="color: #D10000;">Security Considerations:</span></h3>
        <ul>
            <li><strong>Prepared Statements:</strong> Uses prepared statements with parameter binding to prevent SQL injection attacks.</li>
            <li><strong>Input Validation:</strong> Checks the validity of user input (<code>is_numeric()</code>) to ensure only numeric values are processed.</li>
            <li><strong>Error Handling:</strong> Provides error messages for debugging without exposing sensitive information, enhancing application security.</li>
            <li><strong>Database Connection Closure:</strong> Ensures database connections are properly closed after use to optimize resource management and security.</li>
        </ul>

    </div>



</body>

</html>
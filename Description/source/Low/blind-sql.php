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
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: red;">Low</span></h2></br>
    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Code Snippet</h3>
    </div>

    <div class="code-container">
        <pre><code class="php-keyword">&lt;?php
<span class="php-keyword">if</span> (<span class="php-variable">$_SERVER</span>[<span class="php-string">"REQUEST_METHOD"</span>] == <span class="php-string">"POST"</span>) {
    <span class="php-variable">$id</span> = <span class="php-variable">$_POST</span>[<span class="php-string">'user_id'</span>];
    <span class="php-variable">$query</span>  = <span class="php-string">"SELECT user_id, user_name, email FROM users WHERE user_id = '$id';"</span>;
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

        <h3>Checking Request Method:</h3>
        <ul>
            <li>
                <code>if ($_SERVER["REQUEST_METHOD"] == "POST") { ... }</code>: This condition checks if the current request method is POST. This ensures that the code inside the block executes only when the form with <code>method="post"</code> is submitted.
            </li>
        </ul>

        <h3>Retrieving User Input:</h3>
        <ul>
            <li>
                <code>$id = $_POST['user_id'];</code>: This line retrieves the <code>user_id</code> from the POST data. Note that it's directly used in the SQL query, which is not safe. It should be sanitized to prevent SQL injection.
            </li>
        </ul>

        <h3>Database Connection and SQL Preparation:</h3>
        <ul>
            <li>The script assumes a database connection (<code>$conn</code>) has been previously established.</li>
            <li>
                <code>$query = "SELECT user_id, user_name, email FROM users WHERE user_id = '$id';"</code>: Defines the SQL query to select user information based on the <code>user_id</code>.
            </li>
            <li>
                <code>$result = mysqli_query($conn, $query);</code>: Executes the SQL query. Using direct input like this can lead to SQL injection and should be avoided. Prepared statements should be used instead.
            </li>
        </ul>

        <h3>Processing the Query Results:</h3>
        <ul>
            <li>
                <code>if ($result) { ... }</code>: Checks if the query executed successfully.
            </li>
            <li>
                <code>$exists = mysqli_num_rows($result) > 0;</code>: Checks if the query returned any rows.
            </li>
            <li>
                If rows exist, it sets <code>$html = '&lt;p&gt;User ID &lt;span style="color: #00008B;"&gt;EXISTS&lt;/span&gt; in the database.&lt;/p&gt;';</code> indicating the user ID exists in the database.
            </li>
            <li>
                If no rows exist, it sets the HTTP response code to 404 and constructs <code>$html = '&lt;p&gt;User ID is &lt;span style="color: red;"&gt;MISSING&lt;/span&gt; from the database.&lt;/p&gt;';</code> indicating the user ID is missing from the database.
            </li>
        </ul>

        <h3>Error Handling:</h3>
        <ul>
            <li>
                If the query fails, <code>$html = "Error: " . mysqli_error($conn);</code> captures the error message.
            </li>
        </ul>

        <h3>Closing Resources:</h3>
        <ul>
            <li>
                <code>mysqli_free_result($result);</code>: Frees the result set to release resources.
            </li>
            <li>
                <code>mysqli_close($conn);</code>: Closes the database connection once the operations are complete.
            </li>
        </ul>
        <br>
        <h3><span style="color: #D10000;">Security Note:</span></h3>
        <p>
            Always sanitize and validate user inputs (<code>$user_id</code> in this case) to prevent SQL injection attacks. Using prepared statements (<code>$stmt->prepare()</code>, <code>$stmt->bind_param()</code>) helps mitigate these risks.</br>
        </p>
        </br>
    </div>



</body>

</html>
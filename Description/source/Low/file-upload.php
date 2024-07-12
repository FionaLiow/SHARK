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
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: red;">Low</span></h2></br>
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
if (<span class="php-function">isset</span>(<span class="php-variable">$_POST</span>[<span class="php-string">'upload'</span>])) {
    <span class="php-variable">$target_path</span> = <span class="php-string">"../Uploads/Images/"</span>;
    <span class="php-variable">$target_path</span> .= <span class="php-function">basename</span>(<span class="php-variable">$_FILES</span>[<span class="php-string">'image'</span>][<span class="php-string">'name'</span>]);

    <span class="php-comment">// Can we move the file to the upload folder?</span>
    <span class="php-keyword">if</span> (!<span class="php-function">move_uploaded_file</span>(<span class="php-variable">$_FILES</span>[<span class="php-string">'image'</span>][<span class="php-string">'tmp_name'</span>], <span class="php-variable">$target_path</span>)) {
        <span class="php-comment">// No</span>
        <span class="php-variable">$html</span> = <span class="php-string">'&lt;pre&gt;Your image was not uploaded.&lt;/pre&gt;'</span>;
    } else {
        <span class="php-comment">// Yes</span>
        <span class="php-variable">$html</span> = <span class="php-string">"&lt;pre&gt;{$target_path} succesfully uploaded!&lt;/pre&gt;"</span>;
    }
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

        <h3>Sanitizing User Input:</h3>
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

        <h3>Binding Parameters and Executing the Query:</h3>
        <ul>
            <li>
                Since this example does not use prepared statements, it directly executes the query:<br>
                <code>$result = mysqli_query($conn, $query);</code>
            </li>
        </ul>

        <h3>Binding Results and Storing Them:</h3>
        <ul>
            <li>
                <code>if ($result && mysqli_num_rows($result) > 0) { ... }</code>: Checks if the query returned any rows.
            </li>
        </ul>

        <h3>Processing the Query Results:</h3>
        <ul>
            <li>
                <code>while ($row = mysqli_fetch_assoc($result)) { ... }</code>: Iterates through the result set, it retrieves and stores user information in variables.<br>
                <code>$user_id = $row["user_id"];</code><br>
                <code>$user_name = $row["user_name"];</code><br>
                <code>$email = $row["email"];</code><br>
                <code>$html .= "&lt;p&gt;&lt;span&gt;ID: &lt;/span&gt;{$user_id}&lt;/p&gt;&lt;p&gt;&lt;span&gt;Username: &lt;/span&gt; {$user_name}&lt;/p&gt;&lt;p&gt;&lt;span&gt;Email: &lt;/span&gt; {$email}&lt;/p&gt;";</code>: Inside the loop, it constructs HTML to display user information (ID, Username, Email).
            </li>
        </ul>

        <h3>Handling No Results:</h3>
        <ul>
            <li>
                If no user is found:<br>
                <code>} else {<br>$html = "No user found";<br>}</code>: It outputs a message indicating no user was found with the provided <code>user_id</code>.
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

    </div>


</body>

</html>
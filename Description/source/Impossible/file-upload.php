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
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #0000D1;">Impossible</span></h2></br>
    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Code Snippet</h3>
    </div>

    <div class="code-container">
        <pre><code>&lt;div class="form_zone"&gt;
        &lt;p&gt;Upload your image:&lt;/p&gt;
        &lt;form action="" method="post" enctype="multipart/form-data"&gt;
            &lt;input type="file" name="image" id="image"&gt;
            &lt;input type="hidden" name="user_token" value="&lt;?php echo $_SESSION['session_token']; ?&gt;"&gt;
            &lt;button type="submit" name="upload"&gt;Upload&lt;/button&gt;
        &lt;/form&gt;
    &lt;/div&gt;

    &lt;?php

    <span class="php-keyword">if</span> (isset(<span class="php-variable">$_POST</span>[<span class="php-string">'upload'</span>])) {
        <span class="php-comment">// Check Anti-CSRF token</span>
        checkToken(<span class="php-variable">$_REQUEST</span>[<span class="php-string">'user_token'</span>], $_SESSION[<span class="php-string">'session_token'</span>], <span class="php-string">'index.php'</span>);

        <span class="php-comment">// File information</span>
        <span class="php-variable">$uploaded_name</span> = <span class="php-variable">$_FILES</span>[<span class="php-string">'image'</span>][<span class="php-string">'name'</span>];
        <span class="php-variable">$uploaded_ext</span>  = substr(<span class="php-variable">$uploaded_name</span>, strrpos(<span class="php-variable">$uploaded_name</span>, <span class="php-string">'.'</span>) + 1);
        <span class="php-variable">$uploaded_size</span> = <span class="php-variable">$_FILES</span>[<span class="php-string">'image'</span>][<span class="php-string">'size'</span>];
        <span class="php-variable">$uploaded_type</span> = <span class="php-variable">$_FILES</span>[<span class="php-string">'image'</span>][<span class="php-string">'type'</span>];
        <span class="php-variable">$uploaded_tmp</span>  = <span class="php-variable">$_FILES</span>[<span class="php-string">'image'</span>][<span class="php-string">'tmp_name'</span>];

        <span class="php-variable">$target_path</span>  = <span class="php-string">"../Uploads/Images/"</span>;
        <span class="php-variable">$target_file</span>   = md5(uniqid() . <span class="php-variable">$uploaded_name</span>) . <span class="php-string">'.'</span> . <span class="php-variable">$uploaded_ext</span>;
        <span class="php-variable">$temp_file</span>     = ((ini_get(<span class="php-string">'upload_tmp_dir'</span>) == <span class="php-string">''</span>) ? (sys_get_temp_dir()) : (ini_get(<span class="php-string">'upload_tmp_dir'</span>)));
        <span class="php-variable">$temp_file</span>    .= DIRECTORY_SEPARATOR . md5(uniqid() . <span class="php-variable">$uploaded_name</span>) . <span class="php-string">'.'</span> . <span class="php-variable">$uploaded_ext</span>;

        <span class="php-keyword">if</span> ((strtolower(<span class="php-variable">$uploaded_ext</span>) == <span class="php-string">'jpg'</span> || strtolower(<span class="php-variable">$uploaded_ext</span>) == <span class="php-string">'jpeg'</span> || strtolower(<span class="php-variable">$uploaded_ext</span>) == <span class="php-string">'png'</span>) &&
            (<span class="php-variable">$uploaded_size</span> < 10000000000) &&
            (<span class="php-variable">$uploaded_type</span> == <span class="php-string">'image/jpeg'</span> || <span class="php-variable">$uploaded_type</span> == <span class="php-string">'image/png'</span>) && getimagesize(<span class="php-variable">$uploaded_tmp</span>)
        ) {
            <span class="php-comment">// Strip any metadata, by re-encoding image (using php-GD library)</span>
            <span class="php-keyword">if</span> (<span class="php-variable">$uploaded_type</span> == <span class="php-string">'image/jpeg'</span>) {
                <span class="php-variable">$img</span> = imagecreatefromjpeg(<span class="php-variable">$uploaded_tmp</span>);
                imagejpeg(<span class="php-variable">$img</span>, <span class="php-variable">$temp_file</span>, 9);
            } else {
                <span class="php-variable">$img</span> = imagecreatefrompng(<span class="php-variable">$uploaded_tmp</span>);
                imagepng(<span class="php-variable">$img</span>, <span class="php-variable">$temp_file</span>, 9);
            }
            imagedestroy(<span class="php-variable">$img</span>);

            <span class="php-keyword">if</span> (rename(<span class="php-variable">$temp_file</span>, (getcwd() . DIRECTORY_SEPARATOR . <span class="php-variable">$target_path</span> . <span class="php-variable">$target_file</span>))) {
                <span class="php-variable">$html</span> = <span class="php-string">"&lt;pre&gt;&lt;a href='{$target_path}{$target_file}'&gt;{$uploaded_name} ({$target_file})&lt;/a&gt; successfully uploaded!&lt;/pre&gt;"</span>;
            } else {
                <span class="php-variable">$html</span> = <span class="php-string">'&lt;pre&gt;Your image was not uploaded.&lt;/pre&gt;'</span>;
            }

            <span class="php-comment">// Delete any temp files</span>
            <span class="php-keyword">if</span> (file_exists(<span class="php-variable">$temp_file</span>))
                unlink(<span class="php-variable">$temp_file</span>);
        } else {
            <span class="php-comment">// Invalid file</span>
            <span class="php-variable">$html</span> =  <span class="php-string">'&lt;pre&gt;Your image was not uploaded. We can only accept JPEG or PNG images.&lt;/pre&gt;'</span>;
        }
    }

    <span class="php-comment">// Generate Anti-CSRF token</span>
    generateSessionToken();

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
                <code>$user_id = intval($_POST['user_id']);</code>: This line retrieves the <code>user_id</code> from the POST data and converts it to an integer using <code>intval()</code> to ensure it's safe for database queries.
            </li>
        </ul>

        <h3>Database Connection and SQL Preparation:</h3>
        <ul>
            <li>The script assumes a database connection (<code>$conn</code>) has been previously established.</li>
            <li>
                <code>$sql = "SELECT user_id, user_name, email FROM users WHERE user_id = ?";</code>: Defines the SQL query to select user information based on the <code>user_id</code>.
            </li>
            <li>
                <code>$stmt = $conn->prepare($sql);</code>: Prepares the SQL statement for execution.
            </li>
        </ul>

        <h3>Binding Parameters and Executing the Query:</h3>
        <ul>
            <li>
                <code>$stmt->bind_param("i", $user_id);</code>: Binds the <code>user_id</code> parameter to the prepared SQL statement (<code>i</code> indicates it's an integer).
            </li>
            <li>
                <code>$stmt->execute();</code>: Executes the prepared statement with the bound parameter.
            </li>
        </ul>

        <h3>Binding Results and Storing Them:</h3>
        <ul>
            <li>
                <code>$stmt->bind_result($id, $username, $email);</code>: Binds variables (<code>$id</code>, <code>$username</code>, <code>$email</code>) to the prepared statement to store the result.
            </li>
            <li>
                <code>$stmt->store_result();</code>: Stores the result set from the prepared statement.
            </li>
        </ul>

        <h3>Processing the Query Results:</h3>
        <ul>
            <li>
                <code>if ($stmt->num_rows > 0) { ... }</code>: Checks if any rows were returned by the query.
            </li>
            <li>
                <code>while ($stmt->fetch()) { ... }</code>: Iterates through the result set. Assuming only one user is expected (based on <code>user_id</code> uniqueness), it retrieves and prints user information.
            </li>
        </ul>

        <h3>Outputting User Information:</h3>
        <ul>
            <li>
                Inside the <code>while</code> loop, it echoes HTML to display user information (ID, Username, Email). <code>htmlspecialchars()</code> is used to prevent XSS (cross-site scripting) attacks by escaping special characters in the output.
            </li>
        </ul>

        <h3>Handling No Results:</h3>
        <ul>
            <li>
                If no user is found (<code>$stmt->num_rows <= 0</code>), it outputs a message indicating no user was found with the provided <code>user_id</code>.
            </li>
        </ul>

        <h3>Closing Resources:</h3>
        <ul>
            <li>
                <code>$stmt->close();</code>: Closes the prepared statement to free up resources.
            </li>
            <li>
                <code>$conn->close();</code>: Closes the database connection once the operations are complete.
            </li>
        </ul>
        </br>
        <h3><span style="color: #D10000;">Security Note:</span></h3>
        <p>
            Always sanitize and validate user inputs (<code>$user_id</code> in this case) to prevent SQL injection attacks. Using prepared statements (<code>$stmt->prepare()</code>, <code>$stmt->bind_param()</code>) helps mitigate these risks.
        </p>

    </div>


</body>

</html>
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
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #0000D1;">Impossible</span></h2></br>
    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Code Snippet</h3>
    </div>

    <div class="code-container">
        <pre><code>&lt;?php
<span class="php-variable">$target</span> = <span class="php-string">""</span>;

<span class="php-keyword">if</span> (array_key_exists(<span class="php-string">"redirect"</span>, <span class="php-variable">$_GET</span>) && <span class="php-variable">$_GET</span>[<span class="php-string">'redirect'</span>] != <span class="php-string">""</span>) {
    <span class="php-keyword">switch</span> (<span class="php-variable">$_GET</span>[<span class="php-string">'redirect'</span>]) {
        <span class="php-keyword">case</span> <span class="php-string">"../Profile/food_review/fr1.php"</span>:
            <span class="php-variable">$target</span> = <span class="php-string">"../Profile/food_review/fr1.php"</span>;
            <span class="php-keyword">break</span>;
        <span class="php-keyword">case</span> <span class="php-string">"../Profile/food_review/fr2.php"</span>:
            <span class="php-variable">$target</span> = <span class="php-string">"../Profile/food_review/fr2.php"</span>;
            <span class="php-keyword">break</span>;
    }
    <span class="php-keyword">if</span> (<span class="php-variable">$target</span> != <span class="php-string">""</span>) {
        header(<span class="php-string">"location: "</span> . <span class="php-variable">$target</span>);
        exit;
    } <span class="php-keyword">else</span> {
?&gt;
    &lt;div class=<span class="html-string">"body-content"</span>&gt;
    &lt;h2&gt;&amp;nbsp;&amp;nbsp;-&amp;nbsp;&lt;span style ="color: #ff0000;"</span>&gt;Unknown redirect target.&lt;/span&gt;&lt;/h2&gt;
        
    &lt;/div&gt;
&lt;?php
        exit;
    }
}

?&gt;

&lt;div class=<span class="html-string">"body-content"</span>&gt;
    &lt;div class=<span class="html-string">"challenge-title"</span> style=<span class="html-string">"display: flex; align-items: center"</span>&gt;
        &lt;h1&gt;Open HTTP Redirect&lt;/h1&gt;
        &lt;h2&gt;&amp;nbsp;&amp;nbsp;-&amp;nbsp;&lt;span style=<span class="html-string">"color: #0000D1;"</span>&gt;Impossible&lt;/span&gt;&lt;/h2&gt;
    &lt;/div&gt;
    &lt;br&gt;
    &lt;div class=<span class="html-string">"form_zone"</span>&gt;
        &lt;p&gt;
            Below, you'll find two links to insightful food reviews by a renowned food critic
        &lt;/p&gt;
        &lt;ul&gt;
            &lt;li&gt;&lt;a href=<span class="html-string">'?redirect=../Profile/food_review/fr1.php'</span>&gt;Food Review 1&lt;/a&gt;&lt;/li&gt;
            &lt;li&gt;&lt;a href=<span class="html-string">'?redirect=../Profile/food_review/fr2.php'</span>&gt;Food Review 2&lt;/a&gt;&lt;/li&gt;
        &lt;/ul&gt;
    &lt;/div&gt;
&lt;/div&gt;</code></pre>
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
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
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #0000D1;">Impossible</span></h2></br>
    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Code Snippet</h3>
    </div>

    <div class="code-container">
        <pre><code>&lt;?php
<span class="php-keyword">if</span> (<span class="php-variable">$_SERVER</span>[<span class="php-string">"REQUEST_METHOD"</span>] == <span class="php-string">"POST"</span>) {
    <span class="php-variable">$user_id</span> = <span class="php-keyword">intval</span>(<span class="php-variable">$_POST</span>[<span class="php-string">'user_id'</span>]);

    // Database connection assumed to be established earlier in your script
    // For example:
    // <span class="php-comment">// $servername = "localhost";</span>
    // <span class="php-comment">// $username = "root";</span>
    // <span class="php-comment">// $password = "";</span>
    // <span class="php-comment">// $dbname = "your_database";</span>
    // <span class="php-comment">// $conn = new mysqli($servername, $username, $password, $dbname);</span>

    // Prepare and execute the SQL statement
    <span class="php-variable">$sql</span> = <span class="php-string">"SELECT user_id, user_name, email FROM users WHERE user_id = ?"</span>;
    <span class="php-variable">$stmt</span> = <span class="php-variable">$conn</span>-&gt;prepare(<span class="php-variable">$sql</span>);
    <span class="php-variable">$stmt</span>-&gt;bind_param(<span class="php-string">"i"</span>, <span class="php-variable">$user_id</span>);
    <span class="php-variable">$stmt</span>-&gt;execute();
    <span class="php-variable">$stmt</span>-&gt;bind_result(<span class="php-variable">$id</span>, <span class="php-variable">$username</span>, <span class="php-variable">$email</span>);
    <span class="php-variable">$stmt</span>-&gt;store_result();

    // Check if any user was found
    <span class="php-keyword">if</span> (<span class="php-variable">$stmt</span>-&gt;num_rows > 0) {
        <span class="php-keyword">while</span> (<span class="php-variable">$stmt</span>-&gt;fetch()) {
            <span class="php-keyword">echo</span> "&lt;h3&gt;User Information&lt;/h3&gt;";
            <span class="php-keyword">echo</span> "&lt;p&gt;&lt;span&gt;ID:&lt;/span&gt; " . <span class="php-keyword">htmlspecialchars</span>(<span class="php-variable">$id</span>) . "&lt;/p&gt;";
            <span class="php-keyword">echo</span> "&lt;p&gt;&lt;span&gt;Username:&lt;/span&gt; " . <span class="php-keyword">htmlspecialchars</span>(<span class="php-variable">$username</span>) . "&lt;/p&gt;";
            <span class="php-keyword">echo</span> "&lt;p&gt;&lt;span&gt;Email:&lt;/span&gt; " . <span class="php-keyword">htmlspecialchars</span>(<span class="php-variable">$email</span>) . "&lt;/p&gt;";
        }
    } <span class="php-keyword">else</span> {
        <span class="php-keyword">echo</span> "&lt;p&gt;No user found with ID " . <span class="php-keyword">htmlspecialchars</span>(<span class="php-variable">$user_id</span>) . "&lt;/p&gt;";
    }

    // Close the statement and connection
    <span class="php-variable">$stmt</span>-&gt;close();
    <span class="php-variable">$conn</span>-&gt;close();
}
?&gt;
        </code></pre>
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
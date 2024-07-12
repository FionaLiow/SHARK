<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Snippet & Explanations</title>
    <link rel="stylesheet" type="text/css" href="../code-snippet.css">
</head>

<body>
    <h1>Command Injection</h1>
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #FFA500;">Medium</span></h2></br>
    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Code Snippet</h3>
    </div>

    <div class="code-container">
        <pre><code>&lt;div class="form_zone"&gt;
    &lt;p&gt;Ping a device using IP address :&lt;/p&gt;
    &lt;form action="" method="post"&gt;
        &lt;input type="text" name="ip" id="ip" placeholder="Enter IP address"&gt;
        &lt;button type="submit" name="Submit"&gt;Submit&lt;/button&gt;
    &lt;/form&gt;
&lt;/div&gt;

&lt;?php

if (isset(<span class="php-variable">$_POST</span>[<span class="php-string">'Submit'</span>])) {
    <span class="php-variable">$target</span> = <span class="php-variable">$_REQUEST</span>[<span class="php-string">'ip'</span>];

    // Set blacklist
    <span class="php-variable">$substitutions</span> = <span class="php-keyword">array</span>(
        <span class="php-string">'&&'</span> => <span class="php-string">''</span>,
        <span class="php-string">';'</span>  => <span class="php-string">''</span>,
    );

    <span class="php-variable">$target</span> = <span class="php-function">str_replace</span>(<span class="php-function">array_keys</span>(<span class="php-variable">$substitutions</span>), <span class="php-variable">$substitutions</span>, <span class="php-variable">$target</span>);

    // Determine OS and execute the ping command.
    <span class="php-keyword">if</span> (<span class="php-function">stristr</span>(<span class="php-function">php_uname</span>(<span class="php-string">'s'</span>), <span class="php-string">'Windows NT'</span>)) {
        <span class="php-variable">$cmd</span> = <span class="php-function">shell_exec</span>(<span class="php-string">'ping  '</span> . <span class="php-variable">$target</span>);
    } <span class="php-keyword">else</span> {
        <span class="php-variable">$cmd</span> = <span class="php-function">shell_exec</span>(<span class="php-string">'ping  -c 4 '</span> . <span class="php-variable">$target</span>);
    }

}
?&gt;</code></pre>
    </div>


    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Explanations</h3>
    </div>
    <div class="explanation">

        <h3>HTML Form for IP Address Submission:</h3>
        <ul>
            <li>
                <code>&lt;div class="form_zone"&gt;</code>: Creates a styled container for the form.
            </li>
            <li>
                <code>&lt;p&gt;Ping a device using IP address :&lt;/p&gt;</code>: Provides a prompt for the user.
            </li>
            <li>
                <code>&lt;form action="" method="post"&gt;</code>: Sets up a form to submit data via POST to the same page (action="" means the form submits to itself).
            </li>
            <li>
                <code>&lt;input type="text" name="ip" id="ip" placeholder="Enter IP address"&gt;</code>: Allows users to enter an IP address for pinging.
            </li>
            <li>
                <code>&lt;button type="submit" name="Submit"&gt;Submit&lt;/button&gt;</code>: Is a submit button triggering form submission with the name attribute set to Submit.
            </li>
        </ul>

        <h3>PHP Handling of Form Submission:</h3>
        <ul>
            <li>
                <code>if (isset($_POST['Submit'])) { ... }</code>: Checks if the form has been submitted using the POST method and if the Submit button has been clicked.
            </li>
            <li>
                <code>$target = $_REQUEST['ip'];</code>: Retrieves the IP address from the POST data using $_REQUEST, which includes both GET and POST variables. It's sanitized later in the code.
            </li>
            <li>
                <code>$substitutions = array(...);</code>: Defines an array of substitutions to prevent command injection. It removes characters like && and ;.
            </li>
            <li>
                <code>$target = str_replace(array_keys($substitutions), $substitutions, $target);</code>: Sanitizes the $target variable by replacing characters specified in $substitutions with empty strings to prevent command injection.
            </li>
            <li>
                If server OS is Windows:
                <ul>
                    <li><code>$cmd = shell_exec('ping ' . $target);</code>: Executes the ping command on Windows to ping the specified IP address.</li>
                </ul>
            </li>
            <li>
                If server OS is Unix/Linux:
                <ul>
                    <li><code>$cmd = shell_exec('ping -c 4 ' . $target);</code>: Executes the ping command with 4 packets on Unix/Linux to ping the specified IP address.</li>
                </ul>
            </li>
        </ul>

        <h3><span style="color: #D10000;">Security Note:</span></h3>
        <p>
            Sanitizing user input ($target) by removing potentially harmful characters (&&, ;) helps prevent command injection attacks.
            Executing shell commands (shell_exec()) based on user input ($target) can be risky. Ensure that proper sanitization and validation are implemented to mitigate risks.
            Always validate and sanitize input from users before using it in commands or queries to prevent security vulnerabilities.
        </p>
</br>
    </div>



</body>

</html>
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
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #0000D1;">Impossible</span></h2></br>
    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Code Snippet</h3>
    </div>

    <div class="code-container">
        <pre><code>&lt;div class="form_zone"&gt;
    &lt;p&gt;Ping a device using IP address :&lt;/p&gt;
    &lt;form action="" method="post"&gt;
        &lt;input type="hidden" name="user_token" value="&lt;?php echo $_SESSION['session_token']; ?&gt;"&gt;
        &lt;input type="text" name="ip" id="ip" placeholder="Enter IP address"&gt;
        &lt;button type="submit" name="Submit"&gt;Submit&lt;/button&gt;
    &lt;/form&gt;
&lt;/div&gt;

&lt;?php

<span class="php-keyword">if</span> (isset(<span class="php-variable">$_POST</span>[<span class="php-string">'Submit'</span>])) {
    <span class="php-comment">// Check Anti-CSRF token</span>
    checkToken(<span class="php-variable">$_REQUEST</span>[<span class="php-string">'user_token'</span>], <span class="php-variable">$_SESSION</span>[<span class="php-string">'session_token'</span>], <span class="php-string">'index.php'</span>);

    <span class="php-variable">$target</span> = <span class="php-variable">$_REQUEST</span>[<span class="php-string">'ip'</span>];
    <span class="php-variable">$target</span> = stripslashes(<span class="php-variable">$target</span>);

    <span class="php-comment">// Split the IP into 4 octects</span>
    <span class="php-variable">$octet</span> = explode(<span class="php-string">"."</span>, <span class="php-variable">$target</span>);

    <span class="php-comment">// Check IF each octet is an integer</span>
    <span class="php-keyword">if</span> ((is_numeric(<span class="php-variable">$octet</span>[<span class="php-number">0</span>])) &amp;&amp; (is_numeric(<span class="php-variable">$octet</span>[<span class="php-number">1</span>])) &amp;&amp; (is_numeric(<span class="php-variable">$octet</span>[<span class="php-number">2</span>])) &amp;&amp; (is_numeric(<span class="php-variable">$octet</span>[<span class="php-number">3</span>])) &amp;&amp; (sizeof(<span class="php-variable">$octet</span>) == <span class="php-number">4</span>)) {
        <span class="php-comment">// If all 4 octets are int's put the IP back together.</span>
        <span class="php-variable">$target</span> = <span class="php-variable">$octet</span>[<span class="php-number">0</span>] . <span class="php-string">'.'</span> . <span class="php-variable">$octet</span>[<span class="php-number">1</span>] . <span class="php-string">'.'</span> . <span class="php-variable">$octet</span>[<span class="php-number">2</span>] . <span class="php-string">'.'</span> . <span class="php-variable">$octet</span>[<span class="php-number">3</span>];

        <span class="php-keyword">if</span> (stristr(php_uname(<span class="php-string">'s'</span>), <span class="php-string">'Windows NT'</span>)) {
            <span class="php-variable">$cmd</span> = shell_exec(<span class="php-string">'ping  '</span> . <span class="php-variable">$target</span>);
        } else {
            <span class="php-variable">$cmd</span> = shell_exec(<span class="php-string">'ping  -c 4 '</span> . <span class="php-variable">$target</span>);
        }

    } else {
        <span class="php-variable">$cmd</span> =  <span class="php-string">'&lt;pre&gt;ERROR: You have entered an invalid IP.&lt;/pre&gt;'</span>;
    }
}

<span class="php-comment">// Generate Anti-CSRF token</span>
generateSessionToken();
?&gt;
    </code></pre>
    </div>



    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Explanations</h3>
    </div>
    <div class="explanation">

        <h3>HTML Form (<code>&lt;div class="form_zone"&gt;...&lt;/form&gt;</code>):</h3>
        <ul>
            <li><strong>Purpose:</strong> Allows users to input an IP address and initiate a ping request.</li>
            <li><strong>Components:</strong>
                <ul>
                    <li><strong>Hidden CSRF Token:</strong> Ensures form submission authenticity (<code>$_SESSION['session_token']</code>).</li>
                    <li><strong>Input Field</strong> (<code>&lt;input type="text" name="ip" id="ip" placeholder="Enter IP address"&gt;</code>): Where users enter the IP address to ping.</li>
                    <li><strong>Submit Button</strong> (<code>&lt;button type="submit" name="Submit"&gt;Submit&lt;/button&gt;</code>): Initiates the form submission to process the ping request.</li>
                </ul>
            </li>
        </ul>

        <h3>PHP Logic (<code>if (isset($_POST['Submit'])) { ... }</code>):</h3>
        <ul>
            <li><strong>CSRF Protection:</strong>
                <ul>
                    <li><strong>Function Call</strong> (<code>checkToken(...)</code>): Validates the CSRF token submitted in the form against the token stored in the session (<code>$_SESSION['session_token']</code>).</li>
                </ul>
            </li>
            <li><strong>Processing the IP Address:</strong>
                <ul>
                    <li><strong>Retrieving IP</strong> (<code>$target = $_REQUEST['ip'];</code>): Retrieves the user-input IP address from the form submission.</li>
                    <li><strong>Sanitization</strong> (<code>$target = stripslashes($target);</code>): Removes backslashes from the IP address input to prevent potential injection attacks.</li>
                </ul>
            </li>
            <li><strong>Validating IP Address:</strong>
                <ul>
                    <li><strong>Splitting IP</strong> (<code>$octet = explode(".", $target);</code>): Splits the IP address into its four octets.</li>
                    <li><strong>Checking Octets</strong> (<code>is_numeric($octet[0]) ... sizeof($octet) == 4</code>): Ensures each octet is a numeric value and that there are exactly four octets in the IP address.</li>
                </ul>
            </li>
            <li><strong>Executing Ping Command:</strong>
                <ul>
                    <li><strong>Operating System Check</strong> (<code>stristr(php_uname('s'), 'Windows NT')</code>): Detects the operating system to determine the appropriate ping command syntax.</li>
                    <li><strong>Ping Execution</strong> (<code>shell_exec('ping ...')</code>): Executes the ping command with the specified IP address (<code>$target</code>), either on Windows or Unix/Linux systems.</li>
                    <li><strong>Result</strong> (<code>$cmd = ...</code>): Stores the output of the ping command in the variable <code>$cmd</code> to display to the user.</li>
                </ul>
            </li>
            <li><strong>Error Handling:</strong>
                <ul>
                    <li><strong>Invalid IP Address</strong> (<code>$cmd = '&lt;pre&gt;ERROR: You have entered an invalid IP.&lt;/pre&gt;';</code>): If the IP address format is incorrect (e.g., not numeric octets or fewer/more than four octets), displays an error message.</li>
                </ul>
            </li>
            <li><strong>CSRF Token Regeneration:</strong>
                <ul>
                    <li><strong>Function Call</strong> (<code>generateSessionToken();</code>): Regenerates the CSRF token for subsequent form submissions to maintain security.</li>
                </ul>
            </li>
        </ul>

    </div>



</body>

</html>
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
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #2CF4EE;">High</span></h2></br>
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

    <span class="php-keyword">if</span> (isset(<span class="php-variable">$_POST</span>[<span class="php-string">'Submit'</span>])) {
        <span class="php-variable">$target</span> = trim(<span class="php-variable">$_REQUEST</span>[<span class="php-string">'ip'</span>]);

        <span class="php-comment">// Set blacklist</span>
        <span class="php-variable">$substitutions</span> = array(
            <span class="php-string">'&amp;'</span>  =&gt; <span class="php-string">''</span>,
            <span class="php-string">';'</span>  =&gt; <span class="php-string">''</span>,
            <span class="php-string">'| '</span> =&gt; <span class="php-string">''</span>,
            <span class="php-string">'-'</span>  =&gt; <span class="php-string">''</span>,
            <span class="php-string">'$'</span>  =&gt; <span class="php-string">''</span>,
            <span class="php-string">'('</span>  =&gt; <span class="php-string">''</span>,
            <span class="php-string">')'</span>  =&gt; <span class="php-string">''</span>,
            <span class="php-string">'`'</span>  =&gt; <span class="php-string">''</span>,
            <span class="php-string">'||'</span> =&gt; <span class="php-string">''</span>,
        );

        <span class="php-variable">$target</span> = str_replace(array_keys(<span class="php-variable">$substitutions</span>), <span class="php-variable">$substitutions</span>, <span class="php-variable">$target</span>);

        <span class="php-comment">// Determine OS and execute the ping command.</span>
        <span class="php-keyword">if</span> (stristr(php_uname(<span class="php-string">'s'</span>), <span class="php-string">'Windows NT'</span>)) {
            <span class="php-variable">$cmd</span> = shell_exec(<span class="php-string">'ping  '</span> . <span class="php-variable">$target</span>);
        } <span class="php-keyword">else</span> {
            <span class="php-variable">$cmd</span> = shell_exec(<span class="php-string">'ping  -c 4 '</span> . <span class="php-variable">$target</span>);
        }

    }

    ?&gt;
    </code></pre>
    </div>



    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Explanations</h3>
    </div>
    <div class="explanation">

        <h3>HTML Form Setup:</h3>
        <ul>
            <li><code>&lt;div class="form_zone"&gt;</code>: Defines a styled container for the form.</li>
            <li><code>&lt;p&gt;Ping a device using IP address :&lt;/p&gt;</code>: Provides a description of the form's purpose.</li>
            <li><code>&lt;form action="" method="post"&gt;</code>: Sets up a form that sends data via POST to the same page.</li>
            <li><code>&lt;input type="text" name="ip" id="ip" placeholder="Enter IP address"&gt;</code>: Text input field for entering the IP address.</li>
            <li><code>&lt;button type="submit" name="Submit"&gt;Submit&lt;/button&gt;</code>: Submit button to send the form data.</li>
        </ul>

        <h3>Processing the Form Submission:</h3>
        <ul>
            <li><code>if (isset($_POST['Submit'])) { ... }</code>: Checks if the form was submitted via POST with the Submit button clicked.</li>
            <li><code>$target = trim($_REQUEST['ip']);</code>: Retrieves the IP address from the form data, trims any leading or trailing whitespace.</li>
        </ul>

        <h3>Blacklist Setup:</h3>
        <ul>
            <li>Defines an array <code>$substitutions</code> to remove potentially harmful characters from the IP address input to mitigate command injection vulnerabilities.</li>
            <li>Characters removed include &, ;, |, -, $, (, ), ``` , ||.</li>
            <li><code>$target = str_replace(array_keys($substitutions), $substitutions, $target);</code>: Replaces characters in $target based on the $substitutions array.</li>
        </ul>

        <h3>Executing Ping Command:</h3>
        <ul>
            <li>Determines the operating system and executes the appropriate ping command:</li>
            <li><code>if (stristr(php_uname('s'), 'Windows NT')) { ... }</code>: Executes the ping command on Windows.</li>
            <li><code>$cmd = shell_exec('ping ' . $target);</code>: Executes the ping command with the sanitized IP address.</li>
            <li><code>else { ... }</code>: Executes the ping command on Unix-like systems.</li>
            <li><code>$cmd = shell_exec('ping -c 4 ' . $target);</code>: Executes the ping command with the sanitized IP address, sending 4 packets.</li>
        </ul>
</br>
        <h3><span style="color: #D10000;">Security Considerations:</span></h3>
        <ul>
            <li><strong>Input Sanitization:</strong> Removes potentially harmful characters from the IP address input to prevent command injection.</li>
            <li><strong>Operating System Check:</strong> Determines the OS to execute the correct ping command syntax.</li>
            <li><strong>Command Execution:</strong> Uses <code>shell_exec</code> to execute system commands, which should be handled carefully to avoid command injection vulnerabilities.</li>
        </ul>

    </div>



</body>

</html>
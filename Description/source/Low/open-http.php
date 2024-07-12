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
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: red;">Low</span></h2></br>
    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Code Snippet</h3>
    </div>

    <div class="code-container">
        <pre><code>&lt;?php
<span class="php-variable">$redirect_url</span> = <span class="php-string">''</span>;

<span class="php-comment">// PHP logic to handle redirection</span>
<span class="php-keyword">if</span> (<span class="php-function">isset</span>(<span class="php-variable">$_GET</span>[<span class="php-string">'redirect'</span>]) &amp;&amp; !<span class="php-function">empty</span>(<span class="php-variable">$_GET</span>[<span class="php-string">'redirect'</span>])) {
    <span class="php-variable">$redirect_url</span> = <span class="php-variable">$_GET</span>[<span class="php-string">'redirect'</span>];
    <span class="php-keyword">header</span>(<span class="php-string">"Location: $redirect_url"</span>);
    <span class="php-keyword">exit</span>;
}

<span class="php-comment">// If no valid redirect parameter is provided, set HTTP response code and display message</span>
<span class="php-function">http_response_code</span>(500);
?&gt;</code></pre>
    </div>


    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Explanations</h3>
    </div>
    <div class="explanation">

        <h3>Handling Redirection:</h3>
        <ul>
            <li>
                <code>$redirect_url = '';</code>: Initializes an empty variable to store the URL to which the user will be redirected.
            </li>
        </ul>

        <h3>Logic for Redirection:</h3>
        <ul>
            <li>
                <code>if (isset($_GET['redirect']) && !empty($_GET['redirect'])) { ... }</code>: Checks if the redirect parameter is set in the GET request and is not empty.
            </li>
            <li>
                <code>$redirect_url = $_GET['redirect'];</code>: Assigns the value of the redirect parameter from the GET request to <code>$redirect_url</code>.
            </li>
            <li>
                <code>header("Location: $redirect_url");</code>: Sends an HTTP header to redirect the user to the URL specified by <code>$redirect_url</code>.
            </li>
            <li>
                <code>exit;</code>: Terminates the script immediately after issuing the redirection to prevent further execution.
            </li>
        </ul>

        <h3>Handling Invalid Redirection:</h3>
        <ul>
            <li>
                If the redirect parameter is not provided or is empty:
                <ul>
                    <li><code>http_response_code(500);</code>: Sets the HTTP response code to 500 (Internal Server Error).</li>
                </ul>
            </li>
            <li>
                <p><strong>Note:</strong> This typically indicates that the server encountered an unexpected condition that prevented it from fulfilling the request.</p>
            </li>
        </ul>

        <h3>Security Note:</h3>
        <p>
            When performing redirection based on user input (<code>$_GET['redirect']</code> in this case), always validate and sanitize the input to prevent open redirection attacks.
            Avoid redirecting to URLs controlled by users unless absolutely necessary. If redirection to user-controlled URLs is required, ensure strict validation of input to prevent abuse.
            Always use the <code>exit;</code> statement after <code>header("Location: ...");</code> to prevent subsequent code execution, which could potentially be a security risk if sensitive information or actions are still processed.
        </p>
</br>
    </div>


</body>

</html>
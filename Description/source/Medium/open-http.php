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
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #FFA500;">Medium</span></h2></br>
    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Code Snippet</h3>
    </div>

    <div class="code-container">
        <pre><code>&lt;?php
<span class="php-keyword">if</span> (<span class="php-function">array_key_exists</span>(<span class="php-string">"redirect"</span>, <span class="php-variable">$_GET</span>) && <span class="php-variable">$_GET</span>[<span class="php-string">'redirect'</span>] != <span class="php-string">""</span>) {
    <span class="php-keyword">if</span> (<span class="php-function">preg_match</span>(<span class="php-string">"/http:\/\/|https:\/\//i"</span>, <span class="php-variable">$_GET</span>[<span class="php-string">'redirect'</span>])) {
        <span class="php-function">http_response_code</span>(500);
?&gt;
        &lt;div class="body-content"&gt;
            &lt;h2&gt;&lt;i class="fa-solid fa-exclamation fa-bounce" style="color: #ff0000;"&gt;&lt;/i&gt;&nbsp;&nbsp;Absolute URLs not allowed.&lt;/h2&gt;
        &lt;/div&gt;
&lt;?php
        <span class="php-keyword">exit</span>;
    } <span class="php-keyword">else</span> {
        <span class="php-function">header</span>(<span class="php-string">"location: "</span> . <span class="php-variable">$_GET</span>[<span class="php-string">'redirect'</span>]);
        <span class="php-keyword">exit</span>;
    }
}

<span class="php-function">http_response_code</span>(500);
?&gt;

&lt;div class="body-content"&gt;
    &lt;div class="challenge-title" style="display: flex; align-items: center"&gt;
        &lt;h1&gt;Open HTTP Redirect&lt;/h1&gt;
        &lt;h2&gt;&nbsp;&nbsp;-&nbsp;&lt;span style="color: #FFA500;"&gt;Medium&lt;/span&gt;&lt;/h2&gt;
    &lt;/div&gt;
    &lt;/br&gt;
    &lt;div class="form_zone"&gt;
        &lt;p&gt;
            Below, you'll find two links to insightful food reviews by a renowned food critic
        &lt;/p&gt;
        &lt;ul&gt;
            &lt;li&gt;&lt;a href='?redirect=../Profile/food_review/fr1.php'&gt;Food Review 1&lt;/a&gt;&lt;/li&gt;
            &lt;li&gt;&lt;a href='?redirect=../Profile/food_review/fr2.php'&gt;Food Review 2&lt;/a&gt;&lt;/li&gt;
        &lt;/ul&gt;
    &lt;/div&gt;
&lt;/div&gt;
</code></pre>
    </div>



    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Explanations</h3>
    </div>
    <div class="explanation">

        <h3>Checking and Handling Redirect:</h3>
        <ul>
            <li><code>if (array_key_exists("redirect", $_GET) && $_GET['redirect'] != "") { ... }</code>: Checks if the redirect parameter exists in the GET request and is not empty.</li>
            <li><code>preg_match("/http:\/\/|https:\/\//i", $_GET['redirect'])</code>: Uses a regular expression to check if the redirect parameter contains http:// or https://, indicating an absolute URL.</li>
            <li><strong>If an absolute URL is detected:</strong></li>
            <ul>
                <li>Sets HTTP response code to 500 (<code>http_response_code(500);</code>).</li>
                <li>Outputs a warning message within <code>&lt;div class="body-content"&gt;</code>, informing that absolute URLs are not allowed.</li>
            </ul>
            <li><strong>If the redirect parameter is a relative URL:</strong></li>
            <ul>
                <li>Redirects the user to the specified relative URL using <code>header("location: " . $_GET['redirect']);</code>.</li>
                <li><code>exit;</code> is used after each condition to terminate script execution immediately.</li>
            </ul>
        </ul>

        <h3>HTML Content Display:</h3>
        <ul>
            <li><strong>If the redirect parameter is not set or is empty:</strong></li>
            <ul>
                <li>Sets HTTP response code to 500 (<code>http_response_code(500);</code>).</li>
                <li>Displays HTML content within <code>&lt;div class="body-content"&gt;</code>:</li>
                <ul>
                    <li><code>&lt;div class="challenge-title"&gt;</code>: Displays a challenge title.</li>
                    <li><code>&lt;h1&gt;Open HTTP Redirect&lt;/h1&gt;</code>: Main title for the challenge.</li>
                    <li><code>&lt;h2&gt; - &lt;span style="color: #FFA500;"&gt;Medium&lt;/span&gt;&lt;/h2&gt;</code>: Subtitle indicating the difficulty level.</li>
                    <li><code>&lt;div class="form_zone"&gt;</code>: Styled container for the form.</li>
                    <li>Provides a description and lists two links to food reviews (Food Review 1 and Food Review 2) within an unordered list (<code>&lt;ul&gt;</code>).</li>
                </ul>
            </ul>
        </ul>

        <h3><span style="color: #D10000;">Security Considerations:</span></h3>
        <ul>
            <li><strong>Preventing Open Redirects:</strong> Blocks redirection to absolute URLs (http:// or https://) to mitigate open redirect vulnerabilities.</li>
            <li><strong>HTTP Response Codes:</strong> Sets HTTP response code to 500 when encountering potential security risks or unexpected conditions, providing appropriate feedback to users.</li>
            <li><strong>User Input Validation:</strong> Uses regular expression (<code>preg_match</code>) to validate and sanitize user input (<code>$_GET['redirect']</code>), ensuring that only relative URLs are allowed.</li>
        </ul>

    </div>



</body>

</html>
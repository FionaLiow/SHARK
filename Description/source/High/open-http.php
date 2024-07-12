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
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #2CF4EE;">High</span></h2></br>
    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Code Snippet</h3>
    </div>

    <div class="code-container">
        <pre><code>&lt;?php
<span class="php-keyword">if</span> (array_key_exists(<span class="php-string">"redirect"</span>, <span class="php-variable">$_GET</span>) && <span class="php-variable">$_GET</span>[<span class="php-string">'redirect'</span>] != <span class="php-string">""</span>) {
    <span class="php-keyword">if</span> (strpos(<span class="php-variable">$_GET</span>[<span class="php-string">'redirect'</span>], <span class="php-string">"fr1.php"</span>) !== <span class="php-keyword">false</span> || strpos(<span class="php-variable">$_GET</span>[<span class="php-string">'redirect'</span>], <span class="php-string">"fr2.php"</span>) !== <span class="php-keyword">false</span>) {
        header(<span class="php-string">"location: "</span> . <span class="php-variable">$_GET</span>[<span class="php-string">'redirect'</span>]);
        exit;
    } <span class="php-keyword">else</span> {
        http_response_code(500);
?&gt;
        &lt;div class="body-content"&gt;
            &lt;h2&gt;&lt;i class="fa-solid fa-exclamation fa-bounce" style="color: #ff0000;"&gt;&lt;/i&gt;&nbsp;&nbsp;Absolute URLs not allowed.&lt;/h2&gt;
        &lt;/div&gt;
&lt;?php
        exit;
    }
}

http_response_code(500);
?&gt;


&lt;div class="body-content"&gt;
    &lt;div class="challenge-title" style="display: flex; align-items: center"&gt;
        &lt;h1&gt;Open HTTP Redirect&lt;/h1&gt;
        &lt;h2&gt;&nbsp;&nbsp;-&nbsp;&lt;span style="color: #2CF4EE;"&gt;High&lt;/span&gt;&lt;/h2&gt;
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

        <h3>Initial Check (<code>if (array_key_exists("redirect", $_GET) && $_GET['redirect'] != ""))</code>:</h3>
        <ul>
            <li>Verifies if the "redirect" key exists in the GET parameters and is not empty.</li>
        </ul>

        <h3>Validation of Redirect URL:</h3>
        <ul>
            <li><strong>Checks if the "redirect" parameter (<code>$_GET['redirect']</code>) contains either "fr1.php" or "fr2.php" using <code>strpos()</code> function.</strong></li>
            <li>If the condition is met (<code>strpos() !== false</code>), it performs a redirect using <code>header("location: " . $_GET['redirect'])</code>.</li>
            <li>Immediately exits the script after performing the redirect to prevent further execution.</li>
        </ul>

        <h3>Absolute URL Block:</h3>
        <ul>
            <li>If the "redirect" parameter does not contain "fr1.php" or "fr2.php", indicating an attempt to redirect to an absolute URL or unauthorized resource:</li>
            <li>Sets HTTP response code 500 (Internal Server Error).</li>
            <li>Displays an error message within a <code>&lt;div class="body-content"&gt;</code> block, indicating that absolute URLs are not allowed.</li>
        </ul>

        <h3>Fallback Response (<code>http_response_code(500)</code>):</h3>
        <ul>
            <li>If the initial condition (<code>if (array_key_exists("redirect", $_GET) && $_GET['redirect'] != ""))</code> is not met (no valid "redirect" parameter provided):</li>
            <li>Sets HTTP response code 500 (Internal Server Error).</li>
            <li>Renders the main content block within <code>&lt;div class="body-content"&gt;</code>, presenting the challenge title and a form with links to food reviews.</li>
        </ul>
</br>
        <h3><span style="color: #D10000;">Security Considerations:</span></h3>
        <ul>
            <li><strong>Open Redirect Prevention:</strong> Restricts redirects to specific internal URLs ("fr1.php" and "fr2.php") to mitigate the risk of open redirects.</li>
            <li><strong>HTTP Response Code:</strong> Uses appropriate HTTP response codes (500) to indicate server errors or unauthorized attempts.</li>
            <li><strong>Error Messaging:</strong> Provides clear error messaging ("<em>Absolute URLs not allowed.</em>") within a styled <code>&lt;div&gt;</code> to inform users of policy violations.</li>
        </ul>

    </div>



</body>

</html>
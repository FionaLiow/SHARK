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

        <h3>HTTP Redirect Handling:</h3>
        <ul>
            <li>The script checks if the redirect parameter exists in the <code>$_GET</code> array and is not empty (<code>array_key_exists("redirect", $_GET) && $_GET['redirect'] != ""</code>).</li>
            <li>It uses a switch statement to assign the <code>$_GET['redirect']</code> value to the <code>$target</code> variable based on predefined safe values (<code>../Profile/food_review/fr1.php</code> and <code>../Profile/food_review/fr2.php</code>).</li>
        </ul>

        <h3>Safe Redirect Handling:</h3>
        <ul>
            <li>Ensures the <code>$target</code> variable is set correctly by matching <code>$_GET['redirect']</code> values to predefined safe URLs (<code>$target = "../Profile/food_review/fr1.php";</code> and <code>$target = "../Profile/food_review/fr2.php";</code>).</li>
            <li>If <code>$target</code> is successfully set, it redirects the user using <code>header("location: " . $target);</code> to prevent open redirect vulnerabilities.</li>
        </ul>

        <h3>Error Handling:</h3>
        <ul>
            <li>Provides a meaningful error message (<code>&lt;div class="body-content"&gt;</code>) if the <code>$_GET['redirect']</code> value does not match the predefined safe URLs. This helps prevent potential misuse or unauthorized redirection attempts.</li>
        </ul>
</br>
        <h3>Best Practices:</h3>
        <ul>
            <li>Avoids directly using user-controlled input (<code>$_GET['redirect']</code>) in sensitive operations like redirection without validation against a predefined whitelist.</li>
            <li>Uses <code>exit;</code> after redirection or error handling to terminate further script execution, ensuring that the intended behavior (redirect or error message display) is enforced without unintended code execution.</li>
        </ul>
</br>
        <h3><span style="color: #D10000;">Security Notes:</span></h3>
        <ul>
            <li>Although the script handles redirection securely by matching against predefined safe values, it's crucial to regularly review and update the whitelist (switch statement) if new safe redirect URLs are added or old ones are removed.</li>
        </ul>

    </div>


</body>

</html>
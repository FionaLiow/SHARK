<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Snippet & Explanations</title>
    <link rel="stylesheet" type="text/css" href="../code-snippet.css">
</head>

<body>
    <h1>File Inclusion</h1>
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #0000D1;">Impossible</span></h2></br>
    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Code Snippet</h3>
    </div>

    <div class="code-container">
        <pre><code>&lt;?php
    <span class="php-keyword">if</span> (isset(<span class="php-variable">$_GET</span>[<span class="php-string">'page'</span>])) {
        <span class="php-variable">$file</span> = <span class="php-variable">$_GET</span>[<span class="php-string">'page'</span>];
        <span class="php-variable">$allowed_files</span> = [<span class="php-string">'profile1.php'</span>, <span class="php-string">'profile2.php'</span>, <span class="php-string">'profile3.php'</span>];

        <span class="php-keyword">if</span> (!in_array(<span class="php-variable">$file</span>, <span class="php-variable">$allowed_files</span>)) {
            <span class="php-comment">// File is not in the whitelist, exit the script</span>
            echo <span class="php-string">"ERROR: File not found!"</span>;
            exit;
        }
    ?&gt;
        &lt;div class="link-container"&gt;
            &lt;?php include <span class="php-variable">$file</span>; ?&gt;
            &lt;br&gt;
            &lt;a href="../Impossible/file-inclusion.php"&gt;Back&lt;/a&gt;
        &lt;/div&gt;
    &lt;?php
    } else {
    ?&gt;
        &lt;div class="link-container"&gt;
            &lt;h2&gt;View Profile Picture&lt;/h2&gt;
            &lt;a href="?page=profile1.php"&gt;Profile 1&lt;/a&gt;
            &lt;a href="?page=profile2.php"&gt;Profile 2&lt;/a&gt;
            &lt;a href="?page=profile3.php"&gt;Profile 3&lt;/a&gt;
        &lt;/div&gt;
    &lt;?php
    }
    ?&gt;
    </code></pre>
    </div>



    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Explanations</h3>
    </div>
    <div class="explanation">

        <h3>File Inclusion Security:</h3>
        <ul>
            <li>The code restricts inclusion to specific files (<code>profile1.php</code>, <code>profile2.php</code>, <code>profile3.php</code>) using an array whitelist (<code>$allowed_files</code>). This helps prevent arbitrary file inclusion attacks by ensuring only approved files can be included.</li>
        </ul>

        <h3>Input Validation:</h3>
        <ul>
            <li>When handling <code>$_GET['page']</code>, the code checks if the requested file exists in the whitelist (<code>$allowed_files</code>). This validation prevents attackers from injecting arbitrary file paths or accessing unintended files on the server.</li>
        </ul>

        <h3>Error Handling:</h3>
        <ul>
            <li>If the requested file (<code>$_GET['page']</code>) is not in the whitelist, the script exits with an error message (<code>"ERROR: File not found!"</code>). This approach stops further execution, minimizing exposure to unauthorized file inclusions.</li>
        </ul>

</br>
        <h3><span style="color: #D10000;">Security Considerations:</span></h3>
        <ul>
            <li>Ensure that the whitelist (<code>$allowed_files</code>) is regularly updated and maintained. Any changes or additions to the whitelist should be carefully reviewed to avoid unintended access to sensitive files.</li>
            <li>Always use whitelisting over blacklisting for file inclusion. Whitelists explicitly define what is allowed, whereas blacklists attempt to block what is known to be harmful, which can be less effective against new or unknown threats.</li>
        </ul>

    </div>



</body>

</html>
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
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #2CF4EE;">High</span></h2></br>
    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Code Snippet</h3>
    </div>

    <div class="code-container">
        <pre><code>&lt;?php
    <span class="php-keyword">if</span> (isset(<span class="php-variable">$_GET</span>[<span class="php-string">'page'</span>])) {
        <span class="php-variable">$file</span> = <span class="php-variable">$_GET</span>[<span class="php-string">'page'</span>];
        <span class="php-comment">// Input validation</span>
        <span class="php-keyword">if</span> (strpos(<span class="php-variable">$file</span>, <span class="php-string">'profile'</span>) === <span class="php-keyword">false</span>) {
            <span class="php-comment">// File name does not contain 'profile'</span>
            echo <span class="php-string">"ERROR: File not found!"</span>;
            exit;
        }
        <span class="php-variable">$verified_file</span> = str_replace(array(<span class="php-string">"http://"</span>, <span class="php-string">"https://"</span>), <span class="php-string">""</span>, <span class="php-variable">$file</span>);
        <span class="php-variable">$verified_file</span> = str_replace(array(<span class="php-string">"../"</span>, <span class="php-string">"..\\"</span>), <span class="php-string">""</span>, <span class="php-variable">$file</span>);
    ?&gt;
        &lt;div class="link-container"&gt;
            &lt;?php include <span class="php-variable">$verified_file</span>; ?&gt;
            &lt;br&gt;
            &lt;a href="../High/file-inclusion.php"&gt;Back&lt;/a&gt;
        &lt;/div&gt;
    &lt;?php
    } <span class="php-keyword">else</span> {
    ?&gt;
        &lt;/br&gt;
        &lt;p&gt;&lt;span style="font-weight:bold;" class="rainbow-text"&gt;HINT!&lt;/span&gt; Your final mission is to find the hidden message left by those profiles.&lt;/p&gt;
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

        <h3>Initial Check (<code>isset($_GET['page'])</code>):</h3>
        <ul>
            <li>Checks if the <code>page</code> parameter is present in the GET request.</li>
        </ul>

        <h3>Input Validation (<code>strpos($file, 'profile') === false</code>):</h3>
        <ul>
            <li>Uses <code>strpos</code> to check if the value of <code>$file</code> (the value of <code>page</code> parameter) contains the substring <code>'profile'</code>.</li>
            <li>If the substring <code>'profile'</code> is not found, it indicates an error because only files with <code>'profile'</code> in their name are allowed.</li>
            <li>Outputs an error message ("<code>ERROR: File not found!</code>") and exits the script if the condition is true.</li>
        </ul>

        <h3>File Inclusion (<code>include $verified_file;</code>):</h3>
        <ul>
            <li>If the input validation passes (i.e., <code>$file</code> contains <code>'profile'</code>), removes potentially dangerous substrings like "<code>http://</code>", "<code>https://</code>", "<code>../</code>", "<code>..\</code>" from <code>$file</code> to ensure safe file inclusion.</li>
            <li>Includes the validated file (<code>$verified_file</code>) within the HTML structure.</li>
        </ul>

        <h3>Back Link (<code>&lt;a href="../High/file-inclusion.php"&gt;Back&lt;/a&gt;</code>):</h3>
        <ul>
            <li>Provides a link labeled "Back" that allows the user to return to a specified location (<code>../High/file-inclusion.php</code> in this case).</li>
        </ul>

        <h3>Profile Links (if <code>$_GET['page']</code> is not set):</h3>
        <ul>
            <li>Displays a set of profile links if the <code>page</code> parameter is not provided in the GET request.</li>
            <li>Each link (<code>?page=profile1.php</code>, <code>?page=profile2.php</code>, <code>?page=profile3.php</code>) points to a specific profile page.</li>
        </ul>
</br>
        <h3><span style="color: #D10000;">Security Considerations:</span></h3>
        <ul>
            <li><strong>Input Validation:</strong> Ensures that only files with <code>'profile'</code> in their name are included, mitigating directory traversal attacks.</li>
            <li><strong>File Inclusion:</strong> Uses sanitized <code>$verified_file</code> to include files, removing potential risks associated with URL-based input.</li>
            <li><strong>Error Handling:</strong> Provides clear error messages and exits the script if input validation fails, preventing further execution of potentially insecure operations.</li>
        </ul>

    </div>



</body>

</html>
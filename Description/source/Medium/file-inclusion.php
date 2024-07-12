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
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #FFA500;">Medium</span></h2></br>
    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Code Snippet</h3>
    </div>

    <div class="code-container">
        <pre><code>&lt;?php
if (isset(<span class="php-variable">$_GET</span>[<span class="php-string">'page'</span>])) {
    <span class="php-variable">$file</span> = <span class="php-variable">$_GET</span>[<span class="php-string">'page'</span>];
    <span class="php-variable">$verified_file</span> = <span class="php-function">str_replace</span>(<span class="php-function">array</span>(<span class="php-string">"http://"</span>, <span class="php-string">"https://"</span>), <span class="php-string">""</span>, <span class="php-variable">$file</span>);
    <span class="php-variable">$verified_file</span> = <span class="php-function">str_replace</span>(<span class="php-function">array</span>(<span class="php-string">"../"</span>, <span class="php-string">"..\\"</span>), <span class="php-string">""</span>, <span class="php-variable">$file</span>);
    ?&gt;
        &lt;div class="link-container"&gt;
            &lt;?php include <span class="php-variable">$verified_file</span>; ?&gt;
            &lt;br&gt;
            &lt;a href="../Medium/file-inclusion.php"&gt;Back&lt;/a&gt;
        &lt;/div&gt;
    &lt;?php
} else {
    ?&gt;
        &lt;/br&gt;
        &lt;p&gt;&lt;span style="font-weight:bold;" class="rainbow-text" ;&gt;HINT!&lt;/span&gt; Your final mission is to find the hidden mesage left by those profiles.&lt;/p&gt;
        &lt;div class="link-container"&gt;
            &lt;h2&gt;View Profile Picture&lt;/h2&gt;
            &lt;a href="?page=profile1.php"&gt;Profile 1&lt;/a&gt;
            &lt;a href="?page=profile2.php"&gt;Profile 2&lt;/a&gt;
            &lt;a href="?page=profile3.php"&gt;Profile 3&lt;/a&gt;
        &lt;/div&gt;
    &lt;?php
}
?&gt;</code></pre>
    </div>



    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Explanations</h3>
    </div>
    <div class="explanation">

        <h3>Handling File Inclusion via GET Parameter:</h3>
        <ul>
            <li><code>if (isset($_GET['page'])) { ... }</code>: Checks if the page parameter is set in the GET request.</li>
            <li><code>$file = $_GET['page'];</code>: Retrieves the value of page parameter from the GET request.</li>
            <li><code>$verified_file = str_replace(array("http://", "https://"), "", $file);</code>: Removes http:// and https:// prefixes from $file to prevent loading files from external URLs.</li>
            <li><code>$verified_file = str_replace(array("../", "..\\"), "", $file);</code>: Removes ../ and ..\\ sequences from $file to prevent directory traversal attacks.</li>
            <li><code>$verified_file</code> now contains a sanitized filename suitable for inclusion.</li>
        </ul>

        <h3>HTML Output:</h3>
        <p>Inside the conditional block (if (isset($_GET['page'])) { ... }):</p>
        <ul>
            <li><code>&lt;div class="link-container"&gt;</code>: Starts a styled container for the included content.</li>
            <li><code>&lt;?php include $verified_file; ?&gt;</code>: Dynamically includes the file specified by $verified_file. This assumes $verified_file points to a local file after sanitization.</li>
            <li><code>&lt;a href="../Medium/file-inclusion.php"&gt;Back&lt;/a&gt;</code>: Provides a link to navigate back to the original file inclusion page.</li>
        </ul>
        <p>Inside the else block (when $_GET['page'] is not set):</p>
        <ul>
            <li><code>&lt;p&gt;&lt;span style="font-weight:bold;" class="rainbow-text" ;&gt;HINT!&lt;/span&gt; Your final mission is to find the hidden message left by those profiles.&lt;/p&gt;</code>: Displays a hint message with styled text.</li>
            <li><code>&lt;div class="link-container"&gt;</code>: Starts a container for profile links.</li>
            <li><code>&lt;h2&gt;View Profile Picture&lt;/h2&gt;</code>: Heading indicating the purpose of the links.</li>
            <li>Profile links (<code>&lt;a href="?page=profile1.php"&gt;Profile 1&lt;/a&gt;, &lt;a href="?page=profile2.php"&gt;Profile 2&lt;/a&gt;, &lt;a href="?page=profile3.php"&gt;Profile 3&lt;/a&gt;</code>): Links to different profile pages that set the page parameter in the URL.</li>
        </ul>

        <h3><span style="color: #D10000;">Security Considerations:</span></h3>
        <ul>
            <li><strong>Input Validation:</strong> The use of <code>str_replace()</code> to remove specific strings (http://, https://, ../, ..\\) from $file helps mitigate against including files from external URLs or traversing directories.</li>
            <li><strong>File Inclusion:</strong> Dynamically including files based on user input (<code>$verified_file</code>) should only include files that are safe and intended for inclusion. Avoid including files that are not under direct control.</li>
            <li><strong>Directory Traversal:</strong> Removing ../ and ..\\ sequences prevents potential directory traversal attacks, which could otherwise allow an attacker to access sensitive files on the server.</li>
        </ul>

    </div>



</body>

</html>
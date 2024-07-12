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
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: red;">Low</span></h2></br>
    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Code Snippet</h3>
    </div>

    <div class="code-container">
        <pre><code>&lt;?php
<span class="php-keyword">if</span> (<span class="php-function">isset</span>(<span class="php-variable">$_GET</span>[<span class="php-string">'page'</span>])) {
    <span class="php-variable">$file</span> = <span class="php-variable">$_GET</span>[<span class="php-string">'page'</span>];
    ?&gt;
    &lt;div class="link-container"&gt;
        &lt;?php <span class="php-keyword">include</span> <span class="php-variable">$file</span>; ?&gt;
        &lt;br&gt;
        &lt;a href="../Low/file-inclusion.php"&gt;Back&lt;/a&gt;
    &lt;/div&gt;
&lt;?php
} else {
?&gt;
    &lt;br&gt;
    &lt;p&gt;&lt;span style="font-weight:bold;"&gt;HINT!&lt;/span&gt; Your final mission is to find the hidden message left by those profiles.&lt;/p&gt;
    &lt;div class="link-container"&gt;
        &lt;h2&gt;View Profile Picture&lt;/h2&gt;
        &lt;a href="?page=../Profile/profile1.php"&gt;Profile 1&lt;/a&gt;
        &lt;a href="?page=../Profile/profile2.php"&gt;Profile 2&lt;/a&gt;
        &lt;a href="?page=../Profile/profile3.php"&gt;Profile 3&lt;/a&gt;
    &lt;/div&gt;
&lt;?php
}
?&gt;</code></pre>
    </div>

    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Explanations</h3>
    </div>

    <div class="explanation">

        <h3>Checking for Query Parameter:</h3>
        <ul>
            <li>
                <code>if (isset($_GET['page'])) { ... }</code>: This condition checks if the <code>page</code> query parameter is set in the URL. This determines whether to include a specific file based on user input.
            </li>
        </ul>

        <h3>Handling File Inclusion:</h3>
        <ul>
            <li>
                <code>$file = $_GET['page'];</code>: This line retrieves the value of the <code>page</code> parameter from the GET request.
            </li>
            <li>
                <code>include $file;</code>: Includes the file specified by the user, which could lead to a vulnerability known as Local File Inclusion (LFI) if not properly sanitized.
            </li>
        </ul>

        <h3>Conditional Output:</h3>
        <ul>
            <li>
                If the <code>page</code> parameter is set:
                <ul>
                    <li>The included file (<code>$file</code>) is displayed within a <code>&lt;div class="link-container"&gt;</code>.</li>
                    <li>A back link <code>&lt;a href="../Low/file-inclusion.php"&gt;Back&lt;/a&gt;</code> is provided to return to the original page.</li>
                </ul>
            </li>
            <li>
                If the <code>page</code> parameter is not set:
                <ul>
                    <li>A hint message is displayed: <code>&lt;p&gt;&lt;span style="font-weight:bold;"&gt;HINT!&lt;/span&gt; Your final mission is to find the hidden message left by those profiles.&lt;/p&gt;</code></li>
                    <li>Links are provided to view profiles (<code>profile1.php</code>, <code>profile2.php</code>, <code>profile3.php</code>) with the <code>page</code> parameter set accordingly (<code>?page=...</code>).</li>
                </ul>
            </li>
        </ul>

        <h3>Security Note:</h3>
        <p>
            Using user-supplied input (<code>$_GET['page']</code> in this case) directly in file inclusion operations can lead to Local File Inclusion (LFI) vulnerabilities.
            Validate and sanitize user input rigorously before including files. Ensure that only expected and safe files can be included, and consider using a whitelist approach where possible.
            Avoid exposing sensitive system files or files that shouldn't be directly accessible through such mechanisms.
        </p>
</br>
    </div>


</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Snippet & Explanations</title>
    <link rel="stylesheet" type="text/css" href="../code-snippet.css">
</head>

<body>
    <h1>File Upload</h1>
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: red;">Low</span></h2></br>
    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Code Snippet</h3>
    </div>

    <div class="code-container">
        <pre><code>&lt;div class="form_zone"&gt;
    &lt;p&gt;Upload your image:&lt;/p&gt;
    &lt;form action="" method="post" enctype="multipart/form-data"&gt;
        &lt;input type="file" name="image" id="image"&gt;
        &lt;button type="submit" name="upload"&gt;Upload&lt;/button&gt;
    &lt;/form&gt;
&lt;/div&gt;

&lt;?php
if (<span class="php-function">isset</span>(<span class="php-variable">$_POST</span>[<span class="php-string">'upload'</span>])) {
    <span class="php-variable">$target_path</span> = <span class="php-string">"../Uploads/Images/"</span>;
    <span class="php-variable">$target_path</span> .= <span class="php-function">basename</span>(<span class="php-variable">$_FILES</span>[<span class="php-string">'image'</span>][<span class="php-string">'name'</span>]);

    <span class="php-comment">// Can we move the file to the upload folder?</span>
    <span class="php-keyword">if</span> (!<span class="php-function">move_uploaded_file</span>(<span class="php-variable">$_FILES</span>[<span class="php-string">'image'</span>][<span class="php-string">'tmp_name'</span>], <span class="php-variable">$target_path</span>)) {
        <span class="php-comment">// No</span>
        <span class="php-variable">$html</span> = <span class="php-string">'&lt;pre&gt;Your image was not uploaded.&lt;/pre&gt;'</span>;
    } else {
        <span class="php-comment">// Yes</span>
        <span class="php-variable">$html</span> = <span class="php-string">"&lt;pre&gt;{$target_path} succesfully uploaded!&lt;/pre&gt;"</span>;
    }
}
?&gt;</code></pre>
    </div>


    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Explanations</h3>
    </div>
    <div class="explanation">

        <h3>HTML Form for Image Upload:</h3>
        <ul>
            <li>
                <code>&lt;div class="form_zone"&gt;</code>: Creates a styled container for the form.
            </li>
            <li>
                <code>&lt;p&gt;Upload your image:&lt;/p&gt;</code>: Provides a prompt for the user.
            </li>
            <li>
                <code>&lt;form action="" method="post" enctype="multipart/form-data"&gt;</code>: Sets up a form to submit files via POST with multipart/form-data encoding.
            </li>
            <li>
                <code>&lt;input type="file" name="image" id="image"&gt;</code>: Allows users to select a file for upload.
            </li>
            <li>
                <code>&lt;button type="submit" name="upload"&gt;Upload&lt;/button&gt;</code>: Is a submit button triggering form submission with the name attribute set to upload.
            </li>
        </ul>

        <h3>PHP Handling of File Upload:</h3>
        <ul>
            <li>
                <code>if (isset($_POST['upload'])) { ... }</code>: Checks if the form has been submitted with the upload button.
            </li>
            <li>
                <code>$target_path = "../Uploads/Images/";</code>: Sets the directory path where uploaded files will be stored.
            </li>
            <li>
                <code>$target_path .= basename($_FILES['image']['name']);</code>: Appends the basename of the uploaded file's original name to the target path.
            </li>
            <li>
                <code>move_uploaded_file($_FILES['image']['tmp_name'], $target_path);</code>: Attempts to move the uploaded file from its temporary location ($_FILES['image']['tmp_name']) to the specified target path ($target_path).
            </li>
        </ul>

        <h3>Handling Upload Success or Failure:</h3>
        <ul>
            <li>
                If <code>move_uploaded_file()</code> returns true:
                <ul>
                    <li><code>$html = "&lt;pre&gt;{$target_path} succesfully uploaded!&lt;/pre&gt;";</code>: Sets a success message displaying the uploaded file's path.
                </ul>
            </li>
            <li>
                If <code>move_uploaded_file()</code> returns false:
                <ul>
                    <li><code>$html = '&lt;pre&gt;Your image was not uploaded.&lt;/pre&gt;';</code>: Sets an error message indicating the upload failure.
                </ul>
            </li>
        </ul>

        <h3>Security Note:</h3>
        <p>
            Always validate and sanitize user input, especially file uploads (<code>$_FILES['image']['name']</code> in this case), to prevent vulnerabilities like directory traversal and file overwrites.
            Store uploaded files in a directory that is outside the web root and restrict file permissions to prevent unauthorized access or execution of uploaded files.
            Consider implementing additional checks such as file type validation (<code>$_FILES['image']['type']</code>) and file size limits to enhance security and prevent abuse.
        </p>
</br>
    </div>




</body>

</html>
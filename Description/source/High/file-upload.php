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
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #2CF4EE;">High</span></h2></br>
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

    <span class="php-keyword">if</span> (isset(<span class="php-variable">$_POST</span>[<span class="php-string">'upload'</span>])) {
        <span class="php-variable">$target_path</span>  = <span class="php-string">"../Uploads/Images/"</span>;
        <span class="php-variable">$target_path</span> .= basename(<span class="php-variable">$_FILES</span>[<span class="php-string">'image'</span>][<span class="php-string">'name'</span>]);

        <span class="php-variable">$uploaded_name</span> = <span class="php-variable">$_FILES</span>[<span class="php-string">'image'</span>][<span class="php-string">'name'</span>];
        <span class="php-variable">$uploaded_tmp</span>  = <span class="php-variable">$_FILES</span>[<span class="php-string">'image'</span>][<span class="php-string">'tmp_name'</span>];
        <span class="php-variable">$uploaded_ext</span>  = substr(<span class="php-variable">$uploaded_name</span>, strrpos(<span class="php-variable">$uploaded_name</span>, <span class="php-string">'.'</span>) + 1);
        <span class="php-variable">$uploaded_size</span> = <span class="php-variable">$_FILES</span>[<span class="php-string">'image'</span>][<span class="php-string">'size'</span>];

        <span class="php-keyword">if</span> ((strtolower(<span class="php-variable">$uploaded_ext</span>) == <span class="php-string">"jpg"</span> || strtolower(<span class="php-variable">$uploaded_ext</span>) == <span class="php-string">"jpeg"</span> || strtolower(<span class="php-variable">$uploaded_ext</span>) == <span class="php-string">"png"</span>) &&
            (<span class="php-variable">$uploaded_size</span> &lt; 10000000000)&&getimagesize( <span class="php-variable">$uploaded_tmp</span> )
        ) {

            <span class="php-keyword">if</span> (!move_uploaded_file(<span class="php-variable">$uploaded_tmp</span>, <span class="php-variable">$target_path</span>)) {
                <span class="php-variable">$html</span> = <span class="php-string">'&lt;pre&gt;Your image was not uploaded.&lt;/pre&gt;'</span>;
            } <span class="php-keyword">else</span> {
                <span class="php-variable">$html</span> = <span class="php-string">'&lt;pre&gt;{$target_path} succesfully uploaded!&lt;/pre&gt;'</span>;
            }
        } <span class="php-keyword">else</span> {
            <span class="php-comment">// Invalid file</span>
            <span class="php-variable">$html</span> = <span class="php-string">'&lt;pre&gt;Your image was not uploaded. We can only accept JPEG or PNG images.&lt;/pre&gt;'</span>;
        }
    }

    ?&gt;
    </code></pre>
    </div>



    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Explanations</h3>
    </div>
    <div class="explanation">

        <h3>Form Structure (<code>&lt;form&gt;</code>):</h3>
        <ul>
            <li>Displays a form with <code>enctype="multipart/form-data"</code> for uploading files.</li>
            <li>Includes an <code>&lt;input type="file" name="image"&gt;</code> element named "image" and a submit button.</li>
        </ul>

        <h3>PHP Processing (<code>if (isset($_POST['upload'])))</code>:</h3>
        <ul>
            <li>Checks if the form has been submitted with the name "upload".</li>
        </ul>

        <h3>File Handling:</h3>
        <ul>
            <li><strong>Target Path Calculation (<code>$target_path</code>):</strong> Sets the target directory path (<code>../Uploads/Images/</code>) for storing uploaded images. Appends the basename of the uploaded file (<code>$_FILES['image']['name']</code>) to <code>$target_path</code>.</li>
            <li><strong>File Information Retrieval:</strong> Retrieves the name (<code>$uploaded_name</code>), temporary path (<code>$uploaded_tmp</code>), extension (<code>$uploaded_ext</code>), and size (<code>$uploaded_size</code>) of the uploaded file.</li>
            <li><strong>File Validation:</strong> Checks if the file extension (<code>$uploaded_ext</code>) is either "jpg", "jpeg", or "png" using <code>strtolower()</code> for case-insensitivity. Validates if the file size (<code>$uploaded_size</code>) is less than 10,000,000,000 bytes (approximately 10GB). Uses <code>getimagesize($uploaded_tmp)</code> to verify that the uploaded file is indeed an image.</li>
            <li><strong>File Upload (<code>move_uploaded_file()</code>):</strong> If all validations pass, moves the uploaded file from its temporary location (<code>$uploaded_tmp</code>) to the target path (<code>$target_path</code>). Updates <code>$html</code> variable with a success message ("<code>$target_path successfully uploaded!</code>") if the file upload is successful.</li>
            <li><strong>Error Handling:</strong> If any validation fails (invalid file type, size, or not an image), updates <code>$html</code> with an error message indicating the reason for upload failure.</li>
        </ul>
</br>
        <h3><span style="color: #D10000;">Security Considerations:</span></h3>
        <ul>
            <li><strong>File Type Validation:</strong> Ensures that only JPEG and PNG images are accepted using a whitelist approach (<code>strtolower()</code> check).</li>
            <li><strong>File Size Limit:</strong> Limits the maximum file size to prevent server overload (<code>$uploaded_size</code> check).</li>
            <li><strong>Temporary Path Usage:</strong> Utilizes the temporary path (<code>$uploaded_tmp</code>) for handling file uploads, avoiding direct execution from user-supplied paths.</li>
        </ul>

    </div>


</body>

</html>
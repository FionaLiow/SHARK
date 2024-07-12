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
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #FFA500;">Medium</span></h2></br>
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
if (isset(<span class="php-variable">$_POST</span>[<span class="php-string">'upload'</span>])) {
    <span class="php-variable">$target_dir</span> = <span class="php-string">"../Uploads/Images/"</span>;
    <span class="php-variable">$target_path</span> = <span class="php-variable">$target_dir</span> . <span class="php-function">basename</span>(<span class="php-variable">$_FILES</span>[<span class="php-string">'image'</span>][<span class="php-string">'name'</span>]);
  
    <span class="php-variable">$uploaded_name</span> = <span class="php-variable">$_FILES</span>[<span class="php-string">'image'</span>][<span class="php-string">'tmp_name'</span>];
    <span class="php-variable">$uploaded_type</span> = <span class="php-variable">$_FILES</span>[<span class="php-string">'image'</span>][<span class="php-string">'type'</span>];
    <span class="php-variable">$uploaded_size</span> = <span class="php-variable">$_FILES</span>[<span class="php-string">'image'</span>][<span class="php-string">'size'</span>];

    <span class="php-keyword">if</span> ((<span class="php-variable">$uploaded_type</span> == <span class="php-string">"image/jpeg"</span> || <span class="php-variable">$uploaded_type</span> == <span class="php-string">"image/png"</span>) &&
        (<span class="php-variable">$uploaded_size</span> &lt; 10000000000)
    ) {
        
        <span class="php-keyword">if</span> (!<span class="php-function">move_uploaded_file</span>(<span class="php-variable">$uploaded_name</span>, <span class="php-variable">$target_path</span>)) {
            <span class="php-variable">$html</span> = <span class="php-string">'&lt;pre&gt;Your image was not uploaded.&lt;/pre&gt;'</span>;
        } <span class="php-keyword">else</span> {
            <span class="php-variable">$html</span> = <span class="php-string">"&lt;pre&gt;{$target_path} succesfully uploaded!&lt;/pre&gt;"</span>;
        }
    } <span class="php-keyword">else</span> {
        // Invalid file
        <span class="php-variable">$html</span> = <span class="php-string">'&lt;pre&gt;Your image was not uploaded. We can only accept JPEG or PNG images.&lt;/pre&gt;'</span>;
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
            <li><code>&lt;div class="form_zone"&gt;</code>: Creates a styled container for the form.</li>
            <li><code>&lt;p&gt;Upload your image:&lt;/p&gt;</code>: Provides a prompt for the user.</li>
            <li><code>&lt;form action="" method="post" enctype="multipart/form-data"&gt;</code>: Sets up a form to submit data via POST to the same page and allows for file uploads.</li>
            <li><code>&lt;input type="file" name="image" id="image"&gt;</code>: Allows users to select a file for upload.</li>
            <li><code>&lt;button type="submit" name="upload"&gt;Upload&lt;/button&gt;</code>: A submit button triggering form submission with the name attribute set to upload.</li>
        </ul>

        <h3>PHP Handling of File Upload:</h3>
        <ul>
            <li><code>if (isset($_POST['upload'])) { ... }</code>: Checks if the form has been submitted using the POST method and if the upload button has been clicked.</li>
            <li><code>$target_dir = "../Uploads/Images/";</code>: Specifies the directory where uploaded images will be stored.</li>
            <li><code>$target_path = $target_dir . basename($_FILES['image']['name']);</code>: Constructs the full path for the uploaded file using the base name of the uploaded file.</li>
            <li><code>$uploaded_name = $_FILES['image']['tmp_name'];</code>, <code>$uploaded_type = $_FILES['image']['type'];</code>, <code>$uploaded_size = $_FILES['image']['size'];</code>: Retrieves information about the uploaded file, including its temporary name, type, and size.</li>
        </ul>

        <h3>Validation and Upload Process:</h3>
        <ul>
            <li><strong>Validation checks:</strong></li>
            <ul>
                <li>Checks if the uploaded file type (<code>$uploaded_type</code>) is either "image/jpeg" or "image/png".</li>
                <li>Checks if the uploaded file size (<code>$uploaded_size</code>) is less than 10000000000 bytes (approximately 10MB).</li>
            </ul>
            <li>If both validation conditions are met:</li>
            <ul>
                <li><code>move_uploaded_file($uploaded_name, $target_path);</code>: Moves the uploaded file from its temporary location to the specified target path.</li>
                <li>If successful, sets <code>$html</code> to indicate the successful upload with the path of the uploaded file.</li>
                <li>If unsuccessful, sets <code>$html</code> to indicate that the image was not uploaded.</li>
            </ul>
            <li>If the file does not meet the validation criteria:</li>
            <ul>
                <li>Sets <code>$html</code> to indicate that only JPEG or PNG images are accepted and provides an error message.</li>
            </ul>
        </ul>

        <h3><span style="color: #D10000;">Security Considerations:</span></h3>
        <ul>
            <li><strong>File Type and Size Validation:</strong> Ensures that only JPEG or PNG images within a reasonable size limit are accepted for upload, preventing potential execution of malicious code disguised as image files.</li>
            <li><strong>File Upload Location:</strong> Specifies a directory (../Uploads/Images/) where uploaded files are stored, ensuring they are kept separate from executable scripts and sensitive data.</li>
        </ul>

    </div>



</body>

</html>
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
    <h2>&nbsp;&nbsp;-&nbsp;<span style="color: #0000D1;">Impossible</span></h2></br>
    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Code Snippet</h3>
    </div>

    <div class="code-container">
        <pre><code>&lt;div class="form_zone"&gt;
        &lt;p&gt;Upload your image:&lt;/p&gt;
        &lt;form action="" method="post" enctype="multipart/form-data"&gt;
            &lt;input type="file" name="image" id="image"&gt;
            &lt;input type="hidden" name="user_token" value="&lt;?php echo $_SESSION['session_token']; ?&gt;"&gt;
            &lt;button type="submit" name="upload"&gt;Upload&lt;/button&gt;
        &lt;/form&gt;
    &lt;/div&gt;

    &lt;?php

    <span class="php-keyword">if</span> (isset(<span class="php-variable">$_POST</span>[<span class="php-string">'upload'</span>])) {
        <span class="php-comment">// Check Anti-CSRF token</span>
        checkToken(<span class="php-variable">$_REQUEST</span>[<span class="php-string">'user_token'</span>], $_SESSION[<span class="php-string">'session_token'</span>], <span class="php-string">'index.php'</span>);

        <span class="php-comment">// File information</span>
        <span class="php-variable">$uploaded_name</span> = <span class="php-variable">$_FILES</span>[<span class="php-string">'image'</span>][<span class="php-string">'name'</span>];
        <span class="php-variable">$uploaded_ext</span>  = substr(<span class="php-variable">$uploaded_name</span>, strrpos(<span class="php-variable">$uploaded_name</span>, <span class="php-string">'.'</span>) + 1);
        <span class="php-variable">$uploaded_size</span> = <span class="php-variable">$_FILES</span>[<span class="php-string">'image'</span>][<span class="php-string">'size'</span>];
        <span class="php-variable">$uploaded_type</span> = <span class="php-variable">$_FILES</span>[<span class="php-string">'image'</span>][<span class="php-string">'type'</span>];
        <span class="php-variable">$uploaded_tmp</span>  = <span class="php-variable">$_FILES</span>[<span class="php-string">'image'</span>][<span class="php-string">'tmp_name'</span>];

        <span class="php-variable">$target_path</span>  = <span class="php-string">"../Uploads/Images/"</span>;
        <span class="php-variable">$target_file</span>   = md5(uniqid() . <span class="php-variable">$uploaded_name</span>) . <span class="php-string">'.'</span> . <span class="php-variable">$uploaded_ext</span>;
        <span class="php-variable">$temp_file</span>     = ((ini_get(<span class="php-string">'upload_tmp_dir'</span>) == <span class="php-string">''</span>) ? (sys_get_temp_dir()) : (ini_get(<span class="php-string">'upload_tmp_dir'</span>)));
        <span class="php-variable">$temp_file</span>    .= DIRECTORY_SEPARATOR . md5(uniqid() . <span class="php-variable">$uploaded_name</span>) . <span class="php-string">'.'</span> . <span class="php-variable">$uploaded_ext</span>;

        <span class="php-keyword">if</span> ((strtolower(<span class="php-variable">$uploaded_ext</span>) == <span class="php-string">'jpg'</span> || strtolower(<span class="php-variable">$uploaded_ext</span>) == <span class="php-string">'jpeg'</span> || strtolower(<span class="php-variable">$uploaded_ext</span>) == <span class="php-string">'png'</span>) &&
            (<span class="php-variable">$uploaded_size</span> < 10000000000) &&
            (<span class="php-variable">$uploaded_type</span> == <span class="php-string">'image/jpeg'</span> || <span class="php-variable">$uploaded_type</span> == <span class="php-string">'image/png'</span>) && getimagesize(<span class="php-variable">$uploaded_tmp</span>)
        ) {
            <span class="php-comment">// Strip any metadata, by re-encoding image (using php-GD library)</span>
            <span class="php-keyword">if</span> (<span class="php-variable">$uploaded_type</span> == <span class="php-string">'image/jpeg'</span>) {
                <span class="php-variable">$img</span> = imagecreatefromjpeg(<span class="php-variable">$uploaded_tmp</span>);
                imagejpeg(<span class="php-variable">$img</span>, <span class="php-variable">$temp_file</span>, 9);
            } else {
                <span class="php-variable">$img</span> = imagecreatefrompng(<span class="php-variable">$uploaded_tmp</span>);
                imagepng(<span class="php-variable">$img</span>, <span class="php-variable">$temp_file</span>, 9);
            }
            imagedestroy(<span class="php-variable">$img</span>);

            <span class="php-keyword">if</span> (rename(<span class="php-variable">$temp_file</span>, (getcwd() . DIRECTORY_SEPARATOR . <span class="php-variable">$target_path</span> . <span class="php-variable">$target_file</span>))) {
                <span class="php-variable">$html</span> = <span class="php-string">"&lt;pre&gt;&lt;a href='{$target_path}{$target_file}'&gt;{$uploaded_name} ({$target_file})&lt;/a&gt; successfully uploaded!&lt;/pre&gt;"</span>;
            } else {
                <span class="php-variable">$html</span> = <span class="php-string">'&lt;pre&gt;Your image was not uploaded.&lt;/pre&gt;'</span>;
            }

            <span class="php-comment">// Delete any temp files</span>
            <span class="php-keyword">if</span> (file_exists(<span class="php-variable">$temp_file</span>))
                unlink(<span class="php-variable">$temp_file</span>);
        } else {
            <span class="php-comment">// Invalid file</span>
            <span class="php-variable">$html</span> =  <span class="php-string">'&lt;pre&gt;Your image was not uploaded. We can only accept JPEG or PNG images.&lt;/pre&gt;'</span>;
        }
    }

    <span class="php-comment">// Generate Anti-CSRF token</span>
    generateSessionToken();

    ?&gt;</code></pre>
    </div>



    <div class="heading">
        <h3>&nbsp;&nbsp;&nbsp;Explanations</h3>
    </div>
    <div class="explanation">

        <h3>File Upload Handling:</h3>
        <ul>
            <li>The form (<code>&lt;form action="" method="post" enctype="multipart/form-data"&gt;</code>) allows users to upload images (<code>&lt;input type="file" name="image"&gt;</code>). It includes a hidden field for Anti-CSRF token (<code>$_SESSION['session_token']</code>), ensuring the form submission is from an authenticated session.</li>
        </ul>

        <h3>Anti-CSRF Protection:</h3>
        <ul>
            <li>The code uses <code>checkToken()</code> and <code>generateSessionToken()</code> functions to validate and generate Anti-CSRF tokens respectively. This prevents CSRF attacks by ensuring that the request originates from the expected user session.</li>
        </ul>

        <h3>File Validation and Processing:</h3>
        <ul>
            <li>Validates the uploaded file:
                <ul>
                    <li>Checks file extension (<code>$uploaded_ext</code>) and size (<code>$uploaded_size</code>) to ensure it meets specified criteria (JPEG or PNG format, size limit of 10MB).</li>
                    <li>Verifies file type (<code>$uploaded_type</code>) to ensure it's an image (<code>image/jpeg</code> or <code>image/png</code>) using <code>getimagesize($uploaded_tmp)</code>.</li>
                </ul>
            </li>
            <li>Secure File Handling:
                <ul>
                    <li>Generates a unique filename (<code>$target_file</code>) using <code>md5(uniqid() . $uploaded_name)</code> to prevent filename collisions and potential overwriting of existing files.</li>
                    <li>Uses a temporary file (<code>$temp_file</code>) to process the uploaded image, ensuring any metadata is stripped by re-encoding the image using PHP GD library (<code>imagecreatefromjpeg()</code> and <code>imagecreatefrompng()</code>).</li>
                </ul>
            </li>
            <li>Directory Traversal Prevention:
                <ul>
                    <li>Constructs the final file path (<code>$target_path . $target_file</code>) ensuring it resides within a specified directory (<code>../Uploads/Images/</code>) and uses <code>rename()</code> to move the processed image to its destination, mitigating directory traversal attacks.</li>
                </ul>
            </li>
        </ul>

        <h3>Error Handling:</h3>
        <ul>
            <li>Provides informative error messages (<code>&lt;pre&gt;</code>) to users about why an upload might fail (e.g., invalid file type or size).</li>
            <li>Deletes temporary files (<code>$temp_file</code>) after successful or failed upload attempts, maintaining clean server-side file management.</li>
        </ul>
</br>
        <h3><span style="color: #D10000;">Security Notes:</span></h3>
        <ul>
            <li>Always validate and sanitize file uploads thoroughly to prevent malicious file injections or execution.</li>
            <li>Utilize server-side checks (<code>getimagesize()</code>, MIME type validation) in addition to client-side checks to ensure uploaded content is safe and expected.</li>
        </ul>

    </div>



</body>

</html>
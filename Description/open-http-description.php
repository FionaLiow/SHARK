<p>A security vulnerability where a web application redirects users to a different URL without proper validation, allowing attackers to redirect users to malicious sites.</p>
</br>
<p><strong>Common Exploits:</strong></p>
<ul>
    <li><strong>Phishing Attacks:</strong> Redirecting users to fake login pages to steal credentials.</li>
    <li><strong>Malware Distribution:</strong> Redirecting users to sites that host malware.</li>
    <li><strong>Spoofing:</strong> Redirecting users to a site that mimics a legitimate site.</li>
</ul>
</br>
<p><strong>Prevention:</strong></p>
<ul>
    <li><strong>Validate Redirects:</strong> Ensure redirects only go to trusted, whitelisted URLs.</li>
    <li><strong>Use Relative URLs:</strong> Avoid using user-supplied URLs for redirects.</li>
    <li><strong>Sanitize Input:</strong> Check and sanitize user input to prevent malicious URLs.</li>
</ul>
<p><strong>Local File Inclusion (LFI):</strong></p>
<ul>
    <li><strong>Description:</strong> Includes local files from the server's filesystem.</li>
    <li><strong>Vulnerability:</strong> Occurs due to unsanitized user input that allows file path traversal (`../`) to access sensitive files.</li>
    <li><strong>Impact:</strong> Can lead to unauthorized data disclosure or execution of arbitrary code.</li>
</ul></br>
<p><strong>Remote File Inclusion (RFI):</strong></p>
<ul>
    <li><strong>Description:</strong> Includes files hosted on remote servers via URLs.</li>
    <li><strong>Vulnerability:</strong> Allows attackers to inject URLs pointing to malicious scripts, which are executed by the server.</li>
    <li><strong>Impact:</strong> Enables remote code execution, compromising the server's integrity and data.</li>
</ul></br>
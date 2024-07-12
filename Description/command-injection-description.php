<p><strong>Definition:</strong> Command injection is a security vulnerability where attackers exploit improper handling of user input in an application to execute arbitrary commands on the underlying operating system.</p>

</br>

<p><strong>How It Works:</strong></p>
<ul>
  <li>Attackers manipulate input (e.g., web forms) with special characters or commands.</li>
  <li>Application passes this input to the OS as commands, which executes them with application's privileges.</li>
</ul>

</br>

<p><strong>Impact:</strong></p>
<ul>
  <li>Allows attackers to run commands, access files, modify system settings.</li>
  <li>Can lead to data theft, system compromise, and unauthorized actions.</li>
</ul>
</br>
<p><strong>More information : </strong><a href="https://portswigger.net/web-security/os-command-injection" target="_blank">https://portswigger.net/web-security/os-command-injection</a></p>
</br>
<p><strong>More information : </strong><a href="https://owasp.org/www-community/attacks/Command_Injection" target="_blank">https://owasp.org/www-community/attacks/Command_Injection</a></p>
</br>
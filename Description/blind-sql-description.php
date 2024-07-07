<p>Blind SQL Injection is a type of SQL injection attack where an attacker can infer information from a database without seeing the direct results of the query.</p>
</br>
<p><strong>Types:</strong></p>
<p><strong>Boolean-based Blind SQL Injection:</strong></p>
<ul>
  <li>Attacker sends SQL queries that return true or false.</li>
  <li>Observes changes in the application's response (e.g., content changes, HTTP status codes).</li>
  <li>Example Payload: ' OR (SELECT 1 FROM users WHERE username='admin' AND LENGTH(password)=8) --</li>
</ul>
</br>
<p><strong>Time-based Blind SQL Injection:</strong></p>
<ul>
  <li>Attacker sends SQL queries that cause delays.</li>
  <li>Measures the response time to infer data.</li>
  <li>Example Payload: ' OR IF((SELECT LENGTH(password) FROM users WHERE username='admin')=8, SLEEP(5), 0) --  </li></br>
</ul>

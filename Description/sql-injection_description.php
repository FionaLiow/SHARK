<style>
    .source-btn {
        float: right;
        font-size: 18px;
        font-weight: bold;
        padding: 12px 24px;
        background-color: #ccc;
        color: #333;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border: none;
        border-radius: 5px;
        cursor: pointer;
        outline: none;
        position: relative;
        transition: background-color 0.3s, box-shadow 0.3s;
    }

    .source-btn:hover {
        background-color: #525252;
        color: white;
        animation: glow 0.5s infinite alternate;
    }

    @keyframes glow {
        from {
            box-shadow: 0 0 5px #ccc, 0 0 10px #ccc, 0 0 15px #ccc;
        }

        to {
            box-shadow: 0 0 10px #ccc, 0 0 15px #999, 0 0 20px #999;
        }
    }
</style>
</br>
<p>SQL injection (SQLi) is a cyberattack that manipulates an application's database queries to steal or alter data. In simple terms, imagine tricking a website into revealing its secrets by sneaking in malicious code disguised as normal input.</p>
</br>
<p><strong>SQL injection (SQLi) can have devastating effects on websites and businesses:</strong></p>
<p><strong>Data Theft: </strong>Attackers can steal sensitive information like user credentials, financial data, or personal details.</p>
<p><strong>Data Manipulation: </strong>They can alter data in the database, such as changing account balances or deleting critical information.</p>
<p><strong>Website Defacement: </strong>In some cases, attackers can even take control of the website and modify its content.</p>
<p><strong>Loss of Trust: </strong>A successful SQLi attack can severely damage a company's reputation and lead to lost customers.</p>
</br>
<p><strong>More information : </strong><a href="https://owasp.org/www-community/attacks/SQL_Injection" target="_blank">https://owasp.org/www-community/attacks/SQL_Injection</a></p>
</br>
<p><strong>Cheatsheet : </strong><a href="https://portswigger.net/web-security/sql-injection/cheat-sheet" target="_blank">https://portswigger.net/web-security/sql-injection/cheat-sheet</a></p></br>
<hr></br>
<button type="submit" class="source-btn" onclick="openSourcePage()">
    View source & explanations
</button></br>
<script>
    function openSourcePage() {
        var currentPageUrl = window.location.href;

        var parts = currentPageUrl.split('/');
        var newUrl = parts.slice(0, 4).join('/') + '/Description/source/' + parts.slice(4).join('/');

        window.open(newUrl, '_blank');
    }
</script>
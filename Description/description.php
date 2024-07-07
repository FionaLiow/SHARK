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
<?php
$currentUrl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$parts = explode('/', $currentUrl);
$challenge = isset($parts[5]) ? $parts[5] : null;
$baseName = preg_replace('/\.php.*/', '', $challenge);
$fileName = $baseName . '-description.php';
include ($fileName);
?>
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
document.addEventListener("DOMContentLoaded", function () {
  var securitySelect = document.getElementById("security");
  securitySelect.addEventListener("change", function () {
    var securityLevel = securitySelect.value;

    if (securityLevel !== "") {
      alert("Security level set to " + securityLevel);

      // AJAX request to save security level in session
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "Functions/save_security_level.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          location.reload();
        }
      };
      xhr.send("security=" + encodeURIComponent(securityLevel));
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  var securitySelect = document.getElementById("security");
  var previousIndex = securitySelect.selectedIndex;

  securitySelect.addEventListener("change", function () {
    var securityLevel = securitySelect.value;

    // Prompt confirmation from the user
    if (
      securityLevel !== "" &&
      confirm(
        "Are you sure you want to change the security level? You might lose your progress! "
      )
    ) {
      alert("Security level set to " + securityLevel);

      // AJAX request to save security level in session
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "../Functions/save_security_level.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          var currentURL = window.location.href;
          var urlParts = currentURL.split("/");
          var baseURL = urlParts.slice(0, -2).join("/"); // Base URL excluding the last two parts (directory and file)
          var newURL = baseURL + "/" + securityLevel + "/" + urlParts[urlParts.length - 1]; // Construct new URL
          alert("Redirecting URL: " + newURL);
          window.location.href = newURL;
        }
      };
      xhr.send("security=" + encodeURIComponent(securityLevel));
    } else {
      securitySelect.selectedIndex = previousIndex;
    }
  });
});

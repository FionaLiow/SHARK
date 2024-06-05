document
  .getElementById("registration")
  .addEventListener("submit", function (event) {
    if (!this.checkValidity()) {
      event.preventDefault(); // Prevent form submission if validation fails
      alert("Please fill out the form correctly...");
    } else {
      event.preventDefault(); // Prevent form submission initially
      validateAccount();
    }

    function validateAccount() {
      let email = document.getElementById("email").value;
      if (email !== "") {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "locale.txt", true);
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4) {
            if (xhr.status === 200) {
              var data = xhr.responseText;
              if (data.includes(email)) {
                alert(
                  "Email is registered previously, registration fail ... :("
                );
              } else {
                let password = document.getElementById("pwsd").value;
                let cnfrmPassword = document.getElementById("pwsdc").value;
                if (password.length != 0) {
                  if (password === cnfrmPassword) {
                    sendData();
                  } else {
                    alert("Password and Confirm Password do not match :(");
                  }
                }
              }
            } else {
              console.error("Request failed");
            }
          }
        };
        xhr.send();
      } else {
        alert("Email Required");
      }
    }

    function sendData() {
      let username = document.getElementById("username").value;
      let email = document.getElementById("email").value;
      let password = document.getElementById("pwsd").value;

      var data = {
        username: username,
        email: email,
        password: password,
      };

      // Ensure proper encoding of data
      var formData = new FormData();
      formData.append("data", JSON.stringify(data));

      // Send data using AJAX
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "Functions/register.php", true);
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          alert(xhr.responseText);
          window.location.href = "index.php";
        }
      };
      xhr.send(formData);
    }
  });

function encode(data, source) {
  var formData = new FormData();
  if (source === "email") {
    formData.append("action", "checkemail");
    formData.append("email", JSON.stringify(data));
  } else if (source === "data") {
    formData.append("action", "writedata");
    formData.append("data", JSON.stringify(data));
  }
  sendData(formData);
}

function sendData(formData) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "Functions/register.php", true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var response = xhr.responseText;
      if (response.trim() === "true") {
        alert("Email is already registered, registration failed.");
        location.reload();
        return;
      } else if (response.trim() === "false") {
        checkPassword();
      } else {
        alert(response);
        window.location.href = "index.php";
      }
    }
  };
  xhr.send(formData);
}

document.getElementById("registration").addEventListener("submit", function (event) {
  if (!this.checkValidity()) {
    event.preventDefault(); // Prevent form submission if validation fails
    alert("Please fill out the form correctly.");
  } else {
    event.preventDefault(); // Prevent form submission initially
    checkemail();
  }
});

function checkemail() {
  let email = document.getElementById("email").value;
  var data = { email: email };
  let source = "email";
  encode(data, source);
}

function checkPassword() {
  let password = document.getElementById("pwsd").value;
  let cnfrmPassword = document.getElementById("pwsdc").value;

  if (password.length !== 0) {
    if (password === cnfrmPassword) {
      writedata();
    } else {
      alert("Password and Confirm Password do not match.");
    }
  }
}

function writedata() {
  let username = document.getElementById("username").value;
  let email = document.getElementById("email").value;
  let password = document.getElementById("pwsd").value;

  var data = {
    username: username,
    email: email,
    password: password
  };

  let source = "data";
  encode(data, source);
}

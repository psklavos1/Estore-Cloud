// Forms
const formLogin = document.getElementById("login-form");
const formSignup = document.getElementById("signup-form");

// Regex Patterns
// alpharithmetic
const reg_alpharithmetic = /^[a-z][a-z0-9]+$/i;
const reg_characters = /^[a-z]+$/i;
const reg_mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

// Login Form Validation
formLogin.addEventListener("submit", (e) => {
  e.preventDefault();

  let error = false;
  document.getElementById("user_created").innerText = "";
  // Input Fields
  let usernameLogin = document.getElementById("email_login");
  let passwordLogin = document.getElementById("password_login");
  let btnLogin = document.getElementById("btn_login");

  // Error Fields
  let usernameLogin_err = document.getElementById("username_login_err");
  let passwordLogin_err = document.getElementById("password_login_err");
  let submitLogin_err = document.getElementById("submit_login_err");

  // usrname check
  if (!usernameLogin.value.match(reg_mailformat)) {
    error = true;
    usernameLogin_err.innerText = "Input has to be a valid Email";
    usernameLogin.style.borderBottom = "2px solid red";
  } else {
    usernameLogin_err.innerText = "";
    usernameLogin.style.borderBottom = "2px solid blueviolet";
  }

  // password check
  if (passwordLogin.value.length < 4 || passwordLogin.value.length > 20) {
    error = true;
    passwordLogin_err.innerText = "Password must have a length 4-20 chars";
    passwordLogin.style.borderBottom = "2px solid red";
  } else {
    passwordLogin_err.innerText = "";
    passwordLogin.style.borderBottom = "2px solid blueviolet";
  }

  if (error) {
    submitLogin_err.innerText =
      "There is no account with the given credentials";
    console.log(submitLogin_err.textContent);
  }
  // New
  else {
    $.ajax({
      url: "scripts/php/services/keyrock/keyrock_signin.php",
      method: "POST",
      data: {
        email: usernameLogin.value,
        password: passwordLogin.value,
        loginAction: btnLogin.value.toLowerCase(),
      },
      datatype: "json",
      success: function (response) {
        if (response === "Logged In Successfully") {
          console.log(response);
          window.location.href = "scripts/php/main/welcome.php";
        } else {
          submitLogin_err.innerText =
            "There is no account with the given credentials";
        }
      },
    });
  }
});

// Signup Form Validation
formSignup.addEventListener("submit", (e) => {
  e.preventDefault();
  let error = false;
  // Input Fields
  let name = document.getElementById("name_signup");
  let surname = document.getElementById("surname_signup");
  let username = document.getElementById("username_signup");
  let password = document.getElementById("password_signup");
  let conf_password = document.getElementById("conf_password_signup");
  let email = document.getElementById("email_signup");
  let role = document.querySelector('input[name="role"]:checked');
  let btnSignup = document.getElementById("btn_signup");

  // Error Fields
  let name_err = document.getElementById("name_signup_err");
  let surname_err = document.getElementById("surname_signup_err");
  let username_err = document.getElementById("username_signup_err");
  let password_err = document.getElementById("password_signup_err");
  let conf_password_err = document.getElementById("conf_password_signup_err");
  let email_err = document.getElementById("email_signup_err");

  // name check
  if (name.value.length > 20 || !name.value.match(reg_characters)) {
    error = true;
    name_err.innerText =
      "Name must contain only letters and have at most 20 chars";
    name.style.borderBottom = "2px solid red";
  } else {
    name_err.innerText = "";
    name.style.borderBottom = "2px solid blueviolet";
  }

  // surnname check
  if (surname.value.length > 20 || !surname.value.match(reg_characters)) {
    error = true;
    surname_err.innerText =
      "Surname must contain only letters and have at most 20 chars";
    surname.style.borderBottom = "2px solid red";
  } else {
    surname_err.innerText = "";
    surname.style.borderBottom = "2px solid blueviolet";
  }

  // usrname check
  if (
    username.value.length < 5 ||
    username.value.length > 20 ||
    !username.value.match(reg_alpharithmetic)
  ) {
    error = true;
    username_err.innerText =
      "Username has to be an alpharithmetic with 5-20 chars starting with a char";
    username.style.borderBottom = "2px solid red";
  } else {
    username_err.innerText = "";
    username.style.borderBottom = "2px solid blueviolet";
  }

  // password check
  if (password.value.length < 4 || password.value.length > 20) {
    error = true;
    password_err.innerText = "Password must have a length 5-20 chars";
    password.style.borderBottom = "2px solid red";
  } else {
    password_err.innerText = "";
    password.style.borderBottom = "2px solid blueviolet";
  }

  // confirm_password check
  if (conf_password.value.length < 4 || conf_password.value.length > 20) {
    error = true;
    conf_password_err.innerText = "Password must have a length 5-20 chars";
    conf_password.style.borderBottom = "2px solid red";
  } else if (!(conf_password.value === password.value)) {
    error = true;
    conf_password_err.innerText = "Does not match given password";
    conf_password.style.borderBottom = "2px solid red";
  } else {
    conf_password_err.innerText = "";
    conf_password.style.borderBottom = "2px solid blueviolet";
  }

  // email check
  if (!email.value.match(reg_mailformat)) {
    error = true;
    email_err.innerText = "Invalid email format";
    email.style.borderBottom = "2px solid red";
  } else {
    email_err.innerText = "";
    email.style.borderBottom = "2px solid blueviolet";
  }

  if (!error) {
    $.ajax({
      url: "scripts/php/services/keyrock/keyrock_signup.php",
      method: "POST",
      data: {
        name: name.value,
        surname: surname.value,
        username: username.value,
        password: password.value,
        email: email.value,
        role: role.value,
      },
      datatype: "json",
      success: function (response) {
        if (response === "Signed Up Successfully") {
          console.log(response);
          document.getElementById("flip").click();
          document.getElementById("user_created").innerText =
            "Signup Completed Successfully.\nPlease Await Confirmation";
        } else {
          // Error
          if (response == "Email already used") {
            $("#email_signup_err").html(response);
            $("#email_signup").css("border-bottom", "2px solid red");
          } else {
            if ($("#email_signup_err").html() != "") {
              $("#email_signup").css("border-bottom", "2px solid purple");
              $("#email_signup_err").html("");
            }
            console.log(response);
          }
        }
      },
    });
  }
});

// Jquery
// Check if username in use
// $(document).ready(function () {
//   $("#username_signup").blur(function () {
//     let usernameVal = $(this).val();
//     $.ajax({
//       url: "./scripts/php/ajaxfiles/username_availability.php",
//       method: "POST",
//       data: { user_name: usernameVal },
//       datatype: "json",
//       success: function (response) {
//         $("#username_signup_err").html(response);
//         if (response != "") {
//           $("#username_signup").css("border-bottom", "2px solid red");
//         } else
//           $("#username_signup").css("border-bottom", "2px solid blueviolet");
//       },
//     });
//   });
// });

// // Check if email in use
// $(document).ready(function () {
//   $("#email_signup").blur(function () {
//     let emailVal = $(this).val();
//     $.ajax({
//       url: "./scripts/php/ajaxfiles/email_availability.php",
//       method: "POST",
//       data: { email: emailVal },
//       datatype: "json",
//       success: function (response) {
//         $("#email_signup_err").html(response);
//         if (response != "") {
//           $("#email_signup").css("border-bottom", "2px solid red");
//         } else if ($("#email_signup").css("border-bottom") == "2px solid red")
//           $("#email_signup").css("border-bottom", "2px solid blueviolet");
//       },
//     });
//   });
// });

// Variables
let passfield = document.getElementById("password_login");
let eyeIcon = document.getElementsByClassName("show");

// Event listener to toggle show password
function toggleShow() {
  if (passfield.type === "password") {
    passfield.type = "text";
    eyeIcon[0].classList.replace("fa-eye-slash", "fa-eye");
  } else {
    passfield.type = "password";
    eyeIcon[0].classList.replace("fa-eye", "fa-eye-slash");
  }
}

// Unused ready function to reload page Css
function reloadCss() {
  console.log("CSS RELOAD");
  var links = document.getElementsByTagName("link");
  for (var cl in links) {
    var link = links[cl];
    if (link.rel === "stylesheet") link.href += "";
  }
}

// click listener on change view to login or signup
// This function empties the filled form fields, the errors and
// resets the border colors
function clearForm(chkbox) {
  console.log("In function");
  let form = chkbox.checked
    ? document.getElementById("login-form")
    : document.getElementById("signup-form");

  let id = form.id;
  const myArray = id.split("-");
  let formKind = myArray[0];

  //  get ALL elements whose ID ends with `err`
  let errorElements = form.querySelectorAll('[id$="err"]');

  // get All elements whose ID ends with 'formKind'= login/signup
  let inputFields = form.querySelectorAll("[id$=" + formKind + "]");
  console.log(inputFields);

  errorElements.forEach((element) => {
    element.innerText = "";
  });

  // restore border color
  inputFields.forEach((input) => {
    input.style.borderBottomColor = "gray";
  });

  form.reset();
}

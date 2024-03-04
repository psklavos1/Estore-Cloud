// Variables
var modalAddBtn = document.querySelector(".add-btn");
var modalEditBtn = document.querySelector(".edit-btn");
var modalBgs = document.querySelector("modal-bg");
var modalBg1 = document.querySelector("#mod-1");
var modalBg2 = document.querySelector("#mod-2");
var modalClose1 = document.querySelector("#mod-cl-1");
var modalClose2 = document.querySelector("#mod-cl-2");
const prevData = [];
var rowEditing = false;
var idChanging;

// Print My Products
print_products();
function print_products() {
  $(document).ready(function () {
    get_seller_products();
    function get_seller_products() {
      $.ajax({
        url: "../services/data_storage_proxy/fetch_seller_products.php",
        method: "GET",
        success: function (data) {
          var obj = JSON.parse(data);
          $("#my-product-data").html(obj.html);
        },
      });
    }
  });
}

// Handle edit button pressed
$(document).ready(function () {
  $(document).on("click", ".edit-btn", function () {
    if (!rowEditing) {
      // flag to stop others rows from being edited
      rowEditing = true;
      var tr = $(this).closest("tr").find("td").not(":last-child");
      // The id of the row tha was being edited
      idChanging = $(this).attr("id");

      // store data before change
      for (let i = 0; i < tr.length; i++) {
        prevData[i] = $(tr[i]).html();
      }
      tr.attr("contenteditable", "true");
    } else {
      alert("Another row is being edited currently");
    }
  });
});

// On cllick listener. This function is triggered when edit/save/reject change in clicled
// It is used to change the buttons that are available to the user to commit actions
let change_btns = function (a) {
  var id = $(a).attr("id");
  if (!rowEditing || (rowEditing && idChanging == id)) {
    $("#" + id + ".edit-btn").toggleClass("invisible");
    $("#" + id + ".reject-btn").toggleClass("invisible");
    $("#" + id + ".save-btn").toggleClass("invisible");
  }
};

// Handle Modal
// Open modal#1 when add new button is pressed
$(document).on("click", ".add-btn", function () {
  modalBg1.classList.add("bg-active");
});

// if reject edit is pressed stop editing, return to prior state
$(document).ready(function () {
  $(document).on("click", ".reject-btn", function () {
    // free editor
    rowEditing = false;
    // cancel editable
    var tr = $(this).closest("tr").find("td").not(".mr_id, :last-child");
    tr.attr("contenteditable", "false");
    // restore the data prior to change
    for (let i = 0; i < prevData.length; i++) {
      $(tr[i]).html(prevData[i]);
    }
  });
});

// In Modal variables
var revertBtn = document.getElementById("revert-btn");
var inputs = document.querySelectorAll(".modal input");

// Reset input fields in Modal when revert is pressed.
revertBtn.addEventListener("click", () => {
  inputs.forEach((input) => (input.value = ""));
  $(".error").hide();
});

// Close Modal
modalClose1.addEventListener("click", function () {
  modalBg1.classList.remove("bg-active");
  // clear the form
  document.getElementById("revert-btn").click();
});

// helper functions to check wanted criteria for modal inputs

// Checks that the date inserted in right format
function check_date(input_id) {
  var pattern = /^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/;
  var date = $(input_id).val();
  if (pattern.test(date) && isNaN(date)) {
    // Get today's date
    var todaysDate = new Date();
    var inputDate = new Date(date);

    // call setHours to take the time out of the comparison
    // Check that the given date is in the future
    if (inputDate.setHours(0, 0, 0, 0) < todaysDate.setHours(0, 0, 0, 0)) {
      $(input_id + "_error_msg").html(
        "Invalid Date. Should be after current date"
      );
      $(input_id + "_error_msg").show();
      $(input_id).css("border", "1px solid red");
      return false;
    } else {
      $(input_id + "_error_msg").hide();
      $(input_id).css("border", "1px solid #9b59b6");
      return true;
    }
  } else {
    $(input_id + "_error_msg").html("Date should be on format yyyy-mm-dd");
    $(input_id + "_error_msg").show();
    $(input_id).css("border", "1px solid red");
    return false;
  }
}

// Check  if alphanumeric
function check_alphanumeric(input_id) {
  var pattern = /^[\w+( +\w+)*\s]*$/;
  var input = $(input_id).val();
  if (pattern.test(input)) {
    $(input_id + "_error_msg").hide();
    $(input_id).css("border", "1px solid #9b59b6");
    return true;
  } else {
    $(input_id + "_error_msg").html("Should be an alpharithmetic");
    $(input_id + "_error_msg").show();
    $(input_id).css("border", "1px solid red");
    return false;
  }
}

// Check the length to be less than 30 chars and input field not empty
function check_right_length(input_id) {
  var input = $(input_id).val();
  if (input.length < 30 && input.length > 0) {
    $(input_id + "_error_msg").hide();
    $(input_id).css("border", "1px solid #9b59b6");
    return true;
  } else {
    $(input_id + "_error_msg").html("Should contain less than 30 characters");
    $(input_id + "_error_msg").show();
    $(input_id).css("border", "1px solid red");
    return false;
  }
}

// Check if it contains only chars
function check_characters_only(input_id) {
  var pattern = /^[A-Za-z\s]*$/;
  var input = $(input_id).val();
  if (pattern.test(input) && isNaN(input)) {
    $(input_id + "_error_msg").hide();
    $(input_id).css("border", "2px solid #9b59b6");
    return true;
  } else {
    $(input_id + "_error_msg").html("Should be an non-numeric alpharithmetic");
    $(input_id + "_error_msg").show();
    $(input_id).css("border", "1px solid red");
    return false;
  }
}

// Check if it contains only numbers
function check_numeric_only(input_id) {
  var pattern = /^[0-9]*[ \.]?[0-9]+[€]*$/;
  var input = $(input_id).val();
  if (pattern.test(input)) {
    $(input_id + "_error_msg").hide();
    $(input_id).css("border", "2px solid #9b59b6");
    return true;
  } else {
    $(input_id + "_error_msg").html("Should contain numeric or float.");
    $(input_id + "_error_msg").show();
    $(input_id).css("border", "1px solid red");
    return false;
  }
}

// Commulative function that makes all the checks needed for the modal and presents
// the error messages if there are any
function check_valid_modal() {
  // check if valid inputs process
  $(".error").hide();

  var error_name = false;
  var error_product_code = false;
  var error_price = false;
  var error_date_of_withdrawal = false;
  var error_category = false;
  var error_available = false;

  // Check if valid after focusing out of input boxes.
  $("#name").focusout(function () {
    error_name = check_right_length("#name");
  });

  $("#product_code").focusout(function () {
    error_product_code = check_alphanumeric("#product_code");
  });

  $("#price").focusout(function () {
    error_price = check_numeric_only("#price");
  });

  $("#date_of_withdrawal").focusout(function () {
    error_date_of_withdrawal = check_date("#date_of_withdrawal");
  });

  $("#category").focusout(function () {
    error_category = check_right_length("#category");
  });

  $("#available").focusout(function () {
    error_available = check_numeric_only("#available");
  });

  error_name = false;
  error_product_code = false;
  error_price = false;
  error_date_of_withdrawal = false;
  error_category = false;
  error_available = false;
  error_name = !check_right_length("#name");
  error_product_code = !check_alphanumeric("#product_code");
  error_price = !check_numeric_only("#price");
  error_date_of_withdrawal = !check_date("#date_of_withdrawal");
  error_category = !check_right_length("#category");
  error_available = !check_numeric_only("#available");

  if (
    error_name === false &&
    error_product_code === false &&
    error_price === false &&
    error_date_of_withdrawal === false &&
    error_category === false &&
    error_available === false
  ) {
    return true;
  } else {
    alert("Not all fields correctly filled");
    return false;
  }
}

// Ajax
// Add New Product
$(document).on("click", "#submit-btn", function (e) {
  e.preventDefault();

  // take data
  var name = $("#name").val();
  var product_code = $("#product_code").val();
  var price = $("#price").val();
  var date_of_withdrawal = $("#date_of_withdrawal").val();
  var category = $("#category").val();
  var available = $("#available").val();

  // check if modal input fields are correctly filled
  if (
    check_valid_modal(
      name,
      product_code,
      price,
      date_of_withdrawal,
      category,
      available
    )
  ) {
    // ajax request to add product
    $.ajax({
      type: "POST",
      url: "../services/data_storage_proxy/add_product.php",
      datatype: "json",
      data: {
        name: name,
        product_code: product_code,
        price: price,
        category: category,
        date_of_withdrawal: date_of_withdrawal,
        available: available,
      },
      success: function (response) {
        if (response.hasOwnProperty("message")) {
          alert("Failed insertion");
        } else {
          // On successful insertion in database append the new row in the table
          print_products();
          id = JSON.parse(response).id;
          $.ajax({
            type: "POST",
            url: "../services/orion_proxy/orion_create_entity.php",
            datatype: "json",
            data: {
              id: id,
              name: name,
              product_code: product_code,
              price: price,
              category: category,
              date_of_withdrawal: date_of_withdrawal,
              available: available,
            },
          });
        }
        document.getElementById("revert-btn").click();
      },
      error: function (jqXHR, exception) {
        var msg = "";
        if (jqXHR.status === 0) {
          msg = "Not connect.\n Verify Network.";
        } else if (jqXHR.status == 404) {
          msg = "Requested page not found. [404]";
        } else if (jqXHR.status == 500) {
          msg = "Internal Server Error [500].";
        } else if (exception === "parsererror") {
          msg = "Requested JSON parse failed.";
        } else if (exception === "timeout") {
          msg = "Time out error.";
        } else if (exception === "abort") {
          msg = "Ajax request aborted.";
        } else {
          msg = "Uncaught Error.\n" + jqXHR.responseText;
        }
        alert(msg);
      },
    });
  }
});

// delete Button
// AJax
$(document).on("click", ".delete-btn", function deleteProduct() {
  answer = confirm("Are you sure?");
  console.log(answer);
  if (answer) {
    var tr = $(this).closest("tr");
    var btn_div = $(this).closest("div");
    var del_id = btn_div.attr("id");
    $.ajax({
      type: "POST",
      url: "../services/data_storage_proxy/delete_product.php",
      datatype: "json",
      data: { del_id: del_id },
      success: function (response) {
        var obj = JSON.parse(response);
        if (obj.message == "SUCCESS") {
          // remove from table
          tr.fadeOut(150, function () {
            tr.remove();
          });
          $.ajax({
            type: "POST",
            url: "../services/orion_proxy/orion_delete_entity.php",
            datatype: "json",
            data: {
              id: del_id,
            },
          });
        } else alert("Problem deleting this item");
      },
      error: function (jqXHR, exception) {
        var msg = "";
        if (jqXHR.status === 0) {
          msg = "Not connect.\n Verify Network.";
        } else if (jqXHR.status == 404) {
          msg = "Requested page not found. [404]";
        } else if (jqXHR.status == 500) {
          msg = "Internal Server Error [500].";
        } else if (exception === "parsererror") {
          msg = "Requested JSON parse failed.";
        } else if (exception === "timeout") {
          msg = "Time out error.";
        } else if (exception === "abort") {
          msg = "Ajax request aborted.";
          heck;
        } else {
          msg = "Uncaught Error.\n" + jqXHR.responseText;
        }
        alert(msg);
      },
    });
  }
});

// Handle save button pressed
// Ajax
$(document).on("click", ".save-btn", function (event) {
  event.preventDefault();

  // free the editor to be used again
  rowEditing = false;
  var tr = $(this).closest("tr").find("td").not(".mr_id, :last-child");
  tr.attr("contenteditable", "false");
  tr = $(this).closest("tr");
  var i = 0;
  var cols = new Array(7);
  $(tr)
    .find("td")
    .each(function () {
      // get the new values of all the fields
      cols[i] = $(this).text();
      i += 1;
    });
  var update_id = $(this).attr("id");
  data = {
    product_id: update_id,
    name: cols[1],
    product_code: cols[2],
    price: cols[3],
    date_of_withdrawal: cols[4],
    category: cols[5],
    available: cols[6],
  };

  $.ajax({
    type: "POST",
    url: "../services/data_storage_proxy/edit_product.php",
    datatype: "json",
    data: data,
    success: function (data) {
      print_products();
      $.ajax({
        type: "POST",
        url: "../services/orion_proxy/orion_update_entity.php",
        datatype: "json",
        data: {
          id: update_id,
          name: cols[1],
          product_code: cols[2],
          price: cols[3],
          category: cols[5],
          date_of_withdrawal: cols[4],
          available: cols[6],
        },
      });
    },
    error: function (jqXHR, exception) {
      var msg = "";
      if (jqXHR.status === 0) {
        msg = "Not connect.\n Verify Network.";
      } else if (jqXHR.status == 404) {
        msg = "Requested page not found. [404]";
      } else if (jqXHR.status == 500) {
        msg = "Internal Server Error [500].";
      } else if (exception === "parsererror") {
        msg = "Requested JSON parse failed.";
      } else if (exception === "timeout") {
        msg = "Time out error.";
      } else if (exception === "abort") {
        msg = "Ajax request aborted.";
      } else {
        msg = "Uncaught Error.\n" + jqXHR.responseText;
      }
      alert(msg);
    },
  });
});

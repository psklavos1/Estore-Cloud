// Search
// Search By Category List
let select = document.getElementById("select");
let list = document.getElementById("list");
let selectText = document.getElementById("selectText");
let options = document.getElementsByClassName("options");
let searchBy = document.getElementById("searchBy");

// Click listener to open list of search by choices
select.onclick = function () {
  list.classList.toggle("open");
};

// When an option is pressed the selectText and the search by input are changed
for (option of options) {
  option.onclick = function () {
    selectText.innerHTML = this.innerHTML;
    searchBy.value = this.innerHTML;
  };
}

// Ajax

// Print Products
$(document).ready(function () {
  get_products_all();
  function get_products_all() {
    $.ajax({
      url: "../services/data_storage_proxy/fetch_products.php",
      method: "GET",
      success: function (data) {
        // alert(data);
        $("#product-data").html(data);
        // console.log(data);
      },
    });
  }
});

$("#search-btn").click(function (e) {
  e.preventDefault();
  // lowercase transform
  var searchBy = $("#searchBy").val().toLowerCase();
  // remove spaces
  searchBy = searchBy.replace(/\s/g, "");
  // remove max
  searchBy = searchBy.replace("max", "");
  var searchText = $("#searchText").val();

  $.ajax({
    url: "../services/data_storage_proxy/fetch_products.php",
    method: "GET",
    data: { searchBy: searchBy, searchText: searchText },
    success: function (data) {
      $("#product-data").html(data);
    },
  });
});

$(document).on("click", ".add-cart", function () {
  var product_id = $(this).attr("id");
  $.ajax({
    url: "../services/data_storage_proxy/add_to_cart.php",
    type: "POST",
    data: { id: product_id },
    success: function (data) {
      if (data.hasOwnProperty("message")) {
        alert(data["message"]);
      } else {
        alert("Successfully Added to cart");
        // Change Icon color
        anchor = $("#a-" + product_id);
        anchor.find(".fa-cart-shopping").css("color", "purple");
      }
    },
    error: function () {
      alert("Error");
    },
  });
});

// Subsscribe
$(document).on("click", ".subscribe-btn", function () {
  var product_id = $(this).attr("id");
  $.ajax({
    url: "../services/orion_proxy/orion_add_subscription.php",
    type: "POST",
    data: { id: product_id },
    success: function (data) {
      alert(data);
    },
    error: function () {
      alert("Error");
    },
  });
});

// Ajax
// Add to cart
$(document).ready(function () {
  $(".add-cart").click(function () {
    var product_id = $(this).attr("id");
    $.ajax({
      url: "../ajaxfiles/add_to_cart.php",
      type: "POST",
      data: { id: product_id },
      success: function (data) {
        if (data !== "Error") {
          alert("Successfully Added to cart");
          // Change Icon color
          anchor = $("#a-" + product_id);
          anchor.find(".fa-cart-shopping").css("color", "purple");
        } else alert("There was a problem inserting item");
      },
    });
  });
});

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

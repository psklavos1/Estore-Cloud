// Coupon button
var coupon_btn = document.querySelector("#coupon-btn");
coupon_btn.addEventListener("click", function () {
  alert("There is no coupon with the specified value");
});

// Checkout button
var checkout_btn = document.querySelector("#checkout-btn");
checkout_btn.addEventListener("click", function () {
  alert("Thank you for supporting us. Have a Nice day!");
});

// This function updates the printed values of the quantity and subtotal fields when a change
// at the quantity of the products in the cart is made
function update_cart(tr, qty) {
  var qty_field = $(tr).find(".number");
  var subtotal_field = $(tr).find(".subtotal-td");
  var price = parseFloat($(tr).find(".price").text());
  var subtotal = price * qty;
  qty_field.text(qty);
  subtotal_field.text(subtotal);
  update_cart_totals();
}

// This function updates the cart totals at the total's section taking account the shipping
// and the coupon discounts added
function update_cart_totals() {
  var subtotals = document.querySelectorAll(".subtotal-td");
  var cart_subtotal_field = $("#cart-subtotal");
  var cart_total_field = $("#cart-total");

  var discount = parseFloat($("#cart-discount").text());
  var shipping = parseFloat($("#cart-shipping").text());
  var sum = 0;

  // sum up all the subtotals
  subtotals.forEach((subtotal) => {
    sum += parseFloat($(subtotal).text());
  });

  cart_subtotal_field.text(sum);
  var total = sum + shipping - discount;
  if (total > 0) cart_total_field.text(total);
  else cart_total_field.text(0);
}

// Ajax
// Print carts
print_carts();
function print_carts() {
  $(document).ready(function () {
    get_carts();
    function get_carts() {
      $.ajax({
        url: "../services/data_storage_proxy/fetch_carts.php",
        method: "GET",
        success: function (data) {
          // alert(data);
          // console.log(data);
          var obj = JSON.parse(data);
          $("#cart-data").html(obj.html);
          $("#subtotal").val(obj.carts_sum);
          print_checkout();
        },
      });
    }
  });
}

// Print checkout
// print_checkout();
function print_checkout() {
  var subtotal = $("#subtotal").val();
  var shipping = $("#shipping").val();
  var discount = $("#discount").val();

  $.ajax({
    type: "POST",
    data: {
      carts_subtotal: subtotal,
      shipping: shipping,
      discount: discount,
    },
    url: "../ajaxfiles/print_checkout.php",
    success: function (data) {
      var obj = JSON.parse(data);
      $("#checkout-data").html(obj.html);
      // console.log(data);
    },
  });
}

// Quantity Buttons
// Increment. Add one more instance of the product in the cart
$(document).on("click", ".increment-btn", function () {
  var tr = $(this).closest("tr");
  var product_id = tr.attr("id");
  var qty = parseInt($(tr).find(".number").text());
  qty += 1;
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "../services/data_storage_proxy/add_to_cart.php",
    data: { id: product_id },
    success: function (data) {
      if (data.hasOwnProperty("message")) {
        alert(data["message"]);
      }
      // If added succesfully update the cart data
      else update_cart(tr, qty);
    },
  });
});

// Decrement. Remove one instance of the product from the cart
// Specifically the oldest
$(document).on("click", ".decrement-btn", function () {
  var tr = $(this).closest("tr");
  var product_id = tr.attr("id");
  var qty = parseInt($(tr).find(".number").text());
  qty -= 1;
  if (qty >= 0) {
    $.ajax({
      type: "POST",
      url: "../services/data_storage_proxy/remove_cart.php",
      dataType: "json",
      data: { id: product_id, action: "decrement" },
      success: function (data) {
        if (data["message"] == "SUCCESS") {
          update_cart(tr, qty);
        } else alert("Error removing product");
      },
      error: function () {
        alert("Error");
      },
    });
  } else alert("There are no more products in the cart");
});

// AJAX for remove from cart
$(document).on("click", ".remove-btn", function () {
  answer = confirm("Remove Item From Cart?");
  if (answer) {
    var tr = $(this).closest("tr");
    var product_id = tr.attr("id");
    $.ajax({
      type: "POST",
      url: "../services/data_storage_proxy/remove_cart.php",
      dataType: "json",
      data: { id: product_id, action: "delete" },
      success: function (data) {
        if (data["message"] == "SUCCESS") {
          // remove from table
          tr.fadeOut(150, function () {
            tr.remove();
          });
        } else print_carts();
      },
    });
  }
});

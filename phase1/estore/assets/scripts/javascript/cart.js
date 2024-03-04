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

// AJAX for remove from cart
$(document).ready(function () {
  $(".remove-btn").click(function () {
    answer = confirm("Remove Item From Cart?");
    if (answer) {
      var tr = $(this).closest("tr");
      var product_id = tr.attr("id");
      $.ajax({
        type: "POST",
        url: "../ajaxfiles/remove_from_cart.php",
        data: { product_id: product_id },
        success: function (response) {
          if (response == 0) {
            // remove from table
            tr.fadeOut(150, function () {
              tr.remove();
            });
          } else alert("Problem deleting this item");
        },
      });
    }
  });
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

// Quantity Buttons
// Ajax
// Increment. Add one more instance of the product in the cart
$(document).ready(function () {
  $(".increment-btn").click(function () {
    var tr = $(this).closest("tr");
    var product_id = tr.attr("id");
    var qty = parseInt($(tr).find(".number").text());
    qty += 1;
    if (qty <= 10) {
      $.ajax({
        type: "POST",
        url: "../ajaxfiles/add_to_cart.php",
        data: { id: product_id },
        success: function (data) {
          if (data !== "Error") {
            // If added succesfully update the cart data
            update_cart(tr, qty);
          } else alert("No more products can be inserted.");
        },
      });
    } else alert("No more products available.");
  });
});

// Ajax
// Increment. Remove one instance of the product from the cart
// Specifically the oldest
$(document).ready(function () {
  $(".decrement-btn").click(function () {
    var tr = $(this).closest("tr");
    var product_id = tr.attr("id");
    var qty = parseInt($(tr).find(".number").text());
    qty -= 1;
    if (qty >= 0) {
      $.ajax({
        type: "POST",
        url: "../ajaxfiles/decrement_cart.php",
        data: { id: product_id },
        success: function (data) {
          if (data !== "Error") {
            update_cart(tr, qty);
          } else alert("The product could not be removed.");
        },
      });
    } else alert("There are no more products in the cart");
  });
});

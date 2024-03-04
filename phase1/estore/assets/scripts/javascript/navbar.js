// To move active to proper anchor of the nav
$(function () {
  $(".menu a").each(function () {
    if ($(this).prop("href") == window.location.href) {
      $(this).addClass("active");
    } else $(this).removeClass("active");
  });
});

const hamburger = document.querySelector(".hamburger");
const mobile_menu = document.querySelector(".mobile-nav");

// change hamburger and menu look when hamburger pressed
hamburger.addEventListener("click", function () {
  hamburger.classList.toggle("is-active");
  mobile_menu.classList.toggle("is-active");
});

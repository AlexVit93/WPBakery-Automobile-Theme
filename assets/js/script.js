document.addEventListener("DOMContentLoaded", function () {
  const burger = document.querySelector(".header__burger");
  const mobileMenu = document.querySelector(".header__mobile-menu");
  const faqItems = document.querySelectorAll(".faq__item");

  burger.addEventListener("click", function () {
    if (mobileMenu.classList.contains("active")) {
      mobileMenu.style.maxHeight = mobileMenu.scrollHeight + "px";
      setTimeout(() => {
        mobileMenu.style.maxHeight = "0";
      }, 10);
      setTimeout(() => {
        mobileMenu.classList.remove("active");
      }, 200);
    } else {
      mobileMenu.classList.add("active");
      mobileMenu.style.maxHeight = "1000px";
    }
  });

  

  faqItems.forEach((item) => {
    item.addEventListener("click", function () {
      item.classList.toggle("open");
    });
  });
});

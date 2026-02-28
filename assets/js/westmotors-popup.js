document.addEventListener("DOMContentLoaded", function () {
  document.addEventListener("click", function (e) {
    const openButton = e.target.closest(".js-callback-open");
    if (openButton) {
      e.preventDefault();
      const formId = openButton.dataset.formId;
      if (formId) {
        const popup = document.getElementById("callback-popup-" + formId);
        if (popup) {
          popup.style.display = "block";
        } else {
          console.error(`Popup with ID "callback-popup-${formId}" not found.`);
        }
      }
    }

    const closeTarget = e.target.closest(
      ".wm-popup__overlay, .wm-popup__close"
    );
    if (closeTarget) {
      const popup = closeTarget.closest(".wm-popup");
      if (popup) {
        popup.style.display = "none";
      }
    }
  });
});

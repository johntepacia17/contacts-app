document.addEventListener("DOMContentLoaded", () => {
  const nameEl = document.getElementById("deleteContactName");
  const confirmBtn = document.getElementById("confirmContactDeleteBtn");

  if (!confirmBtn) return;

  let targetId = null;

  // Works for BOTH server rows and AJAX-rendered rows (event delegation)
  document.addEventListener("click", (e) => {
    const btn = e.target.closest(".js-contact-delete");
    if (!btn) return;

    targetId = btn.getAttribute("data-contact-id");
    const contactName = btn.getAttribute("data-contact-name") || "this contact";

    if (nameEl) nameEl.textContent = contactName;
  });

  confirmBtn.addEventListener("click", () => {
    if (!targetId) return;

    const form = document.getElementById(`delete-form-${targetId}`);
    if (form) form.submit();
  });
});

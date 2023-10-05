/**
 * Gestisce l'evento "DOMContentLoaded" per inizializzare il toggle dell'occhio per la password.
 * Abilita l'utente a mostrare o nascondere la password quando clicca sull'icona dell'occhio.
 */
document.addEventListener("DOMContentLoaded", function () {
  /**
   * Riferimento all'icona dell'occhio.
   * @type {HTMLElement}
   */
  const eyeToggle = document.querySelector(".eye-toggle");

  /**
   * Riferimento all'input della password.
   * @type {HTMLInputElement}
   */
  const passwordInput = document.querySelector("#password");

  /**
   * Gestisce il click sull'icona dell'occhio.
   * Cambia il tipo dell'input della password da "password" a "text" e viceversa,
   * nonché l'icona visualizzata per rappresentare lo stato attuale.
   */
  eyeToggle.addEventListener("click", function () {
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      eyeToggle.classList.remove("fa-eye");
      eyeToggle.classList.add("fa-eye-slash");
    } else {
      passwordInput.type = "password";
      eyeToggle.classList.remove("fa-eye-slash");
      eyeToggle.classList.add("fa-eye");
    }
  });
});

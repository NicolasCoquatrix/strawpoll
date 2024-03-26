// SCRIPTS "MOT DE PASSE"
const passwordVisibility = document.querySelector("#passwordVisibility");

passwordVisibility.addEventListener("click", function () {
  if (password.type === "password") {
    password.type = "text";
    this.classList.remove("fa-eye");
    this.classList.add("fa-eye-slash");
  } else {
    password.type = "password";
    this.classList.remove("fa-eye-slash");
    this.classList.add("fa-eye");
  }
});

// SCRIPTS "ALERTES"
const connectionAlertBox = document.querySelector("#connectionAlertBox");

if (connectionAlertBox != null) {
  const connectionFailedAlertClose = document.querySelector("#connectionFailedAlertClose");
  connectionFailedAlertClose.addEventListener("click", function (e) {
    connectionAlertBox.remove();
  });
}
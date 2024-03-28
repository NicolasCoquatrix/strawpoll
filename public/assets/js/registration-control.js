// FONCTIONS "ALERTES"
function resetAlerts(alertBoxId) {
  let alertBox = document.querySelector("#" + alertBoxId);
  if (alertBox != null) {
    alertBox.remove();
  }
}

function removeAlert(alertId, closeButtonId) {
  let alert = document.querySelector("#" + alertId);
  let closeButton = document.querySelector("#" + closeButtonId);
  if (closeButton != null) {
    closeButton.addEventListener("click", function (e) {
      alert.remove();
    });
  }
}

function createAlert(box, alertBoxId, alertId, label, message, importance) {
  let alertBox = document.querySelector("#" + alertBoxId);
  if (alertBox == null) {
    alertBox = document.createElement("div");
    alertBox.id = alertBoxId;
    alertBox.className = "mt-2";
  }

  let alertDiv = document.createElement("div");
  alertDiv.id = alertId;
  alertDiv.className =
    "mb-1 py-1 gap-2 alert alert-" +
    importance +
    " d-flex justify-content-between";

  let messageText = document.createElement("p");
  messageText.className = "m-1";
  let messageLabel = document.createElement("span");
  messageLabel.className = "fw-bold";
  messageLabel.innerHTML = label + " : ";
  messageText.appendChild(messageLabel);
  messageText.innerHTML += message;
  alertDiv.appendChild(messageText);

  let closeButton = document.createElement("button");
  closeButton.type = "button";
  closeButton.id = alertId + "Close";
  closeButton.className = "p-2 btn-close cursor-pointer";
  closeButton.addEventListener("click", function (e) {
    alertDiv.remove();
  });
  alertDiv.appendChild(closeButton);

  alertBox.appendChild(alertDiv);
  box.appendChild(alertBox);
}

// FONCTIONS "PSEUDO"
async function checkExistingPseudo() {
  try {
    const answer = await fetch(
      "assets/json/json.pseudo-check.php?pseudo=" + pseudo.value
    );
    const data = await answer.json();
    return data;
  } catch (error) {
    console.error("Une erreur s'est produite : ", error);
    throw error;
  }
}

async function checkPseudo(pseudoBox, pseudo, pseudoSate, submit) {
  resetAlerts("pseudoAlertBox");

  let errors = 0;

  if (pseudo.value.length != 0) {
    if (pseudo.value.length < 3 || pseudo.value.length > 20) {
      errors++;
      createAlert(
        pseudoBox,
        "pseudoAlertBox",
        "pseudoLengthAlert",
        "Attention",
        "Le pseudo doit comporter entre 3 et 20 caractères.",
        "warning"
      );
    }

    if (!/^[a-zA-Z0-9_]/.test(pseudo.value)) {
      errors++;
      createAlert(
        pseudoBox,
        "pseudoAlertBox",
        "pseudoFormatAlert",
        "Attention",
        "Le pseudo ne peux comporter que des lettres, des chiffres et le caractère spécial ( _ ).",
        "warning"
      );
    }

    try {
      const existingPseudo = await checkExistingPseudo();
      if (existingPseudo["nb"] == 1) {
        errors++;
        createAlert(
          pseudoBox,
          "pseudoAlertBox",
          "pseudoExistingAlert",
          "Attention",
          "Ce pseudo est déjà utilisé.",
          "warning"
        );
      }
    } catch (error) {
      console.error("Une erreur s'est produite : ", error);
      throw error;
    }
  } else if (submit == true) {
    errors++;
    createAlert(
      pseudoBox,
      "pseudoAlertBox",
      "pseudoObligatoryAlert",
      "Attention",
      "Le champ pseudo est obligatoire.",
      "warning"
    );
  } else {
    pseudoSate.className = "mb-2 px-3 py-0 alert alert-light";
    return false;
  }

  if (errors == 0) {
    pseudoSate.className = "mb-2 px-3 py-0 alert alert-success";
    return true;
  } else {
    pseudoSate.className = "mb-2 px-3 py-0 alert alert-warning";
    return false;
  }
}

function checkPseudoLength(pseudo, pseudoLength) {
  pseudoLength.innerHTML = pseudo.value.length + "/20";
  if (pseudo.value.length >= 3 && pseudo.value.length <= 20) {
    pseudoLength.className = "mb-2 py-0 alert alert-success ";
  } else if (pseudo.value.length > 0) {
    pseudoLength.className = "mb-2 py-0 alert alert-warning";
  } else {
    pseudoLength.className = "mb-2 py-0 alert alert-light";
  }
}

// FONCTIONS "EMAIL"
async function checkExistingEmail() {
  try {
    const answer = await fetch(
      "assets/json/json.email-check.php?email=" + email.value
    );
    const data = await answer.json();
    return data;
  } catch (error) {
    console.error("Une erreur s'est produite : ", error);
    throw error;
  }
}

async function checkEmail(emailBox, email, emailSate, submit) {
  resetAlerts("emailAlertBox");

  let errors = 0;

  if (email.value.length != 0) {
    if (
      !/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))/i.test(
        email.value
      )
    ) {
      errors++;
      createAlert(
        emailBox,
        "emailAlertBox",
        "emailFormatAlert",
        "Attention",
        "Le format de l'adresse mail est invalide.",
        "warning"
      );
    }

    try {
      const existingEmail = await checkExistingEmail();
      if (existingEmail["nb"] == 1) {
        errors++;
        createAlert(
          emailBox,
          "emailAlertBox",
          "emailExistingAlert",
          "Attention",
          "Cet email est déjà utilisé.",
          "warning"
        );
      }
    } catch (error) {
      console.error("Une erreur s'est produite : ", error);
      throw error;
    }
  } else if (submit == true) {
    errors++;
    createAlert(
      emailBox,
      "emailAlertBox",
      "emailObligatoryAlert",
      "Attention",
      "Le champ email est obligatoire.",
      "warning"
    );
  } else {
    emailSate.className = "mb-2 px-3 py-0 alert alert-light";
    return false;
  }

  if (errors == 0) {
    emailSate.className = "mb-2 px-3 py-0 alert alert-success";
    return true;
  } else {
    emailSate.className = "mb-2 px-3 py-0 alert alert-warning";
    return false;
  }
}

// FONCTIONS "MOT DE PASSE"
function checkPassword(passwordBox, password, passwordSate, submit) {
  resetAlerts("passwordAlertBox");

  let errors = 0;

  if (password.value.length != 0) {
    if (password.value.length < 8 || password.value.length > 40) {
      errors++;
      createAlert(
        passwordBox,
        "passwordAlertBox",
        "passwordLengthAlert",
        "Attention",
        "Le mot de passe doit comporter entre 8 et 40 caractères.",
        "warning"
      );
    }

    if (
      !/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-])/.test(
        password.value
      )
    ) {
      errors++;
      createAlert(
        passwordBox,
        "passwordAlertBox",
        "passwordFormatAlert",
        "Attention",
        "Le mot de passe doit contenir au minimum : une minuscule, une majuscule, un chiffre et un caractère spécial ( # , ? , ! , @ , $ , % , ^ , & , * , - ).",
        "warning"
      );
    }
  } else if (submit == true) {
    errors++;
    createAlert(
      passwordBox,
      "passwordAlertBox",
      "passwordObligatoryAlert",
      "Attention",
      "Le champ mot de passe est obligatoire.",
      "warning"
    );
  } else {
    passwordSate.className = "mb-2 px-3 py-0 alert alert-light";
    return false;
  }

  if (errors == 0) {
    passwordSate.className = "mb-2 px-3 py-0 alert alert-success";
    return true;
  } else {
    passwordSate.className = "mb-2 px-3 py-0 alert alert-warning";
    return false;
  }
}

function checkPasswordLength(
  password,
  passwordLength,
  passwordStrengthLabel,
  passwordStrength
) {
  passwordLength.innerHTML = password.value.length + "/40";
  if (password.value.length >= 8 && password.value.length <= 40) {
    passwordLength.className = "mb-2 py-0 alert alert-success ";
  } else if (password.value.length > 0) {
    passwordLength.className = "mb-2 py-0 alert alert-warning";
  } else {
    passwordLength.className = "mb-2 py-0 alert alert-light";
  }

  if (password.value.length > 0) {
    if (
      /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/.test(
        password.value
      )
    ) {
      if (
        /^(?=.*?[A-Z]{3})(?=.*?[a-z]{3})(?=.*?[0-9]{3})(?=.*?[#?!@$%^&*-]{3}).{16,}$/.test(
          password.value
        )
      ) {
        passwordStrength.style.width = "100%";
        passwordStrength.className = "progress-bar bg-success";
        passwordStrengthLabel.innerHTML = "Très fort";
        passwordStrengthLabel.className = "fw-bold text-success";
      } else if (
        /^(?=.*?[A-Z]{2})(?=.*?[a-z]{2})(?=.*?[0-9]{2})(?=.*?[#?!@$%^&*-]{2}).{12,}$/.test(
          password.value
        )
      ) {
        passwordStrength.style.width = "75%";
        passwordStrength.className = "progress-bar bg-success";
        passwordStrengthLabel.innerHTML = "Fort";
        passwordStrengthLabel.className = "fw-bold text-success";
      } else {
        passwordStrength.style.width = "50%";
        passwordStrength.className = "progress-bar bg-warning";
        passwordStrengthLabel.innerHTML = "Moyen";
        passwordStrengthLabel.className = "fw-bold text-warning";
      }
    } else {
      passwordStrength.style.width = "25%";
      passwordStrength.className = "progress-bar bg-danger";
      passwordStrengthLabel.innerHTML = "Insuffisant";
      passwordStrengthLabel.className = "fw-bold text-danger";
    }
  } else {
    passwordStrength.style.width = "0%";
    passwordStrength.className = "progress-bar bg-danger";
    passwordStrengthLabel.innerHTML = "";
    passwordStrengthLabel.className = "fw-bold";
  }
}

// FONCTIONS "CODE POSTAL"
function checkAddress(addressBox, address, addressSate) {
  resetAlerts("addressAlertBox");

  let errors = 0;

  if (address.value != "") {
    if (!/^\d{5}$/.test(address.value)) {
      errors++;
      createAlert(
        addressBox,
        "addressAlertBox",
        "addressFormatAlert",
        "Attention",
        "Le code postal doit comporter 5 chiffres.",
        "warning"
      );
    }

    if (errors == 0) {
      addressSate.className = "mb-2 px-3 py-0 alert alert-success";
      return true;
    } else {
      addressSate.className = "mb-2 px-3 py-0 alert alert-warning";
      return false;
    }
  } else {
    addressSate.className = "mb-2 px-3 py-0 alert alert-light";
    return true;
  }
}

// FONCTIONS "GENRE"
function checkGender(genderBox, gender, genderSate) {
  resetAlerts("genderAlertBox");

  let errors = 0;

  if (gender.id != "genderMan" && gender.id != "genderWoman") {
    errors++;
    createAlert(
      genderBox,
      "genderAlertBox",
      "genderExistingAlert",
      "Attention",
      "Le genre sélecionné n'existe pas.",
      "warning"
    );
  }

  if (errors == 0) {
    genderSate.className = "mb-2 px-3 py-0 alert alert-success";
    return true;
  } else {
    genderSate.className = "mb-2 px-3 py-0 alert alert-warning";
    return false;
  }
}

// FONCTIONS "DATE DE NAISSANCE"
function checkBirth(birthBox, birth, birthSate) {
  resetAlerts("birthAlertBox");

  let errors = 0;

  if (birth.value != "") {
    if (!/^\d{4}-\d{2}-\d{2}$/.test(birth.value)) {
      errors++;
      createAlert(
        birthBox,
        "birthAlertBox",
        "birthFormatAlert",
        "Attention",
        "Le format de la date est incorrect.",
        "warning"
      );
    }

    if (!moment(birth.value, "YYYY-MM-DD", true).isValid()) {
      errors++;
      createAlert(
        birthBox,
        "birthAlertBox",
        "birthDateAlert",
        "Attention",
        "Cette date n'existe pas.",
        "warning"
      );
    }

    currentDate = new Date();
    selectedBirthDate = new Date(birth.value);

    if (selectedBirthDate <= currentDate) {
      let age = currentDate.getFullYear() - selectedBirthDate.getFullYear();
      let selectedBirthMonth = selectedBirthDate.getMonth();
      let currentMonth = currentDate.getMonth();
      if (
        currentMonth < selectedBirthMonth ||
        (currentMonth === selectedBirthMonth &&
          currentDate.getDate() < selectedBirthDate.getDate())
      ) {
        age--;
      }

      if (age > 122) {
        errors++;
        createAlert(
          birthBox,
          "birthAlertBox",
          "birthMaxDateAlert",
          "Attention",
          "Vous avez " +
            age +
            " ans ... Félicitations, vous avez battu le record de longévité humaine qui était de 122 ans ! Malheureusement, vous ne pouvez pas vous inscrire avant d'avoir inscrit votre nom dans le Guinness Book.",
          "warning"
        );
      }
    } else {
      errors++;
      createAlert(
        birthBox,
        "birthAlertBox",
        "birthFutureAlert",
        "Attention",
        "Vous ne pouvez pas être né dans le futur.",
        "warning"
      );
    }

    if (errors == 0) {
      birthSate.className = "mb-2 px-3 py-0 alert alert-success";
      return true;
    } else {
      birthSate.className = "mb-2 px-3 py-0 alert alert-warning";
      return false;
    }
  } else {
    birthSate.className = "mb-2 px-3 py-0 alert alert-light";
    birth.value = "";
    return true;
  }
}

// FONCTIONS "CONDITIONS GÉNÉRALES D'UTILISATION"
function checkCGU(CGUBox, CGU) {
  resetAlerts("CGUAlertBox");

  let errors = 0;

  if (!CGU.checked) {
    errors++;
    createAlert(
      CGUBox,
      "CGUAlertBox",
      "CGUObligatoryAlert",
      "Attention",
      "Vous devez avoir lu et accepté les conditions générales d'utilisation pour pouvoir vous inscrire.",
      "warning"
    );
  }

  if (errors == 0) {
    return true;
  } else {
    return false;
  }
}

// SCRIPTS "PSEUDO"
removeAlert("pseudoLengthAlert", "pseudoLengthAlertClose");
removeAlert("pseudoFormatAlert", "pseudoFormatAlertClose");
removeAlert("pseudoExistingAlert", "pseudoExistingAlertClose");
removeAlert("pseudoObligatoryAlert", "pseudoObligatoryAlertClose");

const pseudoBox = document.querySelector("#pseudoBox");
const pseudo = document.querySelector("#pseudo");
const pseudoSate = document.querySelector("#pseudoSate");

pseudo.addEventListener("blur", function (e) {
  checkPseudo(pseudoBox, pseudo, pseudoSate, false);
});

const pseudoLength = document.querySelector("#pseudoLength");

pseudo.addEventListener("input", function (e) {
  checkPseudoLength(pseudo, pseudoLength);
});

const pseudoInfo = document.querySelector("#pseudoInfo");

pseudoInfo.addEventListener("click", function (e) {
  resetAlerts("pseudoAlertBox");
  createAlert(
    pseudoBox,
    "pseudoAlertBox",
    "pseudoInfoAlert",
    "Info",
    "Le pseudo doit être unique et comporter entre 3 et 20 caractères alphanumérique, sans espace, le seul caractère spécial autorisé est le ( _ ).",
    "info"
  );
});

// SCRIPTS "EMAIL"
removeAlert("emailFormatAlert", "emailFormatAlertClose");
removeAlert("emailExistingAlert", "emailExistingAlertClose");
removeAlert("emailObligatoryAlert", "emailObligatoryAlertClose");

const emailBox = document.querySelector("#emailBox");
const email = document.querySelector("#email");
const emailSate = document.querySelector("#emailSate");

email.addEventListener("blur", function (e) {
  checkEmail(emailBox, email, emailSate, false);
});

const emailInfo = document.querySelector("#emailInfo");

emailInfo.addEventListener("click", function (e) {
  resetAlerts("emailAlertBox");
  createAlert(
    emailBox,
    "emailAlertBox",
    "emailInfoAlert",
    "Info",
    "L'email doit être unique.",
    "info"
  );
});

// SCRIPTS "MOT DE PASSE"
removeAlert("passwordLengthAlert", "passwordLengthAlertClose");
removeAlert("passwordFormatAlert", "passwordFormatAlertClose");
removeAlert("passwordObligatoryAlert", "passwordObligatoryAlertClose");

const passwordBox = document.querySelector("#passwordBox");
const password = document.querySelector("#password");
const passwordSate = document.querySelector("#passwordSate");

password.addEventListener("blur", function (e) {
  checkPassword(passwordBox, password, passwordSate, false);
});

const passwordLength = document.querySelector("#passwordLength");
const passwordStrengthLabel = document.querySelector("#passwordStrengthLabel");
const passwordStrength = document.querySelector("#passwordStrength");

password.addEventListener("input", function (e) {
  checkPasswordLength(
    password,
    passwordLength,
    passwordStrengthLabel,
    passwordStrength
  );
});

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

const passwordInfo = document.querySelector("#passwordInfo");

passwordInfo.addEventListener("click", function (e) {
  resetAlerts("passwordAlertBox");
  createAlert(
    passwordBox,
    "passwordAlertBox",
    "passwordInfoAlert",
    "Info",
    "Le mot de passe doit comporter entre 8 et 40 caractères et contenir au minimum : une minuscule, une majuscule, un chiffre et un caractère spécial ( # , ? , ! , @ , $ , % , ^ , & , * , - ).",
    "info"
  );
});

// SCRIPTS "CODE POSTAL"
removeAlert("addressFormatAlert", "addressFormatAlertClose");

const addressBox = document.querySelector("#addressBox");
const address = document.querySelector("#address");
const addressSate = document.querySelector("#addressSate");

address.addEventListener("blur", function (e) {
  checkAddress(addressBox, address, addressSate);
});

const addressInfo = document.querySelector("#addressInfo");

addressInfo.addEventListener("click", function (e) {
  resetAlerts("addressAlertBox");
  createAlert(
    addressBox,
    "addressAlertBox",
    "addressInfoAlert",
    "Info",
    "Ce champ est optionnel et sert à établir des statistiques.",
    "info"
  );
});

// SCRIPTS "GENRE"
removeAlert("genderExistingAlert", "genderExistingAlertClose");

const genderBox = document.querySelector("#genderBox");
const genders = document.querySelectorAll('input[type="radio"]');
const genderSate = document.querySelector("#genderSate");

genders.forEach((gender) => {
  gender.addEventListener("change", function (e) {
    if (gender.checked) {
      checkGender(genderBox, gender, genderSate);
    }
  });
});

const resetGender = document.querySelector("#resetGender");

resetGender.addEventListener("click", function (e) {
  genders.forEach((gender) => {
    gender.checked = false;
    genderSate.className = "mb-2 px-3 py-0 alert alert-light";
  });
});

const genderInfo = document.querySelector("#genderInfo");

genderInfo.addEventListener("click", function (e) {
  resetAlerts("genderAlertBox");
  createAlert(
    genderBox,
    "genderAlertBox",
    "genderInfoAlert",
    "Info",
    "Ce champ est optionnel et sert à établir des statistiques.",
    "info"
  );
});

// SCRIPTS "DATE DE NAISSANCE"
removeAlert("birthFormatAlert", "birthFormatAlertClose");
removeAlert("birthDateAlert", "birthDateAlertClose");
removeAlert("birthMaxDateAlert", "birthMaxDateAlertClose");
removeAlert("birthFutureAlert", "birthFutureAlertClose");

const birthBox = document.querySelector("#birthBox");
const birth = document.querySelector("#birth");
const birthSate = document.querySelector("#birthSate");

birth.addEventListener("blur", function (e) {
  checkBirth(birthBox, birth, birthSate);
});

const birthInfo = document.querySelector("#birthInfo");

birthInfo.addEventListener("click", function (e) {
  resetAlerts("birthAlertBox");
  createAlert(
    birthBox,
    "birthAlertBox",
    "birthInfoAlert",
    "Info",
    "Ce champ est optionnel et sert à établir des statistiques.",
    "info"
  );
});

// SCRIPTS "CONDITIONS GÉNÉRALES D'UTILISATION"
removeAlert("CGUObligatoryAlert", "CGUObligatoryAlertClose");

const CGUBox = document.querySelector("#CGUBox");
const CGU = document.querySelector("#CGU");

CGU.addEventListener("change", function (e) {
  checkCGU(CGUBox, CGU);
});

// SCRIPTS "ENVOI DU FORMULAIRE"
const registrationBox = document.querySelector("#registrationBox");
const registrationAlert = document.querySelector("#registrationAlert");

if (registrationAlert != null) {
}

const formSubmit = document.querySelector("#formSubmit");

formSubmit.addEventListener("click", async function (e) {
  e.preventDefault();

  let formValidated = true;
  let validatedFields = [];

  validatedFields.push(await checkPseudo(pseudoBox, pseudo, pseudoSate, true));
  validatedFields.push(await checkEmail(emailBox, email, emailSate, true));
  validatedFields.push(
    checkPassword(passwordBox, password, passwordSate, true)
  );
  validatedFields.push(checkAddress(addressBox, address, addressSate));
  genders.forEach((gender) => {
    if (gender.checked) {
      validatedFields.push(checkGender(genderBox, gender, genderSate));
    }
  });
  validatedFields.push(checkBirth(birthBox, birth, birthSate));
  validatedFields.push(checkCGU(CGUBox, CGU));

  let errors = 0;

  validatedFields.forEach(function (field) {
    if (field != true) {
      formValidated = false;
      errors++;
    }
  });

  let errorsPrint = errors;
  if (errors > 1) {
    errorsPrint = errors + " champs invalides";
  } else {
    errorsPrint = errors + " champ invalide";
  }

  if (formValidated) {
    document.querySelector("#form").submit();
  } else {
    resetAlerts("registrationAlertBox");
    createAlert(
      registrationBox,
      "registrationAlertBox",
      "registrationFailedAlert",
      "Erreur lors de l'envoi du formulaire",
      "Il y a " + errorsPrint + " dans votre formulaire d'inscription.",
      "danger"
    );
  }
});

function resetAlerts(alertBoxId) {
  let alertBox = document.querySelector("#" + alertBoxId);
  if (alertBox != null) {
    alertBox.remove();
  }
}

function createAlert(box, alertBoxId, alertId, message) {
  let alertBox = document.querySelector("#" + alertBoxId);
  if (alertBox == null) {
    alertBox = document.createElement("div");
    alertBox.id = alertBoxId;
    alertBox.className = "mt-2";
  }

  let alertDiv = document.createElement("div");
  alertDiv.id = alertId;
  alertDiv.className =
    "mb-1 py-1 gap-2 alert alert-warning d-flex justify-content-between";

  let messageText = document.createElement("p");
  messageText.className = "m-1";
  let messageLabel = document.createElement("span");
  messageLabel.className = "fw-bold";
  messageLabel.innerHTML = "Attention : ";
  messageText.appendChild(messageLabel);
  messageText.innerHTML += message;
  alertDiv.appendChild(messageText);

  let closeButton = document.createElement("button");
  closeButton.className = "p-2 btn-close cursor-pointer";
  closeButton.addEventListener("click", function (e) {
    alertDiv.remove();
  });
  alertDiv.appendChild(closeButton);

  alertBox.appendChild(alertDiv);
  box.appendChild(alertBox);
}

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

async function checkPseudo(pseudoBox, pseudo, pseudoSate) {
  resetAlerts("pseudoAlertBox");

  let errors = 0;

  if (pseudo.value.length != 0) {
    if (pseudo.value.length < 3 || pseudo.value.length > 20) {
      errors++;
      createAlert(
        pseudoBox,
        "pseudoAlertBox",
        "pseudoLengthAlert",
        "Le pseudo doit comporter entre 3 et 20 caractères."
      );
    }

    if (!/^[a-zA-Z0-9_]+$/.test(pseudo.value)) {
      errors++;
      createAlert(
        pseudoBox,
        "pseudoAlertBox",
        "pseudoFormatAlert",
        "Le pseudo ne peux comporter que des lettres, des chiffres et le caractère spécial (_)."
      );
    }

    try {
      const existingPseudo = await checkExistingPseudo(pseudo.value);
      if (existingPseudo["nb"] == 1) {
        errors++;
        createAlert(
          pseudoBox,
          "pseudoAlertBox",
          "pseudoExistingAlert",
          "Ce pseudo est déjà utilisé."
        );
      }
    } catch (error) {
      console.error("Une erreur s'est produite : ", error);
      throw error;
    }
  } else {
    errors++;
    createAlert(
      pseudoBox,
      "pseudoAlertBox",
      "pseudoObligatoryAlert",
      "Le champ pseudo est obligatoire."
    );
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
    return true;
  } else {
    pseudoLength.className = "mb-2 py-0 alert alert-warning";
    return false;
  }
}

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

async function checkEmail(emailBox, email, emailSate) {
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
        "Le format de l'adresse mail est invalide."
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
          "Cet email est déjà utilisé."
        );
      }
    } catch (error) {
      console.error("Une erreur s'est produite : ", error);
      throw error;
    }
  } else {
    errors++;
    createAlert(
      emailBox,
      "emailAlertBox",
      "emailObligatoryAlert",
      "Le champ email est obligatoire."
    );
  }

  if (errors == 0) {
    emailSate.className = "mb-2 px-3 py-0 alert alert-success";
    return true;
  } else {
    emailSate.className = "mb-2 px-3 py-0 alert alert-warning";
    return false;
  }
}

function checkPassword(passwordBox, password, passwordSate) {
  resetAlerts("passwordAlertBox");

  let errors = 0;

  if (password.value.length != 0) {
    if (password.value.length < 8 || password.value.length > 40) {
      errors++;
      createAlert(
        passwordBox,
        "passwordAlertBox",
        "passwordLengthAlert",
        "Le mot de passe doit comporter entre 8 et 40 caractères."
      );
    }

    if (
      !/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,40}$/.test(
        password.value
      )
    ) {
      errors++;
      createAlert(
        passwordBox,
        "passwordAlertBox",
        "passwordFormatAlert",
        "Le mot de passe doit contenir au minimum : une minuscule, une majuscule, un chiffre et un caractère spécial (#,?,!,@,$,%,^,&,*,-)."
      );
    }
  } else {
    errors++;
    createAlert(
      passwordBox,
      "passwordAlertBox",
      "passwordObligatoryAlert",
      "Le champ mot de passe est obligatoire."
    );
  }

  if (errors == 0) {
    passwordSate.className = "mb-2 px-3 py-0 alert alert-success";
    return true;
  } else {
    passwordSate.className = "mb-2 px-3 py-0 alert alert-warning";
    return false;
  }
}

function checkPasswordLength(password, passwordLength) {
  passwordLength.innerHTML = password.value.length + "/40";
  if (password.value.length >= 8 && password.value.length <= 40) {
    passwordLength.className = "mb-2 py-0 alert alert-success ";
    return true;
  } else {
    passwordLength.className = "mb-2 py-0 alert alert-warning";
    return false;
  }
}

function checkZipCode(zipCodeBox, zipCode, zipCodeSate) {
  resetAlerts("zipCodeAlertBox");

  let errors = 0;

  if (zipCode.value != "") {
    if (!/^\d{5}$/.test(zipCode.value)) {
      errors++;
      createAlert(
        zipCodeBox,
        "zipCodeAlertBox",
        "zipCodeAlert",
        "Le code postal doit comporter entre 5 chiffres."
      );
    }

    if (errors == 0) {
      zipCodeSate.className = "mb-2 px-3 py-0 alert alert-success";
      return true;
    } else {
      zipCodeSate.className = "mb-2 px-3 py-0 alert alert-warning";
      return false;
    }
  } else {
    zipCodeSate.className = "mb-2 px-3 py-0 alert alert-light";
    return true;
  }
}

function checkGender(genderBox, gender, genderSate) {
  resetAlerts("genderAlertBox");

  let errors = 0;

  if (
    gender.id != "genderMan" &&
    gender.id != "genderWoman" &&
    gender.id != "genderOther"
  ) {
    errors++;
    createAlert(
      genderBox,
      "genderAlertBox",
      "genderAlert",
      "Le genre sélecionné n'existe pas."
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
        "Le format de la date est incorrect."
      );
    }

    if (!moment(birth.value, "YYYY-MM-DD", true).isValid()) {
      errors++;
      createAlert(
        birthBox,
        "birthAlertBox",
        "birthDateAlert",
        "Cette date n'existe pas."
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
          "Vous avez " +
            age +
            " ans ... Félicitations, vous avez battu le record de longévité humaine qui était de 122 ans ! Malheureusement, vous ne pouvez pas vous inscrire avant d'avoir inscrit votre nom dans le Guinness Book."
        );
      }
    } else {
      errors++;
      createAlert(
        birthBox,
        "birthAlertBox",
        "birthFutureAlert",
        "Vous ne pouvez pas être né dans le futur."
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

function checkCGT(CGTBox, CGT) {
  resetAlerts("CGTAlertBox");

  let errors = 0;

  if (!CGT.checked) {
    errors++;
    createAlert(
      CGTBox,
      "CGTAlertBox",
      "CGTAlert",
      "Vous devez avoir lu et accepté les conditions générales d'utilisation pour pouvoir vous inscrire."
    );
  }

  if (errors == 0) {
    return true;
  } else {
    return false;
  }
}

const pseudoBox = document.querySelector("#pseudoBox");
const pseudo = document.querySelector("#pseudo");
const pseudoSate = document.querySelector("#pseudoSate");
const pseudoLength = document.querySelector("#pseudoLength");
pseudo.addEventListener("blur", function (e) {
  checkPseudo(pseudoBox, pseudo, pseudoSate);
});
pseudo.addEventListener("input", function (e) {
  checkPseudoLength(pseudo, pseudoLength);
});

const emailBox = document.querySelector("#emailBox");
const email = document.querySelector("#email");
const emailSate = document.querySelector("#emailSate");
email.addEventListener("blur", function (e) {
  checkEmail(emailBox, email, emailSate);
});

const passwordBox = document.querySelector("#passwordBox");
const password = document.querySelector("#password");
const passwordSate = document.querySelector("#passwordSate");
const passwordLength = document.querySelector("#passwordLength");
password.addEventListener("blur", function (e) {
  checkPassword(passwordBox, password, passwordSate);
});
password.addEventListener("input", function (e) {
  checkPasswordLength(password, passwordLength);
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

const zipCodeBox = document.querySelector("#zipCodeBox");
const zipCode = document.querySelector("#zipCode");
const zipCodeSate = document.querySelector("#zipCodeSate");
zipCode.addEventListener("blur", function (e) {
  checkZipCode(zipCodeBox, zipCode, zipCodeSate);
});

const genderBox = document.querySelector("#genderBox");
const genders = document.querySelectorAll('input[type="radio"]');
const genderSate = document.querySelector("#genderSate");
const resetGender = document.querySelector("#resetGender");
genders.forEach((gender) => {
  gender.addEventListener("change", function (e) {
    if (gender.checked) {
      checkGender(genderBox, gender, genderSate);
    }
  });
});
resetGender.addEventListener("click", function (e) {
  genders.forEach((gender) => {
    gender.checked = false;
    genderSate.className = "mb-2 px-3 py-0 alert alert-light";
  });
});

const birthBox = document.querySelector("#birthBox");
const birth = document.querySelector("#birth");
const birthSate = document.querySelector("#birthSate");
birth.addEventListener("blur", function (e) {
  checkBirth(birthBox, birth, birthSate);
});

const CGTBox = document.querySelector("#CGTBox");
const CGT = document.querySelector("#CGT");
CGT.addEventListener("change", function (e) {
  checkCGT(CGTBox, CGT);
});

const registrationBox = document.querySelector("#registrationBox");
const registrationAlert = document.querySelector("#registrationAlert");
if (!registrationAlert == null) {
}
const formSubmit = document.querySelector("#formSubmit");
formSubmit.addEventListener("click", async function (e) {
  e.preventDefault();
  let formValidated = true;
  let validatedFields = [];

  validatedFields.push(await checkPseudo(pseudoBox, pseudo, pseudoSate));
  validatedFields.push(await checkEmail(emailBox, email, emailSate));
  validatedFields.push(checkPassword(passwordBox, password, passwordSate));
  validatedFields.push(checkZipCode(zipCodeBox, zipCode, zipCodeSate));
  genders.forEach((gender) => {
    if (gender.checked) {
      validatedFields.push(checkGender(genderBox, gender, genderSate));
    }
  });
  validatedFields.push(checkBirth(birthBox, birth, birthSate));
  validatedFields.push(checkCGT(CGTBox, CGT));

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
    if (registrationAlert) {
      registrationAlert.remove();
    }

    const registrationFailed = document.querySelector("#registrationFailed");
    if (registrationFailed) {
      registrationFailed.remove();
    }

    let newRegistrationFailed = document.createElement("div");
    newRegistrationFailed.id = "registrationFailed";
    newRegistrationFailed.className =
      "mb-0 mt-2 py-1 gap-2 alert alert-danger d-flex justify-content-between";

    let newRegistrationFailedText = document.createElement("p");
    newRegistrationFailedText.className = "m-1";

    let newRegistrationFailedLabel = document.createElement("span");
    newRegistrationFailedLabel.className = "fw-bold";
    newRegistrationFailedLabel.innerText =
      "Erreur lors de l'envoi du formulaire : ";

    let newRegistrationFailedErrors = document.createElement("span");
    newRegistrationFailedErrors.className = "fw-bold";
    newRegistrationFailedErrors.innerText = errorsPrint;

    newRegistrationFailedText.appendChild(newRegistrationFailedLabel);
    newRegistrationFailedText.innerHTML += "Il y a ";
    newRegistrationFailedText.appendChild(newRegistrationFailedErrors);
    newRegistrationFailedText.innerHTML +=
      " dans votre formulaire d'inscription.";
    newRegistrationFailed.appendChild(newRegistrationFailedText);

    let closeButton = document.createElement("button");
    closeButton.className = "p-2 btn-close cursor-pointer";
    closeButton.addEventListener("click", function (e) {
      newRegistrationFailed.remove();
    });
    newRegistrationFailed.appendChild(closeButton);

    registrationBox.appendChild(newRegistrationFailed);
  }
});

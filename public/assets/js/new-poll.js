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

// FONCTIONS "NON DU SONDAGE"
function checkPollName(pollNameBox, pollName, pollNameState, submit) {
  resetAlerts("pollNameAlertBox");

  let errors = 0;

  if (pollName.value.length != 0) {
    if (pollName.value.length < 2 || pollName.value.length > 100) {
      errors++;
      createAlert(
        pollNameBox,
        "pollNameAlertBox",
        "pollNameLengthAlert",
        "Attention",
        "Le nom du sondage doit comporter entre 2 et 100 caractères (Nombre de caractères actuel : " +
          pollName.value.length +
          ").",
        "warning"
      );
    }
  } else if (submit == true) {
    errors++;
    createAlert(
      pollNameBox,
      "pollNameAlertBox",
      "pollNameObligatoryAlert",
      "Attention",
      "Le champ nom du sondage est obligatoire.",
      "warning"
    );
  } else {
    pollNameState.className = "mb-0 px-3 py-0 alert alert-light";
    return false;
  }

  if (errors == 0) {
    pollNameState.className = "mb-0 px-3 py-0 alert alert-success";
    return true;
  } else {
    pollNameState.className = "mb-0 px-3 py-0 alert alert-warning";
    return false;
  }
}

// FONCTIONS "CHOIX"
function checkChoice(choiceBox, choice, choiceState, index, submit) {
  resetAlerts("choice" + index + "AlertBox");

  let errors = 0;

  if (choice.value.length != 0) {
    if (choice.value.length < 2 || choice.value.length > 100) {
      errors++;
      createAlert(
        choiceBox,
        "choice" + index + "AlertBox",
        "choice" + index + "LengthAlert",
        "Attention",
        "Le nom du choix doit comporter entre 2 et 100 caractères (Nombre de caractères actuel : " +
          choice.value.length +
          ").",
        "warning"
      );
    }

    for (let i = 1; i <= choicesIndex; i++) {
      if (i != index) {
        let otherChoice = document.querySelector("#choice" + i);
        if (otherChoice.value == choice.value) {
          errors++;
          createAlert(
            choiceBox,
            "choice" + index + "AlertBox",
            "choice" + index + "ExistingAlert",
            "Attention",
            "Ce nom est déjà attribué à un autre choix.",
            "warning"
          );
        }
      }
    }
  } else if (submit == true) {
    errors++;
    createAlert(
      choiceBox,
      "choice" + index + "AlertBox",
      "choice" + index + "ObligatoryAlert",
      "Attention",
      "Le champ nom du choix est obligatoire.",
      "warning"
    );
  } else {
    choiceState.className = "mb-0 px-3 py-0 alert alert-light";
    return false;
  }

  if (errors == 0) {
    choiceState.className = "mb-0 px-3 py-0 alert alert-success";
    return true;
  } else {
    choiceState.className = "mb-0 px-3 py-0 alert alert-warning";
    return false;
  }
}

// FONCTIONS "NOMBRE DE CHOIX POSSIBLES"
function checkNumberChoices(numberChoicesBox, inputNumberChoices) {
  resetAlerts("numberChoicesAlertBox");

  let errors = 0;
  if (inputNumberChoices.value.length != 0) {
    if (!/^[0-9]$/.test(inputNumberChoices.value)) {
      console.log("2");
      errors++;
      createAlert(
        numberChoicesBox,
        "numberChoicesAlertBox",
        "numberChoicesFormatAlert",
        "Attention",
        "Le nombre de choix doit être un chiffre positif entier.",
        "warning"
      );
    } else {
      if (inputNumberChoices.value < 1) {
        inputNumberChoices.value = 1;
        errors++;
        createAlert(
          numberChoicesBox,
          "numberChoicesAlertBox",
          "numberChoicesMinAlert",
          "Attention",
          "Le nombre de choix possibles ne peux pas être inférieur à 1.",
          "warning"
        );
      }

      if (inputNumberChoices.value > numberChoices) {
        inputNumberChoices.value = numberChoices;
        errors++;
        createAlert(
          numberChoicesBox,
          "numberChoicesAlertBox",
          "numberChoicesMaxAlert",
          "Attention",
          "Le nombre de choix possibles ne peux pas être supérieur au nombre de choix.",
          "warning"
        );
      }
    }
  } else {
    errors++;
    createAlert(
      numberChoicesBox,
      "numberChoicesAlertBox",
      "numberChoicesObligatoryAlert",
      "Attention",
      "Le champ nombre de choix possible est obligatoire et doit être un chiffre positif entier.",
      "warning"
    );
    return false;
  }

  if (errors == 0) {
    return true;
  } else {
    return false;
  }
}

// SCRIPTS "NON DU SONDAGE"
removeAlert("pollNameLengthAlert", "pollNameLengthAlertClose");
removeAlert("pollNameObligatoryAlert", "pollNameObligatoryAlertClose");

const pollNameBox = document.querySelector("#pollNameBox");
const pollName = document.querySelector("#pollName");
const pollNameState = document.querySelector("#pollNameState");

pollName.addEventListener("blur", function (e) {
  checkPollName(pollNameBox, pollName, pollNameState, false);
});

const pollNameInfo = document.querySelector("#pollNameInfo");

pollNameInfo.addEventListener("click", function (e) {
  resetAlerts("pollNameAlertBox");
  createAlert(
    pollNameBox,
    "pollNameAlertBox",
    "pollNameInfoAlert",
    "Info",
    "Le nom du sondage doit comporter entre 2 et 100 caractères.",
    "info"
  );
});

// SCRIPTS "CHOIX"
let numberChoices = 2;
let choicesIndex = 2;
const numberChoicesMax = document.querySelector("#numberChoices");

const choicesBox = document.querySelector("#choicesBox");
const choicesInfo = document.querySelector("#choicesInfo");

choicesInfo.addEventListener("click", function (e) {
  resetAlerts("choicesAlertBox");
  createAlert(
    choicesBox,
    "choicesAlertBox",
    "choicesInfoAlert",
    "Info",
    "Au minimum, deux choix doivent être disponibles. Les noms des choix doivent être uniques et comporter entre 2 et 100 caractères.",
    "info"
  );
});

// SCRIPTS "CHOIX 1"
removeAlert("choice1LengthAlert", "choice1LengthAlertClose");
removeAlert("choice1ObligatoryAlert", "choice1ObligatoryAlertClose");

const choice1Box = document.querySelector("#choice1Box");
const choice1 = document.querySelector("#choice1");
const choice1State = document.querySelector("#choice1State");

choice1.addEventListener("blur", function (e) {
  checkChoice(choice1Box, choice1, choice1State, 1, false);
});

const choice1Delete = document.querySelector("#choice1Delete");

choice1Delete.addEventListener("click", function (e) {
  if (numberChoices > 2) {
    choice1Box.remove();
    numberChoices--;
    numberChoicesMax.max = numberChoices;
    if (inputNumberChoices.value > numberChoices) {
      inputNumberChoices.value = numberChoices;
    }
  } else {
    resetAlerts("choicesAlertBox");
    createAlert(
      choice1Box,
      "choice1AlertBox",
      "choice1InfoAlert",
      "Attention",
      "Au minimum, deux choix doivent être disponibles. Vous ne pouvez pas supprimer plus de choix.",
      "warning"
    );
  }
});

// SCRIPTS "CHOIX 2"
removeAlert("choice2LengthAlert", "choice2LengthAlertClose");
removeAlert("choice2ObligatoryAlert", "choice2ObligatoryAlertClose");

const choice2Box = document.querySelector("#choice2Box");
const choice2 = document.querySelector("#choice2");
const choice2State = document.querySelector("#choice2State");

choice2.addEventListener("blur", function (e) {
  checkChoice(choice2Box, choice2, choice2State, 2, false);
});

const choice2Delete = document.querySelector("#choice2Delete");

choice2Delete.addEventListener("click", function (e) {
  if (numberChoices > 2) {
    choice2Box.remove();
    numberChoices--;
    numberChoicesMax.max = numberChoices;
    if (inputNumberChoices.value > numberChoices) {
      inputNumberChoices.value = numberChoices;
    }
  } else {
    resetAlerts("choicesAlertBox");
    createAlert(
      choice2Box,
      "choice2AlertBox",
      "choice2InfoAlert",
      "Attention",
      "Au minimum, deux choix doivent être disponibles. Vous ne pouvez pas supprimer plus de choix.",
      "warning"
    );
  }
});

// SCRIPTS "AJOUTER UN CHOIX"
const addChoice = document.querySelector("#addChoice");

addChoice.addEventListener("click", function (e) {
  numberChoices++;
  choicesIndex++;

  let choiceIndex = choicesIndex;

  let choiceBox = document.createElement("div");
  choiceBox.id = "choice" + choiceIndex + "Box";
  choiceBox.className = "mb-2";

  let flexBox = document.createElement("div");
  flexBox.className = "d-flex gap-2";
  choiceBox.appendChild(flexBox);

  let choiceState = document.createElement("div");
  choiceState.id = "choice" + choiceIndex + "State";
  choiceState.className = "px-3 py-0 mb-0 alert alert-light";
  flexBox.appendChild(choiceState);

  var choice = document.createElement("input");
  choice.type = "text";
  choice.className = "form-control";
  choice.name = "choice" + choiceIndex;
  choice.id = "choice" + choiceIndex;
  choice.placeholder = "Entrez le nom du choix";
  choice.required = true;
  flexBox.appendChild(choice);

  choice.addEventListener("blur", function (e) {
    checkChoice(choiceBox, choice, choiceState, choiceIndex, false);
  });

  var choiceDelete = document.createElement("button");
  choiceDelete.type = "button";
  choiceDelete.className = "btn btn-danger";
  choiceDelete.id = "choice" + choiceIndex + "Delete";
  flexBox.appendChild(choiceDelete);

  var trashIcon = document.createElement("i");
  trashIcon.className = "fas fa-trash";
  choiceDelete.appendChild(trashIcon);

  choiceDelete.addEventListener("click", function (e) {
    if (numberChoices > 2) {
      choiceBox.remove();
      numberChoices--;
      numberChoicesMax.max = numberChoices;
      if (inputNumberChoices.value > numberChoices) {
        inputNumberChoices.value = numberChoices;
      }
    } else {
      resetAlerts("choicesAlertBox");
      createAlert(
        choiceBox,
        "choice" + choiceIndex + "AlertBox",
        "choice" + choiceIndex + "InfoAlert",
        "Attention",
        "Au minimum, deux choix doivent être disponibles. Vous ne pouvez pas supprimer plus de choix.",
        "warning"
      );
    }
  });

  choicesBox.appendChild(choiceBox);
});

// SCRIPTS "NOMBRE DE CHOIX POSSIBLES"
const numberChoicesBox = document.querySelector("#numberChoicesBox");
const numberChoicesInfo = document.querySelector("#numberChoicesInfo");
const numberChoicesMinus = document.querySelector("#numberChoicesMinus");
const numberChoicesPlus = document.querySelector("#numberChoicesPlus");
const inputNumberChoices = document.querySelector("#numberChoices");

inputNumberChoices.addEventListener("blur", function (e) {
  checkNumberChoices(numberChoicesBox, inputNumberChoices);
});

numberChoicesMinus.addEventListener("click", function (e) {
  if (inputNumberChoices.value > 1) {
    inputNumberChoices.value--;
  }
});

numberChoicesPlus.addEventListener("click", function (e) {
  if (inputNumberChoices.value < numberChoices) {
    inputNumberChoices.value++;
  }
});

numberChoicesInfo.addEventListener("click", function (e) {
  resetAlerts("numberChoicesAlertBox");
  createAlert(
    numberChoicesBox,
    "numberChoicesAlertBox",
    "numberChoicesInfoAlert",
    "Info",
    "Détermine le nombre maxumim de choix que les votants peuvent choisir.",
    "info"
  );
});

// SCRIPTS "ENVOI DU FORMULAIRE"
const newPollBox = document.querySelector("#newPollBox");
const newPollBoxAlert = document.querySelector("#newPollBoxAlert");
const formSubmit = document.querySelector("#formSubmit");

formSubmit.addEventListener("click", function (e) {
  e.preventDefault();

  let formValidated = true;
  let validatedFields = [];

  validatedFields.push(
    checkPollName(pollNameBox, pollName, pollNameState, true)
  );

  for (let i = 1; i <= choicesIndex; i++) {
    let choiceBox = document.querySelector("#choice" + i + "Box");
    let choice = document.querySelector("#choice" + i);
    let choiceState = document.querySelector("#choice" + i + "State");
    if (choice) {
      validatedFields.push(
        checkChoice(choiceBox, choice, choiceState, i, true)
      );
    }
  }

  validatedFields.push(
    checkNumberChoices(numberChoicesBox, inputNumberChoices)
  );

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
    resetAlerts("newPollAlertBox");
    createAlert(
      newPollBox,
      "newPollAlertBox",
      "newPollFailedAlert",
      "Erreur lors de l'envoi du formulaire",
      "Il y a " +
        errorsPrint +
        " dans votre formulaire de création du sondage.",
      "danger"
    );
  }
});

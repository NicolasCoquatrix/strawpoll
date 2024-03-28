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

// FONCTIONS "TEMPLATES"
function renderTemplate(template, data) {
  for (const [key, value] of Object.entries(data)) {
      template = template.replace(new RegExp('{{\\s*' + key + '\\s*}}', 'g'), value);
  }
  return template;
}

// FORMULAIRE "INFORMATIONS PERSONNELLES"
const infosCardBox = document.querySelector("#infosCardBox");
const infosCard = document.querySelector("#infosCard");
const editInfos = document.querySelector("#editInfos");

editInfos.addEventListener("click", function (e) {
  infosCard.remove();
  const infosTemplate = document.querySelector("#infosTemplate");
  const clonedinfosTemplate = document.importNode(infosTemplate, true);
  infosCardBox.innerHTML = clonedinfosTemplate.innerHTML;
});

// FORMULAIRE "INFORMATIONS PERSONNELLES"
const passwordCardBox = document.querySelector("#passwordCardBox");
const passwordCard = document.querySelector("#passwordCard");
const editPassword = document.querySelector("#editPassword");

editPassword.addEventListener("click", function (e) {
  passwordCard.remove();
  const passwordTemplate = document.querySelector("#passwordTemplate");
  const clonedPasswordTemplate = document.importNode(passwordTemplate, true);
  passwordCardBox.innerHTML = clonedPasswordTemplate.innerHTML;
});
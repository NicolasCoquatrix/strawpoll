<div class="container py-4">
    <div class="row justify-content-center">
        <h1 class="text-center">Créer un nouveau sondage</h1>
        <div id="newPollBox">
            <div class="card">
                <form method="POST" id="form" name="form">
                    <div class="p-3 card-header">
                        <!-- NOM DU SONDAGE -->
                        <div id="pollNameBox">
                            <div class="mb-2 d-flex gap-2">
                                <h2 class="mb-0 h5">Nom du sondage</h2>
                                <p class="mb-0 text-danger">*</p>
                                <i id="pollNameInfo" class="p-0 d-flex align-items-center btn cursor-pointer fas fa-info-circle" title="Le nom du sondage doit comporter entre 2 et 100 caractères."></i>
                            </div>
                            <div class="d-flex gap-2">
                                <div class="px-3 py-0 mb-0 alert alert-light" id="pollNameState"></div>
                                <input type="text" class="form-control fw-bold" name="pollName" id="pollName" placeholder="Entrez le nom du sondage" minlength ="2" maxlength ="100" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div id="choicesBox">

                            <div class="mb-2 d-flex gap-2">
                                <h2 class="mb-0 h5">Choix possibles</h2>
                                <p class="mb-0 text-danger">*</p>
                                <i id="choicesInfo" class="p-0 d-flex align-items-center btn cursor-pointer fas fa-info-circle" title="Au minimum, deux choix doivent être disponibles. Les noms des choix doivent être uniques et comporter entre 2 et 100 caractères."></i>
                            </div>
                                
                            <!-- CHOIX 1 -->
                            <div class="mb-2" id="choice1Box">
                                <div class="d-flex gap-2">
                                    <div class="px-3 py-0 mb-0 alert alert-light" id="choice1State"></div>
                                    <input type="text" class="form-control" name="choice1" id="choice1" placeholder="Entrez le nom du choix" minlength ="2" maxlength ="100" required>
                                    <button type="button" class="btn btn-danger" id="choice1Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- CHOIX 2 -->
                            <div class="mb-2" id="choice2Box">
                                <div class="d-flex gap-2">
                                    <div class="px-3 py-0 mb-0 alert alert-light" id="choice2State"></div>
                                    <input type="text" class="form-control" name="choice2" id="choice2" placeholder="Entrez le nom du choix" minlength ="2" maxlength ="100" required>
                                    <button type="button" class="btn btn-danger" id="choice2Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        
                        </div>

                        <!-- AJOUTER UN CHOIX -->
                        <button type="button" class="btn btn-secondary w-100" id="addChoice">
                            <i class="fas fa-plus"></i> Ajouter un choix
                        </button>

                    </div>
                    <div class="card-footer">

                        <!-- NOMBRE DE CHOIX POSSIBLE -->
                        <div id="numberChoicesBox" class="d-flex flex-column align-items-center">
                            <div class="mb-2 d-flex gap-2">
                                <label for="numberChoices" class="mb-0 h5">Nombre de choix possibles <span class="text-danger">*</span></label>
                                <i id="numberChoicesInfo" class="p-0 d-flex align-items-center btn cursor-pointer fas fa-info-circle" title="Détermine le nombre maxumim de choix que les votants peuvent choisir."></i>
                            </div>
                            <div class="gap-1 d-flex align-items-center">
                                <button type="button" class="btn btn-danger" id="numberChoicesMinus">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" class="inline-form-control text-center" name="numberChoices" id="numberChoices" min="1" max="2" value="2" required>
                                <button type="button" class="btn btn-success" id="numberChoicesPlus">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <hr class="my-2">

                        <!-- INPUT INVISIBLE (pour l'envoi en JS) -->
                        <input type="hidden" name="hidden_submit" required>

                        <!-- BOUTON ENVOYER -->
                        <button type="submit" class="btn btn-success w-100" name="form_submit" id="formSubmit">
                            <i class="fas fa-check"></i> Créer
                        </button>
                    </div>
                </form>
            </div>
            <?php if(isset($connectionFailed)): ?>
                <div id="connectionAlertBox" class="mt-2">
                    <div id="connectionFailedAlert" class="mb-1 py-1 gap-2 alert alert-danger d-flex justify-content-between">
                        <p class="m-1"><span class="fw-bold">Connexion impossible : </span>Identifiant ou mot de passe incorrect.</p>
                        <button id="connectionFailedAlertClose" class="p-2 btn-close cursor-pointer"></button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="assets/js/new-poll.js"></script>
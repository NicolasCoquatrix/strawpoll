<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="mb-4">
            <div class="card bg-dark">
                <a href="?page=profil" class="gap-2 card-body d-flex justify-content-center text-decoration-none">
                    <i class="d-flex align-items-center fas fa-user fa-icon-large text-light"></i>
                    <p class="mb-0 h3 text-light">Voir mon profil public</p>
                </a>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
    <h1 class="text-center">Mon compte</h1>

        <!-- GAUCHE -->
        <div class="mb-4 col-lg-6">

            <!-- SECTION INFORMATIONS PERSONNELLES -->
            <div id="infosCardBox">
                <div class="card" id="infosCard">
                    <div class="gap-2 card-header d-flex justify-content-center">
                        <i class="d-flex align-items-center fas fa-user-cog fa-icon-large"></i>
                        <h2 class="mb-0 h3">Informations personnelles</h2>
                    </div>
                    <div class="card-body">

                        <!-- Pseudo -->
                        <div id="pseudoBox">
                            <div class="mb-2 gap-2 d-flex">
                                <i class="my-auto fas fa-user"></i>
                                <h3 class="mb-0 h5">Pseudo</h3>
                            </div>
                            <p class="mb-0"><?= $customer['customer_pseudo'] ?></p>
                        </div>

                        <hr class="my-2">

                        <!-- Email -->
                        <div id="emailBox">
                            <div class="mb-2 gap-2 d-flex">
                                <i class="my-auto fas fa-envelope"></i>
                                <h3 class="mb-0 h5">Email</h3>
                            </div>
                            <p class="mb-0"><?= $customer['customer_email'] ?></p>
                        </div>

                        <hr class="my-2">

                        <!-- Code postal -->
                        <div id="addressBox">
                            <div class="mb-2 gap-2 d-flex">
                                <i class="my-auto fas fa-map-marker-alt"></i>
                                <h3 class="mb-0 h5">Code postale</h3>
                            </div>
                            <p class="mb-0"><?= $customer['customer_address'] ?? 'Non renseigné.' ?></p>
                        </div>

                        <hr class="my-2">

                        <!-- Genre -->
                        <div id="genderBox">
                            <div class="mb-2 gap-2 d-flex">
                                <i class="my-auto fas fa-venus-mars"></i>
                                <h3 class="mb-0 h5">Genre</h3>
                            </div>
                            <p class="mb-0"><?= $customer['customer_gender_formatted'] ?? 'Non renseigné.' ?></p>
                        </div>

                        <hr class="my-2">

                        <!-- Date de naissance -->
                        <div id="birthBox">
                            <div class="mb-2 gap-2 d-flex">
                                <i class="my-auto fas fa-calendar-alt"></i>
                                <h3 class="mb-0 h5">Date de naissance</h3>
                            </div>
                            <p class="mb-0"><?= $customer['customer_birth_formatted'] ?? 'Non renseigné.' ?></p>
                        </div>

                    </div>
                    <div class="card-footer d-flex justify-content-between gap-3">

                        <!-- Modifier informations personnelles -->
                        <button type="button" class="btn btn-secondary w-100" id="editInfos">
                            <i class="fas fa-edit"></i> Modifier mes informations
                        </button>
                    </div>
                </div>
                <?php if(isset($_SESSION['infosModified'])): ?>
                <div id="infosAlertBox" class="mt-2">
                    <div id="infosAlert" class="mb-1 py-1 gap-2 alert alert-success d-flex justify-content-between">
                        <p class="m-1"><span class="fw-bold">Mise à jour réussi : </span>Vos informations personnelles ont bien été mises à jour.</p>
                        <button id="infosAlertClose" class="p-2 btn-close cursor-pointer"></button>
                    </div>
                </div>
                <?php unset($_SESSION['infosModified']); ?>
                <?php endif; ?>
                <?php if(isset($infosFailed)): ?>
                <div id="infosAlertBox" class="mt-2">
                    <div id="infosAlert" class="mb-1 py-1 gap-2 alert alert-danger d-flex justify-content-between">
                        <p class="m-1"><span class="fw-bold">Echec de la mise à jour : </span>Une erreur est survenu lors de la mise à jour de vos informations personnelles.</p>
                        <button id="infosAlertClose" class="p-2 btn-close cursor-pointer"></button>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- DROITE -->
        <div class="mb-4 col-lg-6">

            <!-- SECTION MOT DE PASSE -->
            <div class="mb-4" id="passwordCardBox">
                <div class="card" id="passwordCard">
                    <div class="gap-2 card-header d-flex justify-content-center">
                        <i class="d-flex align-items-center fas fa-user-lock fa-icon-large"></i>
                        <h2 class="mb-0 h3">Mot de passe</h2>
                    </div>
                    <div class="card-body">

                        <!-- Mot de passe -->
                        <div id="passwordBox">
                            <p class="mb-0 h5">••••••••</p>
                        </div>

                    </div>
                    <div class="card-footer d-flex justify-content-between gap-3">

                        <!-- Modifier mot de passe -->
                        <button type="button" class="btn btn-secondary w-100" id="editPassword">
                            <i class="fas fa-edit"></i> Modifier mon mot de passe
                        </button>
                    </div>
                </div>
                <?php if(isset($_SESSION['passwordModified'])): ?>
                <div id="passwordAlertBox" class="mt-2">
                    <div id="passwordAlert" class="mb-1 py-1 gap-2 alert alert-success d-flex justify-content-between">
                        <p class="m-1"><span class="fw-bold">Mise à jour réussi : </span>Votre mot de passe a bien été mise à jour.</p>
                        <button id="passwordAlertClose" class="p-2 btn-close cursor-pointer"></button>
                    </div>
                </div>
                <?php unset($_SESSION['passwordModified']); ?>
                <?php endif; ?>
                <?php if(isset($passwordFailed)): ?>
                <div id="passwordAlertBox" class="mt-2">
                    <div id="passwordAlert" class="mb-1 py-1 gap-2 alert alert-danger d-flex justify-content-between">
                        <p class="m-1"><span class="fw-bold">Echec de la mise à jour : </span>Une erreur est survenu lors de la mise à jour de votre mot de passe.</p>
                        <button id="passwordAlertClose" class="p-2 btn-close cursor-pointer"></button>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- SECTION GRADE -->
            <div id="gardeCardBox">
                <div class="mb-4 card" id="gardeCard">
                    <div class="gap-2 card-header d-flex justify-content-center">
                        <i class="d-flex align-items-center fas fa-user-tag fa-icon-large"></i>
                        <h2 class="mb-0 h3">Grade</h2>
                    </div>
                    <div class="card-body">

                        <!-- Grade -->
                        <div id="gradeBox">
                            <p class="mb-0 h5"><?= $customer['customer_grade_formatted'] ?></p>
                        </div>

                    </div>
                    <?php if($customer['grade_id'] != '1'): ?>
                    <div class="card-footer d-flex justify-content-between gap-3">

                        <!-- Promouvoir grade -->
                        <a href="?page=promotion" class="btn btn-primary w-100" id="upgradeGrade">
                            <i class="fas fa-arrow-up"></i> Demander une promotion
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- TEMPLATE FORMULAIRE INFORMATIONS PERSONNELLES -->
<template id="infosFormTemplate">
    <div class="card" id="infosCard">
        <div class="gap-2 card-header d-flex justify-content-center">
            <i class="d-flex align-items-center fas fa-user-cog fa-icon-large"></i>
            <h2 class="mb-0 h3">Informations personnelles</h2>
        </div>
        <form method="POST" id="infosForm" name="form">
            <div class="card-body">

                <!-- PSEUDO -->
                <div id="pseudoBox">
                    <div class="d-flex justify-content-between">
                        <div class="mb-2 d-flex gap-2">
                            <div class="px-3 py-0 mb-0 alert alert-success" id="pseudoSate"></div>
                            <i class="my-auto fas fa-user"></i>
                            <label for="pseudo" class="mb-0 h5">Pseudo <span class="text-danger">*</span></label>
                            <i id="pseudoInfo" class="p-0 d-flex align-items-center btn cursor-pointer fas fa-info-circle" title="Le pseudo doit être unique et comporter entre 3 et 20 caractères alphanumérique, sans espace, le seul caractère spécial autorisé est le ( _ )."></i>
                        </div>
                        <p class="mb-2 py-0 alert alert-success" id="pseudoLength"><?= strlen($customer['customer_pseudo']) ?>/20</p>
                    </div>
                    <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Entrez votre pseudo" value="<?= $customer['customer_pseudo'] ?>" minlength="3" maxlength="20" required autocomplete="username">
                </div>

                <hr class="my-2">

                <!-- EMAIL -->
                <div id="emailBox">
                    <div class="mb-2 d-flex gap-2">
                        <div class="px-3 py-0 mb-0 alert alert-success" id="emailSate"></div>
                        <i class="my-auto fas fa-envelope"></i>
                        <label for="email" class="mb-0 h5">Email <span class="text-danger">*</span></label>
                        <i id="emailInfo" class="p-0 d-flex align-items-center btn cursor-pointer fas fa-info-circle" title="L'email doit être unique."></i>
                    </div>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Entrez votre email" value="<?= $customer['customer_email'] ?>" required autocomplete="email">
                </div>

                <hr class="my-2">

                <!-- CODE POSTAL -->
                <div id="addressBox">
                    <div class="mb-2 d-flex gap-2">
                        <div class="px-3 py-0 mb-0 alert alert-<?php if($customer['customer_address'] != null){echo 'success';} else {echo 'light';} ?>" id="addressSate"></div>
                        <i class="my-auto fas fa-map-marker-alt"></i>
                        <label for="address" class="mb-0 h5">Code postal</label>
                        <i id="addressInfo" class="p-0 d-flex align-items-center btn cursor-pointer fas fa-info-circle" title="Ce champ est optionnel et sert à établir des statistiques."></i>
                    </div>
                    <input type="number" class="form-control" name="address" id="address" placeholder="Entrez votre code postal." value="<?= $customer['customer_address'] ?>" min="0" minlength="5" maxlength="5" autocomplete="postal-code">
                </div>

                <hr class="my-2">

                <!-- GENRE -->
                <div id="genderBox">
                    <div class="mb-2 d-flex gap-2">
                        <div class="px-3 py-0 mb-0 alert alert-<?php if($customer['customer_gender'] != null){echo 'success';} else {echo 'light';} ?>" id="genderSate"></div>
                        <i class="my-auto fas fa-venus-mars"></i>
                        <p class="mb-0 h5">Genre</p>
                        <i id="genderInfo" class="p-0 d-flex align-items-center btn cursor-pointer fas fa-info-circle" title="Ce champ est optionnel et sert à établir des statistiques."></i>
                    </div>
                    <div class="input-group mb-2">
                        <div class="gap-4 form-control d-flex">
                            <div class="mb-0 form-check">
                                <input class="form-check-input" type="radio" name="gender" id="genderMan" value="1" <?= $customer['customer_gender'] == '1' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="genderMan">
                                    Homme
                                </label>
                            </div>
                            <div class="mb-0 form-check">
                                <input class="form-check-input" type="radio" name="gender" id="genderWoman" value="2" <?= $customer['customer_gender'] == '2' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="genderWoman">
                                    Femme
                                </label>
                            </div>
                        </div>
                        <span class="p-0 input-group-text">
                            <i id="resetGender" class="px-3 py-2 btn btn-close cursor-pointer"></i>
                        </span>
                    </div>
                </div>

                <hr class="my-2">

                <!-- DATE DE NAISSANCE -->
                <div id="birthBox">
                    <div class="mb-2 d-flex gap-2">
                        <div class="px-3 py-0 mb-0 alert alert-<?php if($customer['customer_address'] != null){echo 'success';} else {echo 'light';} ?>" id="birthSate"></div>
                        <i class="my-auto fas fa-calendar-alt"></i>
                        <label for="birth" class="mb-0 h5">Date de naissance</label>
                        <i id="birthInfo" class="p-0 d-flex align-items-center btn cursor-pointer fas fa-info-circle" title="Ce champ est optionnel et sert à établir des statistiques."></i>
                    </div>
                    <input type="date" class="form-control" name="birth" id="birth" max="<?= date("Y-m-d") ?>" value="<?= $customer['customer_birth'] ?>" autocomplete="birthdate">
                </div>
                
                <hr class="my-2">

                <!-- CHAMPS OBLIGATOIRES -->
                <p class="small mb-0">Les champs marqués d'un <span class="text-danger">*</span> sont obligatoires.</p>

            </div>
            <div class="card-footer d-flex justify-content-between gap-3">

                <!-- INPUT INVISIBLE (pour l'envoi en JS) -->
                <input type="hidden" name="infos_hidden_submit" required>

                <!-- BOUTON ANNULER -->
                <a href="?page=compte" class="btn btn-secondary w-100" id="infosCancel">
                    <i class="fas fa-times-circle"></i> Annuler
                </a>

                <!-- BOUTON ENVOYER -->
                <button type="submit" class="btn btn-success w-100" name="infos_submit" id="infosSubmit">
                    <i class="fas fa-check-circle"></i> Valider
                </button>
            </div>
        </form>
    </div>
</template>

<!-- TEMPLATE FORMULAIRE MOT DE PASSE -->
<template id="passwordFormTemplate">
    <div class="card" id="passwordCard">
        <div class="gap-2 card-header d-flex justify-content-center">
            <i class="d-flex align-items-center fas fa-user-lock fa-icon-large"></i>
            <h2 class="mb-0 h3">Mot de passe</h2>
        </div>
        <form method="POST" id="passwordForm" name="form">
            <div class="card-body">

                <!-- ANCIEN MOT DE PASSE -->
                <div id="oldPasswordBox">
                    <div class="d-flex justify-content-between">
                        <div class="mb-2 d-flex gap-2">
                            <div class="px-3 py-0 mb-0 alert alert-light" id="oldPasswordSate"></div>
                            <i class="my-auto fas fa-key"></i>
                            <label for="oldPassword" class="mb-0 h5">Ancien mot de passe <span class="text-danger">*</span></label>
                        </div>
                    </div>
                    <div class="input-group mb-1">
                        <input type="password" class="form-control" name="oldPassword" id="oldPassword" placeholder="Entrez votre ancien mot de passe" required>
                        <span class="p-0 input-group-text">
                            <i id="oldPasswordVisibility" class="btn cursor-pointer fas fa-eye"></i>
                        </span>
                    </div>
                </div>

                <hr class="my-2">

                <!-- NOUVEAU MOT DE PASSE -->
                <div id="newPasswordBox">
                    <div class="d-flex justify-content-between">
                        <div class="mb-2 d-flex gap-2">
                            <div class="px-3 py-0 mb-0 alert alert-light" id="newPasswordSate"></div>
                            <i class="my-auto fas fa-lock"></i>
                            <label for="newPassword" class="mb-0 h5">Nouveau mot de passe <span class="text-danger">*</span></label>
                            <i id="newPasswordInfo" class="p-0 d-flex align-items-center btn cursor-pointer fas fa-info-circle" title="Le mot de passe doit comporter entre 8 et 40 caractères et contenir au minimum : une minuscule, une majuscule, un chiffre et un caractère spécial ( # , ? , ! , @ , $ , % , ^ , & , * , - )."></i>
                        </div>
                        <p class="mb-2 alert alert-light py-0" id="newPasswordLength">0/40</p>
                    </div>
                    <div class="input-group mb-1">
                        <input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="Entrez votre nouveau mot de passe" minlength="8" maxlength="40" required>
                        <span class="p-0 input-group-text">
                            <i id="newPasswordVisibility" class="btn cursor-pointer fas fa-eye"></i>
                        </span>
                    </div>
                    <p class="mb-0 small">Force du nouveau mot de passe : <span id="newPasswordStrengthLabel" class="fw-bold"></span></p>
                    <div class="progress">
                        <div id="newPasswordStrength" class="progress-bar bg-danger" style="width: 0%;"></div>
                    </div>
                </div>

                <hr class="my-2">

                <!-- CHAMPS OBLIGATOIRES -->
                <p class="small mb-0">Les champs marqués d'un <span class="text-danger">*</span> sont obligatoires.</p>

            </div>
            <div class="card-footer d-flex justify-content-between gap-3">

                <!-- INPUT INVISIBLE (pour l'envoi en JS) -->
                <input type="hidden" name="password_hidden_submit" required>

                <!-- BOUTON ANNULER -->
                <a href="?page=compte" class="btn btn-secondary w-100" id="passwordCancel">
                    <i class="fas fa-times-circle"></i> Annuler
                </a>

                <!-- BOUTON ENVOYER -->
                <button type="submit" class="btn btn-success w-100" name="password_submit" id="passwordSubmit">
                    <i class="fas fa-check-circle"></i> Valider
                </button>
            </div>
        </form>
    </div>
</template>

<script src="assets/js/account.js"></script>
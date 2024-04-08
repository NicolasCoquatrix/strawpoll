<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6" id="registrationBox">
            <div class="card">
                <div class="gap-2 card-header d-flex justify-content-center">
                    <i class="d-flex align-items-center fas fa-user-plus fa-icon-large"></i>
                    <h1 class="mb-0 h2 text-center">Inscription</h1>
                </div>
                <form method="POST" id="form" name="form">
                    <div class="card-body">

                        <!-- PSEUDO -->
                        <div id="pseudoBox">
                            <div class="d-flex justify-content-between">
                                <div class="mb-2 d-flex gap-2">
                                    <div class="px-3 py-0 mb-0 alert alert-light" id="pseudoSate"></div>
                                    <i class="my-auto fas fa-user"></i>
                                    <label for="pseudo" class="mb-0 h5">Pseudo <span class="text-danger">*</span></label>
                                    <i id="pseudoInfo" class="p-0 d-flex align-items-center btn cursor-pointer fas fa-info-circle" title="Le pseudo doit être unique et comporter entre 3 et 20 caractères alphanumérique, sans espace, le seul caractère spécial autorisé est le ( _ )."></i>
                                </div>
                                <p class="mb-2 py-0 alert alert-light" id="pseudoLength">0/20</p>
                            </div>
                            <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Entrez votre pseudo" value="<?= $pseudo ?? '' ?>" minlength="3" maxlength="20" required autocomplete="username">
                            <?php if(!empty($errors['pseudo'])): ?>
                            <div id="pseudoAlertBox" class="mt-2">
                                <?php foreach($errors['pseudo'] as $error): ?>
                                <div id="<?= $error['alert_id'] ?>" class="mb-1 py-1 gap-2 alert alert-danger d-flex justify-content-between">
                                    <p class="m-1"><span class="fw-bold">Attention : </span><?= $error['message'] ?></p>
                                    <button id="<?= $error['alert_id'] ?>Close" class="p-2 btn-close cursor-pointer"></button>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </div>

                        <hr class="my-2">

                        <!-- EMAIL -->
                        <div id="emailBox">
                        <div class="mb-2 d-flex gap-2">
                            <div class="px-3 py-0 mb-0 alert alert-light" id="emailSate"></div>
                            <i class="my-auto fas fa-envelope"></i>
                            <label for="email" class="mb-0 h5">Email <span class="text-danger">*</span></label>
                            <i id="emailInfo" class="p-0 d-flex align-items-center btn cursor-pointer fas fa-info-circle" title="L'email doit être unique."></i>
                        </div>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Entrez votre email" value="<?= $email ?? '' ?>" required autocomplete="email">
                            <?php if(!empty($errors['email'])): ?>
                            <div id="emailAlertBox" class="mt-2">
                                <?php foreach($errors['email'] as $error): ?>
                                <div id="<?= $error['alert_id'] ?>" class="mb-1 py-1 gap-2 alert alert-danger d-flex justify-content-between">
                                    <p class="m-1"><span class="fw-bold">Attention : </span><?= $error['message'] ?></p>
                                    <button id="<?= $error['alert_id'] ?>Close" class="p-2 btn-close cursor-pointer"></button>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </div>

                        <hr class="my-2">

                        <!-- MOT DE PASSE -->
                        <div id="passwordBox">
                            <div class="d-flex justify-content-between">
                                <div class="mb-2 d-flex gap-2">
                                    <div class="px-3 py-0 mb-0 alert alert-light" id="passwordSate"></div>
                                    <i class="my-auto fas fa-lock"></i>
                                    <label for="password" class="mb-0 h5">Mot de passe</label>
                                    <i id="passwordInfo" class="p-0 d-flex align-items-center btn cursor-pointer fas fa-info-circle" title="Le mot de passe doit comporter entre 8 et 40 caractères et contenir au minimum : une minuscule, une majuscule, un chiffre et un caractère spécial ( # , ? , ! , @ , $ , % , ^ , & , * , - )."></i>
                                </div>
                                <p class="mb-2 alert alert-light py-0" id="passwordLength">0/40</p>
                            </div>
                            <div class="input-group mb-1">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Entrez votre mot de passe" minlength="8" maxlength="40"  required>
                                <span class="p-0 input-group-text">
                                    <i id="passwordVisibility" class="btn cursor-pointer fas fa-eye"></i>
                                </span>
                            </div>
                            <p class="mb-0 small">Force du mot de passe : <span id="passwordStrengthLabel" class="fw-bold"></span></p>
                            <div class="progress">
                                <div id="passwordStrength" class="progress-bar bg-danger" style="width: 0%;"></div>
                            </div>
                            <?php if(!empty($errors['password'])): ?>
                            <div id="passwordAlertBox" class="mt-2">
                                <?php foreach($errors['password'] as $error): ?>
                                <div id="<?= $error['alert_id'] ?>" class="mb-1 py-1 gap-2 alert alert-danger d-flex justify-content-between">
                                    <p class="m-1"><span class="fw-bold">Attention : </span><?= $error['message'] ?></p>
                                    <button id="<?= $error['alert_id'] ?>Close" class="p-2 btn-close cursor-pointer"></button>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </div>

                        <hr class="my-2">

                        <!-- CODE POSTAL -->
                        <div id="addressBox">
                            <div class="mb-2 d-flex gap-2">
                                <div class="px-3 py-0 mb-0 alert alert-light" id="addressSate"></div>
                                <i class="my-auto fas fa-map-marker-alt"></i>
                                <label for="address" class="mb-0 h5">Code postal</label>
                                <i id="addressInfo" class="p-0 d-flex align-items-center btn cursor-pointer fas fa-info-circle" title="Ce champ est optionnel et sert à établir des statistiques."></i>
                            </div>
                            <input type="number" class="form-control" name="address" id="address" placeholder="Entrez votre code postal." value="<?= $address ?? '' ?>" min="0" minlength="5" maxlength="5" autocomplete="postal-code">
                            <?php if(!empty($errors['address'])): ?>
                            <div id="addressAlertBox" class="mt-2">
                                <?php foreach($errors['address'] as $error): ?>
                                <div id="<?= $error['alert_id'] ?>" class="mb-1 py-1 gap-2 alert alert-danger d-flex justify-content-between">
                                    <p class="m-1"><span class="fw-bold">Attention : </span><?= $error['message'] ?></p>
                                    <button id="<?= $error['alert_id'] ?>Close" class="p-2 btn-close cursor-pointer"></button>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </div>

                        <hr class="my-2">

                        <!-- GENRE -->
                        <div id="genderBox">
                            <div class="mb-2 d-flex gap-2">
                                <div class="px-3 py-0 mb-0 alert alert-light" id="genderSate"></div>
                                <i class="my-auto fas fa-venus-mars"></i>
                                <p class="mb-0 h5">Genre</p>
                                <i id="genderInfo" class="p-0 d-flex align-items-center btn cursor-pointer fas fa-info-circle" title="Ce champ est optionnel et sert à établir des statistiques."></i>
                            </div>
                            <div class="input-group mb-2">
                                <div class="gap-4 form-control d-flex">
                                    <div class="mb-0 form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="genderMan" value="1" <?php if(!empty($_POST['gender'])){if($_POST['gender'] == '1'){echo 'checked';}} ?>>
                                        <label class="form-check-label" for="genderMan">
                                            Homme
                                        </label>
                                    </div>
                                    <div class="mb-0 form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="genderWoman" value="2" <?php if(!empty($_POST['gender'])){if($_POST['gender'] == '2'){echo 'checked';}} ?>>
                                        <label class="form-check-label" for="genderWoman">
                                            Femme
                                        </label>
                                    </div>
                                </div>
                                <span class="p-0 input-group-text">
                                    <i id="resetGender" class="px-3 py-2 btn btn-close cursor-pointer"></i>
                                </span>
                            </div>
                            <?php if(!empty($errors['gender'])): ?>
                            <div id="genderAlertBox" class="mt-2">
                                <?php foreach($errors['gender'] as $error): ?>
                                <div id="<?= $error['alert_id'] ?>" class="mb-1 py-1 gap-2 alert alert-danger d-flex justify-content-between">
                                    <p class="m-1"><span class="fw-bold">Attention : </span><?= $error['message'] ?></p>
                                    <button id="<?= $error['alert_id'] ?>Close" class="p-2 btn-close cursor-pointer"></button>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </div>

                        <hr class="my-2">

                        <!-- DATE DE NAISSANCE -->
                        <div id="birthBox">
                            <div class="mb-2 d-flex gap-2">
                                <div class="px-3 py-0 mb-0 alert alert-light" id="birthSate"></div>
                                <i class="my-auto fas fa-calendar-alt"></i>
                                <label for="birth" class="mb-0 h5">Date de naissance</label>
                                <i id="birthInfo" class="p-0 d-flex align-items-center btn cursor-pointer fas fa-info-circle" title="Ce champ est optionnel et sert à établir des statistiques."></i>
                            </div>
                            <input type="date" class="form-control" name="birth" id="birth" max="<?= date("Y-m-d") ?>" value="<?= $birth ?? '' ?>" autocomplete="birthdate">
                            <?php if(!empty($errors['birth'])): ?>
                            <div id="birthAlertBox" class="mt-2">
                                <?php foreach($errors['birth'] as $error): ?>
                                <div id="<?= $error['alert_id'] ?>" class="mb-1 py-1 gap-2 alert alert-danger d-flex justify-content-between">
                                    <p class="m-1"><span class="fw-bold">Attention : </span><?= $error['message'] ?></p>
                                    <button id="<?= $error['alert_id'] ?>Close" class="p-2 btn-close cursor-pointer"></button>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </div>

                        <hr class="my-2">

                        <!-- CONDITIONS GÉNÉRALES D'UTILISATION -->
                        <div id="CGUBox">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="CGU" id="CGU" required>
                                <label class="form-check-label" for="CGU">
                                    J'accèpte les <a href="#" class="link-dark">conditions générales d'utilisation</a>. <span class="text-danger">*</span>
                                </label>
                            </div>
                            <?php if(!empty($errors['CGU'])): ?>
                            <div id="CGUAlertBox" class="mt-2">
                                <?php foreach($errors['CGU'] as $error): ?>
                                <div id="<?= $error['alert_id'] ?>" class="mb-1 py-1 gap-2 alert alert-danger d-flex justify-content-between">
                                    <p class="m-1"><span class="fw-bold">Attention : </span><?= $error['message'] ?></p>
                                    <button id="<?= $error['alert_id'] ?>Close" class="p-2 btn-close cursor-pointer"></button>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- CHAMPS OBLIGATOIRES -->
                        <p class="small mb-0">Les champs marqués d'un <span class="text-danger">*</span> sont obligatoires.</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between gap-3">

                        <!-- INPUT INVISIBLE (pour l'envoi en JS) -->
                        <input type="hidden" name="hidden_submit" required>

                        <!-- LIEN PAGE CONNEXION -->
                        <a href="?page=connexion" class="btn btn-secondary w-100">
                            <i class="fas fa-sign-in-alt"></i> Déjà un compte ?
                        </a>

                        <!-- BOUTON ENVOYER -->
                        <button type="submit" class="btn btn-success w-100" name="form_submit" id="formSubmit">
                            <i class="fas fa-user-plus"></i> S'inscrire
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/registration.js"></script>
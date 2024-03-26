<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<div class="row justify-content-center">
    <div class="col-lg-6" id="registrationBox">
        <!-- <p class="alert <?php if(!empty($_SESSION['name'])){echo 'alert-success';} else {echo 'alert-light';} ?> text-center" id="formAlert"><?php if(!empty($_SESSION['name'])){echo 'Inscription de \'' . $_SESSION['name'] . '\' réalisé avec succés.';} else {echo 'Merci de remplir ce formulaire d\'inscription.';} ?></p> -->
        <div class="card">
            <div class="card-header">
                <h1 class="mb-0 text-center">Inscription</h1>
            </div>
            <form action="../src/scripts/add-user.php" method="POST" id="form" name="form">
                <div class="card-body">
                    <div class="mb-3" id="pseudoBox">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex gap-2">
                                <div class="mb-2 px-3 py-0 alert alert-light rounded" id="pseudoSate"></div>
                                <label for="pseudo" class="form-label">Pseudo <span class="text-danger">*</span></label>
                                <i id="pseudoInfo" class="d-flex align-items-center mb-2 fas fa-info-circle" title="Le pseudo doit être unique et comporter entre 3 et 20 caractères alphanumérique, sans espace (le seul caractère spécial autorisé est le (_))."></i>
                            </div>
                            <p class="mb-2 py-0 alert alert-light" id="pseudoLength">0/20</p>
                        </div>
                        <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Entrez votre pseudo" minlength="3" maxlength="20" required autocomplete="username">
                    </div>
                    <div class="mb-3" id="emailBox">
                        <div class="d-flex gap-2">
                            <div class="alert alert-light px-3 py-0 mb-2" id="emailSate"></div>
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <i id="emailInfo" class="d-flex align-items-center mb-2 fas fa-info-circle" title="L'email doit être unique."></i>
                        </div>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Entrez votre email"  required autocomplete="email">
                    </div>
                    <div class="mb-3"  id="passwordBox">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex gap-2">
                                <div class="alert alert-light px-3 py-0 mb-2" id="passwordSate"></div>
                                <label for="password" class="form-label">Mot de passe <span class="text-danger">*</span></label>
                                <i id="passwordInfo" class="d-flex align-items-center mb-2 fas fa-info-circle" title="Le mot de passe doit comporter entre 8 et 40 caractères et contenir au minimum : une minuscule, une majuscule, un chiffre et un caractère spécial (#,?,!,@,$,%,^,&,*,-)."></i>
                            </div>
                            <p class="mb-2 alert alert-light py-0" id="passwordLength">0/40</p>
                        </div>
                        <div class="input-group mb-2">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Entrez votre mot de passe" minlength="8" maxlength="40"  required>
                            <span class="p-0 input-group-text">
                                <i id="passwordVisibility" class="btn cursor-pointer fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    <div class="mb-3"  id="zipCodeBox">
                        <div class="d-flex gap-2">
                            <div class="alert alert-light px-3 py-0 mb-2" id="zipCodeSate"></div>
                            <label for="zipCode" class="form-label">Code postal</label>
                            <i id="zipCodeInfo" class="d-flex align-items-center mb-2 fas fa-info-circle" title="Ce champ est optionnel et sert à établir des statistiques."></i>
                        </div>
                        <input type="number" class="form-control" name="zip_code" id="zipCode" placeholder="Entrez votre code postal." min="0" minlength="5" maxlength="5" autocomplete="postal-code">
                    </div>
                    <div class="mb-3"  id="genderBox">
                        <div class="d-flex gap-2">
                            <div class="alert alert-light px-3 py-0 mb-2" id="genderSate"></div>
                            <p class="form-label">Genre</p>
                            <i id="genderInfo" class="d-flex align-items-center mb-2 fas fa-info-circle" title="Ce champ est optionnel et sert à établir des statistiques."></i>
                        </div>
                        <div class="input-group mb-2">
                            <div class="gap-4 form-control d-flex">
                                <div class="mb-0 form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="genderMan">
                                    <label class="form-check-label" for="genderMan">
                                        Homme
                                    </label>
                                </div>
                                <div class="mb-0 form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="genderWoman">
                                    <label class="form-check-label" for="genderWoman">
                                        Femme
                                    </label>
                                </div>
                                <div class="mb-0 form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="genderOther">
                                    <label class="form-check-label" for="genderOther">
                                        Autre
                                    </label>
                                </div>
                            </div>
                            <span class="p-0 input-group-text">
                                <i id="resetGender" class="px-3 py-2 btn btn-close cursor-pointer"></i>
                            </span>
                        </div>
                    </div>
                    <div class="mb-3"  id="birthBox">
                        <div class="d-flex gap-2">
                            <div class="alert alert-light px-3 py-0 mb-2" id="birthSate"></div>
                            <label for="birth" class="form-label">Date de naissance</label>
                            <i id="birthInfo" class="d-flex align-items-center mb-2 fas fa-info-circle" title="Ce champ est optionnel et sert à établir des statistiques."></i>
                        </div>
                        <input type="date" class="form-control" name="birth" id="birth" max="<?= date("Y-m-d") ?>">
                    </div>
                    <div class="mb-3"  id="CGTBox">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="CGT" required>
                            <label class="form-check-label" for="CGT">
                                J'accèpte les <a href="#">conditions générales d'utilisation</a>. <span class="text-danger">*</span>
                            </label>
                        </div>
                    </div>
                    <p class="form-label mb-0">Les champs marqué d'un <span class="text-danger">*</span> sont obligatoires.</p>
                </div>
                <div class="card-footer d-flex justify-content-between gap-3">
                    <input type="hidden" name="hidden_submit"  required>
                    <a href="?page=connexion" target="_blank" class="btn btn-secondary w-100">Déjà un compte ?</a>
                    <button type="submit" class="btn btn-primary w-100" name="form_submit" id="formSubmit">S'inscrire</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="assets/js/registration-control.js"></script>
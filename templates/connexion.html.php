<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6" id="connectionBox">
            <div class="card">
                <div class="gap-2 card-header d-flex justify-content-center">
                    <i class="d-flex align-items-center fas fa-sign-in-alt fa-icon-large"></i>
                    <h1 class="mb-0 h2 text-center">Connexion</h1>
                </div>
                <form action="/?page=connexion" method="POST" id="form" name="form">
                    <div class="card-body">

                        <!-- PSEUDO -->
                        <div id="loginBox">
                            <div class="mb-2 gap-2 d-flex">
                                <i class="my-auto fas fa-user"></i>
                                <label for="login" class="mb-0 h5">Identifiant</label>
                            </div>
                            <input type="text" class="form-control" name="login" id="login" placeholder="Entrez votre email ou pseudo" value="<?= $login ?? '' ?>" required autocomplete="email">
                        </div>

                        <hr class="my-2">

                        <!-- MOT DE PASSE -->
                        <div id="passwordBox">
                            <div class="mb-2 gap-2 d-flex">
                                <i class="my-auto fas fa-lock"></i>
                                <label for="password" class="mb-0 h5">Mot de passe</label>
                            </div>
                            <div class="input-group mb-1">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Entrez votre mot de passe" required>
                                <span class="p-0 input-group-text">
                                    <i id="passwordVisibility" class="btn cursor-pointer fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between gap-3">

                        <!-- LIEN PAGE CONNEXION -->
                        <a href="?page=inscription" class="btn btn-secondary w-100">
                            <i class="fas fa-user-plus"></i> Créer un compte
                        </a>

                        <!-- BOUTON ENVOYER -->
                        <button type="submit" class="btn btn-success w-100" name="form_submit" id="formSubmit">
                            <i class="fas fa-sign-in-alt"></i> Se connecter
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

<script src="assets/js/connection.js"></script>
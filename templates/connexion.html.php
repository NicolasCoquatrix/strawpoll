<div class="row justify-content-center">
    <div class="col-lg-6" id="connectionBox">
        <div class="card">
            <div class="card-header">
                <h1 class="mb-0 text-center">Connexion</h1>
            </div>
            <form action="/?page=connexion" method="POST" id="form" name="form">
                <div class="card-body">

                    <!-- PSEUDO -->
                    <div class="mb-3" id="pseudoBox">
                        <label for="pseudo" class="form-label">Pseudo</label>
                        <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Entrez votre pseudo" value="<?= $customer['customer_pseudo'] ?? '' ?>" required autocomplete="username">
                    </div>

                    <!-- MOT DE PASSE -->
                    <div class="mb-3"  id="passwordBox">
                        <label for="password" class="form-label">Mot de passe</label>
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
                    <a href="?page=inscription" class="btn btn-secondary w-100">Créer un compte</a>

                    <!-- BOUTON ENVOYER -->
                    <button type="submit" class="btn btn-primary w-100" name="form_submit" id="formSubmit">Se connecter</button>
                </div>
            </form>
        </div>
        <?php if(isset($connectionFailed)): ?>
            <div id="connectionAlertBox" class="mt-2">
                <div id="connectionFailedAlert" class="mb-1 py-1 gap-2 alert alert-danger d-flex justify-content-between">
                    <p class="m-1"><span class="fw-bold">Connexion impossible : </span>Adresse mail ou mot de passe incorrect.</p>
                    <button id="connectionFailedAlertClose" class="p-2 btn-close cursor-pointer"></button>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script src="assets/js/connection-control.js"></script>
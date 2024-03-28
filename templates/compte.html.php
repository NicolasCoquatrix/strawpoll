<div class="container py-4">
    <div class="row justify-content-center">
        <div class="mb-4" id="infosBox">
            <div class="card bg-dark">
                <a href="/" class="gap-2 card-body d-flex justify-content-center text-decoration-none">
                    <i class="d-flex align-items-center fas fa-user fa-icon-large text-light"></i>
                    <p class="mb-0 h3 text-light">Voir mon profil public</p>
                </a>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">

        <!-- GAUCHE -->
        <div class="mb-4 col-lg-6" id="infosBox">

            <!-- SECTION GRADE -->
            <div class="card">
                <div class="gap-2 card-header d-flex justify-content-center">
                    <i class="d-flex align-items-center fas fa-user-cog fa-icon-large"></i>
                    <h2 class="mb-0 h3">Informations personelles</h2>
                </div>
                <div class="card-body">

                    <!-- Pseudo -->
                    <div id="pseudoBox">
                        <div class="mb-2 gap-2 d-flex">
                            <i class="my-auto fas fa-user-cog"></i>
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
                        <i class="fas fa-edit"></i> Modifier mes inforations
                    </button>
                </div>
            </div>
        </div>

        <!-- DROITE -->
        <div class="mb-4 col-lg-6" id="passwordBox">

            <!-- SECTION MOT DE PASSE -->
            <div class="mb-4 card">
                <div class="gap-2 card-header d-flex justify-content-center">
                    <i class="d-flex align-items-center fas fa-lock fa-icon-large"></i>
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

            <!-- SECTION GRADE -->
            <div class="mb-4 card">
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
                    <button type="button" class="btn btn-primary w-100" id="upgradeGrade">
                        <i class="fas fa-arrow-up"></i> Demander une promotion
                    </button>
                </div>
                <?php endif; ?>
            </div>

            <!-- SECTION DÉCONNEXION -->

            <a href='script.php?script=disconnection.php' class="btn btn-danger w-100" id="disconnection">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </a>

        </div>

    </div>
</div>

<script src="assets/js/account.js"></script>
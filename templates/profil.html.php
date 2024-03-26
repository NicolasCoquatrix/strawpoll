<div class="row justify-content-center">
    <div class="col-lg-6" id="profilBox">
        <div class="card">
            <div class="card-header">
                <h1 class="mb-0 text-center">Profil</h1>
            </div>
            <div class="card-body">

                <!-- PSEUDO -->
                <div class="mb-3" id="pseudoBox">
                    <h2 class="h4">Pseudo</h2>
                    <p class="mb-0"><?= $customer['customer_pseudo'] ?></p>
                </div>

                <!-- EMAIL -->
                <div class="mb-3" id="emailBox">
                    <h2 class="h4">Email</h2>
                    <p class="mb-0"><?= $customer['customer_email'] ?></p>
                </div>

                <!-- CODE POSTAL -->
                <div class="mb-3" id="addressBox">
                    <h2 class="h4">Code Postal</h2>
                    <p class="mb-0"><?= $customer['customer_address'] ?></p>
                </div>

                <!-- GENRE -->
                <div class="mb-3" id="genderBox">
                    <h2 class="h4">Genre</h2>
                    <p class="mb-0"><?= $customer['customer_gender'] ?></p>
                </div>

                <!-- DATE DE NAISSANCE -->
                <div class="mb-3" id="birthBox">
                    <h2 class="h4">Date de naissance</h2>
                    <p class="mb-0"><?= $customer['customer_birth'] ?></p>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between gap-3">

                <!-- DÉCONNEXION -->
                <a href="script.php?script=disconnection.php" class="btn btn-danger w-100">Déconnexion</a>
            </div>
        </div>
    </div>
</div>
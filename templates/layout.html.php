<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strawpoll | <?= $title ?? '' ?></title>
    <meta name="description" content="<?= $description ?? '' ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="d-flex flex-column">
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="p-0 gap-2 navbar-brand d-flex align-items-center" href="/">
                    <img src="assets/img/logo_100x100.webp" alt="logo" class="img-logo">
                    <p class="mb-0">Strawpoll</p>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav d-flex justify-content-between w-100">
                            <div class="navbar-nav">
                                <a class="nav-link <?php if($page == 'index'){echo 'active';} ?>" href="/">Accueil</a>
                                <a class="nav-link <?php if($page == 'profil'){echo 'active';} ?>" href="/">Mon profil</a>
                                <a class="nav-link <?php if($page == 'creer-formulaire'){echo 'active';} ?>" href="/">Créer un formulaire</a>
                            </div>
                            <div class="navbar-nav">
                                <a class="btn btn-primary" href="/?page=<?= !empty($_SESSION['customer_id']) ? 'compte' : 'connexion' ?>">
                                <?php if(!empty($_SESSION['customer_id'])): ?>
                                    <i class="fas fa-user-cog"></i> <?= $_SESSION['customer_pseudo'] ?>
                                <?php else: ?>
                                    <i class="fas fa-sign-in-alt"></i> Connexion
                                <?php endif; ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <hr class="m-0">
    </header>
    <main>
        <?php require "$page.html.php"; ?>
    </main>
    <footer class="footer mt-auto bg-dark py-4">
        <div class="container text-center">
            <p class="text-white mb-0">© <?php echo date("Y"); ?> <a href="https://github.com/NicolasCoquatrix" target="_blank" class="link-light">Nicolas Coquatrix</a> - Tous droits réservés.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
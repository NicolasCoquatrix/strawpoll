<?php 

date_default_timezone_set('Europe/Paris');

$title = 'Inscription';
$description = 'Page d\'inscription de Strapall.';

if(!empty($_SESSION['customer_id'])){
    header('Location: /?page=compte');
}

if(isset($_POST['hidden_submit'])){
    $errors = [];

    // PSEUDO
    if(!empty($_POST['pseudo'])){
        $pseudo = $_POST['pseudo'];

        // Teste si le pseudo est libre
        $query = $dbh->prepare('SELECT customer_pseudo FROM customer WHERE LOWER(customer_pseudo) = LOWER(:customer_pseudo);');
        $query->execute(['customer_pseudo' => $pseudo]);
        $customer_pseudo = $query->fetch();

        if($customer_pseudo){
            // Erreur : Pseudo existant
            $errors['pseudo']['pseudo_existing'] = ['alert_id' => 'pseudoExistingAlert', 'message' => 'Ce pseudo est déjà utilisé.'];
        }

        // Teste si la taille du pseudo est entre 3 et 20 caractères
        if(strlen($pseudo) < 3 || strlen($pseudo) > 20){
            // Erreur : Taille du pseudo incorrect
            $errors['pseudo']['pseudo_length'] = ['alert_id' => 'pseudoLengthAlert', 'message' => 'Le pseudo doit comporter entre 3 et 20 caractères.'];
        }

        // Test si le pseudo comporte que des lettres, des chiffres ou le caractère spécial ( _ ).",
        if(!preg_match('/^[a-zA-Z0-9_]/', $pseudo)){
            // Erreur : Format du pseudo incorrect
            $errors['pseudo']['pseudo_format'] = ['alert_id' => 'pseudoFormatAlert', 'message' => 'Le pseudo ne peux comporter que des lettres, des chiffres et le caractère spécial ( _ ).'];
        }
    } else {
        // Erreur : Champ pseudo vide
        $errors['pseudo']['pseudo_obligatory'] = ['alert_id' => 'pseudoObligatoryAlert', 'message' => 'Le champ pseudo est obligatoire.'];
    }

    // EMAIL
    if(!empty($_POST['email'])){
        $email = strtolower($_POST['email']);

        // Teste si l'email est libre
        $query = $dbh->prepare('SELECT customer_email FROM customer WHERE customer_email = :customer_email;');
        $query->execute(['customer_email' => $email]);
        $customer_email = $query->fetch();

        if($customer_email){
            // Erreur : Email existant
            $errors['email']['email_existing'] = ['alert_id' => 'emailExistingAlert', 'message' => 'Cet email est déjà utilisé.'];
        }

        // Teste si le format du mail est valide
        if(!preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))/i', $email)){
            // Erreur : Format de l'email incorrect
            $errors['email']['email_format'] = ['alert_id' => 'emailFormatAlert', 'message' => 'Le format de l\'adresse mail est invalide.'];
        }
    } else {
        // Erreur : Champ email vide
        $errors['email']['email_obligatory'] = ['alert_id' => 'emailObligatoryAlert', 'message' => 'Le champ email est obligatoire.'];
    }

    // MOT DE PASSE
    if(!empty($_POST['password'])){
        $password = $_POST['password'];

        // Teste si la taille du mot de passe est entre 8 et 40 caractères
        if(strlen($password) < 8 || strlen($password) > 40){
            // Erreur : Taille du mot de passe incorrect
            $errors['password']['password_length'] = ['alert_id' => 'passwordLengthAlert', 'message' => 'Le mot de passe doit comporter entre 8 et 40 caractères.'];
        }

        // Test si le mot de passe contenient au minimum : une minuscule, une majuscule, un chiffre et un caractère spécial ( # , ? , ! , @ , $ , % , ^ , & , * , - ).",
        if(!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-])/', $password)){
            // Erreur : Format de l'email incorrect
            $errors['password']['password_format'] = ['alert_id' => 'passwordFormatAlert', 'message' => 'Le mot de passe doit contenir au minimum : une minuscule, une majuscule, un chiffre et un caractère spécial ( # , ? , ! , @ , $ , % , ^ , & , * , - ).'];
        }
    } else {
        // Erreur : Champ mot de passe vide
        $errors['password']['password_obligatory'] = ['alert_id' => 'passwordObligatoryAlert', 'message' => 'Le champ mot de passe est obligatoire.'];
    }

    // CODE POSTAL /^\d{5}$/
    if(!empty($_POST['address'])){
        $address = $_POST['address'];

        // Teste si le code postal contient 5 chiffres
        if(!preg_match('/^\d{5}$/', $address)){
            // Erreur : Format du code postal incorrect
            $errors['address']['address_format'] = ['alert_id' => 'addressFormatAlert', 'message' => 'Le code postal doit comporter 5 chiffres..'];
        }
    } else {
        $address = null;
    }

    // GENRE
    if(!empty($_POST['gender'])){
        $gender = $_POST['gender'];

        // Teste si le genre est 1 (Homme) ou 2 (Femme)
        if($gender != 1 && $gender != 2){
            // Erreur : Genre inconnu
            $errors['gender']['gender_existing'] = ['alert_id' => 'genderExistingAlert', 'message' => 'Le genre sélecionné n\'existe pas.'];
        }
    } else {
        $gender = null;
    }

    // DATE DE NAISSANCE
    if(!empty($_POST['birth'])){
        $birth = $_POST['birth'];

        // Teste si le format de la date est valide
        if(!preg_match('/^\d{4}-\d{2}-\d{2}$/', $birth)){
            // Erreur : Format de la date de naissance incorrect
            $errors['birth']['birth_format'] = ['alert_id' => 'birthFormatAlert', 'message' => 'Le format de la date est incorrect.'];
        }

        // Teste si la date existe
        $birthDate = date("Y-m-d", strtotime($birth));

        if($birth != $birthDate){
            // Erreur : La date n'existe pas
            $errors['birth']['birth_date'] = ['alert_id' => 'birthDateAlert', 'message' => 'Cette date n\'existe pas.'];
        } else {
            $currentDate = date('Y-m-d');

            // Teste si la date n'est pas dans le futur
            if($birthDate > $currentDate){

                // Erreur : La date est dans le futur
                $errors['birth']['birth_future'] = ['alert_id' => 'birthFutureAlert', 'message' => 'Vous ne pouvez pas être né dans le futur.'];
            } else {

                // Teste si la date est il y a moins de 122 ans
                $birthDay = intval(date("d", strtotime($birth)));
                $birthMonth = intval(date("m", strtotime($birth)));
                $birthYear = intval(date("Y", strtotime($birth)));

                $currentDay = intval(date('d'));
                $currentMonth = intval(date('m'));
                $currentYear = intval(date('Y'));

                $age = $currentYear - $birthYear;
                if ($currentMonth < $birthMonth || $currentMonth == $birthMonth && $currentDay < $birthDay){
                    $age--;
                }

                // Erreur : Plus de 122 ans
                if ($age > 122) {
                    $errors['birth']['birth_max_date'] = ['alert_id' => 'birthMaxDateAlert', 'message' => "Vous avez $age ans ... Félicitations, vous avez battu le record de longévité humaine qui était de 122 ans ! Malheureusement, vous ne pouvez pas vous inscrire avant d'avoir inscrit votre nom dans le Guinness Book."];
                }
            }
        }
    } else {
        $birth = null;
    }

    // CONDITIONS GÉNÉRALES D'UTILISATION
    if(empty($_POST['CGU']) || $_POST['CGU'] != 'on'){
        // Erreur : Le champ CGU n'est pas coché
        $errors['CGU']['CGU_obligatory'] = ['alert_id' => 'CGUObligatoryAlert', 'message' => 'Vous devez avoir lu et accepté les conditions générales d\'utilisation pour pouvoir vous inscrire.'];
    }

    if(empty($errors)){
        $query = $dbh->prepare("INSERT INTO customer (customer_pseudo, customer_email, customer_password, customer_gender, customer_birth, customer_address, grade_id) VALUES (:customer_pseudo, :customer_email, :customer_password, :customer_gender, :customer_birth, :customer_address, '3')");
        $query->execute([
            'customer_pseudo' => $pseudo,
            'customer_email' => $email,
            'customer_password' => password_hash($password, PASSWORD_DEFAULT),
            'customer_gender' => $gender,
            'customer_birth' => $birth,
            'customer_address' => $address,
        ]);

        $_SESSION['customer_id'] = $dbh->lastInsertId();
        $_SESSION['customer_pseudo'] = $pseudo;
        $_SESSION['customer_grade'] = '3';
        header('Location: /');
            }
}
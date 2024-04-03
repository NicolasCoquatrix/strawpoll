<?php 
if(!empty($_SESSION['customer_id'])){
    date_default_timezone_set('Europe/Paris');

    $title = 'Mon compte';

    // RECUPERATION DES INFORMATIONS DE L'UTILISATEUR
    $query = $dbh->prepare('SELECT * FROM customer WHERE customer_id = :customer_id;');
    $query->execute(['customer_id' => $_SESSION['customer_id']]);
    $customer = $query->fetch();

    if ($customer) {
        if($customer['customer_gender'] != null){
            if($customer['customer_gender'] == '1'){
                $customer['customer_gender_formatted'] = 'Homme';
            } else if($customer['customer_gender'] == '2') {
                $customer['customer_gender_formatted'] = 'Femme';
            }
        }

        if($customer['customer_birth'] != null){
            $customer['customer_birth_formatted'] = date('d/m/Y', strtotime($customer['customer_birth']));
        }

        if($customer['grade_id'] != null){
            if($customer['grade_id'] == '1'){
                $customer['customer_grade_formatted'] = 'Administrateur';
            } else if($customer['grade_id'] == '2') {
                $customer['customer_grade_formatted'] = 'Enquêteur';
            } else if($customer['grade_id'] == '3') {
                $customer['customer_grade_formatted'] = 'Participant';
            }
        }
    }

    // TRAITEMENT DU FORMULAIRE "INFORMATIONS PERSONNELLES"
    if(isset($_POST['infos_hidden_submit'])){

        $errors = 0;

        // PSEUDO
        if(!empty($_POST['pseudo'])){
            $pseudo = $_POST['pseudo'];

            if($pseudo != $customer['customer_pseudo']){

                // Teste si le pseudo est libre
                $query = $dbh->prepare('SELECT customer_pseudo FROM customer WHERE LOWER(customer_pseudo) = LOWER(:customer_pseudo);');
                $query->execute(['customer_pseudo' => $pseudo]);
                $customer_pseudo = $query->fetch();

                if($customer_pseudo){
                    // Erreur : Pseudo existant
                    $errors++;
                }

                // Teste si la taille du pseudo est entre 3 et 20 caractères
                if(strlen($pseudo) < 3 || strlen($pseudo) > 20){
                    // Erreur : Taille du pseudo incorrect
                    $errors++;
                }

                // Test si le pseudo comporte que des lettres, des chiffres ou le caractère spécial ( _ ).",
                if(!preg_match('/^[a-zA-Z0-9_]/', $pseudo)){
                    // Erreur : Format du pseudo incorrect
                    $errors++;
                }
            }
        } else {
            // Erreur : Champ pseudo vide
            $errors++;
        }

        // EMAIL
        if(!empty($_POST['email'])){
            $email = strtolower($_POST['email']);

            if($email != $customer['customer_email']){

                // Teste si l'email est libre
                $query = $dbh->prepare('SELECT customer_email FROM customer WHERE customer_email = :customer_email;');
                $query->execute(['customer_email' => $email]);
                $customer_email = $query->fetch();

                if($customer_email){
                    // Erreur : Email existant
                    $errors++;
                }

                // Teste si le format du mail est valide
                if(!preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))+$/i', $email)){
                    // Erreur : Format de l'email incorrect
                    $errors++;
                }
            }
        } else {
            // Erreur : Champ email vide
            $errors++;
        }


        // CODE POSTAL
        if(!empty($_POST['address'])){
            $address = $_POST['address'];

            if($address != $customer['customer_address']){

                // Teste si le code postal contient 5 chiffres
                if(!preg_match('/^\d{5}$/', $address)){
                    // Erreur : Format du code postal incorrect
                    $errors++;
                }
            }
        } else {
            $address = null;
        }

        // GENRE
        if(!empty($_POST['gender'])){
            $gender = $_POST['gender'];

            if($gender != $customer['customer_gender']){

                // Teste si le genre est 1 (Homme) ou 2 (Femme)
                if($gender != 1 && $gender != 2){
                    // Erreur : Genre inconnu
                    $errors++;
                }
            }
        } else {
            $gender = null;
        }

        // DATE DE NAISSANCE
        if(!empty($_POST['birth'])){
            $birth = $_POST['birth'];

            if($birth != $customer['customer_birth']){

                // Teste si le format de la date est valide
                if(!preg_match('/^\d{4}-\d{2}-\d{2}$/', $birth)){
                    // Erreur : Format de la date de naissance incorrect
                    $errors++;
                }

                // Teste si la date existe
                $birthDate = date("Y-m-d", strtotime($birth));

                if($birth != $birthDate){
                    // Erreur : La date n'existe pas
                    $errors++;
                } else {
                    $currentDate = date('Y-m-d');

                    // Teste si la date n'est pas dans le futur
                    if($birthDate > $currentDate){

                        // Erreur : La date est dans le futur
                        $errors++;
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
                            $errors++;
                        }
                    }
                }
            }
        } else {
            $birth = null;
        }

        if($errors == 0){
            $query = $dbh->prepare("UPDATE customer SET customer_pseudo = :customer_pseudo, customer_email = :customer_email, customer_gender = :customer_gender, customer_birth = :customer_birth, customer_address = :customer_address WHERE customer_id = :customer_id");
            $query->execute([
                'customer_pseudo' => $pseudo,
                'customer_email' => $email,
                'customer_gender' => $gender,
                'customer_birth' => $birth,
                'customer_address' => $address,
                'customer_id' => $customer['customer_id'],
            ]);

            $_SESSION['infosModified'] = true;
            $_SESSION['customer_pseudo'] = $pseudo;
            header('Location: /?page=compte');
            exit;
        } else {
            $infosFailed = true;
        }
    }

    // TRAITEMENT DU FORMULAIRE "MOT DE PASSE"
    if(isset($_POST['password_hidden_submit'])){

        $errors = 0;

        // ANCIEN MOT DE PASSE
        if (!empty($_POST['oldPassword'])){
            $oldPassword = $_POST['oldPassword'];

            // Teste si l'ancien mot de passe est correct
            if(!password_verify($oldPassword, $customer['customer_password'])){
                // Erreur : Ancien mot de passe incorect
                $errors++;
            }
        } else {
            // Erreur : Champ mot de passe vide
            $errors++;
        }

        // NOUVEAU MOT DE PASSE
        if(!empty($_POST['newPassword'])){
            $newPassword = $_POST['newPassword'];

            // Teste si la taille du mot de passe est entre 8 et 40 caractères
            if(strlen($newPassword) < 8 || strlen($newPassword) > 40){
                // Erreur : Taille du mot de passe incorrect
                $errors++;
            }

            // Test si le mot de passe contenient au minimum : une minuscule, une majuscule, un chiffre et un caractère spécial ( # , ? , ! , @ , $ , % , ^ , & , * , - ).",
            if(!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-])/', $newPassword)){
                // Erreur : Format de l'email incorrect
                $errors++;
            }
        } else {
            // Erreur : Champ mot de passe vide
            $errors++;
        }

        if($errors == 0){
            $query = $dbh->prepare("UPDATE customer SET customer_password = :customer_password WHERE customer_id = :customer_id");
            $query->execute([
                'customer_password' => password_hash($newPassword, PASSWORD_DEFAULT),
                'customer_id' => $customer['customer_id']
            ]);

            $_SESSION['passwordModified'] = true;
            header('Location: /?page=compte');
            exit;
        } else {
            $passwordFailed = true;
        }
    }
} else {
    header('Location: /');
    exit;
}
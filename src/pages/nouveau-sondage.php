<?php 

if(!empty($_SESSION['customer_id'])){

    $title = 'Nouveau sondage';
    $description = 'Créez simplement un sondage avec Strawpoll.';

    if(isset($_POST['hidden_submit'])){

        $errors = 0;

        // NOM DU SONDAGE
        if(!empty($_POST['pollName'])){
            $pollName = $_POST['pollName'];

            // Teste si la taille du nom du sondage est entre 2 et 100 caractères
            if(strlen($pollName) < 2 || strlen($pollName) > 100){
                // Erreur : Taille du nom du sondage incorrect
                $errors['poll']['poll_length'] = ['alert_id' => 'pollNameLengthAlert', 'message' => "Le nom du sondage doit comporter entre 2 et 100 caractères (Nombre de caractères actuel : strlen($pollName))."];
            }
        } else {
            // Erreur : Champ nom du sondage vide
            $errors['poll']['poll_obligatory'] = ['alert_id' => 'pollNameObligatoryAlert', 'message' => 'Le champ nom du sondage est obligatoire.'];
        }

        // NOM DES CHOIX
        $choices = [];

        foreach ($_POST as $fieldName => $fieldValue) {
            if (str_contains($fieldName, 'choice')) { 
                if(!empty($_POST[$fieldName])){
    
                    // Teste si la taille du nom du choix est entre 2 et 100 caractères
                    if(strlen($fieldValue) < 2 || strlen($fieldValue) > 100){
                        // Erreur : Taille du nom du choix incorrect
                        $errors['choice']['choice_length'] = ['alert_id' => 'choiceNameLengthAlert', 'message' => 'Le nom du choix doit comporter entre 2 et 100 caractères (Nombre de caractères actuel : '.strlen($fieldValue).').'];
                    }

                    // Ajoute à la liste de choix
                    $choices[$fieldName] = [$fieldValue];

                } else {
                    // Erreur : Champ nom du choix vide
                    $errors++;
                }
            }
        }

        $occurrences = array_count_values($choices);
    
        // Vérifier si il y a des doublons
        foreach ($occurrences as $value) {
            if ($value > 1) {
                $errors++;
            }
        }
    }
} else {
    header('Location: /');
    exit;
}
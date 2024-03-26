<?php 

session_start();

$title = 'Connexion';
$description = 'Page de connexion de Strapall.';

if(!empty($_SESSION['customer_id'])){
    header('Location: /?page=profil');
}

if(isset($_POST['form_submit'])){
    if(!empty($_POST['pseudo']) && !empty($_POST['password'])){
        $query = $dbh->prepare('SELECT * FROM customer WHERE customer_pseudo = :customer_pseudo;');
        $query->execute(['customer_pseudo' => $_POST['pseudo']]);
        $customer = $query->fetch();
        
        if($customer){
            if(password_verify($_POST['password'], $customer['customer_password'])){
                session_start();
                $_SESSION['customer_id'] = $customer['customer_id'];
                $_SESSION['customer_pseudo'] = $customer['customer_pseudo'];
                $_SESSION['customer_grade'] = $customer['grade_id'];
                header('Location: /');
            }
        }
    }

    $connectionFailed = true;
}
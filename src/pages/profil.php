<?php 

session_start();

if(!empty($_SESSION['customer_id'])){
    $title = $_SESSION['customer_pseudo'];
    $description = 'Profil de '.$_SESSION['customer_pseudo'].'.';

    $query = $dbh->prepare('SELECT * FROM customer WHERE customer_id = :customer_id;');
    $query->execute(['customer_id' => $_SESSION['customer_id']]);
    $customer = $query->fetch();
} else {
    header('Location: /');
}

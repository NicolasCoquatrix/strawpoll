<?php 

if(!empty($_SESSION['customer_id'])){

    $title = 'Mes sondages';
    $description = 'Liste de vos sondages.';

} else {
    header('Location: /');
    exit;
}
<?php

$dbPath = '../../../src/data/db.sqlite';
require '../../../src/data/db-connect.php';

if(isset($_GET['pseudo'])){
    $query = $dbh->prepare("SELECT count(*) AS nb FROM customer WHERE LOWER(customer_pseudo) = LOWER(:customer_pseudo);");
    $query->execute(['customer_pseudo' => $_GET['pseudo']]);
    $customer_pseudo = $query->fetch();

    echo json_encode($customer_pseudo);
    exit;
}
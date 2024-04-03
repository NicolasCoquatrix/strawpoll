<?php

session_start();

$dbPath = '../../../src/data/db.sqlite';
require '../../../src/data/db-connect.php';

if(isset($_SESSION['customer_id'])){
    $query = $dbh->prepare("SELECT * FROM customer WHERE customer_id = :customer_id;");
    $query->execute(['customer_id' => $_SESSION['customer_id']]);
    $customer = $query->fetch();

    echo json_encode($customer);
    exit;
}
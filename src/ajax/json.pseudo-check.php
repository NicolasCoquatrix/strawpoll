<?php

if(isset($value)){
    $query = $dbh->prepare("SELECT count(*) AS nb FROM customer WHERE LOWER(customer_pseudo) = LOWER(:customer_pseudo);");
    $query->execute(['customer_pseudo' => $value]);
    $customer_pseudo = $query->fetch();

    echo json_encode($customer_pseudo);
    exit;
}
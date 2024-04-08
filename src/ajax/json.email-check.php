<?php

if(isset($value)){
    $query = $dbh->prepare("SELECT count(*) AS nb FROM customer WHERE LOWER(customer_email) = LOWER(:customer_email);");
    $query->execute(['customer_email' => $value]);
    $customer_email = $query->fetch();

    echo json_encode($customer_email);
    exit;
}
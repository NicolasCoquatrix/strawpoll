<?php 

if(!empty($_SESSION['customer_id'])){
    $title = 'Mon compte';

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
} else {
    header('Location: /');
}
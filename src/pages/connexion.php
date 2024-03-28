<?php 

$title = 'Connexion';
$description = 'Page de connexion de Strapall.';

if(!empty($_SESSION['customer_id'])){
    header('Location: /?page=compte');
}

if(isset($_POST['form_submit'])){
    if(!empty($_POST['login']) && !empty($_POST['password'])){
        $login = $_POST['login'];

        if(preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))/i', $login)){
            $login = strtolower($login);
            $query = $dbh->prepare('SELECT * FROM customer WHERE LOWER(customer_email) = LOWER(:customer_email);');
            $query->execute(['customer_email' => $login]);
            $customer = $query->fetch();
        } else {
            $query = $dbh->prepare('SELECT * FROM customer WHERE LOWER(customer_pseudo) = LOWER(:customer_pseudo);');
            $query->execute(['customer_pseudo' => $login]);
            $customer = $query->fetch();
        }
        
        if($customer){
            if(password_verify($_POST['password'], $customer['customer_password'])){
                $_SESSION['customer_id'] = $customer['customer_id'];
                $_SESSION['customer_pseudo'] = $customer['customer_pseudo'];
                $_SESSION['customer_grade'] = $customer['grade_id'];
                header('Location: /');
            }
        }
    }

    $connectionFailed = true;
}
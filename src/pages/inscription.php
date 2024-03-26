<?php 

session_start();

$title = 'Inscription';
$description = 'Page d\'inscription de Strapall.';

if(!empty($_SESSION['customer_id'])){
    header('Location: /?page=profil');
}

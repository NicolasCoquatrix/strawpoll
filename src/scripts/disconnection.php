<?php

session_start();

if(!empty($_SESSION['customer_id'])){
    session_destroy();
}

header('Location: /');
exit;
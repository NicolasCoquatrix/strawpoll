<?php

$page = !empty($_GET['page']) ? $_GET['page'] : 'index';

$path = "../src/pages/$page.php";
if(file_exists($path)){
    require '../src/data/db-connect.php';
    require $path;
    require '../templates/layout.html.php';
} else {
    header('HTTP/1.1 404 Not Found');
    require '../templates/404.html.php';
}
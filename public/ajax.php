<?php

$ajax = !empty($_GET['ajax']) ? $_GET['ajax'] : '';
$value = !empty($_GET['value']) ? urldecode($_GET['value']) : '';

$path = "../src/ajax/$ajax.php";
if(file_exists($path)){
    $dbPath = '../src/data/db.sqlite';
    require '../src/data/db-connect.php';
    require $path;
} else {
    header('HTTP/1.1 404 Not Found');
    require '../templates/404.html.php';
    exit;
}
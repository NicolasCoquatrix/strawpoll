<?php

$script = !empty($_GET['script']) ? $_GET['script'] : '';

$path = "../src/scripts/$script";
if(file_exists($path)){
    $dbPath = '../src/data/db.sqlite';
    require '../src/data/db-connect.php';
    require $path;
} else {
    header('HTTP/1.1 404 Not Found');
    require '../templates/404.html.php';
    exit;
}
<?php
require_once 'functions.php';
session_start();
try{
    $db = new PDO('mysql:host=localhost;dbname=btcn07;charset=utf8', 'root', '');
} catch (PDOException $e){
    $error = $e->getMessage();
    echo $error;
}
$currentUser = null;

if (isset($_SESSION['userId'])){
    $user = findUserById($_SESSION['userId']);
    if($user){
        $currentUser = $user;
    }
}
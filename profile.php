<?php
session_start();
if (empty($_SESSION['user'])) {
    header('location: index.php');
    die();
}



include_once('init.php');
include_once('dbConnexion.php');

$sqlQuerry = 'SELECT mail_user, deleted_user FROM users WHERE id_user=:token';
$statement = $db->prepare($sqlQuerry);
$statement->execute([
    'token' => $_SESSION['id_user']
]);

$result = $statement->fetch();
$mail = $result['mail_user'];
$deleted = ($result['deleted_user'] != NULL) ? true : false;

$pageTitle = 'profile';
include('profileView.php');
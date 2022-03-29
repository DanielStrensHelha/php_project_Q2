<?php
session_start();
if (empty($_SESSION['user'])) {
    header('location: index.php');
    die();
}

include_once('init.php');
include_once('dbConnexion.php');

//Show form
$showDetails = true;

//get user informations
$sqlQuerry = 'SELECT * FROM users WHERE `id_user`=:idUser';
$statement = $db->prepare($sqlQuerry);
$statement->execute([
    'idUser' => $_SESSION['id_user']
]);
$result = $statement->fetch();

$currentDate = date_create(NULL, timezone_open('Europe/Brussels'));
$lastChange = date_create($result['lastPseudoChange'], timezone_open('Europe/Brussels'));
$mail = $result['mail_user'];
$deleted = ($result['deleted_user'] != NULL) ? true : false;

// User wants to change an information :
if (isset($_POST['submit_change'])) {
  // TODO insert verification that user account is not deleted

    switch ($_POST['submit_change']) {
        case 'Valider' :
        case 'Changer de pseudo':
            include_once('accountManagement/change_pseudo.php');
            break;


    }
}

$pageTitle = 'profile';
include('profileView.php');

<?php
session_start();
if (empty($_SESSION['user'])) {
    header('location: index.php');
    die();
}

include_once('init.php');
include_once('dbConnexion.php');
$showDetails = true;
$sqlQuerry = 'SELECT * FROM users WHERE `id_user`=:idUser';
$statement = $db->prepare($sqlQuerry);
$statement->execute([
    'idUser' => $_SESSION['id_user']
]);
$result = $statement->fetch();

$lastPseudoChange = $result['lastPseudoChange'];
$mail = $result['mail_user'];
$deleted = ($result['deleted_user'] != NULL) ? true : false;

if (isset($_POST['submit_change'])) {
    switch ($_POST['submit_change']) {
        case 'Valider' :
        case 'Changer de pseudo':
            include_once('accountManagement/change_pseudo.php');
            break;
        
        
    }
}

$pageTitle = 'profile';
include('profileView.php');
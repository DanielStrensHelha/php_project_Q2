<?php
session_start();
$pageTitle = 'ADMIN';

// Verification of the admin status of the user
if (!isset($_SESSION['admin']) or $_SESSION['admin'] < 1){
    header('location: index.php');
    die();
}

$contactDetails = false;

require('init.php');
require('dbConnexion.php');
require('locationDetails/path.php');

require('adminModel.php');

if (!empty($_POST['details'])) {
    $selectedCont = $_POST['details'];
    require('adminViewDetails.php');
}

else if (!empty($_POST['delete']) and $_POST['delete'] === 'Confirm delete' and isset($_POST['selected'])) {
    $sqlQuerry = "DELETE FROM contact WHERE id_contact = :selected";
    $statement = $db->prepare($sqlQuerry);
    $statement-> execute([
        'selected' => $_POST['selected']
    ]);
    $lastPage = (isset($_GET['page']) and is_numeric($_GET['page'])) ? $_GET['page'] : 1;
    header('Location: admin.php?page=' . $lastPage );
}

else {
    require("adminView.php");
}

require('clot.php');
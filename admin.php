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
    
    if (1);

}

else {
    require("adminView.php");
}

require('clot.php');
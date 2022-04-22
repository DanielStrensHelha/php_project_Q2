<?php
session_start();
$pageTitle = 'ADMIN';

// Verification of the admin status of the user
if (!isset($_SESSION['admin']) or $_SESSION['admin'] < 1){
    header('location: index.php');
    die();
}

require('init.php');
require('dbConnexion.php');
require('locationDetails/path.php');

// getting the contact forms
$sqlQuerry = "SELECT COUNT(*) FROM contact";
$statement = $db->prepare($sqlQuerry);
$statement -> execute();


// getting the forms needed
$pages = ceil( ($statement->fetch()['COUNT(*)']) / CONT_BY_PAGE );

$minForm = (isset($_POST['page'])) ?
($_POST['page']-1) * CONT_BY_PAGE :
0;
print_r($minForm);
if (isset($_POST['page']))
    print_r($_POST);
$sqlQuerry = 'SELECT * FROM contact ORDER BY date_time_cont LIMIT :minForm, :nbrForm';
$statement = $db -> prepare($sqlQuerry);

$statement -> bindParam('minForm', $minForm, PDO::PARAM_INT);
$statement -> bindParam('nbrForm', $nbrForm, PDO::PARAM_INT);

$statement -> execute();

$forms = $statement->fetchAll();

require("adminView.php");
require('clot.php');
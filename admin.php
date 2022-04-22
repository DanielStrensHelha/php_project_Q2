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

$formCount = $statement->fetch()['COUNT(*)'];

// getting the forms needed
$pages = ceil($formCount / CONT_BY_PAGE );
$minForm = 
    (isset($_GET['page'])) ?
    ($_GET['page']-1) * CONT_BY_PAGE :
    0;

$page = (isset($_GET['page']) and $_GET['page'] > 0) ? $_GET['page'] : 1;

$sqlQuerry = 'SELECT * FROM contact ORDER BY date_time_cont LIMIT :minForm, :nbrForm';
$statement = $db -> prepare($sqlQuerry);

$statement -> bindParam('minForm', $minForm, PDO::PARAM_INT);
$statement -> bindParam('nbrForm', $nbrForm, PDO::PARAM_INT);

$statement -> execute();

$forms = $statement->fetchAll();

require("adminView.php");
require('clot.php');
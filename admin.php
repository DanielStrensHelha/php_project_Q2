<?php
session_start();
$pageTitle = 'ADMIN';

// Verification of the admin status of the user
if (!isset($_SESSION['admin']) or $_SESSION['admin'] < 1){
    header('location: index.php');
    die();
}

require('init.php');
include('dbConnexion.php');

// getting the contact forms
// TODO make it pluripage
$sqlQuerry = "SELECT COUNT(*) FROM contact";
$statement = $db->prepare($sqlQuerry);
$statement->execute();

$pages = ceil( ($statement->fetch()['COUNT(*)']) / CONT_BY_PAGE );
echo $pages;




require("adminView.php");
require('clot.php');
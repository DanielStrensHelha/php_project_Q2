<?php
session_start();
$pageTitle = 'ADMIN';
if (!isset($_SESSION['admin']) or $_SESSION['admin'] < 1){
    header('location: index.php');
    die();
}
require('init.php');
require("adminView.php");
require('clot.php');
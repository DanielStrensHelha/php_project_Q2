<?php
require('init.php');
$showForm = false;
if (isset($_SESSION['user'])){
    $showForm = true;
}

$pageTitle = 'Upload 🎸';
include('uploadGuitaristView.php');
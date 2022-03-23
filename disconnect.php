<?php
session_start();
if (isset($_POST['disconnect'])){
    session_unset();
    session_destroy();
    header('location: index.php');
    die();
} else {
    header('location: index.php');
    die();
}
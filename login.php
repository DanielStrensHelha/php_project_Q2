<?php
require('init.php');
if (!isset($_SESSION['user'])){
    include_once('dbConnexion.php');

    if(isset($_POST['pseudo']) && isset($_POST['psw']) ){
        $pseudo = $_POST['pseudo'];
        $psw = $_POST['psw'];
        $sqlQuerry = "SELECT pseudo_user, psw_user, admin_user FROM users WHERE pseudo_user = '$pseudo'";
        $statement = $db->prepare($sqlQuerry);
        $statement->execute();

        $user = $statement->fetchAll();


        if (isset($user[0]) and password_verify($psw, $user[0]['psw_user'])){
            $_SESSION['user'] = 'DanielStrens';
            $_SESSION['admin'] = $user[0]['admin_user'];
            header('location: login.php');

        } else {
            $problem = 'wrong user or password';
        }
    }
}

if(isset($_SESSION['user']))
  $pageTitle = 'Profile';
else $pageTitle = 'Login page';

require("loginView.php");
require('clot.php');

<?php
require('init.php');
if (!isset($_SESSION['user'])){
    $pageTitle = 'Login page';

    if(isset($_POST['pseudo']) && isset($_POST['psw']) ){
        include_once('dbConnexion.php');
        
        $pseudo = $_POST['pseudo'];
        $psw = $_POST['psw'];
        $sqlQuerry = "SELECT id_user, pseudo_user, psw_user, admin_user FROM users WHERE pseudo_user = :pseudo";
        $statement = $db->prepare($sqlQuerry);
        $statement->execute(['pseudo' => $pseudo]);

        $user = $statement->fetchAll();


        if (isset($user[0]) and password_verify($psw, $user[0]['psw_user'])){
            $_SESSION['user'] = 'DanielStrens';
            $_SESSION['admin'] = $user[0]['admin_user'];
            $_SESSION['id_user'] = $user[0]['id_user'];
            header('location: login.php');

        } else {
            $problem = 'wrong user or password';
        }
    }
}

else {
    $pageTitle = 'Profile';
    header('location: profile.php');
}

require("loginView.php");
require('clot.php');

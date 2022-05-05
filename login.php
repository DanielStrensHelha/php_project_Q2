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

        $user = $statement->fetch();


        if (!empty($user) and password_verify($psw, $user['psw_user'])){
            $_SESSION['user'] = $user['pseudo_user'];
            $_SESSION['admin'] = $user['admin_user'];
            $_SESSION['id_user'] = $user['id_user'];
            header('location: index.php');

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

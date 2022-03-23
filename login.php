<?php
session_start();
if (!isset($_SESSION['user'])){
    try {
        $db = new PDO(
            'mysql:host=localhost;dbname=guitarheros;charset=utf8',
            'root',
            '',
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ],
        );

    }
    catch (PDOexception $e) {
        die ($e->getMessage());
    }

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

if(isset($_SESSION['user'])) $pageTitle = 'Profile';
else $pageTitle = 'Login page';

require('init.php');
require("loginView.php");
require('clot.php');
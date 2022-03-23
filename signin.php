<?php
$pageTitle = 'Signin page';
require('init.php');
if (isset($_SESSION['user'])){
    header('location: index.php');
    die();
}

if (isset($_POST['pseudo']) and isset($_POST['psw']) and isset($_POST['psw2']) and isset($_POST['emailAddress']) ) {
    $pseudo = $_POST['pseudo'];
    $psw = $_POST['psw'];
    $psw2 = $_POST['psw2'];
    $emailAddress = $_POST['emailAddress'];
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

    $sqlQuerry = "SELECT pseudo_user, mail_user FROM users WHERE pseudo_user = '$pseudo' OR mail_user = '$emailAddress'";
    $statement = $db->prepare($sqlQuerry);
    $statement->execute();

    $result = $statement->fetchAll();

    if (isset($result[0])){
        if($result[0]['pseudo_user'] === $pseudo) $problem = 'pseudo already exists';
        else $problem = 'email address is already used';
    }
    else if ($psw < 8) $problem = 'password to short';
    else if ($pseudo < 4) $problem = 'pseudo to short';

    else if ($psw != $psw2) $problem = "passwords don't match";
    else if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) $problem = "email address invalid";
    else {
        $hashedPsw = password_hash($psw, PASSWORD_BCRYPT, ['cost' => COST]);
        $sqlQuerry = "INSERT INTO users (pseudo_user, mail_user, psw_user) VALUES ('$pseudo', '$emailAddress', '$hashedPsw')";
        $statement = $db->prepare($sqlQuerry);
        $statement->execute();

        $result = $statement->fetchAll();
        header('location: index.php');

        $_SESSION['user'] = $pseudo;
    }
}

require("signinView.php");

require('clot.php');
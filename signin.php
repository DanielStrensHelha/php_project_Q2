<?php
$pageTitle = 'Signin page';
require('init.php');
if (isset($_SESSION['user'])){
    header('location: index.php');
    die();
}

// Form management
if (isset($_POST['pseudo']) and isset($_POST['psw']) and isset($_POST['psw2']) and isset($_POST['emailAddress']) ) {
    $pseudo = $_POST['pseudo'];
    $psw = $_POST['psw'];
    $psw2 = $_POST['psw2'];
    $emailAddress = $_POST['emailAddress'];
    
    // MySQL connexion
    include_once('dbConnexion.php');

    // SQL querry to verify mail and pseudo aren't used yet
    $sqlQuerry = "SELECT pseudo_user, mail_user FROM users WHERE pseudo_user = :pseudo OR mail_user = :mail";
    $statement = $db->prepare($sqlQuerry);
    $statement->execute([
        'pseudo' => $pseudo,
        'mail' => $emailAddress
    ]);

    $result = $statement->fetchAll();

    // if there are results
    if (isset($result[0])){
        if($result[0]['pseudo_user'] === $pseudo) $problem = 'pseudo already exists';
        else $problem = 'email address is already used';
    }

    // Verifying user informations
    else if ($psw < 8) $problem = 'password to short';
    else if ($pseudo < 4) $problem = 'pseudo to short';

    else if ($psw != $psw2) $problem = "passwords don't match";
    else if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) $problem = "email address invalid";

    // If all informations are conform
    else {

        // hash password
        $hashedPsw = password_hash($psw, PASSWORD_BCRYPT, ['cost' => COST]);
        $sqlQuerry = "INSERT INTO users (pseudo_user, mail_user, psw_user) VALUES (:pseudo, :mail, :psw)";
        $statement = $db->prepare($sqlQuerry);
        $statement->execute([
            'pseudo' => $pseudo,
            'mail' => $emailAddress,
            'psw' => $hashedPsw
        ]);

        $sqlQuerry = 'SELECT id_user FROM users WHERE `pseudo_user`= :pseudo';
        $statement = $db->prepare($sqlQuerry);
        $statement->execute([
            'pseudo' => $pseudo
        ]);

        $result = $statement->fetch();
        
        $_SESSION['user'] = $pseudo;
        $_SESSION['id_user'] = $result['id_user'];
        header('location: index.php');
    }
}

require("signinView.php");

require('clot.php');
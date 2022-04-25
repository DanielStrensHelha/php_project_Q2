<?php

try {
    include('locationDetails/db.php');
    $db = new PDO(
        'mysql:host=localhost;dbname=' . $dbName . ';charset=utf8mb4',
        $dbUser,
        $dbPassword,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ],
    );
}
catch (PDOexception $e) {
    die('problem : ' . $e);
}

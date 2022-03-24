<?php
include('locationDetails/db.php');

try {
    $db = new PDO(
        'mysql:host=localhost;dbname=' . $dbName . ';charset=utf8',
        $dbUser,
        $dbPassword,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ],
    );
}
catch (PDOexception $e) {
    die ($e->getMessage());
}

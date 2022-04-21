<?php
include_once('init.php');

$problem = false;
$showForm = true;

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

// Traitement du form
if (isset($_POST['text_contact'])) :

    // Vérification de la taille du message
    if (strlen($_POST['text_contact']) > 750)
        $problem = 'Votre message est trop long !';
    else {

        $keepFile = false;
        // Traitement fichier
        if (isset($_FILES['file_cont']) && $_FILES['file_cont']['error'] == 0) {
            // Vérification de l'extension du fichier
            $fileInfos = pathinfo($_FILES['file_cont']['name']);
            $extension = $fileInfos['extension'];
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            
            if (in_array($extension, $allowedExtensions)) {
                
                // Génération d'un nom pour le fichier
                do {
                    $fileName = uniqid('image_');
                } while (file_exists('uploads/' . $fileName . $extension));


                // Déplacement du fichier
                include('locationDetails/path.php');
                move_uploaded_file($_FILES['file_cont']['tmp_name'], $path . $fileName . '.' . $extension);
                $keepFile = true;
            }

            else {
                $problem = 'Votre fichier n\'est pas une image !';
            }
        }

        // Insertion SQL
        include_once('dbConnexion.php');
        $sqlQuery = 'INSERT INTO contact (text_cont, date_heure_cont, pic_path_cont, id_user)
                     VALUES(:text_cont, NOW(), :pic_path_cont, :id_user)';
        $statement = $db->prepare($sqlQuery);
        $statement->execute([
            ':text_cont' => $_POST['text_contact'],
            ':pic_path_cont' => $keepFile ? $fileName . '.' . $extension : 'NULL',
            ':id_user' => $_SESSION['id_user']
        ]);

        // header('Refresh:2; url=index.php');
        $success = true;
        $showForm = false;
    }
endif;

$pageTitle = 'Contact';
require('contactView.php');
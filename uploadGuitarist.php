<?php
require('init.php');
require('iframeManagement.php');
require('locationDetails/path.php');
require('dbConnexion.php');

$pageTitle = 'Upload 🎸';

//Pour accepter de plus gros fichiers
ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '10M');
//Pour augmenter le temps d'attente
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300);

$showForm = false;

if (isset($_SESSION['user'])) :
    $showForm = true;

 if (!empty($_POST['name']) and !empty($_POST['style']) and !empty($_POST['wikiHero']) and !empty($_POST['ytbSample']) and !empty($_FILES['photo1'])){
//------------------------------ Affectation variables plus facilement utilisables ------------------------------//
    $name = $_POST['name'];
    $style = $_POST['style'];
    $wikiHero = $_POST['wikiHero'];
    
    $ytbSample = $_POST['ytbSample'];
    $sptSample = $_POST['sptSample'];
    
    $ytbLive = $_POST['ytbLive'];
    $descriptionLive = $_POST['descriptionLive'];
    
    $interview = $_POST['interview'];
    $descriptionInterview = $_POST['descriptionInterview'];


//------------------------------ Affectation variables en rapport avec les photos  ------------------------------//
    $photo1 = $_FILES['photo1'];
    $photo2 = $_FILES['photo2'];

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'PNG', 'JPEG', 'JPG'];
    if ($photo1['error'] == 0) {
        $fileInfos1 = pathinfo($_FILES['photo1']['name']);
        $extension1 = $fileInfos1['extension'];
    }

    if (!empty($photo2 and $photo2['error'] == 0)) {
        $fileInfos2 = pathinfo($_FILES['photo2']['name']);
        $extension2 = $fileInfos2['extension'];
    }


//------------------------------ Vérifications des données du formulaire ------------------------------//

    if (strlen($name) < 3)
        $problem = "Nom de guitariste trop court";

    else if (strlen($style) < 3)
        $problem = "Style de guitariste trop court";

    else if (strlen($wikiHero) < 30)
        $problem = "Wiki trop court";

    else if (!isGoodYtbUrl($ytbSample))
        $problem = "Lien Sample Youtube invalide";

    else if (!empty($sptSample) and !isGoodSpotifyUrl($sptSample))
        $problem = "Lien Spotify invalide";

    else if (!empty($ytbLive) and !isGoodYtbUrl($ytbLive))
        $problem = "Lien Live Youtube invalide";

    else if (!empty($interview) and !isGoodYtbUrl($interview))
        $problem = "Lien Interview Youtube invalide";

    else if (!in_array($extension1, $allowedExtensions))
        $problem = "Extension de la photo 1 invalide";

    else if (!empty($photo2) and !in_array($extension2, $allowedExtensions))
        $problem = "Extension de la photo 2 invalide";
    
    else if ($photo1['error'] != 0)
        $problem = "problème avec la photo 1";

    else if (!empty($photo2) and $photo2['error'] != 0)
        $problem = "problème avec la photo 2";
    
    else if(!empty($photo2) and $photo2['error'] != 0)
        $problem = "problème avec la photo 2";

    else if($_FILES['photo1']['size'] > 10485760 or (!empty($_FILES['photo2']) and $_FILES['photo2']['size'] > 10485760))
        $problem = "Photo trop lourde";

//------------------------------ Insertion dans la base de donnée si toutes les infos sont bonnes ------------------------------//
    if (empty($problem)) {
        
        //Génération d'un nom unique pour l'image 1
        do {
            $fileName = uniqid('image_');
        } while (file_exists($path . $fileName . $extension1));

        move_uploaded_file($_FILES['photo1']['tmp_name'], $path . $fileName . '.' . $extension1);

        if (!empty($photo2)) {
            // Génération nom fichier 2            
            do {
                $fileName2 = uniqid('image_');
            } while (file_exists($path . $fileName2 . $extension2));
        
            move_uploaded_file($_FILES['photo2']['tmp_name'], $path . $fileName2 . '.' . $extension2);
        }

        $sqlQuerry = "INSERT INTO guitarist 
        (name_guit, thumbnail_guit, ytbSample_guit, sptSample_guit, style_guit, wiki_hero, pic_guit, ytbLink_guit, ytbExplain_guit, ytbLinkBis_guit, ytbExplainBis_guit, id_user) 
        VALUES (:name_guit, :thumnail, :ytbSample, :sptSample, :style, :wikiHero, :pic, :ytbLink, :ytbExplain, :ytbLinkBis, :ytbExplainBis ,:idUser)";
        
        $statement = $db->prepare($sqlQuerry);
        $statement->bindValue(':name_guit', $name, PDO::PARAM_STR);
        $statement->bindValue(':thumnail', $fileName . '.' . $extension1, PDO::PARAM_STR);
        $statement->bindValue(':ytbSample', $ytbSample, PDO::PARAM_STR);
        $statement->bindValue(':sptSample', $sptSample, PDO::PARAM_STR);
        $statement->bindValue(':style', $style, PDO::PARAM_STR);
        $statement->bindValue(':wikiHero', $wikiHero, PDO::PARAM_STR);

        if (!empty($photo2))
            $statement->bindValue(':pic', $fileName2 . '.' . $extension2, PDO::PARAM_STR);
        else
            $statement->bindValue(':pic', NULL, PDO::PARAM_NULL);
        
        $statement->bindValue(':ytbLink', getIdFromURL($ytbLive), PDO::PARAM_STR);
        $statement->bindValue(':ytbExplain', $descriptionLive, PDO::PARAM_STR);
        $statement->bindValue(':ytbLinkBis', getIdFromURL($interview), PDO::PARAM_STR);
        $statement->bindValue(':ytbExplainBis', $descriptionInterview, PDO::PARAM_STR);
        $statement->bindValue(':idUser', $_SESSION['id_user'], PDO::PARAM_INT);

        $statement->execute();

        $showForm = false;
        $success = true;
    }
 }
endif;


include('uploadGuitaristView.php');
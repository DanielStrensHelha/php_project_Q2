<?php
require('init.php');

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

    $name = $_POST['name'];
    $style = $_POST['style'];
    $wikiHero = $_POST['wikiHero'];
    
    $ytbSample = $_POST['ytbSample'];
    $sptSample = $_POST['sptSample'];
    
    $ytbLive = $_POST['ytbLive'];
    $descriptionLive = $_POST['descriptionLive'];
    
    $interview = $_POST['interview'];
    $descriptionInterview = $_POST['descriptionInterview'];
    
    $photo1 = $_FILES['photo1'];
    $photo2 = $_FILES['photo2'];

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'PNG', 'JPEG', 'JPG'];
    
    if ($_FILES['photo1']['error'] == 0) {
        $fileInfos1 = pathinfo($_FILES['photo1']['name']);
        $extension1 = $fileInfos1['extension'];
    }

    if(!empty($_FILES['photo2']) and $_FILES['photo2']['error'] == 0){
        $fileInfos2 = pathinfo($_FILES['photo2']['name']);
        $extension2 = $fileInfos2['extension'];
    }

    // Vérification de la taille des fichiers
    if($_FILES['photo1']['size'] > 10485760 or (!empty($_FILES['photo2']) and $_FILES['photo2']['size'] > 10485760)) {
        $problem = "Photo trop lourde";
    }
    else if (strlen($name) < 3) {
        $problem = "Nom de guitariste trop court";
    }
    else if (strlen($style) < 3) {
        $problem = "Style de guitariste trop court";
    }
    else if (strlen($wikiHero) < 30) {
        $problem = "Wiki trop court";
    }
    


 }
endif;


$pageTitle = 'Upload 🎸';
include('uploadGuitaristView.php');
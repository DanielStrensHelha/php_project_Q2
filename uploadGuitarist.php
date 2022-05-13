<?php
require('init.php');
$showForm = false;
print_r($_SESSION);

if (isset($_SESSION['user'])) :
    $showForm = true;

 if (!empty($_POST['name']) and !empty($_POST['style']) and !empty($_POST['wikiHero']) and !empty($_POST['ytbSample']) and !empty($_FILES['photo1'])){
    $showForm = true;

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
    
    $fileInfos1 = pathinfo($_FILES['photo1']['name']);
    $extension1 = $fileInfos1['extension'];

    if(!empty($_FILES['photo2']) and $_FILES['photo2']['error'] == 0){
        $fileInfos2 = pathinfo($_FILES['photo2']['name']);
        $extension2 = $fileInfos2['extension'];
    }


 }
endif;


$pageTitle = 'Upload 🎸';
include('uploadGuitaristView.php');
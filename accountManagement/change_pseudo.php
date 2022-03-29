<?php
$changingPseudo = true;
$showDetails = false;

if (!empty($_POST['newPseudo'])) :
    $showDetails=true;
    $changingPseudo = false;
endif;

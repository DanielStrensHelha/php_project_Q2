<?php
$changingPseudo = true;
$showDetails = false;

// If new pseudo chosen
if (!empty($_POST['newPseudo'])) :

    // Verifying the last date of change
    if (!empty($result['lastPseudoChange'])) {
      $diff = abs(date_diff($lastChange, $currentDate)->format("%a"));
      $wait = PSEUDO_CHANGE - $diff;
      if( $diff < PSEUDO_CHANGE)
        $problem = 'Veuillez attendre ' .
                    $wait .
                    ' jours pour changer de pseudo à nouveau.';
    }

    //Verifying new pseudo length
    if (!isset($problem)) :
      if (strlen($_POST['newPseudo']) < 4)
          $problem = 'Pseudo trop court !';

      else if (strlen($_POST['newPseudo']) > MAXLUSER)
          $problem = 'Pseudo trop long !';

      //Verifying pseudo is using valide characters
      else if (preg_match("/^[a-zA-Z0-9\._]+$/", $_POST['newPseudo']) < 1)
        $problem = "pseudo can only contain letters, numbers or one of those special chars (. _)";

      //If pseudo is valid :
      else {
        //Verifying that the pseudo isn't already used
          $sqlQuerry = 'SELECT id_user FROM users WHERE pseudo_user= :wantedPseudo';
          $statement = $db->prepare($sqlQuerry);
          $statement->execute([
              'wantedPseudo' => $_POST['newPseudo']
          ]);

          $result = $statement->fetch();
          if(!empty($result))
              $problem = "pseudo déja utilisé";

          //If pseudo is valid and unused :
          else {
              $sqlQuerry = 'UPDATE users SET pseudo_user=:newPseudo, lastPseudoChange=:currentDate WHERE id_user=:idUser';
              $statement = $db->prepare($sqlQuerry);
              $statement->execute([
                  'newPseudo' => $_POST['newPseudo'],
                  'currentDate' => date_format($currentDate, "Y-m-d"),
                  'idUser' => $_SESSION['id_user']
              ]);

              $_SESSION['user'] = $_POST['newPseudo'];
              $changingPseudo = false;
              $showDetails=true;
          }
      }
    endif;
endif;

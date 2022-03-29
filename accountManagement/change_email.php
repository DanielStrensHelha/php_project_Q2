<?php
$changingPseudo = true;
$showDetails = false;

if (!empty($_POST['newPseudo'])) :
    
    if (strlen($_POST['newPseudo']) < 4)
        $problem = 'Pseudo trop court !';
    
    else if (strlen($_POST['newPseudo']) > MAXLUSER)
        $problem = 'Pseudo trop long !';
    
    else {
        $sqlQuerry = 'SELECT id_user FROM users WHERE pseudo_user= :wantedPseudo';
        $statement = $db->prepare($sqlQuerry);
        $statement->execute([
            'wantedPseudo' => $_POST['newPseudo']
        ]);

        $result = $statement->fetch();
        print_r($result);
        if(!empty($result))
            $problem = 'pseudo already taken';
        else {
            $sqlQuerry = 'UPDATE users SET pseudo_user=:newPseudo WHERE id_user=:idUser';
            $statement = $db->prepare($sqlQuerry);
            $statement->execute([
                'newPseudo' => $_POST['newPseudo'],
                'idUser' => $_SESSION['id_user']
            ]);

            $_SESSION['user'] = $_POST['newPseudo'];
            $changingPseudo = false;
            $showDetails=true;
        }
    }

endif;

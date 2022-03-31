<?php
$changingPassword = true;
$showDetails = false;

// If new password is chosen
if (!empty($_POST['oldPsw']) and !empty($_POST['newPsw']) and !empty($_POST['newPsw2'])) :

    // Verifying that old password is the right one
    $sqlQuerry = 'SELECT psw_user FROM users WHERE id_user=:idUser';
    $statement = $db->prepare($sqlQuerry);
    $statement->execute([
        'idUser' => $_SESSION['id_user']
    ]);
    $oldPsw = $statement->fetch()['psw_user'];
    if(!password_verify($_POST['oldPsw'], $oldPsw))
        $problem = 'Mauvais mot de passe';
    
    // If old password is correct
    else {
        // verify password length
        if (strlen($_POST['oldPsw']) < 8)
            $problem = 'Mot de passe trop court';

        // Verify passwords match
        else if ($_POST['newPsw'] != $_POST['newPsw2'])
            $problem = 'Les mots de passe ne correspondent pas';

        // If everything is alright
        else {
            // hash password
            $hashedPsw = password_hash($_POST['newPsw'], PASSWORD_BCRYPT, ['cost' => COST]);
            $sqlQuerry = "UPDATE users SET psw_user=:newPsw WHERE id_user=:idUser";
            $statement = $db->prepare($sqlQuerry);
            $statement->execute([
                'newPsw' => $hashedPsw,
                'idUser' => $_SESSION['id_user']
            ]);

            $changingPassword = false;
            $showDetails = true;
        }
    }

endif;
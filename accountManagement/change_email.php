<?php
$changingMail = true;
$showDetails = false;

// If new mail chosen
if (!empty($_POST['newMail'])) :

    //Verifying new mail    
    if (!filter_var($_POST['newMail'], FILTER_VALIDATE_EMAIL)) $problem = "email address invalid";
        
    //If mail is valid :
    else {
    //Verifying that the mail isn't already used
        $sqlQuerry = 'SELECT id_user FROM users WHERE mail_user= :wantedMail';
        $statement = $db->prepare($sqlQuerry);
        $statement->execute([
            'wantedMail' => $_POST['newMail']
        ]);

        $result = $statement->fetch();
        if(!empty($result))
            $problem = "Addresse mail déja utilisé";

        //If pseudo is valid and unused :
        else {
            $sqlQuerry = 'UPDATE users SET mail_user=:newMail WHERE id_user=:idUser';
            $statement = $db->prepare($sqlQuerry);
            $statement->execute([
                'newMail' => $_POST['newMail'],
                'idUser' => $_SESSION['id_user']
            ]);

            $mail = $_POST['newMail'];
            $changingMail = false;
            $showDetails=true;
        }
    }
endif;

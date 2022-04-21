<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<header>
    <?php require("menu.php"); ?>
</header>
<body class="preload <?php  if(isset($_COOKIE['theme'])) echo $_COOKIE['theme']; else echo 'light'; ?>">

<div class="grid justifyCenter wholeWidth">
    <div class="contentColor margin radius">
        <p class="centerX margin">Formulaire de contact</p>

        <?php if(!empty($_SESSION['user'])) : ?>
            <?php if ($showForm) : ?>
                <form method="post" action="#" class="grid doubleGrid margin padding smallGap" enctype="multipart/form-data">
                    <label for="text_contact">Votre message : </label>
                    <textarea name="text_contact" id="text_contact" cols="45" rows="10" required maxlength="750" placeholder="Votre message ici..."></textarea>

                    <label for="file_cont">Image (optionnel) : </label>
                    <input type="file" name="file_cont" id="file_cont">
                    <input type="submit" value="Envoyer le formulaire" class="wholeGrid border lightRadius button">
                </form>
            <?php 
                if ($problem) 
                    echo '<p class="margin">' . $problem . '</p>';
            ?>
            <?php endif; ?>            
        <?php else : ?>
            <p class="centerX margin">Vous devez <a href="login.php"> vous connecter</a> pour pouvoir envoyer un formulaire de contact.</p>
        <?php endif; ?>

        <?php if(isset($success)) : ?>
            <p class="centerX margin">Votre message a bien été envoyé !</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>

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
        <div class="contentColor margin radius grid padding">

          <?php if ($showDetails) : ?>

            <form action="#" method="post" class="margin">
                <fieldset class="grid tripleGrid smallGap">
                <legend>Informations personnelles</legend>

                    <label for="pseudo">pseudo : </label>
                    <span class="color2"><?php echo htmlspecialchars($_SESSION['user']); ?></span>
                    <input type="submit" value="Changer de pseudo" name="submit_change" class="border wholeGridPhone">

                    <label for="mail">mail : </label>
                    <span class="color2"><?php echo htmlspecialchars($mail); ?></span>
                    <input type="submit" value="Changer d'addresse mail" name="submit_change" class="border wholeGridPhone">

                    <label for="psw">Mot de passe : </label>
                    <span class="color2">********</span>
                    <input type="submit" value="Changer de mot de passe" name="submit_change" class="border wholeGridPhone">

                </fieldset>
            </form>

          <?php elseif ($changingPseudo) : ?>

            <form action="#" method="post" class="grid doubleGrid smallGap margin">
                    <label for="newPseudo">Nouveau pseudo : </label>
                    <input type="text" name="newPseudo" id="newPseudo" minlength="4" maxlength="<?php echo MAXLUSER; ?>">
                    <input type="submit" value="Valider pseudo" name="submit_change" class="wholeGrid border">
                    <?php if(isset($problem)) echo '<span class="wholeGrid">Erreur : ' . $problem . '</span>'; ?>
            </form>

          <?php elseif($changingMail) : ?>

            <form action="#" method="post" class="grid doubleGrid smallGap margin">
                    <label for="newMail">Nouvelle addresse mail : </label>
                    <input type="mail" name="newMail" id="newMail" minlength="4">
                    <input type="submit" value="Valider addresse mail" name="submit_change" class="wholeGrid border">
                    <?php if(isset($problem)) echo '<span class="wholeGrid">Erreur : ' . $problem . '</span>'; ?>
            </form>

          <?php endif; ?>


        </div>
    </div>

    <div class="grid justifyCenter wholeWidth ">
        <div class="contentColor margin radius grid doubleGrid radius padding">
            <form method="post" action="disconnect.php" class="margin"
            <?php if (!isset($_SESSION['admin']) or $_SESSION['admin'] < 1) echo 'class="wholeGrid"'; ?>
            >
                <input type="submit" value="Déconnexion" name="disconnect" class="border">
            </form>

            <?php if (isset($_SESSION['admin']) and $_SESSION['admin'] > 0): ?>
                <a href="admin.php" class="margin">
                    <input type="button" class="wholeWidth border" value="ADMIN">
                </a>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>

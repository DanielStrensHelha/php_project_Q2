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
        <div class="contentColor margin radius grid">            
            <form action="" method="post" class="margin">
                <fieldset class="grid tripleGrid smallGap">
                <legend>Informations personnelles</legend>

                    <label for="pseudo">pseudo : </label>
                    <?php echo htmlspecialchars($_SESSION['user']); ?></button>
                    <input type="submit" value="Changer de pseudo" name="changePseudo" class="border wholeGridPhone"></input>

                    <label for="mail">mail : </label>
                    <?php echo htmlspecialchars($mail); ?>
                    <input type="submit" value="Changer d'addresse mail" name="changeMail" class="border wholeGridPhone"></input>

                    <label for="psw">Mot de passe : </label>
                    ********
                    <input type="submit" value="Changer de mot de passe" name="changePsw" class="border wholeGridPhone"></input>

                </fieldset>
            </form>
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
                    <input type="button" class="wholeWidth border" value="ADMIN"></button>
                </a>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
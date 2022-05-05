<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<header>
    <?php require("menu.php"); ?>
</header>
<body class="preload <?php  if(isset($_COOKIE['theme'])) echo $_COOKIE['theme']; else echo 'light'; ?>">

<?php
    if (isset($_SESSION['user'])) : include('profile.php');
    else : ?>
    <div class="grid justifyCenter wholeWidth ">
        <div class="contentColor radius margin">
            <p class="centerX">Déja membre ?</p>
            <form method="post" action="#" class="grid loginForm margin padding">
                <input type="text" placeholder="pseudonyme" name="pseudo" minlength="4" maxlength="<?php echo MAXLUSER; ?>" required>
                <input type="password" placeholder="password" name="psw" minlength="8" required>
                <input type="submit" value="Se connecter" class="border">
                <?php if(isset($problem))
                echo '<p>' . $problem . '</p>';
                ?>
                    
            </form>
        </div>

        <a href="signin.php" class="contentColor radius margin centerX padding">
            <p>Pas encore membre</p>
        </a>
    </div>
<?php endif; ?>
</body>
</html>
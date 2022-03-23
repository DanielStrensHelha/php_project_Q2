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

<div class="grid justifyCenter wholeWidth ">
    <div class="contentColor margin radius">
        <p class="centerX">Inscription</p>
        <form method="post" action="#" class="grid signinForm margin padding">
            <label for="pseudo">Pseudo : </label>
            <input type="text" placeholder="pseudonyme" name="pseudo" minlength="4" maxlength="<?php echo MAXLUSER; ?>" required>
            
            <label for="psw">Mot de passe : </label>
            <input type="password" placeholder="password" name="psw" minlength="8" required>
            <label for="psw2">Confirmation du mot de passe : </label>
            <input type="password" placeholder="repeat password" name="psw2" minlength="8" required>

            <label for="emailAddress">Addresse mail : </label>
            <input type="email" placeholder="Email address"  name="emailAddress" required>

            <input type="submit" value="S'inscrire" class="span2 centerX justifyCenter">
        </form>
    </div>
</div>
<?php if (isset($problem)) : ?>
<div class="grid justifyCenter wholeWidth ">
    <div class="contentColor margin radius padding">
    <?php echo $problem; ?>
    </div>
</div>

<?php endif; ?>

</body>
</html>
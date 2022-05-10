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
    <div class="grid wholeWidth justifyCenter">

        <div class="grid comfortWidth justifyStretch">   
            <div class="centerX contentColor radius margin padding">
                <?php echo htmlspecialchars($guitariste['name_guit']); ?>
            </div>
        </div>
    </div>
</body>
</html>

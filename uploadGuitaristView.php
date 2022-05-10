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
        <?php if (!$showForm) : ?>
        <div class="grid comfortWidth justifyStretch">   
            <div class="centerX contentColor radius margin padding">
                <p class="centerX margin">
                    Vous devez <a href="login.php"> vous connecter</a> pour pouvoir uploader un post.
                </p>
            </div>
        </div>
        
        <?php else : ?>
        
        <div class="grid comfortWidth justifyStretch">   
            <div class="centerX contentColor radius margin padding">
                <form action="#" method="post" class="grid doubleGrid margin padding smallGap">
                    <label for="name" class="wholeGridPhone">Nom du guitariste</label>
                    <input type="text" name="name" id="name" class="wholeGridPhone" required maxlength="25" placeholder="Nom du guitariste">

                    <label for="Style" class="wholeGridPhone">Style.s de musique</label>
                    <input type="text" name="style" id="style" class="wholeGridPhone" required maxlength="75" placeholder="Rock, Soul, pop">

                    <label for="wikiHero" class="wholeGridPhone">wiki du guitariste</label>
                    <textarea name="wikiHero" id="wikiHero" class="wholeGridPhone" cols="30" rows="10" placeholder="<background>
Tsobatso est un jeune guitariste.

<young live>
...
                    "></textarea>

                    <label for=""></label>
                </form>
            </div>
        </div>




        <?php endif; ?>
    </div>
</body>
</html>

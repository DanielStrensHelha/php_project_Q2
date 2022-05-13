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
                <form action="#" method="post" class="grid doubleGrid margin padding smallGap" enctype="multipart/form-data">

                    <label for="name" class="wholeGridPhone">Nom du guitariste</label>
                    <input type="text" name="name" id="name" class="wholeGridPhone"
                    required maxlength="25" placeholder="Nom du guitariste"
                    value="<?php if(isset($_POST['name'])) echo htmlspecialchars($_POST['name']); ?>">

                    <label for="style" class="wholeGridPhone">Style.s de musique</label>
                    <input type="text" name="style" id="style" class="wholeGridPhone" 
                    required maxlength="75" placeholder="Rock, Soul, pop"
                    value="<?php if(isset($_POST['style'])) echo htmlspecialchars($_POST['style']); ?>">

                    <label for="wikiHero" class="wholeGridPhone">wiki du guitariste</label>
                    <textarea name="wikiHero" id="wikiHero" class="wholeGridPhone" cols="30" rows="10" required placeholder="<background>
Tsobatso est un jeune guitariste.

<young life>
...
                    "><?php if(isset($_POST['wikiHero'])) echo htmlspecialchars($_POST['wikiHero']); ?></textarea>

                    <label for="ytbSample" class="wholeGridPhone">Sample youtube</label>
                    <input type="text" name="ytbSample" id="ytbSample" 
                    required placeholder="Lien youtube" class="wholeGridPhone"
                    value="<?php if(isset($_POST['ytbSample'])) echo htmlspecialchars($_POST['ytbSample']); ?>">
                    
                    <label for="sptSample" class="wholeGridPhone">Sample spotify</label>
                    <input type="text" name="sptSample" id="sptSample" 
                    placeholder="Lien spotify" class="wholeGridPhone"
                    value="<?php if(!empty($_POST['sptSample'])) echo htmlspecialchars($_POST['sptSample']); ?>">

                    <label for="ytbLive" class="wholeGridPhone">Live youtube</label>
                    <input type="text" name="ytbLive" id="ytbLive" 
                    placeholder="Lien youtube" class="wholeGridPhone"
                    value="<?php if(isset($_POST['ytbLive'])) echo htmlspecialchars($_POST['ytbLive']); ?>">

                    <label for="descriptionLive" class="wholeGridPhone">Description du live</label>
                    <textarea name="descriptionLive" id="descriptionLive" cols="30" rows="10" class="wholeGridPhone" 
                    placeholder="Vidéo de Tsobatso en live au mercury open, 2021">
                    <?php if(isset($_POST['descriptionLive'])) echo htmlspecialchars($_POST['descriptionLive']); ?>
                    </textarea>

                    <label for="interview" class="wholeGridPhone">Interview youtube</label>
                    <input type="text" name="interview" id="interview" 
                    placeholder="Lien youtube" class="wholeGridPhone"
                    value="<?php if(isset($_POST['interview'])) echo htmlspecialchars($_POST['interview']); ?>">

                    <label for="descriptionInterview">Description de l'interview</label>
                    <textarea name="descriptionInterview" id="descriptionInterview" class="wholeGridPhone" cols="30" rows="10" 
                    placeholder="Interview de Tsobatso par Chris rock...">
                    <?php if(isset($_POST['descriptionInterview'])) echo htmlspecialchars($_POST['descriptionInterview']); ?>
                    </textarea>

                    <label for="photo1" class="wholeGridPhone">Photo du guitariste</label>
                    <input type="file" name="photo1" id="photo1" 
                    class="wholeGridPhone" required>

                    <label for="photo2" class="wholeGridPhone">Photo secondaire</label>
                    <input type="file" name="photo2" id="photo2" class="wholeGridPhone">

                    <input type="submit" value="Poster" class="button wholeGrid">
                </form>
            </div>
        </div>

        <?php endif; ?>
    </div>
</body>
</html>

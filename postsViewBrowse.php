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
                <a href="uploadGuitarist.php" class="bigTxt">
                    New post
                </a>
            </div>

            <div class="grid centerX contentColor radius margin padding">
                <form action="#" method="post" class="doubleGrid grid">
                    <label for="Research" class="wholeGridPhone">Search by name : </label>
                    <input type="text" name="search" id="Research" class="wholeGridPhone" placeholder="Guitarist name" maxlength="50">

                    <input type="submit" value="Rechercher" class="button wholeGrid">
                    
                    <div class="wholeGrid margin">Ou trier par</div>

                    <label for="LikeRatio">Ratio de like</label>
                    <input type="radio" name="sort" id="LikeRatio" value="like_ratio" checked>

                </form>
            </div>

            <?php
            foreach($posts as $i => $post) : 

                $infos = getimagesize($path . $post['thumbnail_guit']);
                $adminClass = ($infos[0] > $infos[1]) ? 'adminImageW' : 'adminImageH';
                
                ?>
                <div class="contentColor radius margin padding grid doubleGrid">
                    <div>
                        <h2>
                            <a href="posts.php?guit=<?php echo $post['id_guitarist']; ?>">
                                <?php echo htmlspecialchars($post['name_guit']); ?>
                            </a>
                        </h2>
                        
                        <p>
                            <?php echo htmlspecialchars($desc[$i]); ?>
                        </p>
                    </div>    

                    <div class="grid centerY justifyCenter">
                        <img 
                            src="<?php echo $path . $post['thumbnail_guit']; ?>" 
                            alt="picture not found; ?>" 
                            class="<?php echo $adminClass; ?> wholeGridPhone"
                        >
                    </div>
                </div>

            <?php endforeach; ?>


            <?php include("pageManagement.php") ?>
        </div>

    </div>

</body>
</html>

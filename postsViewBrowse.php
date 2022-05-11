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

                <form action="#" method="get" class="tripleGrid grid centerY">
                    <label for="Research" class="wholeGridPhone belleza">Chercher guitariste / style: </label>
                    <input type="text" name="search" id="Research" placeholder="Guitarist name" maxlength="50"
                    class="wholeGridPhone margin"
                    value="<?php if(isset($_GET['search'])) echo htmlspecialchars($_GET['search']); ?>"                   
                    >
                    <input type="submit" value="Rechercher" class="button wholeGridPhone noMargin border">
                </form>

                <form action="#" method="post" class="grid doubleGrid smallGap">
                    <div class="wholeGrid margin belleza">Ou trier par</div>

                    <label for="likeRatioSort">Ratio de like</label>
                    <input type="radio" name="sort" id="likeRatioSort" class="wholeWidth"
                    value="like_ratio"
                    <?php if( !$checked or $_POST['sort'] === "like_ratio") echo "checked"; ?>
                    >
                
                    <label for="nameSort">Nom</label>
                    <input type="radio" name="sort" id="nameSort" class="wholeWidth"
                    value="name_sort"
                    <?php if($checked and $_POST['sort'] === "name_sort") echo "checked"; ?>
                    >

                    <label for="mostCommentedsort">Les plus commentés</label>
                    <input type="radio" name="sort" id="mostCommentedsort" class="wholeWidth"
                    value="most_commented_sort"
                    <?php if($checked and $_POST['sort'] === "most_commented_sort") echo "checked"; ?>
                    >

                    <input type="submit" value="Appliquer les changements" class="button wholeGrid border">
                </form>

            </div>

            <?php

            foreach($posts as $i => $post) :

                if (file_exists($path . $post['thumbnail_guit'])) {
                    $infos = getimagesize($path . $post['thumbnail_guit']);
                    $adminClass = ($infos[0] > $infos[1]) ? 'adminImageW' : 'adminImageH';
                }
                else $adminClass = 'adminImageW';
                
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
                            alt="picture not found" 
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

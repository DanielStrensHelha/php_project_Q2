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
                Posts
            </div>

            <?php
            $i=-1;
            foreach($posts as $post) : 
                $i++;
                $infos = getimagesize($path . $post['thumbnail_guit']);
                $adminClass = ($infos[0] > $infos[1]) ? 'adminImageW' : 'adminImageH';
                
                ?>
                <div class="contentColor radius margin padding grid doubleGrid">
                    <div>
                        <h2><?php echo htmlspecialchars($post['name_guit']); ?></h2>
                        <p>Insérer description</p>
                        <p>
                            <?php echo htmlspecialchars($desc[$i]); ?>
                        </p>
                    </div>    

                    <div>
                        <img 
                            src="<?php echo $path . $post['thumbnail_guit']; ?>" 
                            alt="picture not found; ?>" 
                            class="<?php echo $adminClass; ?> wholeGridPhone"
                        >
                    </div>
                </div>

            <?php endforeach; ?>
        </div>

    </div>

</body>
</html>

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
            <h1 class="centerX contentColor radius padding marginVert">
                <?php echo htmlspecialchars($guitarist['name_guit']); ?>
            </h1>
        
            <div class="contentColor radius padding grid doubleGrid marginVert">
                <div>
                    <p class="wordBreak">
                        <?php formatWiki($guitarist['wiki_hero']); echo $guitarist['wiki_hero']; ?>
                    </p>
                </div>

                <div class="grid centerY justifyCenter">
                    <?php
                    if (file_exists($path . $guitarist['thumbnail_guit'])) {
                        $infos = getimagesize($path . $guitarist['thumbnail_guit']);
                        $adminClass = ($infos[0] > $infos[1]) ? 'adminImageW' : 'adminImageH';
                    }
                    else $adminClass = 'adminImageW'; 
                    ?>
                    <img 
                        src="<?php echo $path . $guitarist['thumbnail_guit']; ?>" 
                        alt="picture not found"
                        class="<?php echo $adminClass; ?> wholeGridPhone"
                    >
                </div>
            </div>

            <div class="centerX contentColor radius padding grid marginVert">
                <h2>Sample.s</h2>
                <div class="grid doubleGrid centerY">
                    <div class="<?php if (!empty($guitarist['sptSample_guit'])) echo 'wholeGridPhone'; else echo 'wholeGrid' ?>">
                        <?php displayYoutubeVideo($guitarist['ytbSample_guit'], "sample youtube"); ?>
                    </div>
    
                    <?php if(!empty($guitarist['sptSample_guit'])) : ?>
                        <div class="wholeGridPhone">
                            <?php displaySpotifyTrack($guitarist['sptSample_guit']);?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="centerX contentColor radius padding grid marginVert">
                <h2>Sample.s</h2>
                <div class="grid doubleGrid centerY">
                    
                </div>
            </div>

        </div>
    </div>
</body>
</html>

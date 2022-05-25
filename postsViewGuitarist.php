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
                    <h2>Styles : </h2>
                    <p>
                        <?php echo htmlspecialchars($guitarist['style_guit']); ?>
                    </p>

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
                <form action="#" method="post" class="flex flexLign centerY">
                        <input type="hidden" name="id_guit_selected" value="<?php echo htmlspecialchars($_GET['guit']); ?>">
                        <input type="hidden" name="id_guit" value="<?php echo htmlspecialchars($_GET['guit']); ?>">
                        
                        <input style="<?php if($userAppreciation !== 1) echo "filter: grayscale(100%);"; ?>"
                        type="submit" value="⬆️" name="like" class="like bigTxt">

                        <div class=""><?php echo (int)$likes; ?></div>
                        
                        <input style="<?php if($userAppreciation !== 0) echo "filter: grayscale(100%);"; ?>" 
                        type="submit" value="⬇️" name="like" class="like bigTxt">

                        <div class=""><?php echo (int)$dislikes; ?></div>
                    </form>
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

            <?php if(!empty($guitarist['ytbLink_guit'])) : ?>
            <div class="centerX contentColor radius padding grid doubleGrid marginVert centerY">
                <div class="wholeGridPhone">
                    <?php echo htmlspecialchars($guitarist['ytbExplain_guit']); ?>
                </div>
            
                <div class="wholeGridPhone">
                    <?php displayYoutubeVideo($guitarist['ytbLink_guit'], "lien youtube"); ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if(!empty($guitarist['ytbLinkBis_guit'])) : ?>
            <div class="centerX contentColor radius padding grid doubleGrid marginVert centerY">
                <div class="wholeGridPhone">
                    <?php echo htmlspecialchars($guitarist['ytbExplainBis_guit']); ?>
                </div>
            
                <div class="wholeGridPhone">
                    <?php displayYoutubeVideo($guitarist['ytbLinkBis_guit'], "lien youtube"); ?>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>
</body>
</html>

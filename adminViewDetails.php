<?php if(empty($selectedCont)) die(); ?>

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

    <div class="grid wholeWidth justifyCenter">

        <div class="grid comfortWidth justifyStretch">   
            <?php        
                if ($detailedForm['pic_path_cont'] == 'NULL') {
                    $text_width = 'wholeGrid';
                    $showPic = false;
                }
                else {
                    $text_width = 'wholeGridPhone';
                    $showPic = true;
                }
                
            // foreach continues
            ?>
            <div class="contentColor radius margin padding">
                <div class="grid doubleGrid">
                <p class="<?php echo $text_width; ?>">
                    <?php echo htmlspecialchars($detailedForm['text_cont']); ?>
                </p>

                <?php
                if ($showPic) : ?>
                    <?php 
                    $infos = getimagesize($path . $detailedForm['pic_path_cont']);
                    $adminClass = ($infos[0] > $infos[1]) ? 'adminImageW' : 'adminImageH';
                    ?>

                    <img 
                    src="<?php echo $path . $detailedForm['pic_path_cont']; ?>" 
                    alt="picture not found, id : <?php echo $form['pic_path_cont']; ?>" 
                    class="<?php echo $adminClass; ?> wholeGridPhone"
                    >
                <?php endif; ?>
                </div>
            
            </div>
            
            <div class="contentColor radius margin padding grid doubleGrid">
                <p>Pseudo user : </p>
                <p><?php echo htmlspecialchars($detailedUser['pseudo_user']); ?></p>

                <p>Mail user : </p>
                <p><?php echo htmlspecialchars($detailedUser['mail_user']); ?></p>

                <p>Deleted user : </p>
                <p><?php echo ($detailedUser['deleted_user']) ? 'yes' : 'no'; ?></p>

                <p>Last pseudo change : </p>
                <p><?php 
                    if ($detailedUser['lastPseudoChange'] != NULL)
                        echo date("Y / m / d", (int)$detailedUser['lastPseudoChange']); 
                    print_r($detailedUser);
                    ?>
                </p>
            </div>

            <div class="contentColor radius margin padding">
                <form action="#" method="post" class="flex spaceEven padding margin">
                    <input type="hidden" name="selected" value= "<?php echo $detailedForm['id_contact']; ?>">
                    <a href="mailto: <?php echo htmlspecialchars($detailedUser['mail_user']); ?>">
                        Answer by mail
                    </a>
                    <input type="submit" value="Delete" name="details">
                </form>
            </div>
            
        </div>
    
    </div>
</body>
</html>

<?php if(empty($selectedCont)) die(); ?>

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
            <?php
            if ($_POST['details'] === "Details") :
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
                    <div>
                        <?php 
                        $infos = getimagesize($path . $detailedForm['pic_path_cont']);
                        $adminClass = ($infos[0] > $infos[1]) ? 'adminImageW' : 'adminImageH';
                        ?>

                        <img 
                        src="<?php echo $path . $detailedForm['pic_path_cont']; ?>" 
                        alt="picture not found, id : <?php echo $form['pic_path_cont']; ?>" 
                        class="<?php echo $adminClass; ?> wholeGridPhone"
                        ><br>
                        <?php echo htmlspecialchars($detailedForm['pic_path_cont']); ?>
                    </div>
                <?php endif; ?>
                </div>
            
            </div>
            
            <div class="contentColor radius margin padding grid doubleGrid">
                <p>Posted on : </p>
                <p><?php echo date_format($postedOn, "Y / m / d") . " ; " . $daysAgo . " days ago"; ?></p>

                <p>Pseudo user : </p>
                <p><?php echo htmlspecialchars($detailedUser['pseudo_user']); ?></p>

                <p>Mail user : </p>
                <p><?php echo htmlspecialchars($detailedUser['mail_user']); ?></p>

                <p>Deleted user : </p>
                <p><?php echo ($detailedUser['deleted_user']) ? 'yes' : 'no'; ?></p>

                <p>Last pseudo change : </p>
                <p><?php 
                    if ($detailedUser['lastPseudoChange'] != NULL)
                        echo date_format($lastPseudoChange, "Y / m / d");
                    else echo 'NONE';
                    ?>
                </p>
            </div>

            <div class="contentColor radius margin padding">
                <form action="#" method="post" class="flex spaceEven padding margin">
                    <input type="hidden" name="selected" value= "<?php echo $detailedForm['id_contact']; ?>">
                    
                    <a href="mailto: <?php echo htmlspecialchars($detailedUser['mail_user']); ?>">
                        Answer by mail
                    </a>
                    <input type="submit" value="Delete" name="details" class="border">
                    <input type="submit" value="Go back" class="border">
                </form>
            </div>

            <?php elseif($_POST['details'] === "Delete") : ?>
            
                <div class="contentColor radius margin padding grid centerX">
                    <form action="#" method="post">
                        <p>Are you sure you want to delete this contact form ?</p>
                        
                        <input type="hidden" name="selected" value= "<?php echo $detailedForm['id_contact']; ?>">
                        <input type="submit" value="Confirm delete" class="button border lightRadius" name="delete">
                        
                        <input type="submit" value="Go back" class="border button lightRadius">
                    </form>
                </div>

            <?php endif; ?>
        </div>
    
    </div>
</body>
</html>

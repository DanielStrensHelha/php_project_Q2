<?php if (!isset($contactDetails) or $contactDetails) die(); ?>
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

            <div class="contentColor radius margin">
                <p class="centerX padding">Contact forms</p>                
            </div>
            
            <?php foreach($forms as $form) : 
                if ($form['pic_path_cont'] == 'NULL') {
                    $text_width = 'wholeGrid';
                    $showPic = false;
                }
                else {
                    $text_width = 'wholeGridPhone';


                    $showPic = file_exists($path . $form['pic_path_cont']) ? true : false;
                }
                
                // foreach continues
                ?>
                <div class="contentColor radius margin padding">
                    <div class="grid doubleGrid">
                    <p class="<?php echo $text_width; ?>">
                        <?php echo htmlspecialchars($form['text_cont']); ?>
                    </p>

                    <?php
                    if ($showPic) :
                        
                        $infos = getimagesize($path . $form['pic_path_cont']);
                        $adminClass = ($infos[0] > $infos[1]) ? 'adminImageW' : 'adminImageH';
                        ?>

                        <img 
                        src="<?php echo $path . $form['pic_path_cont']; ?>" 
                        alt="picture not found, id : <?php echo $form['pic_path_cont']; ?>" 
                        class="<?php echo $adminClass; ?> wholeGridPhone"
                        >

                    <?php elseif ($text_width=== 'wholeGridPhone' and !$showPic) :
                        echo '<p class="wholeGridPhone">Pictuer not found</p>';
                        
                    ?>
                    <?php endif; ?>
                    </div>
                
                    <form action="#" method="post" class="flex spaceEven padding margin topBorder">
                        <input type="hidden" name="selected" value= "<?php echo $form['id_contact']; ?>">
                        <input type="submit" value="Details" name="details" class="border">
                        <input type="submit" value="Delete" name="details" class="border">
                    </form>
                
                </div>
            <?php endforeach; ?>


            <?php include("pageManagement.php") ?>
        
        </div>
    
    </div>
</body>
</html>

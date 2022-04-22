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

        <div class="grid contactAdmin justifyStretch">
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
                    $showPic = true;
                }
            ?>
                <div class="contentColor radius margin padding">
                    <div class="grid doubleGrid">
                    <p class="<?php echo $text_width; ?>">
                        <?php echo htmlspecialchars($form['text_cont']); ?>
                    </p>

                    <?php 
                    
                    if ($showPic) : ?>
                        <?php 
                        $infos = getimagesize($path . $form['pic_path_cont']);
                        $adminClass = ($infos[0] > $infos[1]) ? 'adminImageW' : 'adminImageH';
                        ?>

                        <img 
                        src="<?php echo $path . $form['pic_path_cont']; ?>" 
                        alt="picture not found, id : <?php echo $form['pic_path_cont']; ?>" 
                        class="adminImageW"
                        >

                    <?php endif; ?>

                    </div>
                </div>
            <?php endforeach; ?>
        
        </div>
    
    </div>
    <form action="#" method="post">
        <input type="number" name="page" id="page">
        <input type="submit" value="submit" name="submit">
    </form>
</body>
</html>

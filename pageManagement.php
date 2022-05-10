<?php if ( $pages > 1) : ?>
    <div class="contentColor radius margin">
        <form action="#" method="get" class="flex spaceEven flexLign marginVert">
        
        <?php if ($pages <= 5) : 
            for ($i = 0; $i < $pages; $i++) { ?>
                <input type="submit" value="<?php echo $i+1 ?>" name="page" class="pageNumber lightRadius">
            <?php }

            else : 
                if ($page > $pages - 2)
                    $page2 = $pages - 2;
                else if ($page > 2)
                    $page2 = $page-1;
                else
                    $page2 = 2;

                if ($page < 3)
                    $page3 = 3;
                else if ($page < $pages -1)
                    $page3 = $page + 1;
                else
                    $page3 = $pages-1;
            
            ?>
                <input type="submit" value="1" name="page" class="pageNumber lightRadius">
                
                <input type="submit" value="<?php echo $page2; ?>" name="page" class="pageNumber lightRadius">
                <input type="submit" value="<?php echo $page3; ?>" name="page" class="pageNumber lightRadius">

                <input type="submit" value="<?php echo $pages; ?>" name="page" class="pageNumber lightRadius">
        <?php endif; ?>
        </form>
    </div>
<?php endif; ?>
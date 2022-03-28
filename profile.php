<div class="grid justifyCenter wholeWidth">
    <div class="contentColor margin radius grid">
        <p class=""></p>
    </div>
</div>

<div class="grid justifyCenter wholeWidth ">
    <div class="contentColor margin radius grid doubleGrid">
        <form method="post" action="disconnect.php" class="margin"
        <?php if (!isset($_SESSION['admin']) or $_SESSION['admin'] < 1) echo 'class="wholeGrid"'; ?>
        >
            <input type="submit" value="Déconnexion" name="disconnect">
        </form>
        <?php if (isset($_SESSION['admin']) and $_SESSION['admin']>0): ?>
            <a href="admin.php" class="lightRadius margin">
                <button class="wholeWidth">ADMIN</button>
            </a>
        <?php endif; ?>
    </div>
</div>
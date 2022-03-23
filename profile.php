<div class="grid justifyCenter wholeWidth centerX">
    <form method="post" action="disconnect.php" class="grid">
        <input type="submit" value="Déconnexion" name="disconnect"/>
    </form>
    
    <?php if (isset($_SESSION['admin']) and $_SESSION['admin'] > 0) : ?>
        <a href="admin.php" class="lightRadius">
            <button class="wholeWidth">ADMIN</button>
        </a>
    <?php endif; ?>
</div>
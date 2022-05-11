<div class="grid topBanner centerX">
    <div class="grid centerY centerX">
        <h1 class="bigTxt dancing">
            Guitar Heros
        </h1>
    </div>
    <div class="grid centerX centerY">
        <label for="mobile" class="mobile">Menu</label>
        <input type="checkbox" role="button" class="hidden" id="mobile"/>
        
        <div class="grid menu">
            <a id="theme" href="#" class="lightRadius"><p>🔲🔳</p></a>            
            <a href="index.php" class="belleza lightRadius"><p>Index</p></a>
            <a href="contact.php" class="belleza lightRadius"><p>Contact</p></a>
            <a href="posts.php" class="belleza lightRadius"><p>Posts</p></a>

            <form method="get" action="posts.php" class="grid centerY">
                <input type="search" placeholder="Rechercher guitariste / style" name="Research" class="lightRadius">
            </form>

        </div>

    </div>
    <div class="grid centerY">
        <a href="login.php" class="belleza lightRadius"><p> <i class='fas fa-user-alt bigTxt'></i> </p></a>
    </div>
</div>

<script>
    // Theme choice
    const themeButton = document.getElementById('theme');
    themeButton.addEventListener('click', function() {
        if (document.body.classList.contains('light')){
            document.body.classList.replace('light', 'dark');
            document.cookie = "theme = dark";
        } else {
            document.body.classList.remove('dark');
            document.body.classList.add('light');
            document.cookie = "theme = light";
        }
    });
</script>
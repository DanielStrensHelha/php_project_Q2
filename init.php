<?php
if (!isset($_SESSION)) session_start();

define('MAXLUSER', 45);
define('COST', 10);
define('PSEUDO_CHANGE', 15);
define('CONT_BY_PAGE', 3);
define('POSTS_BY_PAGE', 5);
$nbrForm = CONT_BY_PAGE;

?>
<script src='https://kit.fontawesome.com/7a200c6812.js' crossorigin='anonymous'></script>

<!-- https://www.w3schools.com/icons/fontawesome5_icons_users_people.asp -->

<script>
    function removePreload() {
        document.body.classList.remove('preload');
    }
    window.onload = removePreload;
</script>

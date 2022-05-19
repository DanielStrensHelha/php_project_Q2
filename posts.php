<?php 
/* 
SELECT 
    columnName
FROM
    table
WHERE
    columnName REGEXP pattern

    TODO - add a search box to the top of the page
*/

$pageTitle = 'Posts';
include('init.php');
include('dbConnexion.php');

$browsePosts = true;

// --------- If the user selected a post --------- // 
if (isset($_GET['id_guitarist'])) {
    //Browse through posts
    $browsePosts = false;
}

// ------------------ Verify and set the page number ---------------------- //
$page = (isset($_GET['page']) and $_GET['page'] > 0) ? $_GET['page'] : 1;

// -----------  Gather informations ------------ //
include ('postsModel.php');

// ----------- Include path for the images ------------ //
include('locationDetails/path.php');

// ----------------------- When browsing posts ----------------------- //
if ($browsePosts) {
    // Making the description shorter
    $desc = array();
    foreach($posts as $post)
        $desc[] = substr($post['wiki_hero'], 0, 400) . '...';

    $pages = ceil($guitaristCount / POSTS_BY_PAGE);


    // ------------- Like interraction ------------- //
    if(isset($_POST['like'], $_POST['id_guit'])) {
        if(in_array($_POST['id_guit'], $likedPosts) or in_array($_POST['id_guit'], $dislikedPosts))
            $sqlQuerry = "UPDATE appreciation SET likes = 1-likes WHERE id_guitarist = :id_guitarist && id_user = :id_user;";
        else
            $sqlQuerry =   "INSERT INTO appreciation (id_guitarist, id_user, likes) 
                            VALUES (:id_guitarist, :id_user, " . ($_POST['like'] === '⬆️') ? 1 : 0 . ");";

        $statement = $db->prepare($sqlQuerry);
        $statement->execute([
            'id_guitarist' => $_POST['id_guit'],
            'id_user' => $_SESSION['id_user']
        ]);
    }

    include("postsViewBrowse.php");
}
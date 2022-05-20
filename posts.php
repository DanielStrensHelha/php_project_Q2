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
    if(!empty($_POST['id_guit']) and !empty($_POST['like'])) {
        $like = ($_POST['like'] === '⬆️') ? 1 : 0;
        
        //Remove from db
        $sqlQuerry = "DELETE FROM appreciation WHERE id_user = :id_user && id_guitarist = :id_guitarist;";
        
        $statement = $db->prepare($sqlQuerry);
        $statement->execute([
            'id_user' => $_SESSION['id_user'],
            'id_guitarist' => $_POST['id_guit']
        ]);

        // Add in arrays and db
        if ($like === 1 and in_array($_POST['id_guit'], $likedPosts));
        else if($like === 0 and in_array($_POST['id_guit'], $dislikedPosts));
        else {
            $sqlQuerry = "INSERT INTO appreciation (id_user, id_guitarist, likes) VALUES (:id_user, :id_guitarist, :likes);";
            
            $statement = $db->prepare($sqlQuerry);
            $statement->execute([
                'id_user' => $_SESSION['id_user'],
                'id_guitarist' => $_POST['id_guit'],
                'likes' => $like
            ]);

            //Array managing
        }
        
        header('Location: posts.php?page=' . $page);
    }

    include("postsViewBrowse.php");
}
<?php

$pageTitle = 'Posts';
include('init.php');
include('dbConnexion.php');

$browsePosts = true;

// --------- If the user selected a post --------- // 
if (isset($_GET['guit'])) {
    //Browse through posts
    $browsePosts = false;
    $guitId = $_GET['guit'];
}

// ------------------ Verify and set the page number ---------------------- //
$page = (isset($_GET['page']) and $_GET['page'] > 0) ? $_GET['page'] : 1;

// -----------  Gather informations ------------ //
include('postsModel.php');

// ----------- Include path for the images ------------ //
include('locationDetails/path.php');


// ----------------------- When guitarist selected ----------------------- //


// ----------------------- When browsing posts ----------------------- //
if ($browsePosts) {
    // Making the description shorter
    $desc = array();
    foreach($posts as $post)
        $desc[] = substr($post['wiki_hero'], 0, 400) . '...';

    $pages = ceil($guitaristCount / POSTS_BY_PAGE);


    // ------------- Like interraction ------------- //
    if(isset($_SESSION['id_user'])) {
        if(!empty($_POST['id_guit']) and !empty($_POST['like'])) {
            $like = ($_POST['like'] === '⬆️') ? 1 : 0;
            
            //Remove from db
            $sqlQuerry = "DELETE FROM appreciation WHERE id_user = :id_user && id_guitarist = :id_guitarist;";
            
            $statement = $db->prepare($sqlQuerry);
            $statement->execute([
                'id_user' => $_SESSION['id_user'],
                'id_guitarist' => $_POST['id_guit']
            ]);

            // Add in db
            if ($like === 1 and in_array($_POST['id_guit'], $likedPosts))/* Do nothing */;
            else if($like === 0 and in_array($_POST['id_guit'], $dislikedPosts))/* Do nothing */;
            else {
                $sqlQuerry = "INSERT INTO appreciation (id_user, id_guitarist, likes) VALUES (:id_user, :id_guitarist, :likes);";
                
                $statement = $db->prepare($sqlQuerry);
                $statement->execute([
                    'id_user' => $_SESSION['id_user'],
                    'id_guitarist' => $_POST['id_guit'],
                    'likes' => $like
                ]);

            }
            
            header('Location: posts.php?page=' . $page . ((isset($_GET['sort'])) ? '&sort=' . $_GET['sort'] : ''));
        }
    }

    include("postsViewBrowse.php");
}
else {
    include('iframeManagement.php');
    include("postsViewGuitarist.php");
}
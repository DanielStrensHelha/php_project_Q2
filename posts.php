<?php
$pageTitle = 'Posts';
include('init.php');
include('dbConnexion.php');

$browsePosts = true;

// ----------------------- When guitarist selected ----------------------- //
if (!empty($_GET['guit'])) {
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

// ------------- Delete comments ---------------- //
if (isset($_POST['delete'])) {
    if ((isset($_SESSION['admin']) and $_SESSION['admin'] > 0) or $_SESSION['id_user'] === $_POST['id_user_comment']) {
        $sqlQuerry = "DELETE FROM comments WHERE id_comments = :id_comment;";
        $statement = $db->prepare($sqlQuerry);
        $statement->execute([
            'id_comment' => $_POST['id_comment']
        ]);
        header('Location: posts.php?guit=' . $_GET['guit']);
    }
}


// ------------- Add comments ---------------- //
if (isset($_POST['comm'], $_GET['guit'], $_SESSION['id_user'])) {
    // Verify comment size
    if (strlen($_POST['comm']) > 750)
        $problemComm = 'Your comment is too long.';
    else {
        $sqlQuerry = "INSERT INTO comments (id_user, id_guitarist, text_com)
                      VALUES (:id_user, :id_guitarist, :comment);";
        $statement = $db->prepare($sqlQuerry);
        $statement->execute([
            'id_user' => $_SESSION['id_user'],
            'id_guitarist' => $_GET['guit'],
            'comment' => $_POST['comm']
        ]);

        header('Location: posts.php?guit=' . $_GET['guit']);
    }
}

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
        print_r($_POST);
        echo '<br> likes = $like';
        echo '<br> tableau dislike ';
        print_r($dislikedPosts);

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
        
        header('Location: posts.php?page=' . $page . 
        '&search=' . $_POST['search'] . 
        '&guit=' . (isset($_POST['id_guit_selected']) ? $_POST['id_guit_selected'] : '' ));
    }
}

// ----------------------- When browsing posts ----------------------- //
if ($browsePosts) {
    // Making the description shorter
    $desc = array();
    foreach($posts as $post)
        $desc[] = substr($post['wiki_hero'], 0, 400) . '...';

    $pages = ceil($guitaristCount / POSTS_BY_PAGE);

    include("postsViewBrowse.php");
}
else {
    include('iframeManagement.php');
    include("postsViewGuitarist.php");
}
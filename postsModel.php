<?php
// If user didn't select a post yet :
if($browsePosts) {
    // get posts from data base
    include('dbConnexion.php');

    $sort = 'AVG(appreciation.likes) DESC';
    if(!empty($_GET['sort'])) {
        switch ($_GET['sort']) {
            case 'name_sort':
                $sort = 'name_guit ASC';
                break;
            case 'most_commented_sort':
                $sort = "COUNT(comments.id_guitarist) DESC";
                break;
        }
    }
// TODO : Veryfi that sum works
    // Get the guitarists 
    $sqlQuerry =    "SELECT thumbnail_guit, guitarist.id_guitarist, name_guit, wiki_hero, 
                        AVG(appreciation.likes) AS appreciation, 
                        COUNT(comments.id_guitarist) AS comments,
                        SUM(appreciation.likes) AS likes,
                        COUNT(appreciation.likes) AS appreciation_count
                    FROM guitarist
                    LEFT JOIN appreciation ON guitarist.id_guitarist = appreciation.id_guitarist
                    LEFT JOIN comments ON guitarist.id_guitarist = comments.id_guitarist
                    GROUP BY guitarist.id_guitarist
                    ORDER BY $sort
                    LIMIT :startPost, :numberOfPosts;
                    ";
    
    $statement = $db->prepare($sqlQuerry);
    
    $statement->bindValue('startPost', ($page - 1) * POSTS_BY_PAGE, PDO::PARAM_INT);
    $statement->bindValue('numberOfPosts', POSTS_BY_PAGE, PDO::PARAM_INT);
    
    $statement->execute();

    $posts = $statement->fetchAll();

    // get the count of posts to show
    $sqlQuerry =    "SELECT COUNT(*) AS count FROM guitarist;";
    
    $statement = $db->prepare($sqlQuerry);
    $statement->execute();

    $guitaristCount = $statement->fetch()['count'];

    
    // ------------- Get the liked posts ------------- //
    $sqlQuerry =    "SELECT id_guitarist FROM appreciation WHERE id_user = :id_user && likes = 1;";
    
    $statement = $db->prepare($sqlQuerry);
    $statement->execute([
        'id_user' => $_SESSION['id_user']
    ]);

    $temp = $statement->fetchAll();

    $likedPosts = array();
    foreach($temp as $key => $value)
        $likedPosts[] = $value['id_guitarist'];
    
    // Get the disliked posts
    $sqlQuerry =    "SELECT id_guitarist FROM appreciation WHERE id_user = :id_user && likes = 0;";

    $statement = $db->prepare($sqlQuerry);
    $statement->execute([
        'id_user' => $_SESSION['id_user']
    ]);

    $temp = $statement->fetchAll();

    $dislikedPosts = array();
    foreach($temp as $key => $value)
        $dislikedPosts[] = $value['id_guitarist'];
}

<?php
// If user didn't select a post yet :
if($browsePosts) {
    // get posts from data base

    $sort = 'appreciation_avg DESC';
    if(!empty($_GET['sort'])) {
        switch ($_GET['sort']) {
            case 'name_sort':
                $sort = 'name_guit ASC';
                break;
            case 'most_commented_sort':
                $sort = "comments_count DESC";
                break;
        }
    }
    
    // Get the guitarists 
    $sqlQuerry =    "SELECT thumbnail_guit, guitarist.id_guitarist, name_guit, wiki_hero,
                        (SELECT AVG(appreciation.likes) FROM appreciation WHERE appreciation.id_guitarist = guitarist.id_guitarist) 
                        AS appreciation_avg, 
                        
                        (SELECT SUM(appreciation.likes) FROM appreciation WHERE appreciation.id_guitarist = guitarist.id_guitarist)
                        AS likes,
                        
                        (SELECT COUNT(appreciation.likes) FROM appreciation WHERE appreciation.id_guitarist = guitarist.id_guitarist)
                        AS appreciation_count,
                        
                        (SELECT COUNT(comments.id_guitarist) FROM comments WHERE comments.id_guitarist = guitarist.id_guitarist)
                        AS comments_count
                    
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
    $idUser = (!empty($_SESSION['id_user'])) ? $_SESSION['id_user'] : -1;
    
    $sqlQuerry =    "SELECT id_guitarist FROM appreciation WHERE id_user = :id_user && likes = 1;";
    
    $statement = $db->prepare($sqlQuerry);
    $statement->execute([
        'id_user' => $idUser
    ]);

    $temp = $statement->fetchAll();

    $likedPosts = array();
    foreach($temp as $key => $value)
        $likedPosts[] = $value['id_guitarist'];
    
    // Get the disliked posts
    $sqlQuerry = "SELECT id_guitarist FROM appreciation WHERE id_user = :id_user && likes = 0;";

    $statement = $db->prepare($sqlQuerry);
    $statement->execute([
        'id_user' => $idUser
    ]);

    $temp = $statement->fetchAll();

    $dislikedPosts = array();
    foreach($temp as $key => $value)
        $dislikedPosts[] = $value['id_guitarist'];
}

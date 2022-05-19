<?php
// If user didn't select a post yet :
if($browsePosts) {
    // get posts from data base
    include('dbConnexion.php');

    $sort = 'AVG(appreciation.likes) DESC';
    if(!empty($_POST['sort'])) {
        switch ($_POST['sort']) {
            case 'name_sort':
                $sort = 'name_guit ASC';
                break;
            case 'most_commented_sort':
                $sort = "COUNT(comments.id_guitarist) DESC";
                break;
        }
    }

    // Get the guitarists
    $sqlQuerry =    "SELECT thumbnail_guit, guitarist.id_guitarist, name_guit, wiki_hero, 
                        AVG(appreciation.likes) AS likes, 
                        COUNT(comments.id_guitarist) AS comments
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
    $sqlQuerry =    "SELECT COUNT(*) FROM guitarist;";
    
    $statement = $db->prepare($sqlQuerry);
    $statement->execute();

    $guitaristCount = $statement->fetch()['COUNT(*)'];
}

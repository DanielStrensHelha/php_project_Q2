<?php
// If user didn't select a post yet :
if($browsePosts) {
    // get posts from data base
    include('dbConnexion.php');

    // Get the guitarists
    $sqlQuerry =    "SELECT thumbnail_guit, guitarist.id_guitarist, name_guit, wiki_hero, AVG(appreciation.likes) AS likes
                    FROM guitarist
                    LEFT JOIN appreciation ON guitarist.id_guitarist = appreciation.id_guitarist
                    GROUP BY guitarist.id_guitarist
                    ORDER BY AVG(appreciation.likes) DESC
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

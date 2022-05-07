<?php
// If user didn't select a post yet :
if($browsePosts) {
    // get posts from data base
    include('dbConnexion.php');

    $sqlQuerry = "SELECT * FROM guitarist LIMIT :startPost, :numberOfPosts";
    $statement = $db->prepare($sqlQuerry);
    
    $statement->bindValue('startPost', ($page - 1) * POSTS_BY_PAGE, PDO::PARAM_INT);
    $statement->bindValue('numberOfPosts', POSTS_BY_PAGE, PDO::PARAM_INT);
    
    $statement->execute();

    $posts = $statement->fetchAll();


}
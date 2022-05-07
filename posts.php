<?php 
/* 
SELECT 
    columnName
FROM
    table
WHERE
    columnName REGEXP pattern
*/ 

$pageTitle = 'Posts';
include('init.php');

$browsePosts = false;

// If user didn't select a post yet : 
if (!isset($_GET['id_guitarist'])) {
    //Browse through posts
    $browsePosts = true;

    // Verify and set the page number
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;


}



include ('postsModel.php');
// Making the description shorter
$desc = array();
foreach($posts as $post) {

   $desc[] = substr($post['wiki_hero'], 0, 500) . '...';

}


include('locationDetails/path.php');
include("postsView.php");
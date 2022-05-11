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

$browsePosts = false;

// If user didn't select a post yet : 
if (!isset($_GET['id_guitarist'])) {
    //Browse through posts
    $browsePosts = true;

    // Verify and set the page number
    $page = (isset($_GET['page']) and $_GET['page'] > 0) ? $_GET['page'] : 1;

}

// Gatter informations
include ('postsModel.php');

// Making the description shorter
$desc = array();
foreach($posts as $post)
   $desc[] = substr($post['wiki_hero'], 0, 400) . '...';

// Include path for the images
include('locationDetails/path.php');

// If browsing
if ($browsePosts) {
    $pages = ceil($guitaristCount / POSTS_BY_PAGE);

    // getting the forms needed for current page
    $minForm = CONT_BY_PAGE * ($page-1);

    $checked = (isset($_POST['sort'])) ? true : false;
                    

    include("postsViewBrowse.php");
}
<?php
$pageTitle = 'Index';

// PHP code that will test the existence of the dataBase
// If the dataBase doesn't exist, it will ask if the user wants to create it

try {
    include('locationDetails/db.php');
    $db = new PDO(
        'mysql:host=localhost;dbname=' . $dbName . ';charset=utf8',
        $dbUser,
        $dbPassword,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ],
    );
    

    $statement = $db->prepare('SELECT * FROM users;');
    $statement->execute();

    require('init.php');
    require("indexView.php");

    require('clot.php');
}

// If there is an error
catch (PDOexception $e) {
    echo 'Server side problem = ' . $e;
    

    if(isset($_POST['submit'])) :
        require('sql/dbCreation.php');
        $stm = $db->prepare($sqlTableCreation);
        $stm->execute();
        echo '<br><br>tables Created ! Refresh the page to continue';


    else :


    ?>
    <div>
        <h1>No table found</h1>
        <p>
            Welcome to Daniel Strens's website ! It's currently beeing worked on. <br>
            This is a first year IT PHP project, it runs on PHP, HTML and CSS and a small bit of java script is used to 
            change the theme of the website. <br>
            <br>
            It seems like you don't have a 'guitarheros' SQL data base OR don't have the required tables in it. <br><br>
            You can fix this issue by opening xampp (if you forgot to) and make sure to add a 'guitarheros' data base. <br><br>

        </p>
        <h2>
            If you downloaded this project from github : <br>
        </h2>
        <p>
            You need to add a folder named 'locationDetails' at the root of this project directory <br>
            You also need to add a folder 'uploads' which will contain the uploaded images of the website. This folder can be anywhere<br>
            Then add a file named 'db.php' in 'locationDetails' and type in<br>
            &lt;?php <br>
            $dbPassword = ' ';<br>
            $dbName = 'guitarheros'; <br>
            $dbUser = 'root'; <br><br>
            Replace the password and user if needed <br><br>
            Then add a file named 'path.php' still in 'locationDetails' and type in<br>
            &lt;?php <br>
            $path = 'uploads/';<br><br>
            Replace 'uploads/' with the path (absolute or relative) to the folder where you store the uploaded files.
            
            To automatically create the necessary tables, click on this button :
            <form action="#" method="post">
                <input type="submit" value="Create tables" name="submit">
            </form>
        </p>
    </div>


<?php endif; }
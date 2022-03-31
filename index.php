<?php
$pageTitle = 'Index';


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
    
    $statement = $db->prepare('SELECT * FROM users WHERE id_user=1');
    $statement->execute();
    $result = $statement->fetch();


    require('init.php');
    require("indexView.php");

    require('clot.php');
}
catch (PDOexception $e) {
    echo 'Server side problem = ' . $e;

    if(isset($_POST['submit'])) :
        include('dbCreation.php');
        $stm = $db->prepare($sqlTableCreation);
        $stm->execute();
        echo '<br><br>tables Created !';


    else :


    ?>
    <div>
        <h1>No table found</h1>
        <p>
            It seems like you don't have a 'guitarheros' SQL data base OR don't have the required tables in it. <br><br>
            You can fix this issue by opening xampp (if you forgot to) and make sure to add a 'guitarheros' data base. <br><br>
            You need to add a folder named 'locationDetails' at the root of this project directory <br>
            Then add a file named 'db.php' and type <br>
            &lt;?php <br>
            $dbPassword = ' ';<br>
            $dbName = 'guitarheros'; <br>
            $dbUser = 'root'; <br><br>
            Replace the password and user if needed <br><br>
            
            To create the necessary tables, click on this button :
            <form action="#" method="post">
                <input type="submit" value="Create tables" name="submit">
            </form>
        </p>
    </div>


<?php
    endif;
}
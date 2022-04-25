<?php 
// counting the contact forms
$sqlQuerry = "SELECT COUNT(*) FROM contact";
$statement = $db->prepare($sqlQuerry);
$statement -> execute();

$formCount = $statement->fetch()['COUNT(*)'];

// current page 
$pages = ceil($formCount / CONT_BY_PAGE );

$page = (isset($_GET['page']) and $_GET['page'] > 0) ? $_GET['page'] : 1;

// getting the forms needed for current page
$minForm = CONT_BY_PAGE * ($page-1);

$sqlQuerry = 'SELECT * FROM contact ORDER BY date_time_cont ASC LIMIT :minForm, :nbrForm';
$statement = $db -> prepare($sqlQuerry);

$statement -> bindParam('minForm', $minForm, PDO::PARAM_INT);
$statement -> bindParam('nbrForm', $nbrForm, PDO::PARAM_INT);

$statement -> execute();

$forms = $statement->fetchAll();

// detailed form
if (!empty($_POST['details']) and isset($_POST['selected'])) {
    if ($_POST['details'] === 'Details' or $_POST['details'] === 'Delete') {
        $sqlQuerry = 'SELECT * FROM contact WHERE id_contact = :idCont';
        $statement = $db -> prepare($sqlQuerry);
        $statement -> execute([
            'idCont' => $_POST['selected']
        ]);
        
        $detailedForm = $statement->fetch();

        $sqlQuerry = 'SELECT id_user, pseudo_user, mail_user, deleted_user, lastPseudoChange FROM users WHERE id_user = :userId';
        $statement = $db -> prepare($sqlQuerry);
        $statement -> execute([
            'userId' => $detailedForm['id_user']
        ]);

        $detailedUser = $statement->fetch();

        $lastPseudoChange = date_create($detailedUser['lastPseudoChange'], timezone_open('Europe/Brussels'));
    }
}
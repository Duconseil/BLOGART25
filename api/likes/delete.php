<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$numMemb = ctrlSaisies($_POST['numMemb']);
$numArt = ctrlSaisies($_POST['numArt']);

// Suppression du like dans la base de données
sql_delete('LIKEART', "numMemb = $numMemb AND numArt = $numArt");

// Redirection vers la liste des likes après suppression
header('Location: ../../views/backend/likes/list.php');
exit();
?>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$numMemb = ctrlSaisies($_POST['numMemb']);
$numArt = ctrlSaisies($_POST['numArt']);
$likeA = ctrlSaisies($_POST['likeA']);

// Mise à jour du like dans la base de données
sql_update(
    'LIKEART', 
    'likeA = ' . $likeA, 
    'numMemb = ' . $numMemb . ' AND numArt = ' . $numArt
);

// Redirection vers la liste des likes après modification
header('Location: ../../views/backend/likes/list.php');
exit();
?>
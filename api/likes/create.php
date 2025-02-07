<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$numMemb = ctrlSaisies($_POST['numMemb']);
$numArt = ctrlSaisies($_POST['numArt']);
$likeA = ctrlSaisies($_POST['likeA']);

if ($likeA !== "1" && $likeA !== "0") {
    die("Erreur : 'likeA' doit être 1 ou 0.");
}
$likeA = (int)$likeA;  

$existingLike = sql_select('LIKEART', '*', "numMemb = $numMemb AND numArt = $numArt");

if ($existingLike) {
    sql_update('LIKEART', "likeA = $likeA", "numMemb = $numMemb AND numArt = $numArt");
} else {
    sql_insert('LIKEART', 'numMemb, numArt, likeA', "$numMemb, $numArt, $likeA");
}

header('Location: ../../views/backend/likes/list.php');
exit();
?>
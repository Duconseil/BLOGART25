<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

date_default_timezone_set('UTC+1');
$numMemb = addslashes($_GET['numMemb']);
$pseudoMemb = addslashes($_POST['pseudoMemb']);
$prenomMemb = addslashes($_POST['prenomMemb']);
$nomMemb = addslashes($_POST['nomMemb']);
$eMailMemb = addslashes($_POST['eMailMemb']);
$numStat = addslashes($_POST['numStat']);

if (!empty($_POST['passMemb'])) {
    $passMemb = password_hash(addslashes($_POST['passMemb']), PASSWORD_DEFAULT);
    $update_query = "`pseudoMemb`='$pseudoMemb', `prenomMemb`='$prenomMemb', `nomMemb`='$nomMemb', `eMailMemb`='$eMailMemb', `numStat`='$numStat', `passMemb`='$passMemb'";
} else {
    $update_query = "`pseudoMemb`='$pseudoMemb', `prenomMemb`='$prenomMemb', `nomMemb`='$nomMemb', `eMailMemb`='$eMailMemb', `numStat`='$numStat'";
}

$sql_result = sql_update('MEMBRE', $update_query, "`numMemb`='$numMemb'");

if ($sql_result) {
    header('Location: /views/backend/members/list.php'); // Correction du chemin absolu
    exit;
} else {
    echo "Une erreur est survenue lors de la mise à jour du membre.";
}
?>

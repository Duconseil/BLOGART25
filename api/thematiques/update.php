<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$libThem = ctrlSaisies($_POST['libThem']);
$numThem = ctrlSaisies($_POST['numThem']);

// Décoder les entités HTML pour stocker du texte brut
$libThem = html_entity_decode($libThem, ENT_QUOTES, 'UTF-8');

// Échapper les apostrophes pour éviter les erreurs SQL
$libThem = addslashes($libThem);

sql_update('THEMATIQUE', "libThem = '$libThem'", "numThem = $numThem");

header('Location: ../../views/backend/thematiques/list.php');
exit();
?>
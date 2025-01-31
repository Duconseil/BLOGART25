<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$libThem = ctrlSaisies($_POST['libThem']);

// Vérification si le champ est vide
if (empty($libThem)) {
    header('Location: ../../views/backend/thematique/create.php?error=empty');
    exit;
}

// Insertion de la thématique
sql_insert('THEMATIQUE', 'libThem', "'$libThem'");

header('Location: ../../views/backend/thematiques/list.php');
exit;
?>

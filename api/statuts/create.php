<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$libStat = ctrlSaisies($_POST['libStat']);

if (empty($libStat)) {
    header('Location: ../../views/backend/statuts/create.php?error=empty');
    exit;
}

sql_insert('STATUT', 'libStat', "'$libStat'");


header('Location: ../../views/backend/statuts/list.php');
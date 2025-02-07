<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$libMotCle = ctrlSaisies($_POST['libMotCle']);

if (empty($libMotCle)) {
    header('Location: ../../views/backend/keywords/create.php?error=empty');
    exit;
}

sql_insert('MOTCLE', 'libMotCle', "'$libMotCle'");

header('Location: ../../views/backend/keywords/list.php');
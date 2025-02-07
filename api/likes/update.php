<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

$libLike = addslashes($_POST['libLike']);
$numLike = addslashes($_POST['numLike']);


sql_update('LIEKART', 'libLike ="' . $libLike . '"', 'numLike =' . $numLike);

header('Location: ../../views/backend/likes/list.php');
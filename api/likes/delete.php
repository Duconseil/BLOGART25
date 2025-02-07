<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

$numLike = addslashes($_POST['numLike']);

sql_delete('LIKEART', "numLike = $numLike");

header('Location: ../../views/backend/likes/list.php');
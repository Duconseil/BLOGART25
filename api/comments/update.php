<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';
require_once '../../functions/query/update.php';

// Debugging: Dump the $_POST array to check data
var_dump($_POST);

// Extract POST data
extract($_POST);

// Sanitize inputs
$numCom = ctrlSaisies($numCom);
$libCom = ctrlSaisies($libCom);
$attModOK = ctrlSaisies($attModOK);
$notifComKOAff = ctrlSaisies($notifComKOAff);

// Sanitize 'dellogiq' and handle potential null values
$dellogiq = isset($dellogiq) ? ctrlSaisies($dellogiq) : 0;  // Default to 0 if not set
$dtModCom = date("Y-m-d-H-i-s");

// If 'dellogiq' should be an integer and it's empty or invalid, set it to 0
if (empty($dellogiq) || !is_numeric($dellogiq)) {
    $dellogiq = 0;  // Ensure it is an integer
}

// Update the comment in the database
sql_update('comment', 
    "libCom = '$libCom', attModOK='$attModOK', notifComKOAff='$notifComKOAff', dellogiq='$dellogiq', dtModCom='$dtModCom'", 
    "numCom = $numCom");

// Redirect to the comments list page
header('Location: ../../views/backend/comments/list.php');

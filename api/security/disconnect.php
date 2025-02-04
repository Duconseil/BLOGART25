<?php
session_start();

if (isset($_SESSION["pseudonyme"])) {
    session_unset();
    session_destroy();
}

header("Location: ../../../header.php");
exit();
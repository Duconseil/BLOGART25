<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numMotCle = ctrlSaisies($_POST['numMotCle']);
    $libMotCle = ctrlSaisies($_POST['libMotCle']);

    if (!empty($numMotCle) && !empty($libMotCle)) {
        sql_update('MOTCLE', "libMotCle = '$libMotCle'", "numMotCle = $numMotCle");

        header('Location: ../../views/backend/keywords/list.php');
        exit();
    } else {
        echo "Les champs sont vides. Veuillez réessayer.";
    }
}
?>

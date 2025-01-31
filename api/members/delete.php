<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

if (isset($_POST['number'])) {
    $numMemb = addslashes($_POST['number']);

    // Vérifier si le membre existe avant de tenter de le supprimer
    $existingMember = sql_select("MEMBRE", "*", "numMemb = $numMemb");
    
    if (!empty($existingMember)) {
        // Supprimer le membre seulement s'il existe
        sql_delete('MEMBRE', "numMemb = $numMemb");
        header('Location: ../../views/backend/members/list.php');
        exit();
    } else {
        echo "Le membre avec l'id $numMemb n'existe pas.";
        exit();
    }
} else {
    echo "L'id du membre à supprimer n'est pas spécifié.";
    exit();
}
?>
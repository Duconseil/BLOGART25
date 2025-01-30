<?php
// Inclure les fichiers nécessaires
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

// Vérifier si les données sont envoyées via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire et les sécuriser
    $numMotCle = ctrlSaisies($_POST['numMotCle']);
    $libMotCle = ctrlSaisies($_POST['libMotCle']);

    // Vérifier que les données sont valides
    if (!empty($numMotCle) && !empty($libMotCle)) {
        // Mettre à jour la base de données
        sql_update('MOTCLE', "libMotCle = '$libMotCle'", "numMotCle = $numMotCle");

        // Rediriger après la mise à jour
        header('Location: ../../views/backend/keywords/list.php');
        exit();
    } else {
        // Gérer l'erreur si les champs sont vides
        echo "Les champs sont vides. Veuillez réessayer.";
    }
}
?>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

// Nettoyer les données envoyées par le formulaire
$numMemb = ctrlSaisies($_POST['numMemb']);
$numArt = ctrlSaisies($_POST['numArt']);
$likeA = ctrlSaisies($_POST['likeA']);

// Vérification que 'likeA' est un entier valide (0 ou 1)
if ($likeA !== "1" && $likeA !== "0") {
    die("Erreur : 'likeA' doit être 1 ou 0.");
}
$likeA = (int)$likeA;  // Convertir 'likeA' en entier (0 ou 1)

// Vérification si le like existe déjà dans la base de données
$existingLike = sql_select('LIKEART', '*', "numMemb = $numMemb AND numArt = $numArt");

if ($existingLike) {
    // Si le like existe déjà, on le met à jour
    sql_update('LIKEART', "likeA = $likeA", "numMemb = $numMemb AND numArt = $numArt");
} else {
    // Si le like n'existe pas, on l'insère
    sql_insert('LIKEART', 'numMemb, numArt, likeA', "$numMemb, $numArt, $likeA");
}

// Redirection après l'insertion ou la mise à jour
header('Location: ../../views/backend/likes/list.php');
exit();
?>
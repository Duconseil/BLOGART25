<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

// Afficher tout le contenu de $_POST pour vérifier que les données sont envoyées correctement
echo "<pre>";
print_r($_POST); // Affiche les données envoyées pour nous aider à déboguer
echo "</pre>";

// Vérification si le formulaire a été soumis via la méthode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si le champ 'libLikes' est bien défini et non vide
    if (isset($_POST['libLikes']) && !empty(trim($_POST['libLikes']))) {
        // Récupérer les données envoyées par le formulaire
        $numMemb = addslashes(trim($_POST['numMemb']));
        $numArt = addslashes(trim($_POST['numArt']));
        $libLikes = addslashes(trim($_POST['libLikes']));

        // Affichage des valeurs récupérées pour vérification
        echo "<pre>";
        echo "numMemb: $numMemb\n";
        echo "numArt: $numArt\n";
        echo "libLikes: $libLikes\n";
        echo "</pre>";

        // Si vous n'avez pas d'erreur jusqu'ici, l'insertion dans la base de données peut être effectuée
        // Construction de la requête d'insertion
        $result = sql_insert('LIKEART', 'numMemb, numArt, libLikes', "'$numMemb', '$numArt', '$libLikes'");

        // Vérifier si l'insertion a réussi
        if ($result) {
            echo "L'insertion a réussi!";
            // Rediriger vers la liste des likes
            header('Location: ../../views/backend/likes/list.php');
            exit;
        } else {
            echo "Erreur : L'insertion dans la base de données a échoué.";
            exit;
        }
    } else {
        // Si 'libLikes' est manquant ou vide, afficher un message d'erreur
        echo "Erreur : Le champ 'libLikes' est manquant ou vide. Assurez-vous d'avoir rempli ce champ dans le formulaire.";
        exit;
    }
} else {
    // Si ce n'est pas une requête POST, afficher un message d'erreur
    echo "Erreur : Le formulaire n'a pas été soumis correctement.";
    exit;
}
?>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

echo "<pre>";
print_r($_POST); 
echo "</pre>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['libLikes']) && !empty(trim($_POST['libLikes']))) {
        $numMemb = addslashes(trim($_POST['numMemb']));
        $numArt = addslashes(trim($_POST['numArt']));
        $libLikes = addslashes(trim($_POST['libLikes']));

        echo "<pre>";
        echo "numMemb: $numMemb\n";
        echo "numArt: $numArt\n";
        echo "libLikes: $libLikes\n";
        echo "</pre>";

        $result = sql_insert('LIKEART', 'numMemb, numArt, libLikes', "'$numMemb', '$numArt', '$libLikes'");

        if ($result) {
            echo "L'insertion a réussi!";
            header('Location: ../../views/backend/likes/list.php');
            exit;
        } else {
            echo "Erreur : L'insertion dans la base de données a échoué.";
            exit;
        }
    } else {
        echo "Erreur : Le champ 'libLikes' est manquant ou vide. Assurez-vous d'avoir rempli ce champ dans le formulaire.";
        exit;
    }
} else {
    echo "Erreur : Le formulaire n'a pas été soumis correctement.";
    exit;
}
?>

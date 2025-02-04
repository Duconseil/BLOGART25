<?php
// Inclure le fichier de connexion ou initialisation de la base de données
include '../../../header.php';

global $DB;

// Vérifiez si la connexion à la base de données est déjà initialisée
if ($DB === null) {
    try {
        $DB = new PDO('mysql:host=localhost;dbname=BLOGART25', 'root', 'root', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]);
    } catch (PDOException $e) {
        die("Impossible de se connecter à la base de données: " . $e->getMessage());
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["pseudoMemb"]) && !empty($_POST["mot_de_passe"])) {
        $pseudoMemb = trim($_POST["pseudoMemb"]);
        $passMemb = trim($_POST["mot_de_passe"]);

        try {
            // Vérifier si le pseudo existe
            $sql = "SELECT * FROM membre WHERE pseudoMemb = :pseudoMemb";
            $stmt = $DB->prepare($sql);
            $stmt->execute(['pseudoMemb' => $pseudoMemb]);
            $user = $stmt->fetch();

            if ($user) {
                // Vérifier le mot de passe avec password_verify
                if (password_verify($passMemb, $user['passMemb'])) {
                    session_start();
                    $_SESSION['pseudoMemb'] = $user['pseudoMemb'];
                    $_SESSION['prenomMemb'] = $user['prenomMemb'];
                    $_SESSION['nomMemb'] = $user['nomMemb'];
                    header("Location: http://localhost:8888?message=connexion_reussie");
                    exit;
                } else {
                    echo "<p style='color:red;'>Mot de passe incorrect.</p>";
                }
            } else {
                echo "<p style='color:red;'>Pseudo non trouvé.</p>";
            }
        } catch (PDOException $e) {
            echo "<p style='color:red;'>Erreur de requête : " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p style='color:red;'>Veuillez remplir tous les champs.</p>";
    }
}
?>

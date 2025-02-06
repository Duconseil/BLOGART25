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
    // Vérification des informations de connexion
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
                    $_SESSION['numStat'] = $user['numStat'];  // Ajout du statut de l'utilisateur

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

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function togglePassword(id) {
            var input = document.getElementById(id);
            input.type = (input.type === "password") ? "text" : "password";
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Connexion</h1>
        <form action="login.php" method="post" class="form-container">
            <div class="form-group">
                <label for="pseudoMemb">Pseudo</label>
                <input type="text" name="pseudoMemb" placeholder="Pseudonyme" minlength="6" required>
            </div>

            <div class="form-group">
                <label for="mot_de_passe">Mot de passe</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Mot de passe" minlength="8" maxlength="15" required>
                <p>(8-15 caractères, une majuscule, une minuscule, un chiffre, un caractère spécial)</p>
                <input type="checkbox" onclick="togglePassword('mot_de_passe')"> Afficher Mot de passe
            </div>

            <div class="form-group">
                <button type="submit">Se connecter</button>
            </div>
        </form>
    </div>

    <?php
    // Vérification de l'authentification et de l'affichage du bouton Admin
    if (isset($_SESSION['pseudoMemb']) && $_SESSION['numStat'] != 3) {
        echo '<button class="admin-button"><a href="admin_dashboard.php">Accéder à l\'Admin</a></button>';
    }
    ?>

</body>
</html>

<style>
    body {
        font-family: Arial, sans-serif;
        text-align: center;
        padding: 20px;
        background-color: #f4f4f4;
    }

    .form-container {
        width: 50%;
        margin: 0 auto;
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 15px;
        text-align: left;
    }

    .form-group input, .form-group button {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .form-group button {
        background-color: #007bff;
        color: white;
        cursor: pointer;
    }

    .form-group button:hover {
        background-color: #0056b3;
    }

    .admin-button {
        margin-top: 20px;
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 16px;
    }

    .admin-button:hover {
        background-color: #218838;
    }
</style>

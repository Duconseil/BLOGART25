<?php
// Inclure le fichier de connexion ou initialisation de la base de données
include '../../../header.php';

global $DB;

$password = $_POST["mot_de_passe"];
$pseudo = $_POST["pseudoMemb"];

// Récupère l'utilisateur depuis la base de données
$connexion = sql_select('MEMBRE', "*", "pseudoMemb = '$pseudo'");


if ($connexion && $connexion[0]) {
    $membre = $connexion[0];


    $hashedPassword = $membre[4];

    if (password_verify($password, $hashedPassword)) {
        echo"okk";
        
        $_SESSION['id'] = $connexion[0]['numMemb'];
        //header('Location: ../../index.php');
        $_SESSION['pseudo'] = $connexion[0]['pseudoMemb'];
        $_SESSION['statut'] = $connexion[0]['numStat'];
        $_SESSION['flash']['danger'] = 'Vous êtes connecté';
    } else {
        echo"non";

        header('Location: ../../views/backend/security/login.php');

    }
} else {
    echo "L'utilisateur n'existe pas.";
}
var_dump($_SESSION);
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

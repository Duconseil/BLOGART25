<?php
// Inclure le fichier de connexion ou initialisation de la base de données
include '../../../header.php';

global $DB; // Assurez-vous que cette variable contient la connexion PDO

// Vérifiez si la connexion à la base de données est déjà initialisée
if ($DB === null) {
    // Exemple de connexion à la base de données avec MAMP (remplacez les valeurs par les vôtres si nécessaire)
    try {
        // Remplacez 'your_db_name', 'root', 'root' par les informations réelles de votre base de données
        $DB = new PDO('mysql:host=localhost;dbname=BLOGART25', 'root', 'root');
        $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // Si la connexion échoue, affichez le message d'erreur
        die("Impossible de se connecter à la base de données: " . $e->getMessage());
    }
}

$se_souvenir = isset($_POST["se_souvenir"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifiez si le pseudoMembnyme et le mot de passe sont renseignés
    if (!empty($_POST["pseudoMembnyme"]) && !empty($_POST["mot_de_passe"])) {
        $pseudoMemb = trim($_POST["pseudoMembnyme"]);
        $passMemb = sha1(trim($_POST["mot_de_passe"])); // Hasher le mot de passe pour la comparaison sécurisée

        // Requête sécurisée pour vérifier le pseudoMembnyme et le mot de passe
        try {
            $sql = "SELECT * FROM membre WHERE passMemb = :mot_de_passe AND pseudoMemb = :pseudoMemb";
            $stmt = $DB->prepare($sql);
            $stmt->execute(['pseudoMemb' => $pseudoMemb, 'mot_de_passe' => $passMemb]);
            $user = $stmt->fetch();

            // Traitement du résultat de la requête
            if ($user) {
                if ($user["code_email"] != null) {
                    echo "<p style='color:red;'>L'utilisateur n'a pas activé son compte par email.</p>";
                } else {
                    // Démarrer la session et enregistrer le pseudoMembnyme
                    session_start();
                    $_SESSION["pseudoMembnyme"] = $pseudoMemb;

                    // Générer un code de cookie unique
                    $code_cookie = passMemb(uniqid(), PASSWORD_DEFAULT);
                    if ($se_souvenir) {
                        // Si "se souvenir de moi" est activé, définir un cookie valide pendant 30 jours
                        setcookie("code_cookie", $code_cookie, time() + (30 * 24 * 3600), "/", "", false, true);
                    }

                    // Mise à jour du code_cookie dans la base de données
                    $sql = "UPDATE membre SET code_cookie = :code_cookie WHERE pseudoMemb = :pseudoMemb";
                    $stmt = $DB->prepare($sql);
                    $stmt->execute(['pseudoMemb' => $pseudoMemb, 'code_cookie' => $code_cookie]);

                    // Redirection après la connexion réussie
                    header("Location: ../../../header.php");
                    exit();
                }
            } else {
                // Si les identifiants sont incorrects
                echo "<p style='color:red;'>Pseudonyme ou mot de passe incorrect.</p>";
            }
        } catch (PDOException $e) {
            echo "<p style='color:red;'>Erreur de requête : " . $e->getMessage() . "</p>";
        }
    } else {
        // Si le pseudoMembnyme ou le mot de passe est manquant
        echo "<p style='color:red;'>Veuillez entrer un pseudo et un mot de passe.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function togglePassword(id) {
            var passMemb = document.getElementById(id);
            if (passMemb.type === "password") {
                passMemb.type = "text";
            } else {
                passMemb.type = "password";
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Inscription</h1>
        <form action="signup.php" method="post" class="form-container">
            <div class="form-group">
                <label for="pseudoMembnyme">Pseudo (non modifiable)</label>
                <input type="text" name="pseudoMembnyme" placeholder="Pseudonyme" minlength="6" required>
                <p>(non modifiable, au moins 6 caractères)</p>
            </div>

            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" placeholder="Prénom" required>
            </div>

            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" name="nom" placeholder="Nom" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Email" minlength="6" required>
                <p>(au moins 6 caractères)</p>
            </div>

            <div class="form-group">
                <label for="email_confirm">Confirmez Email</label>
                <input type="email" name="email_confirm" placeholder="Confirmez Email" minlength="6" required>
            </div>

            <div class="form-group">
                <label for="mot_de_passe">Mot de passe</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Mot de passe" minlength="8" maxlength="15" required>
                <p>(8-15 caractères, une majuscule, une minuscule, un chiffre, un caractère spécial)</p>
                <input type="checkbox" onclick="togglePassword('mot_de_passe')"> Afficher Mot de passe
            </div>

            <div class="form-group">
                <label for="mot_de_passe_confirm">Confirmez Mot de passe</label>
                <input type="password" id="mot_de_passe_confirm" name="mot_de_passe_confirm" placeholder="Confirmez Mot de passe" minlength="8" maxlength="15" required>
                <input type="checkbox" onclick="togglePassword('mot_de_passe_confirm')"> Afficher Mot de passe
            </div>

            <div class="form-group">
                <label>J'accepte que mes données soient conservées</label>
                <input type="radio" name="accepte_donnees" value="oui" required> Oui
                <input type="radio" name="accepte_donnees" value="non" required> Non
            </div>

            <div class="form-group">
                <button type="submit">Soumettre</button>
            </div>
        </form>
    </div>
</body>
</html>

<style>
    body {
        font-family: Arial, sans-serif;
        text-align: center;
        padding: 20px;
        background-color: #f4f4f4;
    }

    h1 {
        color: #333;
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

    .form-group p {
        font-size: 0.9em;
        color: #666;
    }

    .form-group button {
        background-color: #28a745;
        color: white;
        cursor: pointer;
    }

    .form-group button:hover {
        background-color: #218838;
    }
</style>

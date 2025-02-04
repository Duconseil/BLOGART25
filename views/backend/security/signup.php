<?php
include '../../../header.php';
global $DB;

$se_souvenir = isset($_POST["se_souvenir"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification des champs requis
    if (!empty($_POST["pseudonyme"]) && !empty($_POST["mot_de_passe"]) && !empty($_POST['g-recaptcha-response'])) {
        $pseudo = trim($_POST["pseudonyme"]);
        $password = sha1(trim($_POST["mot_de_passe"]));

        // Vérification reCAPTCHA
        $recaptcha_secret = "6LfpN2QpAAAAAF6lmuCFTukw2i8AiG0Ehb8BbBFq";  // Remplacez par votre clé secrète
        $recaptcha_response = $_POST['g-recaptcha-response'];
        $recaptcha_url = "https://www.google.com/recaptcha/api/siteverify";
        $recaptcha_data = [
            'secret' => $recaptcha_secret,
            'response' => $recaptcha_response
        ];

        // Effectuer la requête POST pour vérifier reCAPTCHA
        $options = [
            'http' => [
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
                'content' => http_build_query($recaptcha_data)
            ]
        ];

        $context = stream_context_create($options);
        $recaptcha_result = json_decode(file_get_contents($recaptcha_url, false, $context));

        // Vérification de la réponse reCAPTCHA
        if (!$recaptcha_result->success || $recaptcha_result->score < 0.5) {
            echo "<p style='color:red;'>Échec de la vérification reCAPTCHA. Vous semblez être un robot.</p>";
            exit();
        }

        // Requête sécurisée pour vérifier le pseudonyme et le mot de passe
        $sql = "SELECT * FROM inscription WHERE password = :mot_de_passe AND pseudo = :pseudo";
        $stmt = $DB->prepare($sql);
        $stmt->execute(['pseudo' => $pseudo, 'mot_de_passe' => $password]);
        $user = $stmt->fetch();

        // Traitement du résultat de la requête
        if ($user) {
            if ($user["code_email"] != null) {
                echo "<p style='color:red;'>L'utilisateur n'a pas activé son compte par email.</p>";
            } else {
                session_start();
                $_SESSION["pseudonyme"] = $pseudo;

                $code_cookie = password_hash(uniqid(), PASSWORD_DEFAULT);
                if ($se_souvenir) {
                    setcookie("code_cookie", $code_cookie, time() + (30 * 24 * 3600), "/", "", false, true);
                }

                // Mise à jour du code cookie dans la base de données
                $sql = "UPDATE inscription SET code_cookie = :code_cookie WHERE pseudo = :pseudo";
                $stmt = $DB->prepare($sql);
                $stmt->execute(['pseudo' => $pseudo, 'code_cookie' => $code_cookie]);

                // Redirection après connexion réussie
                header("Location: ../../../header.php");
                exit();
            }
        } else {
            echo "<p style='color:red;'>Pseudonyme ou mot de passe incorrect.</p>";
        }
    } else {
        echo "<p style='color:red;'>Veuillez entrer un pseudonyme, un mot de passe et compléter la vérification reCAPTCHA.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="style.css">
    <script>
        function togglePassword(id) {
            var passwordField = document.getElementById(id);
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }

        // Fonction appelée après soumission du reCAPTCHA
        function onSubmit(token) {
            document.getElementById("form-recaptcha").submit();
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Inscription</h1>
        <form id="form-recaptcha" action="signup.php" method="post" class="form-container">
            <div class="form-group">
                <label for="pseudonyme">Pseudo (non modifiable)</label>
                <input type="text" name="pseudonyme" placeholder="Pseudonyme" minlength="6" required>
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

            <!-- reCAPTCHA -->
            <div class="form-group">
                <button class="g-recaptcha" data-sitekey="6LfpN2QpAAAAAF6lmuCFTukw2i8AiG0Ehb8BbBFq" data-callback="onSubmit" data-action="submit">Soumettre</button>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success" style="display: none;">S'inscrire</button>
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

    .form-group input {
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
        width: 100%;
        padding: 10px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .form-group button:hover {
        background-color: #218838;
    }

    .g-recaptcha {
        margin-top: 20px;
    }
</style>

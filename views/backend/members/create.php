<?php
include '../../../header.php';

// Fonction pour valider l'email
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Fonction pour valider le mot de passe
function validatePassword($password) {
    return preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,15}$/', $password);
}

// Fonction pour vérifier le CAPTCHA via cURL
function verifyCaptcha($captchaResponse) {
    $secretKey = 'YOUR_SECRET_KEY'; // Remplacez par votre clé secrète
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captchaResponse";

    // Initialiser cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    // Décoder la réponse JSON
    return json_decode($response, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $pseudo = $_POST['pseudo'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword']; // Récupérer la confirmation du mot de passe
    $email = $_POST['email'];
    $confirmEmail = $_POST['confirmEmail']; // Récupérer la confirmation de l'email
    $statut = $_POST['statut']; // Récupérer le statut sélectionné
    $captcha = $_POST['g-recaptcha-response'];

    // Validation des données
    if (!validateEmail($email)) {
        echo "L'email n'est pas valide.";
        exit;
    }

    if (!validatePassword($password)) {
        echo "Le mot de passe doit faire entre 8 et 15 caractères et contenir une majuscule, une minuscule, un chiffre et un caractère spécial.";
        exit;
    }

    // Vérification que les mots de passe correspondent
    if ($password !== $confirmPassword) {
        echo "Les mots de passe ne correspondent pas.";
        exit;
    }

    // Vérification que les emails correspondent
    if ($email !== $confirmEmail) {
        echo "Les emails ne correspondent pas.";
        exit;
    }

    // Vérifier le CAPTCHA
    $captchaData = verifyCaptcha($captcha);
    if (!$captchaData["success"]) {
        echo "Erreur de validation du reCAPTCHA.";
        exit;
    }

    // Hacher le mot de passe
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Connexion à la base de données (assurez-vous que la connexion est bien établie)
    $conn = new mysqli("localhost", "username", "password", "database_name"); // Remplacez avec vos informations de connexion

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Requête préparée pour insérer le membre dans la base de données
    $stmt = $conn->prepare("INSERT INTO membre (pseudoMemb, prenomMemb, nomMemb, passMemb, eMailMemb, numStat) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        echo "Erreur lors de la préparation de la requête.";
        exit;
    }

    // Lier les paramètres
    $stmt->bind_param("sssssi", $pseudo, $prenom, $nom, $hashedPassword, $email, $statut);

    // Exécuter la requête
    if ($stmt->execute()) {
        echo "Membre créé avec succès.";
        header('Location: /views/backend/members/list.php');
        exit;
    } else {
        echo "Une erreur est survenue lors de la création du membre. " . $stmt->error;
    }

    // Fermer la connexion
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="style.css">
    <script>
        // Fonction JavaScript pour afficher/masquer le mot de passe
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            var confirmPasswordField = document.getElementById("confirmPassword");
            var checkbox = document.getElementById("showPassword");
            if (checkbox.checked) {
                passwordField.type = "text"; // Afficher le mot de passe
                confirmPasswordField.type = "text"; // Afficher la confirmation du mot de passe
            } else {
                passwordField.type = "password"; // Masquer le mot de passe
                confirmPasswordField.type = "password"; // Masquer la confirmation du mot de passe
            }
        }
    </script>
</head>
<body>
    <div class="container">
    <div class="col-md-12">
            <h1>Création nouveau Membre</h1>
        </div>
        <form action="" method="post" style="padding: 2vw;">
            <div class="form-group">
                <label for="pseudo">Pseudo (non modifiable)</label>
                <input type="text" class="form-control" name="pseudo" id="pseudo" required>
                <p>(Entre 6 et 70 car.)</p>
            </div>

            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control" name="prenom" id="prenom" required>
            </div>

            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" name="nom" id="nom" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" name="password" id="password" required>
                <p>Le mot de passe doit faire entre 8 et 15 caractères et contenir une majuscule, une minuscule, un chiffre et un caractère spécial.</p>
            </div>

            <div class="form-group">
                <label for="confirmPassword">Confirmer le mot de passe</label>
                <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" required>
            </div>

            <div class="form-group">
                <input type="checkbox" id="showPassword" onclick="togglePasswordVisibility()"> <label for="showPassword">Afficher les mots de passe</label>
            </div>

            <br>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="confirmEmail">Confirmer l'email</label>
                <input type="email" class="form-control" name="confirmEmail" id="confirmEmail" required>
            </div>

            <div class="form-group">
                <label for="statut">Statut</label>
                <select class="form-control" name="statut" id="statut" required>
                    <option value="1">Utilisateur</option>
                    <option value="2">Administrateur</option>
                    <option value="3">Modérateur</option>
                </select>
            </div>
            <br>

            <div class="form-group">
                <label for="recaptcha">reCAPTCHA</label>
                <div class="g-recaptcha" data-sitekey="6LfpN2QpAAAAAF6lmuCFTukw2i8AiG0Ehb8BbBFq"></div>
            </div>

            <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">List</a>
                    <button type="submit" class="btn btn-success">Confirmer create ?</button>
                </div>        
            </form>
    </div>
</body>
</html>

<?php
include '../../../footer.php';
?>

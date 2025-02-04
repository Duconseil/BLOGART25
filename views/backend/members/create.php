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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $pseudo = $_POST['pseudo'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $email = $_POST['email'];
    $confirmEmail = $_POST['confirmEmail'];
    $statut = $_POST['statut'];

    // Validation des données
    if (!validateEmail($email)) {
        die("L'email n'est pas valide.");
    }
    if (!validatePassword($password)) {
        die("Le mot de passe doit contenir une majuscule, une minuscule, un chiffre et un caractère spécial.");
    }
    if ($password !== $confirmPassword) {
        die("Les mots de passe ne correspondent pas.");
    }
    if ($email !== $confirmEmail) {
        die("Les emails ne correspondent pas.");
    }

    // Hacher le mot de passe
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password_db = "root";
    $dbname = "BLOGART25"; // Assurez-vous que la base de données existe

    $conn = new mysqli($servername, $username, $password_db, $dbname);

    if ($conn->connect_error) {
        die("Échec de la connexion : " . $conn->connect_error);
    }

    // Requête préparée pour insérer le membre dans la base de données
    $stmt = $conn->prepare("INSERT INTO membre (pseudoMemb, prenomMemb, nomMemb, passMemb, eMailMemb, numStat) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Erreur lors de la préparation de la requête : " . $conn->error);
    }

    $stmt->bind_param("sssssi", $pseudo, $prenom, $nom, $hashedPassword, $email, $statut);
    
    if ($stmt->execute()) {
        header('Location: /views/backend/members/list.php');
        exit;
    } else {
        die("Erreur lors de la création du membre : " . $stmt->error);
    }

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
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            var confirmPasswordField = document.getElementById("confirmPassword");
            var checkbox = document.getElementById("showPassword");
            if (checkbox.checked) {
                passwordField.type = "text";
                confirmPasswordField.type = "text";
            } else {
                passwordField.type = "password";
                confirmPasswordField.type = "password";
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Création nouveau Membre</h1>
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
                <p>Le mot de passe doit contenir une majuscule, une minuscule, un chiffre et un caractère spécial.</p>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirmer le mot de passe</label>
                <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" required>
            </div>
            <div class="form-group">
                <input type="checkbox" id="showPassword" onclick="togglePasswordVisibility()"> <label for="showPassword">Afficher les mots de passe</label>
            </div>
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
            <div class="form-group">
                <label for="recaptcha">reCAPTCHA</label>
                <div class="g-recaptcha" data-sitekey="6LfpN2QpAAAAAF6lmuCFTukw2i8AiG0Ehb8BbBFq" data-callback="enableSubmitButton"></div>
            </div>

            <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">Liste</a>
                    <button type="submit" class="btn btn-success">Confirmer la création ?</button>
                </div>
        </form>
    </div>
</body>
</html>

<?php
include '../../../footer.php';
?>

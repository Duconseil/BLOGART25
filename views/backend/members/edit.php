<?php
include '../../../header.php';

// Vérification si numMemb est présent dans l'URL
if (!isset($_GET['numMemb']) || empty($_GET['numMemb'])) {
    echo "Numéro de membre manquant!";
    exit;
}

$numMemb = $_GET['numMemb'];

// Récupération des informations du membre depuis la base de données
$membres = sql_select("membre INNER JOIN statut ON membre.numStat = statut.numStat", "*", "numMemb = $numMemb");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Vérifier les données du formulaire avant de procéder à la mise à jour
    if (!empty($password)) {
        // Si un mot de passe est fourni, on le hache (utilisation de password_hash pour plus de sécurité)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $update_query = "prenomMemb = '$prenom', nomMemb = '$nom', eMailMemb = '$email', passMemb = '$hashedPassword'";
    } else {
        // Si aucun mot de passe, on ne met à jour que les autres informations
        $update_query = "prenomMemb = '$prenom', nomMemb = '$nom', eMailMemb = '$email'";
    }

    // Exécution de la requête SQL de mise à jour
    $update_result = sql_update("membre", $update_query, "numMemb = $numMemb");

    if ($update_result) {
        // Redirection vers la page de liste des membres après mise à jour
        header('Location: /views/backend/members/list.php'); // Correction du chemin absolu
        exit;
    } else {
        $error_message = "Une erreur est survenue lors de la mise à jour du membre.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="preload" href="members.js" as="script">
    <script src="members.js" preload></script>
    <script>
        // Fonction pour afficher/masquer le mot de passe
        function togglePassword(id) {
            var passwordField = document.getElementById(id);
            var checkbox = document.querySelector('input[type="checkbox"]');
            if (checkbox.checked) {
                passwordField.type = "text";  // Afficher le mot de passe
            } else {
                passwordField.type = "password";  // Masquer le mot de passe
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <!-- Affichage des erreurs si la mise à jour échoue -->
        <?php if (isset($error_message)) : ?>
            <div class="alert alert-danger">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form action="" method="post" style="padding: 2vw;">
            <div class="form-group">
                <label for="numMemb">Numéro</label>
                <input type="text" class="form-control" name="numMemb" id="numMemb" value="<?php echo $membres[0]['numMemb']; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="pseudo">Pseudonyme (non modifiable)</label>
                <input type="text" class="form-control" name="pseudo" id="pseudo" value="<?php echo $membres[0]['pseudoMemb']; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control" name="prenom" id="prenom" value="<?php echo $membres[0]['prenomMemb']; ?>" required>
            </div>

            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $membres[0]['nomMemb']; ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" name="password" id="password" value="">
                <p>Le mot de passe doit faire entre 8 et 15 caractères et contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial.</p>
                <input type="checkbox" onclick="togglePassword('password')"> Afficher le mot de passe
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="<?php echo $membres[0]['eMailMemb']; ?>" required>
            </div>

            <div class="form-group">
                <label for="statut">Statut</label>
                <input type="text" class="form-control" name="statut" id="statut" value="<?php echo $membres[0]['libStat']; ?>" readonly>
            </div>

            <div class="form-group">
                <label for="recaptcha">reCAPTCHA</label>
                <div class="g-recaptcha" data-sitekey="6LfpN2QpAAAAAF6lmuCFTukw2i8AiG0Ehb8BbBFq" data-callback="enableSubmitButton"></div>
            </div>

            <button type="submit" class="btn btn-primary" id="submitBtn">Modifier</button>
        </form>
    </div>
</body>

</html>

<?php
include '../../../footer.php';
?>

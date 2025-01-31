<?php

include '../../../header.php';

$numMemb = $_GET['numMemb'];

// Récupérer les informations de l'utilisateur
$membres = sql_select("membre INNER JOIN statut on membre.numStat = statut.numStat", "*", "numMemb = $numMemb");

// Clé secrète de reCAPTCHA
$secret = 'votre_clé_secrète';

// Vérifier la réponse du reCAPTCHA
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recaptcha_response = $_POST['g-recaptcha-response'];
    
    // Valider le captcha
    $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$recaptcha_response");
    $captcha_success = json_decode($verify);
    
    if (!$captcha_success->success) {
        echo "<p style='color:red;'>La vérification reCAPTCHA a échoué. Veuillez réessayer.</p>";
    } else {
        $numMemb = $_GET['numMemb'];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $email = $_POST['email'];
        $confirm_email = $_POST['confirm_email'];

        // Vérifier si les mots de passe correspondent
        if ($password !== $confirm_password) {
            echo "<p style='color:red;'>Les mots de passe ne correspondent pas.</p>";
        } elseif ($email !== $confirm_email) {
            echo "<p style='color:red;'>Les emails ne correspondent pas.</p>";
        } else {
            // Mettre à jour les informations
            if (!empty($password)) {
                $hashedPassword = sha1($password);
                sql_update("membre", "prenomMemb = '$prenom', nomMemb = '$nom', passMemb = '$hashedPassword', eMailMemb = '$email'", "numMemb = $numMemb");
            } else {
                sql_update("membre", "prenomMemb = '$prenom', nomMemb = '$nom', eMailMemb = '$email'", "numMemb = $numMemb");
            }
            echo "<p style='color:green;'>Les informations ont été mises à jour avec succès.</p>";
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="preload" href="members.js" as="script">
    <script src="members.js" preload></script>
    <script>
        // Fonction pour afficher ou cacher le mot de passe
        function togglePassword(id) {
            var passwordField = document.getElementById(id);
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>
</head>

<body>
<div class="container">
<div class="row">
    <div class="col-md-12">
            <h1>Modification Membre</h1>
        </div>
        <div class="col-md-12">
    <div class="container">
        <form action="<?php echo ROOT_URL . '/api/members/update.php?numMemb=' . $numMemb ?>" method="post" style="padding: 2vw;">
            <div class="form-group">
                <label for="pseudo">Numéro</label>
                <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Pseudo" value="<?php echo $membres[0]['numMemb']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="pseudo">Pseudonyme (non modifiable)</label>
                <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Pseudo" value="<?php echo isset($membres[0]['pseudoMemb']) ? $membres[0]['pseudoMemb'] : ''; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prénom" value="<?php echo isset($membres[0]['prenomMemb']) ? $membres[0]['prenomMemb'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom" value="<?php echo isset($membres[0]['nomMemb']) ? $membres[0]['nomMemb'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe" value="">
                <p>Le mot de passe doit faire entre 8 et 15 caractères et contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial.</p>
                <input type="checkbox" onclick="togglePassword('password')"> Afficher Mot de passe
            </div>
            <br>
            <div class="form-group">
                <label for="confirm_password">Confirmez le mot de passe</label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirmez le mot de passe" value="">
                <input type="checkbox" onclick="togglePassword('confirm_password')"> Afficher Mot de passe
            </div>
            <br>
            <div class="form-group">
                <label for="email">eMail</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo isset($membres[0]['eMailMemb']) ? $membres[0]['eMailMemb'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="confirm_email">Confirmez email</label>
                <input type="email" class="form-control" name="confirm_email" id="confirm_email" placeholder="Confirmez l'email" value="<?php echo isset($membres[0]['eMailMemb']) ? $membres[0]['eMailMemb'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="statut">Statut</label>
                <input type="text" class="form-control" name="statut" id="statut" placeholder="" value="<?php echo $membres[0]['libStat']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="recaptcha">reCAPTCHA</label>
                <div class="g-recaptcha" data-sitekey="6LfpN2QpAAAAAF6lmuCFTukw2i8AiG0Ehb8BbBFq" data-callback="enableSubmitButton"></div>
            </div>

            <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">Liste</a>
                    <button type="submit" class="btn btn-success">Confirmer update ?</button>
                </div>
        </form>
    </div>
</div>
</div>
</body>

</html>

<?php
include '../../../footer.php';
?>

<?php
include '../../../header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données envoyées par le formulaire
    $prenom = $_POST['prenomMemb'];
    $nom = $_POST['nomMemb'];
    $pseudo = $_POST['pseudoMemb'];
    $passMemb1 = $_POST['passMemb1'];
    $passMemb2 = $_POST['passMemb2'];
    $email1 = $_POST['email1'];
    $email2 = $_POST['email2'];
    $verif = isset($_POST['verif']) ? 1 : 0;

    // Validation des données
    if ($passMemb1 !== $passMemb2) {
        $error = "Les mots de passe ne correspondent pas.";
    } elseif (!filter_var($email1, FILTER_VALIDATE_EMAIL) || $email1 !== $email2) {
        $error = "Les emails ne correspondent pas ou sont invalides.";
    } elseif (strlen($passMemb1) < 8 || strlen($passMemb1) > 15 || !preg_match("/[A-Z]/", $passMemb1) || !preg_match("/[a-z]/", $passMemb1) || !preg_match("/\d/", $passMemb1)) {
        $error = "Le mot de passe doit faire entre 8 et 15 caractères et contenir au moins une majuscule, une minuscule, un chiffre.";
    } elseif (!$verif) {
        $error = "Vous devez accepter la conservation de vos données.";
    } else {
        // Hashage du mot de passe
        $hashedPassword = sha1($passMemb1);
        
        // Ajouter le membre à la base de données
        $query = "INSERT INTO membre (prenomMemb, nomMemb, pseudoMemb, passMemb, eMailMemb) VALUES ('$prenom', '$nom', '$pseudo', '$hashedPassword', '$email1')";
        $result = sql_query($query);

        if ($result) {
            header('Location: ' . ROOT_URL . '/members/list.php'); // Rediriger après la création
            exit();
        } else {
            $error = "Une erreur est survenue lors de la création du membre.";
        }
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
        <h1>Création d'un nouveau membre</h1>

        <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>

        <form action="<?php echo ROOT_URL . '/api/members/create.php'; ?>" method="post" style="padding: 2vw;" id="form-recaptcha">
            <div class="form-group">
                <label for="prenomMemb">Prénom</label>
                <input type="text" class="form-control" name="prenomMemb" id="prenomMemb" placeholder="Prénom" required>
            </div>

            <div class="form-group">
                <label for="nomMemb">Nom</label>
                <input type="text" class="form-control" name="nomMemb" id="nomMemb" placeholder="Nom" required>
            </div>

            <div class="form-group">
                <label for="pseudoMemb">Pseudo</label>
                <input type="text" class="form-control" name="pseudoMemb" id="pseudoMemb" placeholder="Pseudo" required>
                <p>(Entre 6 et 70 caractères)</p>
            </div>

            <div class="form-group">
                <label for="passMemb1">Mot de passe</label>
                <input type="password" class="form-control" name="passMemb1" id="passMemb1" placeholder="Mot de passe" required>
                <p>(Entre 8 et 15 caractères, au moins une majuscule, une minuscule, un chiffre et des caractères spéciaux)</p>
                <input type="checkbox" onclick="togglePassword('passMemb1')"> Afficher Mot de passe
            </div>

            <div class="form-group">
                <label for="passMemb2">Confirmez le Mot de passe</label>
                <input type="password" class="form-control" name="passMemb2" id="passMemb2" placeholder="Confirmez le mot de passe" required>
                <input type="checkbox" onclick="togglePassword('passMemb2')"> Afficher Mot de passe
            </div>

            <div class="form-group">
                <label for="email1">E-mail</label>
                <input type="email" class="form-control" name="email1" id="email1" placeholder="E-mail" required>
            </div>

            <div class="form-group">
                <label for="email2">Confirmez l'E-mail</label>
                <input type="email" class="form-control" name="email2" id="email2" placeholder="Confirmez l'email" required>
            </div>

            <div class="form-group">
                <label for="verif">J'accepte la conservation de mes données lors de la création de mon compte</label>
                <input type="checkbox" name="verif" required>
            </div>

            <div class="form-group">
                <div class="g-recaptcha" data-sitekey="6LfpN2QpAAAAAF6lmuCFTukw2i8AiG0Ehb8BbBFq"></div>
            </div>

            <button type="submit" class="btn btn-primary" id="submitBtn">Créer le compte</button>
        </form>
    </div>

    <script>
        function onSubmit(token) {
            document.getElementById("form-recaptcha").submit();
        }
    </script>
</body>

</html>

<?php
include '../../../footer.php';
?>

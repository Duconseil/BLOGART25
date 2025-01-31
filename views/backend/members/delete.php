<?php

include '../../../header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/ctrlSaisies.php';



if (isset($_GET['numMemb'])){
    $numMemb = $_GET['numMemb'];
    $membres = sql_select("MEMBRE", "*", "numMemb = $numMemb")[0];
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="preload" href="members.js" as="script">
    <script src="members.js" preload></script>
</head>

<body>
    <div class="container">

        <form action="<?php echo ROOT_URL . '/api/members/delete.php' ?>" method="post" style="padding: 2vw;">
            <div class="form-group">
                <div class="form-group">
                    <label for="number">Numéro</label>
                    <input type="text" class="form-control" name="number" id="number" placeholder="Numéro" value="<?php echo $membres['numMemb']; ?>">
                </div>
                <div class="form-group">
                    <label for="pseudo">Pseudonyme (non modifiable)</label>
                    <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Pseudo" value="<?php echo isset($membres['pseudoMemb']) ? $membres['pseudoMemb'] : ''; ?>" >
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prénom" value="<?php echo isset($membres['pseudoMemb']) ? $membres['pseudoMemb'] : ''; ?>" >
                </div>
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom" value="<?php echo isset($membres['nomMemb']) ? $membres['nomMemb'] : ''; ?>" >
                </div>
                <div class="form-group">
                    <label for="email">eMail</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo isset($membres['eMailMemb']) ? $membres['eMailMemb'] : ''; ?>" >
                </div>
                <div class="form-group">
                    <label for="confirm_email">Confirmez email</label>
                    <input type="email" class="form-control" name="confirm_email" id="confirm_email" placeholder="Confirmez l'email" value="<?php echo isset($membres['eMailMemb']) ? $membres['eMailMemb'] : ''; ?>" >
                </div>
                <div class="form-group">
                    <label for="statut">Statut</label>
                    <input type="text" class="form-control" name="statut" id="statut" placeholder="Statut" value="<?php echo $membres['numStat']; ?>" >
                </div>
                <div class="form-group">
                    <label for="recaptcha">reCAPTCHA</label>
                    <div class="g-recaptcha" data-sitekey="6LfpN2QpAAAAAF6lmuCFTukw2i8AiG0Ehb8BbBFq" data-callback="enableSubmitButton"></div>
                </div>

                <button type="submit" class="btn btn-danger" id="submitBtn">Supprimer</button>
        </form>

    </div>
</body>

</html>

<?php
include '../../../footer.php';
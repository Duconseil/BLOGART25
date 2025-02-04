<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';
include '../../header.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    
    // Vérification des champs
    $pseudoMemb = isset($_POST['pseudoMemb']) ? ctrlSaisies($_POST['pseudoMemb']) : null;
    $prenomMemb = isset($_POST['prenomMemb']) ? ctrlSaisies($_POST['prenomMemb']) : null;
    $nomMemb = isset($_POST['nomMemb']) ? ctrlSaisies($_POST['nomMemb']) : null;
    $passMemb = isset($_POST['passMemb']) ? ctrlSaisies($_POST['passMemb']) : null;
    $passMemb2 = isset($_POST['passMemb2']) ? ctrlSaisies($_POST['passMemb2']) : null;
    $eMailMemb = isset($_POST['eMailMemb']) ? ctrlSaisies($_POST['eMailMemb']) : null;
    $eMailMemb2 = isset($_POST['eMailMemb2']) ? ctrlSaisies($_POST['eMailMemb2']) : null;
    $accordMemb = isset($_POST['accordMemb']) ? ctrlSaisies($_POST['accordMemb']) : null;
    $numStat = isset($_POST['numStat']) ? ctrlSaisies($_POST['numStat']) : null;

    $errors = [];

    // Vérification Pseudo
    if (strlen($pseudoMemb) < 6 || strlen($pseudoMemb) > 70) {
        $errors[] = "Erreur, le pseudo doit contenir entre 6 et 70 caractères.";
    } else {
        $verif = sql_select('MEMBRE', 'pseudoMemb', "pseudoMemb = '$pseudoMemb'");
        if (!empty($verif)) {
            $errors[] = "Veuillez choisir un pseudo disponible.";
            $pseudoMemb = null;
        }
    }
    if (!$numStat) {
        echo "dgegfhbfhbeh" ; 
    }
    // Vérification mot de passe
    if (!preg_match('/[A-Z]/', $passMemb) || !preg_match('/[a-z]/', $passMemb) || !preg_match('/[0-9]/', $passMemb)) {
        $errors[] = "Le mot de passe doit contenir au moins une majuscule, une minuscule et un chiffre.";
        $passMemb = null;
    }

    if ($passMemb !== $passMemb2) {
        $errors[] = "Les mots de passe doivent être identiques.";
        $passMemb = null;

    }

    if ($passMemb) {
        $hash_password = password_hash($passMemb, PASSWORD_DEFAULT);
    }

    // Vérification Email
    if (!filter_var($eMailMemb, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "$eMailMemb n'est pas une adresse mail valide.";
    }

    if ($eMailMemb !== $eMailMemb2) {
        $errors[] = "Les adresses mail doivent être identiques.";
        $eMailMemb = null;
    }

    // Vérification Accord
    if ($accordMemb !== 'OUI') {
        $errors[] = "Veuillez accepter de partager vos données.";
    }
    $admin_exist = sql_select('MEMBRE', 'numMemb', "numStat = 1");

    if (!empty($admin_exist) && $numStat == 1) { 
        $errors[] = "Il y a déjà un administrateur, vous ne pouvez pas en créer un autre.";
        $numStat = null;
    }


    // Vérification complète avant insertion
    if (empty($errors) && isset($pseudoMemb, $prenomMemb, $nomMemb, $hash_password, $eMailMemb, $numStat)) {
        $dtCreaMemb = date('Y-m-d H:i:s');
        sql_insert(
            'MEMBRE',
            'prenomMemb, nomMemb, pseudoMemb, passMemb, eMailMemb, dtCreaMemb, accordMemb, numStat',
            "'$prenomMemb', '$nomMemb', '$pseudoMemb', '$hash_password', '$eMailMemb', '$dtCreaMemb', '1', '$numStat'"
        );
        header('Location: ../../views/backend/members/list.php');
        exit();

    }

}
?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
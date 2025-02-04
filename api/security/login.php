<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

session_start();

$pseudoMemb = ctrlSaisies($_POST['pseudoMemb']);
$passMemb = ctrlSaisies($_POST['passMemb']);

$search = sql_select('MEMBRE', '*', "pseudoMemb = '$pseudoMemb'");

// TESTE SI LES CHAMPS SONT REMPLIS

if (empty($pseudoMemb) || empty($passMemb)) {
    echo "<p style='color: red;'>Veuillez remplir tous les champs.</p>";  // CEY PAS REMPLI
} 


// TEST MDP
if ($passMemb < 8 && $passMemb > 15) {
    echo 'Erreur, le mot de passe doit contenir entre 8 et 15 caratères.<br>';
    $passMemb = null; 
} 

if (!preg_match('/[A-Z]/', $passMemb) && !preg_match('/[a-z]/', $passMemb)){ // checke maj & min
    echo 'Erreur, le mot de passe doit contenir au moins une majuscule et une minuscule.<br>';
    $passMemb = null;
}

if (!preg_match('/[0-9]/', $passMemb)){
    echo 'Erreur, le mot de passe doit contenir au moins un chiffre.<br>';
    $passMemb = null;
}

// TEST EMAIL MATCHE LE MDP 


$search = sql_select('MEMBRE', '*', "pseudoMemb = '$pseudoMemb'");

if ($search !== null && count($search) > 0) {
    $passwordHash = $search[0]['passMemb'];

    if (password_verify($passMemb, $passwordHash)) {
        $_SESSION['numStat'] = $search[0]['numStat'];
        $_SESSION['pseudo'] = $search[0]['pseudoMemb'];
        $_SESSION['dtCreaMemb'] = $search[0]['dtCreaMemb'];
        $_SESSION['nomMemb'] = $search[0]['nomMemb'];
        $_SESSION['prenomMemb'] = $search[0]['prenomMemb'];
        $_SESSION['EmailMemb'] = $search[0]['EmailMemb'];
         // Ajoutez cette ligne pour stocker le pseudo dans la session
        echo 'Connexion réussie. Bienvenue, ' . $_SESSION['pseudo'] . '!';
    } else {
        echo 'Mot de passe incorrect.';
    }
} else {
    echo 'Aucun utilisateur trouvé avec le pseudo spécifié.';
}





header('Location: /index.php');
exit();

echo("Form login");
?>

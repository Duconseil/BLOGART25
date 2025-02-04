<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

// PSEUDO
$pseudoMemb = ctrlSaisies($_POST['pseudoMemb']); // ENTRE 6-70 CARACS

// Validation longueur du pseudo
if (strlen($pseudoMemb) < 6 || strlen($pseudoMemb) > 70) {
    echo 'Erreur, le pseudo doit contenir entre 6 et 70 caractères.';
} else {
    echo 'Le pseudo est bon<br>';
}

// Vérification de la disponibilité du pseudo
$verif = sql_select('MEMBRE', 'pseudoMemb', "pseudoMemb = '$pseudoMemb'");

if ($verif != NULL){
    echo 'Veuillez choisir un pseudo disponible.';
    $pseudoMemb = null;
}

// PRENOM
$prenomMemb = ctrlSaisies($_POST['prenomMemb']);

// NOM
$nomMemb = ctrlSaisies($_POST['nomMemb']);

// PASSWORD
$passMemb = ctrlSaisies($_POST['passMemb']); // 8-15 CARACS + MAJ / MIN / CHIFFRE, ACCEPTE CARACS SPECIAUX

// Validation longueur du mot de passe
if (strlen($passMemb) < 8 || strlen($passMemb) > 15) {
    echo 'Erreur, le mot de passe doit contenir entre 8 et 15 caractères.<br>';
    $passMemb = null; 
}

// Vérification de la présence de majuscules, minuscules et chiffres
if (!preg_match('/[A-Z]/', $passMemb) || !preg_match('/[a-z]/', $passMemb)){
    echo 'Erreur, le mot de passe doit contenir au moins une majuscule et une minuscule.<br>';
    $passMemb = null;
}

if (!preg_match('/[0-9]/', $passMemb)){
    echo 'Erreur, le mot de passe doit contenir au moins un chiffre.<br>';
    $passMemb = null;
}

// Confirmation du mot de passe
$passMemb2 = ctrlSaisies($_POST['passMemb2']); // DOIT ÊTRE IDENTIQUE A PASSWORD

if ($passMemb != $passMemb2){ 
    echo 'Les mots de passe doivent être identiques.<br>';
    $passMemb = null;
}

// Hachage du mot de passe
$hash_password = password_hash($passMemb, PASSWORD_DEFAULT);

echo '<br>';

// EMAIL
$eMailMemb = ctrlSaisies($_POST['eMailMemb']);
$eMailMemb2 = ctrlSaisies($_POST['eMailMemb2']); // DOIT Ê IDENTIQUE

// Validation de l'email
if (!filter_var($eMailMemb, FILTER_VALIDATE_EMAIL)) {
    echo "$eMailMemb n'est pas une adresse email valide.<br>";
    $eMailMemb = null;
} else {
    echo "$eMailMemb est une adresse email valide.<br>";
}

if ($eMailMemb != $eMailMemb2){
    echo 'Les adresses email doivent être identiques.<br>';
    $eMailMemb = null;
}

// ACCORD DONNEES
$accordMemb = ctrlSaisies($_POST['accordMemb']);
$accordMemb2 = ctrlSaisies($_POST['accordMemb2']);

if ($accordMemb != $accordMemb2){
    echo "Veuillez accepter les Conditions générales d'utilisation ET le partage de vos données.<br>";
    $accordMemb = null;
} 

if ($accordMemb !== 'OUI') {
    echo 'Veuillez accepter de partager vos données.<br>';
} else {
    $accordMemb = TRUE;
}

// STATUT
$numStat = ctrlSaisies($_POST['numStat']);

// DATE CREATION
$dtCreaMemb = date_create()->format('Y-m-d H:i:s');
echo $dtCreaMemb . '<br>'; // donne la date & heure d'inscription
$dtMajMemb = NULL;

// Générer le numéro d'adhérent
$max = 'MAX(numMemb)';
$numMemb = sql_select('MEMBRE', $max);
$numMemb = implode("", $numMemb[0]);
$numMemb++;
echo "Numéro d'adhérent : $numMemb<br>";

// Insérer l'utilisateur dans la base de données si toutes les conditions sont remplies
if (isset($pseudoMemb, $prenomMemb, $nomMemb, $passMemb, $eMailMemb, $accordMemb, $numStat)){
    if (!isset($_SESSION['numStat'])) {
        // Insérer le membre dans la base de données
        sql_insert('MEMBRE', 
        'prenomMemb, nomMemb, pseudoMemb, passMemb, eMailMemb, dtCreaMemb, accordMemb, numMemb, dtMajMemb, numStat', 
        "'$prenomMemb', '$nomMemb', '$pseudoMemb', '$hash_password', '$eMailMemb', '$dtCreaMemb', '$accordMemb', '$numMemb', '$dtMajMemb', '$numStat'");
    } 

    header('Location: ../../views/frontend/profil.php');
} else {
    echo '<br><br><p style="color:red;">Veuillez remplir tout le formulaire.</p>';
}
?>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

// PSEUDO
$pseudoMemb= ctrlSaisies($_POST['pseudoMemb']); // ENTRE 6-70 CARACS

if ($pseudoMemb < 6 && $pseudoMemb > 70) {
    echo 'Erreur, le pseudo doit contenir entre 6 et 70 caractères.';
} else {
    echo 'Le pseudo est bon<br>';
}

$verif = sql_select('MEMBRE', 'pseudoMemb', "pseudoMemb = '$pseudoMemb'");

if ($verif != NULL){
    echo 'Veuillez choisir un pseudo disponible.';
    $pseudoMemb = null;
}

//PRENOM
$prenomMemb = ctrlSaisies($_POST['prenomMemb']);
//NOM
$nomMemb = ctrlSaisies($_POST['nomMemb']);
//PASSWORD
$passMemb = ctrlSaisies($_POST['passMemb']); // 8-15 CARACS + MAJ / MIN / CHIFFRE, ACCEPTE CARACS SPECIAUX

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

$passMemb2 = ctrlSaisies($_POST['passMemb2']); // DOIT ÊTRE IDENTIQUE A PASSWORD

if ($passMemb != $passMemb2){ 
    echo 'Les mots de passe doivent être identiques.<br>';
    $passMemb = null;
} 

$hash_password = password_hash($passMemb, PASSWORD_DEFAULT);

echo '<br>';


//EMAIL
$eMailMemb = ctrlSaisies($_POST['eMailMemb']);
$eMailMemb2 = ctrlSaisies($_POST['eMailMemb2']); // DOIT Ê IDENTIQUE

if (filter_var($eMailMemb, FILTER_VALIDATE_EMAIL)) {
    echo("$eMailMemb est une adresse mail valide.<br>");
  } else {
    echo("$eMailMemb n'est pas une adresse mail valide.<br>");
  }

if ($eMailMemb != $eMailMemb2){
    echo 'Les adresses mail doivent être identiques.<br>';
    $eMailMemb = null;
} 

//ACCORD DONNEES
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

//STATUT
$numStat = ctrlSaisies($_POST['numStat']);

echo '<br>';


echo '<br>';

//DATE CREATION
$dtCreaMemb = date_create()->format('Y-m-d H:i:s');
echo $dtCreaMemb . '<br>'; // donne la date & heure d'inscription
$dtMajMemb = NULL;

$max = 'MAX('. 'numMemb' . ')';
$numMemb = sql_select('MEMBRE', $max);

echo '<br>';
$numMemb = implode("", $numMemb[0]);
echo $numMemb;
echo '<br>';
// GENERE NBR DE MEMBRE (PREND +GRANDE VALEUR ET Y AJOUTE 1)
++$numMemb;
echo $numMemb . '<br>';


if (isset($pseudoMemb, $prenomMemb, $nomMemb, $passMemb, $eMailMemb, $accordMemb, $numStat)){
    if (!isset($_SESSION['numStat'])) {
            //Vous pouvez le faire
            sql_insert('MEMBRE', 
            'prenomMemb, nomMemb, pseudoMemb, passMemb, eMailMemb, dtCreaMemb, accordMemb, numMemb, dtMajMemb, numStat', 
            "'$prenomMemb', '$nomMemb', '$pseudoMemb', '$hash_password', '$eMailMemb', '$dtCreaMemb', '$accordMemb', '$numMemb', '$dtMajMemb', '$numStat'");
        
    } 

    header('Location: ../../views/frontend/profil.php');

} else {
    echo '<br><br><p style="color:red;">Veuillez remplir tout le formulaire.</p>';
}





?>
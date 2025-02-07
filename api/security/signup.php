<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

if (isset($_POST['g-recaptcha-response'])) {
    $token = $_POST['g-recaptcha-response'];
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array(
        'secret' => '[6Lej580qAAAAAJJoCPyuzSi5-Hs-lFr9ylkq_oMD]', 
        'response' => $token
    );
    $options = array(
        'http' => array(
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result);

    if ($response->success && $response->score >= 0.5) {
    } else {
        echo 'Vous êtes un robot, veuillez réessayer.<br>';
        exit;
    }
}

$pseudoMemb = ctrlSaisies($_POST['pseudoMemb']); 

if (strlen($pseudoMemb) < 6 || strlen($pseudoMemb) > 70) {
    echo 'Erreur, le pseudo doit contenir entre 6 et 70 caractères.';
} else {
    echo 'Le pseudo est bon<br>';
}

$verif = sql_select('MEMBRE', 'pseudoMemb', "pseudoMemb = '$pseudoMemb'");

if ($verif != NULL) {
    echo 'Veuillez choisir un pseudo disponible.';
    $pseudoMemb = null;
}

$prenomMemb = ctrlSaisies($_POST['prenomMemb']);

$nomMemb = ctrlSaisies($_POST['nomMemb']);

$passMemb = ctrlSaisies($_POST['passMemb']); 

if (strlen($passMemb) < 8 || strlen($passMemb) > 15) {
    echo 'Erreur, le mot de passe doit contenir entre 8 et 15 caractères.<br>';
    $passMemb = null; 
}

if (!preg_match('/[A-Z]/', $passMemb) || !preg_match('/[a-z]/', $passMemb)){
    echo 'Erreur, le mot de passe doit contenir au moins une majuscule et une minuscule.<br>';
    $passMemb = null;
}

if (!preg_match('/[0-9]/', $passMemb)){
    echo 'Erreur, le mot de passe doit contenir au moins un chiffre.<br>';
    $passMemb = null;
}

$passMemb2 = ctrlSaisies($_POST['passMemb2']); 

if ($passMemb != $passMemb2){ 
    echo 'Les mots de passe doivent être identiques.<br>';
    $passMemb = null;
}

$hash_password = password_hash($passMemb, PASSWORD_DEFAULT);

echo '<br>';

$eMailMemb = ctrlSaisies($_POST['eMailMemb']);
$eMailMemb2 = ctrlSaisies($_POST['eMailMemb2']); 

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

$accordMemb = $_POST['acceptedonnees'];

$numStat = 3; 


$dtCreaMemb = date_create()->format('Y-m-d H:i:s');
echo $dtCreaMemb . '<br>';
$dtMajMemb = NULL;

$max = 'MAX(numMemb)';
$numMemb = sql_select('MEMBRE', $max);
$numMemb = implode("", $numMemb[0]);
$numMemb++;
echo "Numéro d'adhérent : $numMemb<br>";

if (isset($pseudoMemb, $prenomMemb, $nomMemb, $passMemb, $eMailMemb, $accordMemb, $numStat)){
    if (!isset($_SESSION['numStat'])) {
        sql_insert('MEMBRE', 
        'prenomMemb, nomMemb, pseudoMemb, passMemb, eMailMemb, dtCreaMemb, accordMemb, numMemb, dtMajMemb, numStat', 
        "'$prenomMemb', '$nomMemb', '$pseudoMemb', '$hash_password', '$eMailMemb', '$dtCreaMemb', '$accordMemb', '$numMemb', '$dtMajMemb', '$numStat'");
    } 

} else {
    echo '<br><br><p style="color:red;">Veuillez remplir tout le formulaire.</p>';
}
?>

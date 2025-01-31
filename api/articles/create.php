<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

// Récupération et validation des données de formulaire avec ctrlSaisies
$libTitrArt = isset($_POST['libTitrArt']) ? ctrlSaisies($_POST['libTitrArt']) : '';
$libChapoArt = isset($_POST['libChapoArt']) ? ctrlSaisies($_POST['libChapoArt']) : '';
$libAccrochArt = isset($_POST['libAccrochArt']) ? ctrlSaisies($_POST['libAccrochArt']) : '';
$parag1Art = isset($_POST['parag1Art']) ? ctrlSaisies($_POST['parag1Art']) : '';
$libSsTitr1Art = isset($_POST['libSsTitr1Art']) ? ctrlSaisies($_POST['libSsTitr1Art']) : '';
$parag2Art = isset($_POST['parag2Art']) ? ctrlSaisies($_POST['parag2Art']) : '';
$libSsTitr2Art = isset($_POST['libSsTitr2Art']) ? ctrlSaisies($_POST['libSsTitr2Art']) : '';
$parag3Art = isset($_POST['parag3Art']) ? ctrlSaisies($_POST['parag3Art']) : '';
$libConclArt = isset($_POST['libConclArt']) ? ctrlSaisies($_POST['libConclArt']) : '';
$numMotCle = isset($_POST['numMotCle']) ? ctrlSaisies($_POST['numMotCle']) : '';

var_dump($numMotCle);
// Numéro de l'article

// Numéro du thème
$numThem = isset($_POST['numThem']) ? ctrlSaisies($_POST['numThem']) : 0;

// Gestion de l'image téléchargée
if (isset($_FILES['urlPhotArt'])) {
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/src/uploads/';
    $urlPhotArt = $_FILES['urlPhotArt']['name'];
    $uploadPath = $uploadDir . $urlPhotArt;
    move_uploaded_file($_FILES['urlPhotArt']['tmp_name'], $uploadPath);
} else {
    die("Erreur lors de l'envoi du fichier"); 
    exit;
}

// Insertion dans la base de données
sql_insert('ARTICLE', 'libTitrArt, libChapoArt, libAccrochArt, parag1Art, libSsTitr1Art, parag2Art, libSsTitr2Art, parag3Art, libConclArt, numThem, urlPhotArt' , 
"'$libTitrArt', '$libChapoArt', '$libAccrochArt', '$parag1Art', '$libSsTitr1Art', '$parag2Art', '$libSsTitr2Art', '$parag3Art', '$libConclArt', '$numThem', '$urlPhotArt'");

sql_insert('MOTCLEARTICLE', 'numMotCle', 
"'$numMotCle'");


// Redirection après l'insertion
header('Location: ../../views/backend/articles/list.php');
exit();

?>

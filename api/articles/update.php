<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

// Définition de la fonction BBCode (si non définie)
function BBCode($text) {
    $search = [
        '/\[b\](.*?)\[\/b\]/is', // Gras
        '/\[i\](.*?)\[\/i\]/is', // Italique
        '/\[u\](.*?)\[\/u\]/is', // Souligné
        '/\[url=(.*?)\](.*?)\[\/url\]/is', // Lien
        '/\[img\](.*?)\[\/img\]/is' // Image
    ];

    $replace = [
        '<strong>$1</strong>',
        '<em>$1</em>',
        '<u>$1</u>',
        '<a href="$1">$2</a>',
        '<img src="$1" />'
    ];

    return preg_replace($search, $replace, $text);
}

// Récupérer et sécuriser les données POST
$dtCreaArt = ctrlSaisies($_POST['dtCreaArt']);
$dtMajArt = date("Y-m-d H:i:s"); // Date et heure actuelle
$libTitrArt = ctrlSaisies($_POST['libTitrArt']);
$libChapoArt = ctrlSaisies($_POST['libChapoArt']);
$libAccrochArt = ctrlSaisies($_POST['libAccrochArt']);
$parag1Art = ctrlSaisies($_POST['parag1Art']);
$parag1Art = BBCode($parag1Art);  // Traitement BBCode
$libSsTitr1Art = ctrlSaisies($_POST['libSsTitr1Art']);
$parag2Art = ctrlSaisies($_POST['parag2Art']);
$parag2Art = BBCode($parag2Art);  // Traitement BBCode
$libSsTitr2Art = ctrlSaisies($_POST['libSsTitr2Art']);
$parag3Art = ctrlSaisies($_POST['parag3Art']);
$parag3Art = BBCode($parag3Art);  // Traitement BBCode
$libConclArt = ctrlSaisies($_POST['libConclArt']);
$urlPhotArt = $_FILES['urlPhotArt']['name']; // Récupérer le nom du fichier téléchargé
$numMotCle = $_POST['motCle'];
$numArt = ctrlSaisies($_POST['numArt']);
$numThem = ctrlSaisies($_POST['numThem']);
$libThem = sql_select('THEMATIQUE', 'libThem', "numThem = '$numThem'");

// Vérification des champs requis
$requiredFields = ['libTitrArt', 'dtCreaArt', 'libChapoArt', 'libAccrochArt', 'parag1Art', 'libSsTitr1Art', 'parag2Art', 'libSsTitr2Art', 'parag3Art', 'libConclArt'];

foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        echo "Veuillez remplir tous les champs du formulaire.";
        exit();
    }
}

// Vérification de l'image (upload)
if (!empty($urlPhotArt)) {
    $uploadDir = 'src/uploads/';
    $uploadFile = $uploadDir . time() . '_' . basename($urlPhotArt);
    if (move_uploaded_file($_FILES['urlPhotArt']['tmp_name'], $uploadFile)) {
        $nom_image = basename($uploadFile); // Nom du fichier image
    } else {
        echo "Erreur lors du téléchargement de l'image.";
        exit();
    }
} else {
    // Si aucune image n'est téléchargée, laissez l'ancienne image ou définissez-en une valeur par défaut
    $nom_image = '';  // Par exemple, vous pouvez garder l'ancienne image si elle existe
}

// Préparer les données pour la mise à jour dans la base
$set_art = "dtMajArt = '$dtMajArt',
            libTitrArt = '$libTitrArt',
            libChapoArt = '$libChapoArt',
            libAccrochArt = '$libAccrochArt',
            parag1Art = '$parag1Art',
            libSsTitr1Art = '$libSsTitr1Art',
            parag2Art = '$parag2Art',
            libSsTitr2Art = '$libSsTitr2Art',
            parag3Art = '$parag3Art',
            libConclArt = '$libConclArt',
            urlPhotArt = '$nom_image',
            numThem = '$numThem'";

$where_num = "numArt = '$numArt'";
$table_art = "ARTICLE";

// Mise à jour des informations dans la table ARTICLE
sql_update($table_art, $set_art, $where_num);

// Suppression des anciens mots-clés associés à l'article
sql_delete('MOTCLEARTICLE', $where_num);

// Ajout des nouveaux mots-clés pour l'article
foreach ($numMotCle as $mot) {
    sql_insert('MOTCLEARTICLE', 'numArt, numMotCle', "$numArt, $mot");
}

// Redirection vers la liste des articles
header('Location: ../../views/backend/articles/list.php');
exit();  // Terminer l'exécution du script après la redirection
?>

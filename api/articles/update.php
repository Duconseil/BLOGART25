<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

// Fonction BBCode
function BBCode($text) {
    $search = [
        '/\[b\](.*?)\[\/b\]/is',
        '/\[i\](.*?)\[\/i\]/is',
        '/\[u\](.*?)\[\/u\]/is',
        '/\[url=(.*?)\](.*?)\[\/url\]/is',
        '/\[img\](.*?)\[\/img\]/is'
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

// Vérification et sécurisation des données POST
$dtCreaArt = ctrlSaisies($_POST['dtCreaArt'] ?? '');
$dtMajArt = date("Y-m-d H:i:s");
$libTitrArt = ctrlSaisies($_POST['libTitrArt'] ?? '');
$libChapoArt = ctrlSaisies($_POST['libChapoArt'] ?? '');
$libAccrochArt = ctrlSaisies($_POST['libAccrochArt'] ?? '');
$parag1Art = BBCode(ctrlSaisies($_POST['parag1Art'] ?? ''));
$libSsTitr1Art = ctrlSaisies($_POST['libSsTitr1Art'] ?? '');
$parag2Art = BBCode(ctrlSaisies($_POST['parag2Art'] ?? ''));
$libSsTitr2Art = ctrlSaisies($_POST['libSsTitr2Art'] ?? '');
$parag3Art = BBCode(ctrlSaisies($_POST['parag3Art'] ?? ''));
$libConclArt = ctrlSaisies($_POST['libConclArt'] ?? '');
$numArt = ctrlSaisies($_POST['numArt'] ?? '');
$numThem = ctrlSaisies($_POST['numThem'] ?? '');
$numMotCle = $_POST['motCle'] ?? [];

// Vérification et gestion du fichier image
$nom_image = '';
if (!empty($_FILES['urlPhotArt']['name'])) {
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/src/uploads/';
    $fileName = time() . '_' . basename($_FILES['urlPhotArt']['name']);
    $uploadFile = $uploadDir . $fileName;
    
    if (move_uploaded_file($_FILES['urlPhotArt']['tmp_name'], $uploadFile)) {
        $nom_image = $fileName;
    } else {
        echo "Erreur lors du téléchargement de l'image.";
        exit();
    }
}

// Préparation de la requête SQL
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
            numThem = '$numThem'";

if (!empty($nom_image)) {
    $set_art .= ", urlPhotArt = '$nom_image'";
}

$where_num = "numArt = '$numArt'";
$table_art = "ARTICLE";

// Mise à jour des informations de l'article
sql_update($table_art, $set_art, $where_num);

// Suppression des anciens mots-clés associés à l'article
sql_delete('MOTCLEARTICLE', $where_num);

// Ajout des nouveaux mots-clés pour l'article
foreach ($numMotCle as $mot) {
    sql_insert('MOTCLEARTICLE', 'numArt, numMotCle', "$numArt, $mot");
}

// Redirection après mise à jour
header('Location: ../../views/backend/articles/list.php');
exit();

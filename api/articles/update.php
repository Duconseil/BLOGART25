<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Inclus les configurations
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
// Fonction pour obtenir les données de la requête et les sécuriser
function getPostData($keys) {
    $data = [];
    foreach ($keys as $key) {
        if (isset($_POST[$key])) {
            $data[$key] = addslashes($_POST[$key]);
        }
    }
    return $data;
}

// Fonction pour gérer le téléchargement de l'image
function handleFileUpload($numArt) {
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/src/uploads/';
    $ancienneImage = sql_select("ARTICLE", "urlPhotArt", "numArt = $numArt")[0]['urlPhotArt'];

    if (isset($_FILES['urlPhotArt']) && $_FILES['urlPhotArt']['error'] == UPLOAD_ERR_OK) {
        $urlPhotArt = $_FILES['urlPhotArt']['name'];
        $uploadPath = $uploadDir . $urlPhotArt;

        // Vérification du type de fichier pour éviter l'upload de fichiers malveillants
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['urlPhotArt']['type'], $allowedTypes)) {
            if (move_uploaded_file($_FILES['urlPhotArt']['tmp_name'], $uploadPath)) {
                if (!empty($ancienneImage)) {
                    unlink($uploadDir . $ancienneImage);
                }
                return $urlPhotArt; // Retourne le nom de l'image téléchargée
            } else {
                // Gestion des erreurs d'upload
                die('Erreur lors de l\'upload du fichier');
            }
        } else {
            die('Le fichier téléchargé n\'est pas un type autorisé.');
        }
    }
    return null; // Aucun fichier téléchargé
}

// Fonction pour mettre à jour l'article dans la base de données
function updateArticle($numArt, $data, $urlPhotArt) {
    $dtMajArt = date("Y-m-d H:i:s");
    sql_update('ARTICLE', 
        "`dtMajArt`='$dtMajArt', 
            `libTitrArt`='{$data['libTitrArt']}', 
            `libChapoArt`='{$data['libChapoArt']}', 
            `libAccrochArt`='{$data['libAccrochArt']}', 
            `parag1Art`='{$data['parag1Art']}', 
            `libSsTitr1Art`='{$data['libSsTitr1Art']}', 
            `parag2Art`='{$data['parag2Art']}', 
            `libSsTitr2Art`='{$data['libSsTitr2Art']}', 
            `parag3Art`='{$data['parag3Art']}', 
            `libConclArt`='{$data['libConclArt']}', 
            `urlPhotArt`='$urlPhotArt', 
            `numThem`='{$data['numThem']}'", 
        "numArt = $numArt"
    );
}

// Récupérer les données
$numArt = addslashes($_GET['numArt']);
$data = getPostData(['libTitrArt', 'libChapoArt', 'libAccrochArt', 'parag1Art', 'libSsTitr1Art', 'parag2Art', 'libSsTitr2Art', 'parag3Art', 'libConclArt', 'numThem']);

// Gestion du téléchargement de l'image
$urlPhotArt = handleFileUpload($numArt);

// Mise à jour de l'article dans la base de données
updateArticle($numArt, $data, $urlPhotArt);

// Redirection après la mise à jour
header('Location: ../../views/backend/articles/list.php');
exit();

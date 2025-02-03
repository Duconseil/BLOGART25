<?php

// Inclusions des fichiers nécessaires
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

// Connexion à la base de données avec les constantes définies
try {
    $pdo = new PDO("mysql:host=" . SQL_HOST . ";dbname=" . SQL_DB, SQL_USER, SQL_PWD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Insertion dans la table ARTICLE
$sql = "INSERT INTO ARTICLE (libTitrArt, libChapoArt, libAccrochArt, parag1Art, libSsTitr1Art, parag2Art, libSsTitr2Art, parag3Art, libConclArt, numThem, urlPhotArt) 
        VALUES (:libTitrArt, :libChapoArt, :libAccrochArt, :parag1Art, :libSsTitr1Art, :parag2Art, :libSsTitr2Art, :parag3Art, :libConclArt, :numThem, :urlPhotArt)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':libTitrArt' => $libTitrArt,
    ':libChapoArt' => $libChapoArt,
    ':libAccrochArt' => $libAccrochArt,
    ':parag1Art' => $parag1Art,
    ':libSsTitr1Art' => $libSsTitr1Art,
    ':parag2Art' => $parag2Art,
    ':libSsTitr2Art' => $libSsTitr2Art,
    ':parag3Art' => $parag3Art,
    ':libConclArt' => $libConclArt,
    ':numThem' => $numThem,
    ':urlPhotArt' => $urlPhotArt
]);

// Récupérer l'ID de l'article inséré pour l'utiliser dans l'insertion des mots-clés
$lastArt = $pdo->lastInsertId();

// Insertion des mots-clés liés à l'article
if (!empty($numMotCle)) {
    foreach ($numMotCle as $mot) {
        $stmt = $pdo->prepare("INSERT INTO MOTCLEARTICLE (numArt, numMotCle) VALUES (:numArt, :numMotCle)");
        $stmt->execute([
            ':numArt' => $lastArt,
            ':numMotCle' => $mot
        ]);
    }
}

// Redirection après l'insertion
header('Location: ../../views/backend/articles/list.php');
exit();

?>

<?php
// Inclure le fichier de configuration (si défini ailleurs)
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php'; // À ajuster si nécessaire
require_once '../../functions/ctrlSaisies.php';

// Connexion à la base de données avec PDO
try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=" . SQL_HOST . ";dbname=" . SQL_DB, SQL_USER, SQL_PWD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Activer le mode d'erreur PDO
} catch (PDOException $e) {
    echo "Connexion échouée: " . $e->getMessage();
    exit();
}

// Récupérer les champs du formulaire
$dtCreaArt = ctrlSaisies($_POST['dtCreaArt']);
$dtMajArt = date("Y-m-d H:i:s");  // Date de mise à jour (actuelle)
$libTitrArt = ctrlSaisies($_POST['libTitrArt']);
$libChapoArt = ctrlSaisies($_POST['libChapoArt']);
$libAccrochArt = ctrlSaisies($_POST['libAccrochArt']);
$parag1Art = htmlspecialchars(ctrlSaisies($_POST['parag1Art']));  // Traitement HTML pour éviter les injections
$parag2Art = htmlspecialchars(ctrlSaisies($_POST['parag2Art']));
$parag3Art = htmlspecialchars(ctrlSaisies($_POST['parag3Art']));
$libSsTitr1Art = ctrlSaisies($_POST['libSsTitr1Art']);
$libSsTitr2Art = ctrlSaisies($_POST['libSsTitr2Art']);
$libConclArt = htmlspecialchars(ctrlSaisies($_POST['libConclArt']));  // Traitement HTML pour éviter les injections

// Vérification de la photo
$urlPhotArt = $_FILES['urlPhotArt']['name'];  // Nom du fichier photo téléchargé

// Récupérer les mots-clés
$newMotCle = isset($_POST['motCle']) ? $_POST['motCle'] : [];  // Récupération des mots-clés, vérification si le champ est vide

// Vérification que tous les champs obligatoires sont remplis
$requiredFields = ['libTitrArt', 'dtCreaArt', 'libChapoArt', 'libAccrochArt', 'parag1Art', 'libSsTitr1Art', 'parag2Art', 'libSsTitr2Art', 'parag3Art', 'libConclArt', 'urlPhotArt'];
foreach ($requiredFields as $field) {
    if (empty($_POST[$field]) && !isset($_FILES[$field])) {
        echo "Veuillez remplir tous les champs du formulaire.";
        exit();
    }
}

// Vérification de la sélection des mots-clés
if (empty($newMotCle)) {
    echo "Veuillez sélectionner des mots-clés pour l'article.";
    exit();
}

// Vérification du fichier photo (taille et type)
if ($_FILES['urlPhotArt']['error'] !== 0) {
    echo "Une erreur est survenue lors du téléchargement de l'image.";
    exit();
}

if ($_FILES['urlPhotArt']['size'] > 10000000) {  // Limite à 10 Mo
    echo "Le fichier est trop volumineux.";
    exit();
}

list($width, $height) = getimagesize($_FILES['urlPhotArt']['tmp_name']);
if ($width > 5000 || $height > 5000) {  // Limite de taille pour l'image
    echo "L'image est trop grande.";
    exit();
}

// Déplacer l'image téléchargée dans le dossier "uploads"
$nom_image = time() . '_' . $_FILES['urlPhotArt']['name'];
move_uploaded_file($_FILES['urlPhotArt']['tmp_name'], 'src/uploads/' . $nom_image);

// Récupération du numéro de thématique (catégorie)
$numThem = ctrlSaisies($_POST['numThem']);

// Préparer la requête d'insertion dans la table ARTICLE
$sql = "INSERT INTO ARTICLE (dtCreaArt, dtMajArt, libTitrArt, libChapoArt, libAccrochArt, parag1Art, libSsTitr1Art, parag2Art, libSsTitr2Art, parag3Art, libConclArt, urlPhotArt, numThem) 
        VALUES (:dtCreaArt, :dtMajArt, :libTitrArt, :libChapoArt, :libAccrochArt, :parag1Art, :libSsTitr1Art, :parag2Art, :libSsTitr2Art, :parag3Art, :libConclArt, :urlPhotArt, :numThem)";

// Préparer la déclaration SQL
$stmt = $pdo->prepare($sql);

// Lier les paramètres aux valeurs correspondantes
$stmt->bindParam(':dtCreaArt', $dtCreaArt);
$stmt->bindParam(':dtMajArt', $dtMajArt);
$stmt->bindParam(':libTitrArt', $libTitrArt);
$stmt->bindParam(':libChapoArt', $libChapoArt);
$stmt->bindParam(':libAccrochArt', $libAccrochArt);
$stmt->bindParam(':parag1Art', $parag1Art);
$stmt->bindParam(':libSsTitr1Art', $libSsTitr1Art);
$stmt->bindParam(':parag2Art', $parag2Art);
$stmt->bindParam(':libSsTitr2Art', $libSsTitr2Art);
$stmt->bindParam(':parag3Art', $parag3Art);
$stmt->bindParam(':libConclArt', $libConclArt);
$stmt->bindParam(':urlPhotArt', $nom_image);
$stmt->bindParam(':numThem', $numThem);

// Exécuter la requête
$stmt->execute();

// Récupérer l'ID de l'article inséré
$lastArt = $pdo->lastInsertId();

// Lier les mots-clés à l'article
foreach ($newMotCle as $mot) {
    $sqlMotCle = "INSERT INTO MOTCLEARTICLE (numArt, numMotCle) VALUES (:numArt, :numMotCle)";
    $stmtMotCle = $pdo->prepare($sqlMotCle);
    $stmtMotCle->bindParam(':numArt', $lastArt);
    $stmtMotCle->bindParam(':numMotCle', $mot);
    $stmtMotCle->execute();
}

// Rediriger l'utilisateur vers la page de la liste des articles
header('Location: ../../views/backend/articles/list.php');
exit();
?>

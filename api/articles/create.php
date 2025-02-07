<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php'; 
require_once '../../functions/ctrlSaisies.php';

try {
    $pdo = new PDO("mysql:host=" . SQL_HOST . ";dbname=" . SQL_DB, SQL_USER, SQL_PWD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Activer le mode d'erreur PDO
} catch (PDOException $e) {
    echo "Connexion échouée: " . $e->getMessage();
    exit();
}

$dtCreaArt = ctrlSaisies($_POST['dtCreaArt']);
$dtMajArt = date("Y-m-d H:i:s");  
$libTitrArt = ctrlSaisies($_POST['libTitrArt']);
$libChapoArt = ctrlSaisies($_POST['libChapoArt']);
$libAccrochArt = ctrlSaisies($_POST['libAccrochArt']);
$parag1Art = htmlspecialchars(ctrlSaisies($_POST['parag1Art']));  
$parag2Art = htmlspecialchars(ctrlSaisies($_POST['parag2Art']));
$parag3Art = htmlspecialchars(ctrlSaisies($_POST['parag3Art']));
$libSsTitr1Art = ctrlSaisies($_POST['libSsTitr1Art']);
$libSsTitr2Art = ctrlSaisies($_POST['libSsTitr2Art']);
$libConclArt = htmlspecialchars(ctrlSaisies($_POST['libConclArt']));  


$urlPhotArt = $_FILES['urlPhotArt']['name'];  


$newMotCle = isset($_POST['motCle']) ? $_POST['motCle'] : [];  


$requiredFields = ['libTitrArt', 'dtCreaArt', 'libChapoArt', 'libAccrochArt', 'parag1Art', 'libSsTitr1Art', 'parag2Art', 'libSsTitr2Art', 'parag3Art', 'libConclArt', 'urlPhotArt'];
foreach ($requiredFields as $field) {
    if (empty($_POST[$field]) && !isset($_FILES[$field])) {
        echo "Veuillez remplir tous les champs du formulaire.";
        exit();
    }
}


if (empty($newMotCle)) {
    echo "Veuillez sélectionner des mots-clés pour l'article.";
    exit();
}


if ($_FILES['urlPhotArt']['error'] !== 0) {
    echo "Une erreur est survenue lors du téléchargement de l'image.";
    exit();
}

if ($_FILES['urlPhotArt']['size'] > 10000000) {  
    echo "Le fichier est trop volumineux.";
    exit();
}

list($width, $height) = getimagesize($_FILES['urlPhotArt']['tmp_name']);
if ($width > 5000 || $height > 5000) {  
    echo "L'image est trop grande.";
    exit();
}

$nom_image = time() . '_' . $_FILES['urlPhotArt']['name'];
move_uploaded_file($_FILES['urlPhotArt']['tmp_name'], 'src/uploads/' . $nom_image);

$numThem = ctrlSaisies($_POST['numThem']);

$sql = "INSERT INTO ARTICLE (dtCreaArt, dtMajArt, libTitrArt, libChapoArt, libAccrochArt, parag1Art, libSsTitr1Art, parag2Art, libSsTitr2Art, parag3Art, libConclArt, urlPhotArt, numThem) 
        VALUES (:dtCreaArt, :dtMajArt, :libTitrArt, :libChapoArt, :libAccrochArt, :parag1Art, :libSsTitr1Art, :parag2Art, :libSsTitr2Art, :parag3Art, :libConclArt, :urlPhotArt, :numThem)";

$stmt = $pdo->prepare($sql);

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

$stmt->execute();

$lastArt = $pdo->lastInsertId();

foreach ($newMotCle as $mot) {
    $sqlMotCle = "INSERT INTO MOTCLEARTICLE (numArt, numMotCle) VALUES (:numArt, :numMotCle)";
    $stmtMotCle = $pdo->prepare($sqlMotCle);
    $stmtMotCle->bindParam(':numArt', $lastArt);
    $stmtMotCle->bindParam(':numMotCle', $mot);
    $stmtMotCle->execute();
}

header('Location: ../../views/backend/articles/list.php');
exit();
?>

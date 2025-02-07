<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

session_start();
if (!isset($_SESSION['id'])) {
    die("Erreur : Vous devez être connecté pour effectuer cette action.");
}

if (isset($_POST['numArt']) && isset($_POST['libCom'])) {
    $numMemb = $_SESSION['id']; 
    $numArt = intval($_POST['numArt']); 
    $libCom = ctrlSaisies($_POST['libCom']); 

    if ($numArt <= 0) {
        die("Erreur: numArt doit être un entier valide.");
    }

    $dtCreaCom = date("Y-m-d H:i:s"); 

    try {
        $dsn = "mysql:host=" . SQL_HOST . ";dbname=" . SQL_DB . ";charset=utf8";
        $pdo = new PDO($dsn, SQL_USER, SQL_PWD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

        $stmt = $pdo->prepare("INSERT INTO COMMENT (dtCreaCom, libCom, numArt, numMemb) VALUES (:dtCreaCom, :libCom, :numArt, :numMemb)");
        $stmt->bindParam(':dtCreaCom', $dtCreaCom);
        $stmt->bindParam(':libCom', $libCom);
        $stmt->bindParam(':numArt', $numArt);
        $stmt->bindParam(':numMemb', $numMemb);

        $stmt->execute();

        header('Location: ../../views/backend/comments/list.php');
        exit;

    } catch (PDOException $e) {
        die("Erreur lors de l'insertion du commentaire : " . $e->getMessage());
    }
} else {
    die("Erreur : Les paramètres numArt et libCom sont requis.");
}

?>

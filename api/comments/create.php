<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

// Vérification de la session (si l'utilisateur est connecté)
session_start();
if (!isset($_SESSION['id'])) {
    die("Erreur : Vous devez être connecté pour effectuer cette action.");
}

// Vérification que les clés 'numArt' et 'libCom' existent dans $_POST
if (isset($_POST['numArt']) && isset($_POST['libCom'])) {
    // Récupérer l'ID de l'utilisateur connecté
    $numMemb = $_SESSION['id']; // L'ID du membre connecté
    $numArt = intval($_POST['numArt']); // L'ID de l'article
    $libCom = ctrlSaisies($_POST['libCom']); // Commentaire nettoyé

    // Vérification que numArt est un entier valide
    if ($numArt <= 0) {
        die("Erreur: numArt doit être un entier valide.");
    }

    // Récupérer la date de création du commentaire
    $dtCreaCom = date("Y-m-d H:i:s"); // Format date valide

    try {
        // Connexion à la base de données via PDO
        $dsn = "mysql:host=" . SQL_HOST . ";dbname=" . SQL_DB . ";charset=utf8";
        $pdo = new PDO($dsn, SQL_USER, SQL_PWD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

        // Insertion dans la base de données
        $stmt = $pdo->prepare("INSERT INTO COMMENT (dtCreaCom, libCom, numArt, numMemb) VALUES (:dtCreaCom, :libCom, :numArt, :numMemb)");
        $stmt->bindParam(':dtCreaCom', $dtCreaCom);
        $stmt->bindParam(':libCom', $libCom);
        $stmt->bindParam(':numArt', $numArt);
        $stmt->bindParam(':numMemb', $numMemb);

        // Exécution de la requête d'insertion
        $stmt->execute();

        // Redirection vers la liste des commentaires
        header('Location: ../../views/backend/comments/list.php');
        exit;

    } catch (PDOException $e) {
        // Gérer l'erreur en cas de problème avec l'insertion
        die("Erreur lors de l'insertion du commentaire : " . $e->getMessage());
    }
} else {
    // Si les paramètres numArt ou libCom ne sont pas définis, afficher une erreur
    die("Erreur : Les paramètres numArt et libCom sont requis.");
}

?>

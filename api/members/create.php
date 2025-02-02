<?php
header('Content-Type: application/json');

// Inclure la configuration et les fonctions nécessaires
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

// Vérifier si la requête est en POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données JSON envoyées
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (isset($data['pseudo'], $data['prenom'], $data['nom'], $data['password'], $data['email'])) {
        
        // Validation mot de passe
        $password = $data['password'];
        if (strlen($password) >= 8 && strlen($password) <= 15 && preg_match('/[A-Z]/', $password) && preg_match('/[a-z]/', $password) && preg_match('/\d/', $password) && preg_match('/[^a-zA-Z\d]/', $password)) {
            
            // Connexion à la base de données
            $conn = new mysqli("localhost", "username", "password", "database_name"); // Remplacez par vos informations
            if ($conn->connect_error) {
                echo json_encode(['status' => 'error', 'message' => 'Erreur de connexion à la base de données']);
                exit;
            }

            // Hachage du mot de passe
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Préparer l'insertion des données pour éviter les injections SQL
            $stmt = $conn->prepare("INSERT INTO membre (pseudoMemb, prenomMemb, nomMemb, passMemb, eMailMemb) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $data['pseudo'], $data['prenom'], $data['nom'], $hashedPassword, $data['email']);

            // Exécuter la requête
            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Membre créé avec succès']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Erreur lors de la création du membre']);
            }

            // Fermer la connexion
            $stmt->close();
            $conn->close();
            
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Mot de passe invalide']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Données manquantes']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Méthode non autorisée']);
}
?>

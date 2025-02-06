<?php
include '../../../header.php';
require_once '../../../config.php'; // Assurez-vous que ce fichier est bien inclus

// Vérifier si les constantes SQL sont définies
if (!defined('SQL_HOST') || !defined('SQL_USER') || !defined('SQL_PWD') || !defined('SQL_DB')) {
    die("Erreur : Les constantes de connexion à la base de données ne sont pas définies dans config.php.");
}

// Création de la chaîne de connexion DSN pour PDO
$dsn = "mysql:host=" . SQL_HOST . ";dbname=" . SQL_DB . ";charset=utf8";

try {
    // Connexion à la base de données
    $pdo = new PDO($dsn, SQL_USER, SQL_PWD, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    // Récupération des articles
    $stmt = $pdo->prepare("SELECT numArt, libTitrArt FROM article ORDER BY dtCreaArt DESC");
    $stmt->execute();
    $articles = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Vérification de l'ID d'article si présent pour afficher les commentaires spécifiques
$articleTitle = 'Choisissez un article';
$articleId = isset($_GET['numArt']) ? (int)$_GET['numArt'] : 0;

// Récupération des commentaires en attente de validation pour l'article spécifique
$comments = [];
if ($articleId > 0) {
    try {
        $stmt = $pdo->prepare("SELECT c.libCom, c.dtCreCom, m.pseudo, c.status 
                                FROM commentaire c
                                JOIN membre m ON c.numMemb = m.numMemb
                                WHERE c.numArt = :numArt AND c.status = 'en attente'
                                ORDER BY c.dtCreCom DESC");
        $stmt->bindParam(':numArt', $articleId, PDO::PARAM_INT);
        $stmt->execute();
        $comments = $stmt->fetchAll();
        
        // Récupération du titre de l'article pour l'affichage
        $stmt = $pdo->prepare("SELECT libTitrArt FROM article WHERE numArt = :numArt");
        $stmt->bindParam(':numArt', $articleId, PDO::PARAM_INT);
        $stmt->execute();
        $articleTitle = $stmt->fetchColumn();
    } catch (PDOException $e) {
        echo "<p>Erreur lors de la récupération des commentaires.</p>";
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Création d'un nouveau commentaire</h1>
        </div>
        <div class="col-md-12">
            <!-- Formulaire pour créer un commentaire -->
            <form action="<?php echo ROOT_URL . '/api/comments/create.php'; ?>" method="post">
                <div class="form-group">
                    <label for="pseudo">Pseudo</label>
                    <input id="pseudo" name="pseudo" class="form-control" type="text" required />
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input id="prenom" name="prenom" class="form-control" type="text" required />
                </div>
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input id="nom" name="nom" class="form-control" type="text" required />
                </div>
                <div class="form-group">
                    <label for="numArt">Article</label>
                    <select id="numArt" name="numArt" class="form-control" required>
                        <option value="" disabled selected>- - - Choisissez l'article à commenter - - -</option>
                        <?php 
                        foreach ($articles as $article) {
                            echo "<option value=\"{$article['numArt']}\">{$article['libTitrArt']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="libCom">Commentaires</label>
                    <textarea id="libCom" name="libCom" class="form-control" rows="4" required></textarea>
                </div>
                <br />
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">List</a>
                    <button type="submit" class="btn btn-success">Confirmer la création</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Affichage des commentaires de l'article sélectionné -->
<div class="container mt-4">
    <h3>Commentaires de l'Article : <?php echo htmlspecialchars($articleTitle); ?></h3>
    <div class="list-group">
        <?php
        if (count($comments) > 0) {
            foreach ($comments as $comment) {
                echo "<div class=\"list-group-item\">
                        <strong>{$comment['pseudo']}</strong> (En cours de validation)<br>
                        <span class=\"text-muted\">{$comment['dtCreCom']}</span><br>
                        <p>{$comment['libCom']}</p>
                        </div>";
            }
        } else {
            echo "<p>Aucun commentaire en attente de validation pour cet article.</p>";
        }
        ?>
    </div>
</div>

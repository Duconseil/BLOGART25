<?php
include '../../../header.php';
require_once '../../../config.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['pseudo'])) {
    echo "<p>Vous devez être connecté pour accéder à cette page.</p>";
    exit; 
} else {
    //echo "<p>Session active. ID utilisateur : " . $_SESSION['id'] . "</p>"; 
}

if (!defined('SQL_HOST') || !defined('SQL_USER') || !defined('SQL_PWD') || !defined('SQL_DB')) {
    die("Erreur : Les constantes de connexion à la base de données ne sont pas définies dans config.php.");
}

$dsn = "mysql:host=" . SQL_HOST . ";dbname=" . SQL_DB . ";charset=utf8";

try {
    $pdo = new PDO($dsn, SQL_USER, SQL_PWD, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    $stmt = $pdo->prepare("SELECT numArt, libTitrArt FROM article ORDER BY dtCreaArt DESC");
    $stmt->execute();
    $articles = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

$articleTitle = 'Choisissez un article';
$articleId = isset($_GET['numArt']) ? (int)$_GET['numArt'] : 0;

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

$numMemb = $_SESSION['id']; 
try {
    $stmt = $pdo->prepare("SELECT pseudoMemb, prenomMemb, nomMemb FROM membre WHERE numMemb = :numMemb");
    $stmt->bindParam(':numMemb', $numMemb, PDO::PARAM_INT);
    $stmt->execute();
    $tablemembre = $stmt->fetch();
} catch (PDOException $e) {
    echo "<p>Erreur lors de la récupération des informations du membre.</p>";
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Création d'un nouveau commentaire</h1>
        </div>
        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/comments/create.php'; ?>" method="post">
                <input id="numMemb" name="numMemb" class="form-control" style="display: none;" value="<?php echo $numMemb ?>" readonly="readonly" type="text" autofocus="autofocus" />
                
                <label for="pseudoMemb">Pseudo</label>
                <input id="pseudoMemb" name="pseudoMemb" class="form-control" value="<?php echo htmlspecialchars($tablemembre['pseudoMemb']) ?>" readonly="readonly" type="text" />
                
                <label for="prenomMemb">Prénom</label>
                <input id="prenomMemb" name="prenomMemb" class="form-control" value="<?php echo htmlspecialchars($tablemembre['prenomMemb']) ?>" readonly="readonly" type="text" />
                
                <label for="nomMemb">Nom</label>
                <input id="nomMemb" name="nomMemb" class="form-control" value="<?php echo htmlspecialchars($tablemembre['nomMemb']) ?>" readonly="readonly" type="text" />
                
                <label class="h5" for="numArt">Liste des articles</label> <br>
                <select id="numArt" name="numArt">
                    <?php 
                    foreach ($articles as $article) {
                        echo "<option value='".$article['numArt']."'> ".$article['libTitrArt']."</option>";
                    }
                    ?>
                </select> <br>
                
                <div class="form-group">
                    <label for="libCom">Commentaires</label>
                    <textarea id="libCom" name="libCom" class="form-control" rows="4" required></textarea>
                </div>
                <br />
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">Liste</a>
                    <button type="submit" class="btn btn-success">Confirmer la création</button>
                </div>
            </form>
        </div>
    </div>
</div>



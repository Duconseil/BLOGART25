<?php
include '../../../header.php'; 

// Récupération de tous les articles à partir de la base de données
$articles = sql_select("article INNER JOIN thematique ON article.numThem = thematique.numThem", "*");

// Récupération des mots-clés associés aux articles
$motscles = sql_select(
    "motclearticle INNER JOIN motcle ON motclearticle.numMotCle = motcle.numMotCle",
    "motclearticle.numArt, motcle.libMotCle"
);

// Création d'un tableau associatif pour associer les mots-clés aux articles
$motscles_assoc = [];
foreach ($motscles as $motcle) {
    $motscles_assoc[$motcle['numArt']][] = $motcle['libMotCle'];
}
?>

<!-- Layout par défaut de Bootstrap pour afficher tous les articles dans une boucle foreach -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Articles</h1>
            <!-- Table Bootstrap pour afficher les données des articles -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <!-- En-têtes des colonnes de la table -->
                        <th>Id</th>
                        <th>Date</th>
                        <th>Titre</th>
                        <th>Chapeau</th>
                        <th>Accroche</th>
                        <th>Thématique</th>
                        <th>Mots-clés</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Boucle foreach pour afficher chaque article dans la table -->
                    <?php foreach ($articles as $article) { ?>
                        <tr>
                            <!-- Affichage des données des articles dans chaque ligne de la table -->
                            <td><?php echo ($article['numArt']); ?></td>
                            <td><?php echo ($article['dtCreaArt']); ?></td>
                            <td><?php echo ($article['libTitrArt']); ?></td>
                            <td><?php echo (substr($article['libChapoArt'], 0, 100) . '[...]'); // Affiche les 100 premiers caractères du chapeau ?></td>
                            <td><?php echo (substr($article['parag1Art'], 0, 150) . '[...]'); // Affiche les 150 premiers caractères du paragraphe 1 ?></td>
                            <td><?php echo ($article['libThem']); ?></td>
                            <td>
                                <?php 
                                    if (isset($motscles_assoc[$article['numArt']])) {
                                        echo implode(', ', array_map('htmlspecialchars', $motscles_assoc[$article['numArt']]));
                                    } else {
                                        echo 'Aucun';
                                    }
                                ?>
                            </td>
                            <!-- Affichage de l'image de l'article avec un chemin dynamique -->
                            <td><img src="<?php echo ROOT_URL . '/src/uploads/' . str_replace('.jpg', '.png', $article['urlPhotArt'])?>" alt="Description de l'image" style="max-width: 600px; height: auto;"></td>
                            <td>
                                <!-- Boutons d'action pour éditer ou supprimer un article -->
                                <a href="edit.php?numArt=<?php echo ($article['numArt']); ?>" class="btn btn-primary">Edit</a>
                                <a href="delete.php?numArt=<?php echo ($article['numArt']); ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <!-- Bouton pour créer un nouvel article -->
            <a href="create.php" class="btn btn-success">Create</a>
        </div>
    </div>
</div>

<br>

<?php
include '../../../footer.php'; 
?>

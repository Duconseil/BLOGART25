<?php
include '../../../header.php';

// Vérifie si l'ID de l'article est passé en paramètre via la méthode GET.
if (isset($_GET['numArt'])) {
    // Récupère l'ID de l'article depuis l'URL.
    $numArt = intval($_GET['numArt']);
    // Récupère les informations de l'article avec jointure sur la table THEMATIQUE.
    $articles = sql_select("ARTICLE A LEFT JOIN THEMATIQUE T ON A.numThem = T.numThem", "A.*, T.libThem", "A.numArt = $numArt");
    $article = $articles[0] ?? null;
}

// Suppression de l'article si la demande est reçue via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['numArt'])) {
        // Récupère l'ID de l'article depuis le formulaire
        $numArtToDelete = intval($_POST['numArt']);

        // Vérifier s'il y a des entrées dépendantes dans la table 'motclearticle'
        $relatedRows = sql_select('motclearticle', 'COUNT(*) as count', "numArt = $numArtToDelete");

        if ($relatedRows[0]['count'] > 0) {
            // Si des lignes dépendantes existent, afficher un message d'erreur
            $errorMessage = "Impossible de supprimer l'article car il est référencé dans le tableau 'motclearticle'.";
        } else {
            // Effectuer la suppression de l'article et des lignes dépendantes dans la table 'motclearticle'
            $deleteSuccessMotCle = sql_delete('motclearticle', "numArt = $numArtToDelete");

            if ($deleteSuccessMotCle) {
                // Effectuer la suppression de l'article dans la base de données
                $deleteSuccessArticle = sql_delete("ARTICLE", "numArt = $numArtToDelete");

                if ($deleteSuccessArticle) {
                    // Si la suppression est réussie, redirige vers la liste des articles
                    header("Location: list.php?message=Article supprimé avec succès");
                    exit;
                } else {
                    // Si la suppression échoue, affiche un message d'erreur
                    $errorMessage = "Erreur lors de la suppression de l'article.";
                }
            } else {
                // Si la suppression des lignes dépendantes échoue
                $errorMessage = "Erreur lors de la suppression des dépendances de l'article.";
            }
        }
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Suppression de l'article</h1>
        </div>
        <div class="col-md-12">
            <?php if ($article): ?>
            <form action="" method="post">
                <div class="form-group">
                    <input id="numArt" name="numArt" class="form-control" style="display: none" type="text" value="<?php echo htmlspecialchars($numArt); ?>" readonly />
                    <?php 
                    $fields = [
                        'dtCreaArt' => 'Date création',
                        'libTitrArt' => 'Titre',
                        'libChapoArt' => 'Chapeau',
                        'libAccrochArt' => 'Accroche',
                        'parag1Art' => 'Paragraphe 1',
                        'libSsTitr1Art' => 'Sous titre 1',
                        'parag2Art' => 'Paragraphe 2',
                        'libSsTitr2Art' => 'Sous titre 2',
                        'parag3Art' => 'Paragraphe 3',
                        'libConclArt' => 'Conclusion',
                        'libThem' => 'Thématique'
                    ];
                    foreach ($fields as $key => $label) {
                        $value = $article[$key] ?? 'Non défini';
                        echo "<label for='$key'>$label</label>";
                        echo "<input id='$key' name='$key' class='form-control' type='text' value='" . htmlspecialchars($value) . "' readonly />";
                    }
                    ?>
                    <label for="urlPhotArt">URL Photo</label>
                    <input id="urlPhotArt" name="urlPhotArt" class="form-control" type="text" value="../../../src/uploads/<?php echo isset($article['urlPhotArt']) ? htmlspecialchars(str_replace('jpg', 'png', $article['urlPhotArt'])) : 'Non défini'; ?>" readonly />
                </div>
                <br />
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">Annuler</a>
                    <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
                </div>
            </form>
            <?php else: ?>
                <p style="color:red">Article introuvable.</p>
            <?php endif; ?>
            <?php if (isset($errorMessage)): ?>
                <p style="color:red"><?php echo htmlspecialchars($errorMessage); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>

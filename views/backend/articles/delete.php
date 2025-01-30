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
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Suppression de l'article</h1>
        </div>
        <div class="col-md-12">
            <?php if ($article): ?>
            <form action="<?php echo ROOT_URL . '/api/articles/delete.php' ?>" method="post">
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
        </div>
    </div>
</div>

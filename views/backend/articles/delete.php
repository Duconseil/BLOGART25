<?php

include '../../../header.php';

$canDelete = true;
$message = "";

if (isset($_GET['numArt'])) {
    $numArt = intval($_GET['numArt']);
    $articles = sql_select("ARTICLE A LEFT JOIN THEMATIQUE T ON A.numThem = T.numThem", "A.*, T.libThem", "A.numArt = $numArt");
    $article = $articles[0] ?? null;

    $relatedRows = sql_select('motclearticle', 'COUNT(*) as count', "numArt = $numArt");
    if ($relatedRows[0]['count'] > 0) {
        $canDelete = false;
        $message = "Impossible de supprimer l'article : il est lié à des mots-clés. Veuillez supprimer ces associations avant de continuer.";
    }
} else {
    $article = null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $canDelete) {
    if (isset($_POST['numArt'])) {
        $numArtToDelete = intval($_POST['numArt']);
        $imagePath = sql_select("ARTICLE", "urlPhotArt", "numArt = $numArtToDelete")[0]['urlPhotArt'] ?? '';
        
        $deleteSuccessArticle = sql_delete("ARTICLE", "numArt = $numArtToDelete");
        
        if ($deleteSuccessArticle) {
            if (!empty($imagePath) && file_exists("../../../src/uploads/$imagePath")) {
                unlink("../../../src/uploads/$imagePath");
            }
            header("Location: list.php?message=Article supprimé avec succès");
            exit;
        } else {
            $errorMessage = "Erreur lors de la suppression de l'article.";
        }
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Suppression de l'article</h1>
        </div>
        <?php if (!empty($message)) : ?>
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert"> <?php echo $message; ?> </div>
            </div>
        <?php endif; ?>
        <div class="col-md-12">
            <?php if ($article): ?>
            <form action="" method="post">
                <div class="form-group">
                    <input id="numArt" name="numArt" class="form-control" type="hidden" value="<?php echo htmlspecialchars($numArt); ?>" />
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
                        echo "<input id='$key' name='$key' class='form-control' type='text' value='" . htmlspecialchars($value) . "' disabled />";
                    }
                    ?>
                    <label for="urlPhotArt">Image</label><br />
                    <img src="../../../src/uploads/<?php echo htmlspecialchars($article['urlPhotArt'] ?? ''); ?>" alt="Image de l'article" width="150" />
                </div>
                <br />
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">Annuler</a>
                    <button type="submit" class="btn btn-danger" <?php echo $canDelete ? '' : 'disabled'; ?>>Confirmer la suppression</button>
                </div>
            </form>
            <?php else: ?>
                <p style="color:red">Article introuvable.</p>
            <?php endif; ?>
            <?php if (isset($errorMessage)): ?>
                <p style="color:red"> <?php echo htmlspecialchars($errorMessage); ?> </p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
include '../../../footer.php';
?>

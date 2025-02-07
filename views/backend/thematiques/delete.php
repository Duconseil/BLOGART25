<?php
include '../../../header.php';

$numThem = null;
$libThem = '';
$isDeletable = true;

if (isset($_GET['numThem'])) {
    $numThem = $_GET['numThem'];
    
    $libThem = sql_select("THEMATIQUE", "libThem", "numThem = $numThem")[0]['libThem'];
    
    $articlesLinked = sql_select("ARTICLE", "COUNT(*) as count", "numThem = $numThem")[0]['count'];
    
    if ($articlesLinked > 0) {
        $isDeletable = false;
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Suppression Thématique</h1>
        </div>
        <div class="col-md-12">
            <?php if (!$isDeletable): ?>
                <div class="alert alert-danger" role="alert">
                    Suppression impossible : cette thématique est liée à des articles. Veuillez supprimer les articles associés avant de continuer.
                </div>
            <?php endif; ?>

            <form action="<?php echo ROOT_URL . '/api/thematiques/delete.php' ?>" method="post">
                <div class="form-group">
                    <label for="libThem">Nom de la Thématique</label>
                    <input id="numThem" name="numThem" class="form-control" style="display: none" type="text" value="<?php echo htmlspecialchars($numThem); ?>" readonly="readonly" />
                    <input id="libThem" name="libThem" class="form-control" type="text" value="<?php echo htmlspecialchars($libThem); ?>" readonly="readonly" />
                </div>
                <br />
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">List</a>
                    <button type="submit" class="btn btn-danger" <?php echo !$isDeletable ? 'disabled' : ''; ?>>
                        Confirmer delete ?
                    </button>
                </div>
                <div class="form-group mt-2">
                    <p style="color:red"><i><strong>Attention :</strong> La suppression de cette thématique sera définitive.</i></p>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

include '../../../header.php';
$delete = 0;
// Vérifie si le paramètre 'numThem' est présent dans l'URL
if (isset($_GET['numThem'])) {
    // Récupère le numéro de la thématique depuis l'URL
    $numThem = $_GET['numThem'];
    
    // Sélectionne le libellé de la thématique correspondant au numéro
    $libThem = sql_select("THEMATIQUE", "libThem", "numThem = $numThem")[0]['libThem'];

    // Vérifie si des articles sont associés à cette thématique
    $hasArticles = sql_select("ARTICLE", "COUNT(*) as count", "numThem = $numThem")[0]['count'];

    // Si des articles sont associés, la suppression est interdite (delete = 0), sinon elle est autorisée (delete = 1)
    $delete = ($hasArticles > 0) ? 0 : 1;
}
?>

<!-- Bootstrap form to delete a thématique -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Suppression Thématique</h1>
        </div>
        <div class="col-md-12">
            <!-- Form to delete a thématique -->
            <form action="<?php echo ROOT_URL . '/api/thematiques/delete.php' ?>" method="post">
                <div class="form-group">
                    <label for="libThem">Nom de la thématique</label>
                    <input id="numThem" name="numThem" class="form-control" style="display: none" type="text" value="<?php echo($numThem); ?>" readonly="readonly" />
                    <input id="libThem" name="libThem" class="form-control" type="text" value="<?php echo($libThem); ?>" readonly="readonly" disabled />
                </div>
                <br />
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">List</a>
                    <button type="submit" class="btn btn-danger">Confirmer delete ?</button>
                </div>
                <div class="form-group mt-2">
                    <!-- Message d'avertissement pour prévenir l'utilisateur de la suppression définitive -->
                    <p style="color:red"><i><strong>Attention : </strong>La suppression de cet article sera définitive.</i></p>
                </div>
            </form>
        </div>
    </div>
</div>

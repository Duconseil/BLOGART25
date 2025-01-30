<?php

include '../../../header.php';
$delete = 0;
// Vérifie si les paramètres 'numArt' et 'numMotCle' sont présents dans l'URL
if (isset($_GET['numArt']) && isset($_GET['numMotCle'])) {
    // Récupère les numéros de l'article et du mot clé depuis l'URL
    $numArt = $_GET['numArt'];
    $numMotCle = $_GET['numMotCle'];
    
    // Sélectionne le libellé du mot clé correspondant au numéro
    $libMotCle = sql_select("MOTCLEARTICLE", "libMotCle", "numMotCle = $numMotCle")[0]['libMotCle'];

    // Vérifie si des articles sont associés à ce mot clé
    $hasArticles = sql_select("MOTCLEARTICLE", "COUNT(*) as count", "numMotCle = $numMotCle")[0]['count'];

    // Si des articles sont associés, la suppression est interdite (delete = 0), sinon elle est autorisée (delete = 1)
    $delete = ($hasArticles > 0) ? 0 : 1;
}
?>

<!-- Bootstrap form to delete a keyword -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Suppression Mot Clé</h1>
        </div>
        <div class="col-md-12">
            <!-- Form to delete a keyword -->
            <form action="<?php echo ROOT_URL . '/api/motcles/delete.php' ?>" method="post">
                <div class="form-group">
                    <label for="libMotCle">Nom du mot clé</label>
                    <input id="numMotCle" name="numMotCle" class="form-control" style="display: none" type="text" value="<?php echo($numMotCle); ?>" readonly="readonly" />
                    <input id="libMotCle" name="libMotCle" class="form-control" type="text" value="<?php echo($libMotCle); ?>" readonly="readonly" disabled />
                </div>
                <br />
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">List</a>
                    <button type="submit" class="btn btn-danger">Confirmer delete ?</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include '../../../footer.php'; // contains the footer
?>

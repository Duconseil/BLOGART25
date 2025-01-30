<?php

include '../../../header.php';
$delete = 0;
// Vérifie si le paramètre 'numStat' est présent dans l'URL
if (isset($_GET['numStat'])) {
    // Récupère le numéro du statut depuis l'URL
    $numStat = $_GET['numStat'];
    
    // Sélectionne le libellé du statut correspondant au numéro
    $libStat = sql_select("STATUT", "libStat", "numStat = $numStat")[0]['libStat'];

    // Vérifie si des membres sont associés à ce statut
    $hasMembers = sql_select("MEMBRE", "COUNT(*) as count", "numStat = $numStat")[0]['count'];

    // Si des membres sont associés, la suppression est interdite (delete = 0), sinon elle est autorisée (delete = 1)
    $delete = ($hasMembers > 0) ? 0 : 1;
}
?>

<!-- Bootstrap form to create a new statut -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Suppression Statut</h1>
        </div>
        <div class="col-md-12">
            <!-- Form to create a new statut -->
            <form action="<?php echo ROOT_URL . '/api/statuts/delete.php' ?>" method="post">
                <div class="form-group">
                    <label for="libStat">Nom du statut</label>
                    <input id="numStat" name="numStat" class="form-control" style="display: none" type="text" value="<?php echo($numStat); ?>" readonly="readonly" />
                    <input id="libStat" name="libStat" class="form-control" type="text" value="<?php echo($libStat); ?>" readonly="readonly" disabled />
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

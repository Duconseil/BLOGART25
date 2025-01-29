<?php
include '../../../header.php';

if(isset($_GET['numMemb'])){
    $numMemb = $_GET['numMemb'];
    $nomMemb = sql_select("MEMBRE", "nomMemb", "numMemb = $numMemb")[0]['nomMemb'];
    $prenomMemb = sql_select("MEMBRE", "prenomMemb", "numMemb = $numMemb")[0]['prenomMemb'];
}
?>

<!-- Bootstrap form to delete a member -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Suppression Membre</h1>
        </div>
        <div class="col-md-12">
            <!-- Form to delete a member -->
            <form action="<?php echo ROOT_URL . '/api/members/delete.php' ?>" method="post">
                <div class="form-group">
                    <label for="nomMemb">Nom du membre</label>
                    <input id="numMemb" name="numMemb" class="form-control" style="display: none" type="text" value="<?php echo($numMemb); ?>" readonly="readonly" />
                    <input id="nomMemb" name="nomMemb" class="form-control" type="text" value="<?php echo($nomMemb); ?>" readonly="readonly" disabled />
                </div>
                <div class="form-group">
                    <label for="prenomMemb">Prénom du membre</label>
                    <input id="prenomMemb" name="prenomMemb" class="form-control" type="text" value="<?php echo($prenomMemb); ?>" readonly="readonly" disabled />
                </div>
                <br />
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">Annuler</a>
                    <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
                </div>
            </form>
        </div>
    </div>
</div>
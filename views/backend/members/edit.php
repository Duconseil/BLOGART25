<?php
include '../../../header.php';

if(isset($_GET['numMemb'])){
    $numMemb = $_GET['numMemb'];
    $members = sql_select("STATUT", "libStat", "numStat = $numStat")[0]['libStat'];
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Modification Membre</h1>
        </div>
        <div class="col-md-12">
            <!-- Form to update a member -->
            <form action="<?php echo ROOT_URL . '/api/statuts/update.php' ?>" method="post">
                <div class="form-group">
                    <input id="numMemb" name="numMemb" class="form-control" style="display: none" type="text" value="<?php echo($numMemb); ?>" readonly="readonly" />
                </div>
                <div class="form-group">
                    <label for="nomMemb">Nom</label>
                    <input id="nomMemb" name="nomMemb" class="form-control" type="text" value="<?php echo($nomMemb); ?>"/>
                </div>
                <div class="form-group">
                    <label for="prenomMemb">Prénom</label>
                    <input id="prenomMemb" name="prenomMemb" class="form-control" type="text" value="<?php echo ($prenomMemb); ?>"/>
                </div>
                <br />
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">List</a>
                    <button type="submit" class="btn btn-success">Confirmer update ?</button>
                </div>
            </form>
        </div>
    </div>
</div>
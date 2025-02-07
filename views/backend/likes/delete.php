<?php
include '../../../header.php';

if (isset($_GET['numMemb']) && isset($_GET['numArt'])) {
    $numMemb = $_GET['numMemb'];
    $numArt = $_GET['numArt'];
    $likeA = sql_select("LIKEART", "likeA", "numMemb = $numMemb AND numArt = $numArt")[0]['likeA'];
}
?>

<!-- Bootstrap form to delete a like -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="titre text-center">Modération Like : Suppression</h1>
        </div>
        <div class="col-md-12">
            <!-- Form to delete a like -->
            <form action="<?php echo ROOT_URL . '/api/likes/delete.php' ?>" method="post">

                <div class="form-group">
                    <label for="numArt">Numéro d'article</label>
                    <input id="numArt" name="numArt" class="form-control" style="display: none" type="text" value="<?php echo $numArt; ?>" readonly="readonly" />
                    <input id="numArt" name="numArt" class="form-control" type="text" value="<?php echo $numArt; ?>" disabled />
                </div>
                <br>

                <div class="form-group">
                    <label for="numMemb">Numéro Membre</label>
                    <input id="numMemb" name="numMemb" class="form-control" style="display: none" type="text" value="<?php echo $numMemb; ?>" readonly="readonly" />
                    <input id="numMemb" name="numMemb" class="form-control" type="text" value="<?php echo $numMemb; ?>" disabled />
                </div>
                <br>

                <div class="form-group">
                    <label for="likeA">Like/Dislike</label>
                    <input id="likeA" name="likeA" class="form-control" style="display: none" type="text" value="<?php echo $likeA; ?>" />
                    <input id="likeA" name="likeA" class="form-control" type="text" value="<?php echo ($likeA == 1 ? 'Like' : 'Dislike'); ?>" disabled />
                </div>
                <br>

                <div class="form-group">
                    <button type="submit" class="btn btn-danger">Confirmer la suppression ?</button>
                </div>
            </form>
        </div>
    </div>
</div>
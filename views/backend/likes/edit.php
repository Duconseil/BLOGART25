<?php
include '../../../header.php';

if (isset($_GET['numMemb']) && isset($_GET['numArt'])) {
    $numMemb = $_GET['numMemb'];
    $numArt = $_GET['numArt'];
    $likeA = sql_select("LIKEART", "likeA", "numMemb = $numMemb AND numArt = $numArt")[0]['likeA'];
}
?> 

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Modification Like</h1>
        </div>
        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/likes/update.php' ?>" method="post">
                <div class="form-group">
                    <label for="numArt">Numéro d'article</label>
                    <input id="numArt" name="numArt" class="form-control" style="display: none" type="text" value="<?php echo $numArt; ?>" />
                    <input id="numArt" name="numArt" class="form-control" type="text" value="<?php echo $numArt; ?>"  />
                </div>
                <br>

                <div class="form-group">
                    <label for="numMemb">Numéro Membre</label>
                    <input id="numMemb" name="numMemb" class="form-control" style="display: none" type="text" value="<?php echo $numMemb; ?>"  />
                    <input id="numMemb" name="numMemb" class="form-control" type="text" value="<?php echo $numMemb; ?>"  />
                </div>
                <br>

                <div class="form-group">
                    <label for="likeA">Like/Dislike</label>
                    <select id="likeA" name="likeA" class="form-control">
                        <option value="1" <?php echo ($likeA == 1 ? 'selected' : ''); ?>>Like</option>
                        <option value="0" <?php echo ($likeA == 0 ? 'selected' : ''); ?>>Dislike</option>
                    </select>
                </div>
                <br>

                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">Retour à la liste</a>
                    <button type="submit" class="btn btn-danger">Confirmer la modification ?</button>
                </div>
            </form>
        </div>
    </div>
</div>
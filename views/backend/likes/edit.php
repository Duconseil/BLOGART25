<?php
include '../../../header.php';

if (isset($_GET['numMemb'])) {
    $numMemb = $_GET['numMemb'];
    $likeInfo = sql_select("likeart", "*", "numMemb = $numMemb");
    
    // Récupérer les informations de l'article lié à ce like
    if (!empty($likeInfo)) {
        $numArt = $likeInfo[0]['numArt'];
        $numMemb = $likeInfo[0]['numMemb']; // numMemb 1 pour like, 0 pour unlike

        // Récupérer le nom du membre
        $membreInfo = sql_select("MEMBRE", "pseudoMemb", "numMemb = $numMemb");
        $membreNom = $membreInfo[0]['pseudoMemb'];

        // Récupérer le titre de l'article
        $articleInfo = sql_select("ARTICLE", "libTitrArt", "numArt = $numArt");
        $articleTitre = $articleInfo[0]['libTitrArt'];
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Modification Like</h1>
        </div>
        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/likes/create.php' ?>" method="post">
                <div class="form-group">
                    <label for="numMemb">Membre</label>
                    <input id="numMemb" name="numMemb" class="form-control" style="display: none" type="text" value="<?php echo ($numMemb); ?>" readonly="readonly" />
                    <input id="numMembDisplay" class="form-control" type="text" value="<?php echo $membreNom . ' (' . $numMemb . ')'; ?>" readonly="readonly"/>
                </div>
                
                <div class="form-group">
                    <label for="numArt">Article</label>
                    <input id="numArt" name="numArt" class="form-control" type="text" value="<?php echo $articleTitre; ?>" readonly="readonly"/>
                </div>

                <div class="form-group">
                    <label for="numMemb">Article (un)Liké ?</label>
                    <select id="numMemb" name="numMemb" class="form-control">
                        <option value="1" <?php echo ($numMemb == 1) ? 'selected' : ''; ?>>Like</option>
                        <option value="0" <?php echo ($numMemb == 0) ? 'selected' : ''; ?>>Unlike</option>
                    </select>
                </div>
                
                <br />
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">List</a>
                    <button type="submit" class="btn btn-danger">Confirmer changements ?</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include '../../../footer.php';
?>

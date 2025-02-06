<?php
include '../../../header.php';

if (isset($_GET['numCom'])) {
    $numCom = $_GET['numCom'];
    $dtCreaCom = sql_select("comment", "dtCreaCom", "numCom = $numCom")[0]['dtCreaCom'];
    $libCom = sql_select("comment", "libCom", "numCom = $numCom")[0]['libCom'];
    $dtModCom = sql_select("comment", "dtModCom", "numCom = $numCom")[0]['dtModCom'];
    $attModOK = sql_select("comment", "attModOK", "numCom = $numCom")[0]['attModOK'];
    $notifComKOAff = sql_select("comment", "notifComKOAff", "numCom = $numCom")[0]['notifComKOAff'];
    $dtDelLogCom = sql_select("comment", "dtDelLogCom", "numCom = $numCom")[0]['dtDelLogCom'];
    $delLogiq = sql_select("comment", "delLogiq", "numCom = $numCom")[0]['delLogiq'];
    $numArt = sql_select("comment", "numArt", "numCom = $numCom")[0]['numArt'];
    $numMemb = sql_select("comment", "numMemb", "numCom = $numCom")[0]['numMemb'];

    $pseudoMemb = sql_select("membre", "pseudoMemb", "numMemb = $numMemb")[0]['pseudoMemb'];
    $libTitrArt = sql_select("article", "libTitrArt", "numArt = $numArt")[0]['libTitrArt'];
    $parag1Art = sql_select("article", "parag1Art", "numArt = $numArt")[0]['parag1Art'];
}
?>

<!-- Bootstrap form to create a new statut -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <hr style="border-top: 10px solid #000000;">
            <h1 class="titre text-center">Contrôle commentaire en attente : à valider</h1>
            <hr style="border-top: 10px solid #000000;">
            <br>
        </div>
        <div class="col-md-12">
            <!-- Form to create a new statut -->
            <form action="<?php echo ROOT_URL . '/api/comments/update.php'; ?>" method="post">

                <div class="form-group">
                    <label for="libTitrArt"><h2>Titre de l'article</h2></label>
                    <input id="numCom" name="numCom" class="form-control" style="display: none" type="text" value="<?php echo ($numCom); ?>" readonly="readonly" />
                    <input id="libTitrArt" name="libTitrArt" class="form-control" type="text" value="<?php echo ($libTitrArt); ?>" readonly="readonly"/>
                </div>
                <br>

                <div class="form-group">
                    <label for="pseudoMemb"><h2>Information commentaire</h2></label>
                    <p><u>Nom d'utilisateur :</u></p>
                    <input id="pseudoMemb" name="pseudoMemb" class="form-control" type="text" value="<?php echo ($pseudoMemb); ?>" readonly="readonly" />
                    <br>
                    <p><u>Date de création :</u></p>
                    <input id="dtCreaCom" name="dtCreaCom" class="form-control" type="text" value="<?php echo ($dtCreaCom); ?>" readonly="readonly" />
                </div>
                <br>

                <div class="form-group">
                    <label for="libCom"><h2>Contenu du commentaire</h2></label>
                    <textarea id="libCom" name="libCom" class="form-control" rows="6" readonly="readonly"><?php echo ($libCom); ?></textarea>
                </div>
                <br>

                <div class="form-group">
                    <label for="attModOK"><h2>Validation du commentaire</h2></label> 
                    <br>
                    <label>
                        <input type="radio" name="attModOK" value="1" <?php echo ($attModOK == 1) ? 'checked' : ''; ?>> Valider le commentaire
                    </label>
                    <br>
                    <label>
                        <input type="radio" name="attModOK" value="0" <?php echo ($attModOK == 0) ? 'checked' : ''; ?>> Refuser le commentaire
                    </label>
                </div>
                <br>

                <div class="form-group">
                    <label for="notifComKOAff"><h2>Raison du refus</h2></label>
                    <p>A remplir seulement si le commentaire est refusé</p>
                    <textarea id="notifComKOAff" name="notifComKOAff" class="form-control" rows="10"><?php echo ($notifComKOAff); ?></textarea>
                </div>
                <br>
                <br>
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-outline-primary">List</a>
                    <button type="submit" class="btn btn-outline-warning">Envoie Control</button>
                </div>
            </form>
            <br>
            <br>
        </div>
    </div>
</div>

<?php
include '../../../header.php';

if(isset($_GET['numCom'])){
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
            <h1 >Modération commentaire : suppression logique</h1>
            <br>
        </div>
        <div class="col-md-12">
            <!-- Form to create a new statut -->
            <form action="<?php echo ROOT_URL . '/api/comments/update.php' ?>" method="post">

                <div class="form-group">
                    <label for="numArt">Numéro D'article</label>
                    <input id="numCom" name="numCom" class="form-control" style="display: none" type="text" value="<?php echo ($numCom); ?>" readonly="readonly" />
                    <input id="numArt" name="numArt" class="form-control" type="text" value="<?php echo ($numArt); ?>"/>
                </div>
                <br>

                <div class="form-group">
                    <label for="numCom">Numéro Commentaire</label>
                    <input id="numCom" name="numCom" class="form-control" style="display: none" type="text" value="<?php echo ($numCom); ?>" readonly="readonly" />
                    <input id="numCom" name="numCom" class="form-control" type="text" value="<?php echo ($numCom); ?>"/>
                </div>
                <br>

                <div class="form-group">
                    <label for="pseudoMemb">Pseudo Membre</label>
                    <input id="pseudoMemb" name="pseudoMemb" class="form-control" type="text" value="<?php echo ($pseudoMemb); ?>" readonly="readonly"/>
                </div>
                <br>

                <div class="form-group">
                    <label for="libTitrArt">Titre Article</label>
                    <input id="libTitrArt" name="libTitrArt" class="form-control" type="text" value="<?php echo ($libTitrArt); ?>" readonly="readonly"/>
                </div>
                <br>

                <div class="form-group">
                    <label for="parag1Art">Accroche paragraphe 1</label>
                    <input id="parag1Art" name="parag1Art" class="form-control" type="text" value="<?php echo ($parag1Art); ?>" readonly="readonly"/>
                </div>
                <br>

                <div class="form-group">
                    <label for="dtCreaCom">Date création commentaire</label>
                    <input id="dtCreaCom" name="dtCreaCom" class="form-control" type="text" value="<?php echo ($dtCreaCom); ?>" readonly="readonly"/>
                </div>
                <br>

                <div class="form-group">
                    <label for="dtModCom">Date modération commentaire</label>
                    <input id="dtModCom" name="dtModCom" class="form-control" type="text" value="<?php echo ($dtModCom); ?>" readonly="readonly"/>
                </div>
                <br>

                <div class="form-group">
                    <label for="libCom">Commentaire à valider/validé</label>
                    <textarea id="libCom" name="libCom" class="form-control" rows="10" readonly="readonly"><?php echo ($libCom); ?></textarea>
                </div>
                <br>

                <div class="form-group">
                    <label for="attModOK"><strong>En tant que modérateur, je valide le commentaire du membre :</strong></label>
                    <div>
                        <label>
                            <input type="radio" name="attModOK" value="1" <?php echo ($attModOK == 1) ? 'checked' : ''; ?>> Oui
                        </label>
                        <label>
                            <input type="radio" name="attModOK" value="0" <?php echo ($attModOK == 0) ? 'checked' : ''; ?>> Non
                        </label>
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <label for="notifComKOAff"><strong>Si non, en voici les raisons :</strong></label>
                    <textarea id="notifComKOAff" name="notifComKOAff" class="form-control" rows="10"><?php echo ($notifComKOAff); ?></textarea>
                    <p>Vous pouvez ajouter une notification de rejet du post (propos diffamatoires, injures, vulgarité,...)</p>
                </div>

                <div class="form-group">
                    <label for="delLogiq"><strong>En tant que modérateur, je souhaite que le post ne soit pas/plus affiché (suppression logique) :</strong></label>
                    <div>
                        <label>
                            <input type="radio" name="delLogiq" value="1" <?php echo ($delLogiq == 1) ? 'checked' : ''; ?>> Oui
                        </label>
                        <label>
                            <input type="radio" name="delLogiq" value="0" <?php echo ($delLogiq == 0) ? 'checked' : ''; ?>> Non
                        </label>
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <label for="dtDelLogCom">Date suppression logique</label>
                    <input id="dtDelLogCom" name="dtDelLogCom" class="form-control" type="text" value="<?php echo ($dtDelLogCom); ?>" readonly="readonly"/>
                </div>

                <br>
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">List</a>
                    <button type="submit" class="btn btn-warning" style="color: white;">Confirmer Edit ?</button>
                </div>
            </form>
            <br>
            <br>
        </div>
    </div>
</div>

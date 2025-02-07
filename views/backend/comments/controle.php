<?php
include '../../../header.php';

if(isset($_GET['numCom'])){
    $numCom = $_GET['numCom'];
    $tablecom = sql_select("comment", "*", "numCom = $numCom");
    $numMemb=$tablecom[0]['numMemb'];
    $tablemembre = sql_select("membre", "*", "numMemb = $numMemb");
    $tableart=sql_select("article", "*", "numArt = ".$tablecom[0]['numArt']);
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Contrôle commentaire en attente : à valider</h1><br>
        </div>
        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/comments/controle.php' ?>" method="post">
                <div class="form-group">
                <input id="numCom" name="numCom" class="form-control" style="display: none;" value="<?php echo $numCom ?>"readonly="readonly" type="text" autofocus="autofocus" />
                <label class="h3"for="libTitrArt">Titre de l'article</label>
                <input id="libTitrArt" name="libTitrArt" class="form-control" type="text" value="<?php echo($tableart[0]['libTitrArt']); ?>" readonly="readonly" />
                    
                    <br><label class="h3"for="Info">Informations commentaire</label> <br>
                    <label for="pseudoMemb">Nom d'utilisateur</label> <br>
                    <?php echo($tablemembre[0]['pseudoMemb']); ?><br><br>
                    <label for="DtCreaCom">Date de création du commentaire</label> <br>
                    <?php echo($tablecom[0]['dtCreaCom']); ?> <br>
                    <br>
                    <label class="h3"for="libCom">Contenu du commentaire</label>
                    <input id="libCom" name="libCom" class="form-control" type="text" readonly="readonly"value="<?php echo($tablecom[0]['libCom']); ?>" />
                    <label for="attModOK"><strong>En tant que modérateur, je valide le commentaire du membre :</strong></label> <br> <br>
                        <input type="radio" id="validoui"checked name="attModOK" value="1" />
                        <label for="validoui">Validation du commentaire</label> <br>
                        <input type="radio" id="validnon" name="attModOK" value="0" />
                        <label for="validnon">Refuser le commentaire</label><br> <br>
                    <label class="h3"for="notifComKOAff">Raison de refus:</label> <br>
                    <label for="notifComKOAff">(Seulement si commentaire refuser)</label><br>
                    <textarea id="notifComKOAff" name="notifComKOAff" rows="4" cols="50"></textarea> <br>
                </div>
                <br />
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">List</a>
                    <button type="submit" class="btn btn-warning" style="color: white;">Confirmer contrôle ?</button>
                </div>
            </form>
        </div>
    </div>
</div>
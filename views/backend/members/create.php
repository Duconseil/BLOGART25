<?php
include '../../../header.php';


if (isset($_GET['numCom'])){
    $numCom = $_GET['numCom'];
    $comment = sql_select('comment', '*', "numCom ='$numCom'")[0];
    $pseudoMemb = $comment['pseudoMemb'];
    $numArt = $comment['numArt'];
    $libCom = $comment['libCom'];
    } else {
    header('/index.php');
    }

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Création nouveau Membre</h1>
        </div>
        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/members/create.php' ?>" method="post" id="formCreate">
                <div class="form-group">
                    <label for="pseudoMemb">Pseudo du membre (non modifiable)</label>
                    <input id="pseudoMemb" name="pseudoMemb" class="form-control" type="text" autofocus="autofocus" />
                    <p>(entre 6 et 70 caractères)</p>
                    <label for="prenomMemb">Prénom du membre</label>
                    <input id="prenomMemb" name="prenomMemb" class="form-control" type="text" autofocus="autofocus" />
                    <label for="nomMemb">Nom du membre</label>
                    <input id="nomMemb" name="nomMemb" class="form-control" type="text" autofocus="autofocus" />
                    <label for="passMemb">Mot de passe du membre</label>
                    <input id="passMemb" name="passMemb" class="form-control" type="password" autofocus="autofocus" />
                    <p>(Entre 8 et 15 car., au - une majuscule, une minuscule, un chiffre, car. spéciaux acceptés)</p>
                    <button type="button" id="afficher"  class="btn btn-secondary">Afficher le mot de passe</button><br><br>
                    <label for="passMemb2">Confirmez mot de passe du membre</label>
                    <input id="passMemb2" name="passMemb2" class="form-control" type="password" autofocus="autofocus" />
                    <p>(Entre 8 et 15 car., au - une majuscule, une minuscule, un chiffre, car. spéciaux acceptés)</p>
                    <button type="button" id="afficher2" class="btn btn-secondary">Afficher le mot de passe</button><br><br>
                    <label for="eMailMemb">Email du membre</label>
                    <input id="eMailMemb" name="eMailMemb" class="form-control" type="text" autofocus="autofocus" />
                    <label for="eMailMemb2">Confirmez email du membre</label>
                    <input id="eMailMemb2" name="eMailMemb2" class="form-control" type="text" autofocus="autofocus" />
                    <label for="accordMemb">J'accepte que mes données soient conservées :</label>
                    <input type="radio" id="accordMemb" name="accordMemb" value="OUI" />
                    <label for="accordMemb">Oui</label>
                    <input type="radio" id="accordMemb" name="accordMemb" value="NON" checked />
                    <label for="accordMemb">Non</label>
                    <br><br>
                    <label for="numStat">Statut :</label>
                    <select name="numStat" id="numStat">
                        <option value="1" <?= ($numStat == 1) ? 'selected' : '' ?>>Administrateur</option>
                        <option value="2" <?= ($numStat == 2) ? 'selected' : '' ?>>Modérateur</option>
                        <option value="3" <?= ($numStat == 3) ? 'selected' : '' ?>>Membre</option>
                    </select>
                </div>
                <br />
                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary">Confirmer create ?</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById( 'afficher' ).addEventListener( "click", function() {

    attribut = document.getElementById( 'passMemb' ).getAttribute( 'type');
    if(attribut == 'password'){
        document.getElementById( 'passMemb' ).setAttribute( 'type', 'text');
    } else {
        document.getElementById( 'passMemb' ).setAttribute( 'type', 'password');
    }
    
});

document.getElementById( 'afficher2' ).addEventListener( "click", function() {

    attribut = document.getElementById( 'passMemb2' ).getAttribute( 'type');
    if(attribut == 'password'){
        document.getElementById( 'passMemb2' ).setAttribute( 'type', 'text');
    } else {
        document.getElementById( 'passMemb2' ).setAttribute( 'type', 'password');
    }

});



</script>
